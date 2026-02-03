## Implementation Plan — atomic, file-by-file completion checklist

Purpose: finish remaining security hardening, complete DB migration readiness, convert remaining code to prepared statements, and prepare safe staging and production deployments. Each item is atomic (single-file or single small script), includes verification steps, priority, and an estimated timebox.

Notes: this file focuses only on tasks still outstanding from the audit and TODO list. For each task I list the file(s) to change, exact edits, verification commands, and an acceptance criterion.

---

### Global prep (high priority)
- Files: `.gitignore`, `start/.env`, `audit/secrets_matches_redacted.txt`
- Actions:
  - Add `.env` to `.gitignore` and create `start/.env.example` with redacted placeholders.
  - Ensure no production values remain in `start/.env.example`.
- Verify:
  - `git status --porcelain` shows no `.env` tracked.
  - `rg "sk_live_|DB_PASSWORD|SMTP_PASS" -n --hidden --no-ignore-vcs --glob '!vendor'` returns no live secrets in tracked files.
- Time: 15–30m

### 1) Audit and remediate vendor/PHPMailer (medium priority)
- Files: `vendor/`, `PHPMailer/` directory
- Actions:
  - Search for example config files with credentials: `rg "password|smtp|user" vendor/ PHPMailer/`
  - Update `mailer.php` to read SMTP creds from env and validate at runtime (if not already).
  - Upgrade PHPMailer if outdated via `composer update phpmailer/phpmailer` or vendor replacement.
- Verify:
  - `php -l mailer.php` and a local send test with sandbox SMTP (no live creds).
- Time: 1–2h

### 2) Repo-wide risky-pattern scan and prioritized findings (high priority)
- Files: repository root
- Actions:
  - Run the scan and write redacted results to `audit/secrets_matches_redacted.txt`:
    ```bash
    rg --hidden --no-ignore-vcs "sk_live_|sk_test_|DB_PASSWORD|API_KEY|password\(|eval\(|system\(|exec\(|passthru\(|file_put_contents\(|display_errors" -n --glob '!vendor' > audit/raw_grep_matches.txt
    python3 audit/redact_matches.py audit/raw_grep_matches.txt > audit/secrets_matches_redacted.txt
    ```
  - `audit/redact_matches.py` should replace long token segments with `<REDACTED>`.
- Verify: `audit/secrets_matches_redacted.txt` created and reviewed.
- Time: 30–60m

### 3) Remediate high-risk files (critical)
- Targets: `checkout.php`, `mailer.php`, `includes/view/verification.php`, `includes/view/forgot_password.php`, `start/.env`
- Actions per file:
  - Replace hardcoded keys with `getenv('PAYSTACK_SECRET')` and fail fast when `LIVE=true` and keys missing.
  - Add `Administration/config.inc.php` guard: `if (getenv('LIVE')==='true') { ini_set('display_errors',0); error_reporting(0); }`
- Verify:
  - Syntax check and quick runtime test with `LIVE=true` to ensure no secrets echo.
    ```bash
    php -d display_errors=1 -r "putenv('LIVE=true'); require 'checkout.php';"
    ```
- Time: 1–2h

### 4) Convert remaining inline SQL → prepared statements (very high)
- Scope: all files still using `mysqli_query`, `mysql_query`, `->query()` with concatenation in `includes/`, `old/`, and top-level PHP files.
- Process (atomic per-file):
  1. Enumerate candidates: `rg "mysqli_query\(|mysql_query\(|->query\(|\"\s*\.\s*\$" -n includes old public_html > audit/sql_candidates.txt`
  2. For each file in `audit/sql_candidates.txt`:
     - Create branch `fix/sql/<file>`.
     - Replace SQL building with PDO prepared statements using `includes/db/pdo_pg.php` or a MySQL PDO fallback.
     - Convert MySQL-specific SQL to Postgres equivalents when migrating to PG.
     - Add basic smoke script under `tests/` exercising the changed code path.
  3. Record conversion in `audit/sql_conversions.csv`.
- Verification per-file:
  - `php -l <file>` passes
  - `php tests/smoke.php <endpoint>` returns expected status/code
- Priority order (first batch): `includes/auth/login.data.config.php`, `includes/auth/reg.data.config.php`, `checkout.php`, `includes/view/verification.php`, payment/webhook handlers.
- Time: batch of 10 files ≈ 4–8 hours; full repo variable.

