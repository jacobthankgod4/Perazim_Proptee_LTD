# Supabase Migration — Atomic, File-by-File Plan

This document is a step-by-step, atomic playbook to migrate the application from MySQL (`mysqli`) to Supabase (Postgres), integrate Supabase Auth & Storage, convert server code to PDO/Postgres, and cut over with minimal downtime.

Target files and artifacts in this repository (referenced throughout):
- `audit/migrations/*.sql` — current MySQL DDL drafts (in `audit/migrations/`).
- `audit/seeds/*.sql` — seed files for testing.
- `audit/column_inventory.csv` — discovered table/column inventory.
- `public_html/includes/*` — application processors and auth code to convert.

Prerequisites (atomic)
- A Supabase project (staging) with `SUPABASE_URL`, `SUPABASE_ANON_KEY`, `SUPABASE_SERVICE_KEY`.
- Local dev MySQL export (dump) or working DB connection.
- A staging Vercel project or local PHP runtime for testing.
- `pgloader` installed (recommended) or access to Supabase import tools.

Outcome definition (atomic)
- App runs against Postgres/Supabase in staging with feature parity for: registration/login, password reset, property create/list, invest flows, and file uploads.

High-level phases (atomic units of work)
1. Prep & inventory
2. Convert schema (DDL) and import data
3. Migrate Auth (users) strategy
4. Convert PHP DB layer to PDO + Postgres
5. Replace file uploads with Supabase Storage
6. Test, QA, and monitoring
7. Cutover and rollback plan

Atomic tasks and commands

Phase 1 — Prep & inventory (atomic steps)
- 1.1: Ensure `audit/column_inventory.csv` is up-to-date.
- 1.2: Export production MySQL schema and a small data sample:
```bash
mysqldump -u DB_USER -p --no-data DB_NAME > prod_schema.sql
mysqldump -u DB_USER -p --skip-triggers --no-create-info --where="1 LIMIT 1000" DB_NAME > sample_data.sql
```
- 1.3: Create Supabase project (staging). Record `SUPABASE_URL` and `SUPABASE_SERVICE_KEY`.

Phase 2 — Convert schema & load data (atomic steps)
- 2.1: Convert DDL with `pgloader` or script. Example `pgloader` command:
```bash
# direct MySQL -> Postgres migration
pgloader mysql://user:pass@host/dbname postgresql://pguser:pgpass@pg-host/pgdb
```
- 2.2: If using file-based conversion, use this small sed pipeline to adjust simple differences (run and inspect before applying):
```bash
# quick conservative transformations (manual review required)
sed -e 's/`/"/g' \
    -e 's/INT UNSIGNED/INT/g' \
    -e 's/AUTO_INCREMENT/SERIAL/g' \
    -e 's/DATETIME/TIMESTAMP/g' audit/migrations/001_create_users.sql > tmp/001_users_pg.sql
```
- 2.3: Load DDL into Supabase (staging). Use psql or the Supabase SQL editor:
```bash
psql $SUPABASE_DATABASE_URL -f tmp/001_users_pg.sql
```
- 2.4: Import sample data or run `pgloader` to copy data. Validate row counts and types.

Phase 3 — Auth migration (atomic choices and steps)
- Decision A (recommended): Use Supabase Auth for authentication & sessions.
  - 3A.1: Create `users_profile` table in Postgres with a foreign key to Supabase `auth.users` (`id` UUID).
  - 3A.2: For existing users, either:
    - Import hashed passwords if compatible (bcrypt) using Supabase Import API (advanced), OR
    - Require password reset on first login (safer and simpler): generate `reset_token` for each user and email reset links.
  - 3A.3: Update registration/login flow to call Supabase Auth API (server-side) and write profile rows to `users_profile`.

- Decision B (alternative): Keep current `users` table in Postgres and continue to manage auth in-app. (Smaller scope.)

Phase 4 — Code changes: DB layer (atomic tasks)
- 4.1: Add PDO Postgres wrapper file: `includes/db/pdo_pg.php` (example below).
- 4.2: Replace `mysqli_*` processors in `includes/auth/` and `includes/user/processor/` one file at a time:
  - Convert `mysqli_prepare` → `PDO->prepare`, bind with `->bindValue`, `execute`, `fetch(PDO::FETCH_ASSOC)`.
  - Replace MySQL-specific SQL constructs: `ON DUPLICATE KEY` → `ON CONFLICT`.
- 4.3: Validate and run unit/functional tests per changed file.

Example PDO Postgres wrapper (`includes/db/pdo_pg.php`) — drop-in
```php
<?php
// minimal PDO wrapper
$dsn = getenv('DATABASE_URL') ?: 'pgsql:host='.getenv('DB_HOST').';port=5432;dbname='.getenv('DB_NAME');
$opts = [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC];
$pdo = new PDO($dsn, getenv('DB_USER'), getenv('DB_PASSWORD'), $opts);
return $pdo;
```

Atomic example: convert `includes/auth/reg.data.config.php` (high-level)
- OLD (mysqli): uses `INSERT INTO users (...) VALUES (?, ?, ...)` with `mysqli_prepare`.
- NEW (PDO):
```php
<?php
// includes/auth/reg.data.config.php (PDO example snippet)
$pdo = require __DIR__ . '/../db/pdo_pg.php';
$sql = "INSERT INTO users (User_Type, Email, Name, age, gender, bank, Account, Password, account_activation_hash) VALUES (:ut, :email, :name, :age, :gender, :bank, :account, :pwd, :hash)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
  ':ut'=>$user_type, ':email'=>$email, ':name'=>$name, ':age'=>$age, ':gender'=>$gender,
  ':bank'=>$bank, ':account'=>$account, ':pwd'=>$password_hash, ':hash'=>$activation_hash
]);
```

Phase 5 — Storage & uploads (atomic steps)
- 5.1: Create a Supabase Storage bucket (e.g., `uploads`) and set permissions.
- 5.2: Replace file upload handlers to call Supabase Storage upload API (server-side) and store returned path/URL in DB.
- 5.3: Example using `curl` to upload server-side (or use Supabase PHP client):
```bash
curl -X POST "${SUPABASE_URL}/storage/v1/object/upload/uploads/${OBJECT_NAME}" \
  -H "Authorization: Bearer ${SUPABASE_SERVICE_KEY}" \
  -H "Content-Type: multipart/form-data" \
  --data-binary @"/path/to/file"
