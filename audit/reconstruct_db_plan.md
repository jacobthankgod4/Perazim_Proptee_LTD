# Reconstructing the Project Database — Atomic, File-by-File Microprocess Plan

This document describes an expert, repeatable, atomic procedure to reconstruct a working SQL database for the project from source code. The steps below assume you do not have a running DB dump; they show how to derive schema from code, validate it, create a clean schema, and iterate until the app works.

Prerequisites
- Access to the project workspace and ability to run local MySQL/MariaDB (or a dev container).
- Basic familiarity with SQL, `mysqldump`, `mysql` client, and Git.
- The `audit/reconstructed_schema.sql` included with this repo is a best-effort starting point.

Phases (atomic microprocesses)

Phase 0 — Discovery (atomic tasks)
- 0.1: Gather evidence: run targeted greps for table names and columns.
  - Commands:
    - `grep -R "FROM \|INSERT INTO \|UPDATE \|DELETE FROM \|JOIN \|ALTER TABLE" -n includes/ Administration/ public_html/ | sed -E 's/\s+/ /g' > audit/sql_references.txt`
    - `grep -rhoP "\b[A-Za-z0-9_]+\.(?:[A-Za-z0-9_]+)\b|\bINSERT INTO\s+\?\w+|\bFROM\s+\w+" -n .` (adapt as needed).
- 0.2: Parse references into a table -> columns mapping (atomic):
  - Use `awk`/Python to extract column identifiers referenced in `SELECT`/`WHERE`/`INSERT`/`UPDATE` statements.
  - Produce a CSV `audit/column_inventory.csv` with columns: file, table, column, context_line.

Phase 1 — Infer schema (atomic tasks per table)
- 1.1: For each table discovered, collect all column names from `column_inventory.csv`.
- 1.2: Choose types heuristically (atomic rules):
  - any column named `id`, `Id`, `Id_in`, or ending with `_id` -> `INT UNSIGNED` (candidate PK or FK)
  - names containing `email` -> `VARCHAR(255)`
  - names containing `date`, `time` -> `DATETIME`/`TIMESTAMP`
  - monetary fields (`price`, `cost`, `inv`, `amount`) -> `DECIMAL(20,2)`
  - long text (`Description`, `Images`) -> `TEXT`
  - boolean-ish (`Status`) -> `VARCHAR(32)` or `TINYINT(1)` depending on usage
- 1.3: Create one DDL (CREATE TABLE) draft per table in `audit/schema_drafts/` (one file per table). Keep each table creation atomic (single file, single purpose).

Phase 2 — Draft consolidated schema
- 2.1: Compose a consolidated DDL `audit/reconstructed_schema.sql` from table drafts.
- 2.2: Add FK constraints where code indicates relationships (e.g., `investment.property_id -> property.Id`). If uncertain, defer FK or add `ON DELETE SET NULL`.

Phase 3 — Local test apply (atomic tries)
- 3.1: Create a disposable local DB instance: `CREATE DATABASE app_test;` and `USE app_test;`
- 3.2: Apply the DDL in a single transaction where possible (wrap with `SET FOREIGN_KEY_CHECKS=0` before and `1` after if adding circular FKs).
  - Commands:
    - `mysql -u root -p -e "CREATE DATABASE app_test;"`
    - `mysql -u root -p app_test < audit/reconstructed_schema.sql`
- 3.3: Start the application locally (or point a copy to `app_test`) and run core flows (registration, login, create property, invest). Note all SQL errors or column-not-found messages.

Phase 4 — Iterative refinement (atomic bugfix loop)
- 4.1: For each error from Phase 3, update the appropriate table DDL draft (single-column edits) and reapply to a fresh DB.
- 4.2: Repeat until no missing column errors occur when exercising the app's flows.

Phase 5 — Seed minimal data (atomic seeds)
- 5.1: Create deterministic seed files per table: `seeds/001_users.sql`, `seeds/002_property.sql`, `seeds/003_investment.sql`, etc.
- 5.2: Insert minimal valid rows that the app expects (e.g., admin user, sample property, investment packages).
- 5.3: Re-run the app and validate behavior.

Phase 6 — Hardening and finalization (atomic checks)
- 6.1: Add indexes for columns used in WHERE/JOIN often (add single-index modifications in migrations).
- 6.2: Add NOT NULL/DEFAULT constraints where appropriate.
- 6.3: Create a final `migration/` script (atomic steps) and commit DDL + seeds to `migrations/`.

Phase 7 — Backup & delivery (atomic)
- 7.1: Dump final DB: `mysqldump -u user -p perazimp_app > perazimp_app_dump.sql`.
- 7.2: Store the dump in a secure location and do not commit it to the code repo (add to `.gitignore`).

Verification checklist (atomic tests)
- Can register a new user and log in.
- Can create a property and the property appears in listings.
- Can create an `invest_now` entry that increments `investment.current_inv` correctly.
- No SQL errors appear in logs during normal flows.

Commands & micro-commands (copyable)
- Extract SQL reference lines (Discovery):
```
grep -R "FROM \|JOIN \|INSERT INTO \|UPDATE \|DELETE FROM" -n includes/ Administration/ public_html/ | sed -E 's/\s+/ /g' > audit/sql_references.txt
```
- Create and apply schema to local DB:
```
mysql -u root -p -e "CREATE DATABASE perazimp_app_test;"
mysql -u root -p perazimp_app_test < audit/reconstructed_schema.sql
```
- Seed initial admin user (example):
```
# edit seeds/001_users.sql with a bcrypt hash for the password and insert, then run:
mysql -u root -p perazimp_app_test < seeds/001_users.sql
```

Notes, caveats and risks
- The provided `audit/reconstructed_schema.sql` is inferred from code references and contains educated guesses for types and constraints — you must verify by running the app and checking error messages.
- Do not treat this as authoritative production schema. If you have a running DB, always prefer `mysqldump` from the live instance.
- Some columns and tables may be present only in vendor packages or old copies; ignore vendor test fixtures.

If you want, I will:
- Option 1: Run an automated extraction pass (grep/AST) across the repo to produce a detailed column inventory and then refine the SQL automatically.
- Option 2: Produce individual migration files (one per table) and seed files for immediate local testing.

End of plan.