### 5) Template XSS hardening (high)
- Files: `includes/view/*`, `public_html/*.php` templates
- Actions (atomic per-file):
  - Ensure `includes/helpers/escape.php` exists and is included in `includes/view/header.php`.
  - Replace raw echoes of `$_GET`, `$_POST`, and DB values with `escape()`.
  - For JSON APIs, always `json_encode()` server-side and set `Content-Type: application/json`.
- Verification:
  - `rg "echo\s+\$\_GET|echo\s+\$\_POST|echo\s+\$row\[" -n includes/view public_html` should produce zero critical findings after fixes.
- Time: 4–8 hours iterative.

### 6) CSRF enforcement (high)
- Files: `includes/security/csrf_validate.php`, `assets/js/csrf_helper.js`, all POST processors
- Actions (atomic per-form):
  - Add token generation into `includes/view/header.php` as meta tag and add hidden input to forms.
  - Include `csrf_validate.php` at the top of every POST-processing file and return 400 on failure.
  - Update `assets/js/csrf_helper.js` to attach header for `fetch`/AJAX:
    ```js
    fetch(url,{method:'POST',headers:{'x-csrf-token':document.querySelector('meta[name="csrf-token"]').content},body:formData})
    ```
- Verification: automated `tests/csrf_test.sh` demonstrates blocking of invalid posts.
- Time: 1 day

### 7) Migration runner & migrations verification (medium)
- Files: `scripts/migrate.php`, `audit/migrations_pg/*.sql`
- Actions:
  - Confirm runner uses `DATABASE_URL` and writes applied names to `schema_migrations`.
  - Local test with Docker Postgres:
    ```bash
    docker run --name pg-test -e POSTGRES_PASSWORD=pgpass -d -p 5432:5432 postgres:15
    export DATABASE_URL=postgres://postgres:pgpass@127.0.0.1:5432/postgres
    php scripts/migrate.php audit/migrations_pg
    psql "$DATABASE_URL" -c "select filename from schema_migrations;"
    ```
- Verification: migrations applied and no SQL errors.
- Time: 1–2 hours

### 8) Data migration testing with pgloader (medium)
- Files: `scripts/pgloader/pgloader.conf`, `scripts/data_sync.sh`
- Actions:
  - Run pgloader for a small subset first, then full DB to staging; validate counts with `SELECT count(*) FROM ...`.
- Verification: `diff` or row-count parity report written to `audit/migration_run_log.md`.
- Time: 2–6 hours

### 9) Storage migration to Supabase (medium)
- Files to add: `includes/storage/supabase_upload.php`, update upload processors
- Actions:
  - Implement S3-compatible upload calls to Supabase Storage; store returned path in DB.
  - Update public URLs to use Supabase CDN or signed URLs where required.
- Verification: upload/download tests; ensure ACLs are enforced.
- Time: 4–8 hours

### 10) Staging deploy to Vercel & tests (medium)
- Files: `vercel.json` (create), optional `.vercelignore`
- Actions:
  - Add `vercel.json`, push to `migration/supabase`, connect to Vercel, set env vars (staging), deploy.
  - Run `php tests/smoke.php all` via a CI workflow or manual run.
- Verification: site returns 200 for main pages and critical flows pass.
- Time: 1–2 hours

### 11) Rotate secrets and scrub history (critical, owner action)
- Files: `scripts/git_scrub.sh` (create), `audit/git_scrub_instructions.md`
- Actions:
  - Owner rotates keys in external services.
  - Run `git-filter-repo` per instructions to remove old values from history and force-push branches.
- Verification: `rg` returns no secrets across refs; new deployments use rotated keys.
- Time: 1–3 hours

### 12) Cutover & rollback (critical)
- Steps (atomic): freeze writes → final sync → update production envs → deploy → monitor.
- Verification: production acceptance tests pass for 60 minutes.

### 13) Documentation, CI, and handoff (low)
- Files to produce: `audit/per-file-report.md`, `.github/workflows/ci.yml`, `README.md` updates
- Actions:
  - Create per-file report listing: file path, change summary, risk rating, reviewer.
  - Add CI to run `php -l` and `php scripts/migrate.php --dry-run` on PRs.
- Time: 4–8 hours

---

If you want me to start now I can run these atomic steps in order: (A) produce `audit/secrets_matches_redacted.txt`, (B) patch `checkout.php` + `mailer.php` to use `getenv()` and add runtime guards, (C) convert the 3 critical auth processors to PDO prepared statements and push branch `fix/sql/critical-auth`. Which should I run first? 