```

Phase 6 — Testing & QA (atomic checklist)
- 6.1: Deploy staging branch to Vercel and set staging env vars (`DATABASE_URL`, `SUPABASE_SERVICE_KEY`, etc.).
- 6.2: Test flows: registration, login (or password reset flow), create property, list properties, invest, subscription, file upload, payment webhook processing.
- 6.3: Verify logs and queries for errors; fix SQL dialect issues iteratively.

Phase 7 — Cutover (atomic steps; low downtime)
- 7.1: Put production into maintenance mode (brief window) OR implement dual-write for a short period.
- 7.2: Run final data sync (incremental) with `pgloader` or custom ETL.
- 7.3: Flip production env vars to point to Supabase DB and Supabase keys; deploy.
- 7.4: Monitor error rates and critical flows for at least 30–60 minutes; be ready to rollback within a short window.

Rollback plan (atomic)
- Keep previous DB credentials and app version ready. If errors occur, revert Vercel environment variables and redeploy previous commit. Restore write access to old DB.

Environment variables (exact list to set in Vercel / CI)
- `DATABASE_URL` or `DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASSWORD`
- `SUPABASE_URL`, `SUPABASE_ANON_KEY`, `SUPABASE_SERVICE_KEY`
- `PAYSTACK_SECRET`, `PAYSTACK_PUBLIC` (existing payment keys)
- `SMTP_HOST`, `SMTP_USER`, `SMTP_PASS` (mailer)
- `LIVE=false` (set true only after verification)

Automation & scripts (atomic recommendations)
- Use `pgloader` for automated MySQL→Postgres migration.
- Add a small `scripts/mysql-to-pg.sh` that converts `audit/migrations/*.sql` with careful sed rules and outputs `audit/migrations/pg_*` for review before applying.

Deliverables (what I will produce on request — atomic)
- Converted Postgres DDL files under `audit/migrations_pg/`.
- Example `includes/db/pdo_pg.php` and two converted processors (`includes/auth/reg.data.config.php`, `includes/user/processor/pass.data.config.php`).
- Upload handler rewritten to use Supabase Storage.
- Step-by-step cutover checklist and rollback commands.

Estimated timeline (atomic granularity)
- Prep & Inventory: 0.5–1 day
- Schema conversion & data import: 1–3 days
- Auth migration + code changes: 2–5 days
- Storage replacement: 1–2 days
- Testing & QA: 1–3 days
- Cutover & monitoring: 0.5 day

Notes & caveats (atomic warnings)
- Password import may not be possible for some hashed formats — plan a forced reset path.
- Some MySQL queries might depend on MySQL functions — rewrite carefully and test.
- Supabase serverless tier has limits; review row sizes, bandwidth, and backup plans.

Next immediate action
- Reply with `GO` and I will convert the existing MySQL migration SQL files into Postgres DDL drafts and add them to `audit/migrations_pg/`, plus create `includes/db/pdo_pg.php` and one converted auth processor sample.

---
Generated on: 2026-02-03
