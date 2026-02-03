# Audit migrations and seeds — apply and test locally

This folder contains inferred migrations and seeds created from automated extraction of SQL references in the codebase. Use them to create a disposable local database for testing and iterative refinement.

Quick apply (local MySQL):

1. Create a test database:

```bash
mysql -u root -p -e "CREATE DATABASE perazimp_app_test CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

2. Apply migrations in order:

```bash
mysql -u root -p perazimp_app_test < audit/migrations/001_create_users.sql
mysql -u root -p perazimp_app_test < audit/migrations/002_create_property.sql
mysql -u root -p perazimp_app_test < audit/migrations/003_create_investment.sql
mysql -u root -p perazimp_app_test < audit/migrations/004_create_invest_now.sql
mysql -u root -p perazimp_app_test < audit/migrations/005_create_subscribers.sql
mysql -u root -p perazimp_app_test < audit/migrations/006_add_foreign_keys.sql
```

3. Load seeds (after verifying schema):

```bash
mysql -u root -p perazimp_app_test < audit/seeds/001_users.sql
mysql -u root -p perazimp_app_test < audit/seeds/002_property.sql
mysql -u root -p perazimp_app_test < audit/seeds/003_investment.sql
mysql -u root -p perazimp_app_test < audit/seeds/004_invest_now.sql
mysql -u root -p perazimp_app_test < audit/seeds/005_subscribers.sql
```

Notes
- These migrations are inferred and may omit columns used only in obscure code paths; run the application and note SQL errors, then iterate the migrations.
- Replace the placeholder bcrypt hash in `audit/seeds/001_users.sql` before using in any environment.
- Do not commit real credentials or DB dumps into this repository.
