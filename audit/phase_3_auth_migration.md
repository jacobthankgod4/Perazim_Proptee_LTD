# Phase 3: Auth Migration Completion Report

**Date:** 2026-02-03  
**Status:** ✅ Complete — Supabase Auth integration ready (Decision A)

---

## Overview

Phase 3A implements **Supabase Auth** as the authoritative authentication system, replacing the app-managed `users` table with:
- **Supabase Auth** (managed, secure, handles password hashing, MFA, OAuth, etc.)
- **users_profile** (Postgres table) — stores profile metadata linked via `auth_id` (UUID)

This design separates authentication (Supabase) from application data (Postgres), improving security and simplifying future integrations.

---

## 3A.1: New `users_profile` Table

**Migration file:** `audit/migrations_pg/007_create_users_profile_pg.sql`

Creates a new Postgres table:

```sql
CREATE TABLE public.users_profile (
  "auth_id" UUID PRIMARY KEY,      -- Links to Supabase auth.users(id)
  "User_Type" VARCHAR(50) DEFAULT 'user',
  "Name" VARCHAR(255),
  "age" INT,
  "gender" VARCHAR(16),
  "bank" VARCHAR(128),
  "Account" VARCHAR(128),
  "status" VARCHAR(32) DEFAULT 'active',
  "created_at" TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  "updated_at" TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

**Columns preserved from old `users` table:**
- `User_Type`, `Name`, `age`, `gender`, `bank`, `Account`, `status`

**Columns removed/handled by Supabase Auth:**
- `Email` → stored in Supabase `auth.users(email)`
- `Password` → stored in Supabase (hashed, managed)
- `account_activation_hash`, `reset_token_hash`, `reset_token_expires_at` → handled by Supabase Auth flows

---

## 3A.2: User Data Migration

**Migration script:** `scripts/auth_migrate.php`

Two strategies available:

### Strategy 1: Password Reset Tokens (RECOMMENDED)
Users must reset their password on first Supabase login.

```bash
export DATABASE_URL=postgres://user:pass@host:5432/db
php scripts/auth_migrate.php --strategy=reset-token
```

**What it does:**
1. Reads all users from old `users` table
2. Creates entries in `users_profile` with a deterministic UUID (`auth_id`)
3. Generates 7-day reset tokens for each user
4. On first login, users receive email to reset password via Supabase Auth

**Pros:**
- ✅ No plaintext password handling
- ✅ Users get new secure passwords
- ✅ Supabase Auth handles all validation

**Cons:**
- ⚠️ Users must reset password on first login

### Strategy 2: Import Password Hashes (OPTIONAL)
Import existing bcrypt/argon2 hashes directly to Supabase.

```bash
php scripts/auth_migrate.php --strategy=import-hashes \
  --supabase-url=https://xxx.supabase.co \
  --supabase-key=eyJhbGc...
```

**Prerequisites:**
- Existing passwords must be bcrypt or argon2 compatible
- Supabase CLI or REST API configured
- See: [Supabase Password Migration Guide](https://supabase.com/docs/guides/auth/auth-password-migration)

**Pros:**
- ✅ Users don't need to reset password

**Cons:**
- ⚠️ Requires manual setup
- ⚠️ Hash format compatibility risks

---

## 3A.3: Supabase Auth Processors

Three new PHP handlers for authentication:

### 1. Registration: `includes/auth/supabase_register.php`

**Flow:**
1. User submits email + password + name
2. CSRF validation
3. Call Supabase Auth `/signup` endpoint
4. Supabase returns `user.id` (UUID)
5. Insert profile into `users_profile` with `auth_id`
6. Return JWT to client; store in session

**Usage (form):**
```html
<form action="includes/auth/supabase_register.php" method="POST">
  <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
  <input type="email" name="email" required>
  <input type="password" name="password" minlength="8" required>
  <input type="text" name="name" required>
  <button type="submit">Register</button>
</form>
```

**Response:**
```json
{
  "success": true,
  "message": "Registration successful. Check your email for confirmation link."
}
```

---

### 2. Login: `includes/auth/supabase_login.php`

**Flow:**
1. User submits email + password
2. CSRF validation
3. Call Supabase Auth `/token?grant_type=password`
4. Supabase validates and returns JWT + user object
5. Load user profile from `users_profile` table
6. Store JWT and profile in secure session (`httpOnly`, `Secure`, `SameSite=Strict`)
7. Redirect to dashboard

**Usage (form):**
```html
<form action="includes/auth/supabase_login.php" method="POST">
  <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
  <input type="email" name="email" required>
  <input type="password" name="password" required>
  <button type="submit">Login</button>
</form>
```

**Response:**
```json
{
  "success": true,
  "redirect": "user.dashboard.php"
}
```

---

### 3. Logout: `includes/auth/supabase_logout.php`

**Flow:**
1. Revoke JWT at Supabase Auth (optional)
2. Destroy local session
3. Redirect to login page

**Usage:**
```html
<a href="includes/auth/supabase_logout.php">Logout</a>
```

---

## Environment Variables Required

Add to `.env` and Vercel/deployment:

```bash
# Supabase Auth
SUPABASE_URL=https://your-project.supabase.co
SUPABASE_ANON_KEY=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...
SUPABASE_SERVICE_KEY=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...  # Optional, for admin tasks

# Database
DATABASE_URL=postgres://user:pass@host:5432/db

# App config
LIVE=true|false  # Controls session cookie security
```

---

## Implementation Steps (for you)

### 1. Create Supabase Project (5 min)
```bash
# Visit: https://supabase.com/dashboard
# Create new project
# Copy Project URL and Anon/Service keys
```

### 2. Apply migration (2 min)
```bash
export DATABASE_URL=postgres://...
php scripts/migrate.php  # Applies 007_create_users_profile_pg.sql
```

### 3. Migrate existing user data (5 min)
```bash
php scripts/auth_migrate.php --strategy=reset-token
```

### 4. Test authentication (10 min)
```bash
# Visit registration page; fill form
# Check Supabase dashboard for new user
# Confirm email confirmation email arrives
# Click link to set password
# Test login flow
```

### 5. Update existing app code (next phase)
- Replace calls to old `users` table with new `users_profile` table
- Update session checks to use `$_SESSION['auth_user']`
- Remove direct password checks (now handled by Supabase)

---

## Integration with Existing Code

### Accessing auth user in templates:
```php
<?php
if (!isset($_SESSION['auth_user'])) {
    header('Location: login.php');
    exit;
}

$auth_id = $_SESSION['auth_user']['auth_id'];
$email = $_SESSION['auth_user']['email'];
$name = $_SESSION['auth_user']['name'];
$token = $_SESSION['auth_user']['token'];  // JWT for API calls
?>
```

### Querying user profile:
```php
$pdo = getPdoPostgres();
$stmt = $pdo->prepare('
    SELECT "User_Type", "Name", "age", "status"
    FROM public.users_profile
    WHERE "auth_id" = :auth_id
');
$stmt->execute([':auth_id' => $_SESSION['auth_user']['auth_id']]);
$profile = $stmt->fetch(PDO::FETCH_ASSOC);
```

### Updating user profile:
```php
$stmt = $pdo->prepare('
    UPDATE public.users_profile
    SET "Name" = :name, "age" = :age, "updated_at" = CURRENT_TIMESTAMP
    WHERE "auth_id" = :auth_id
');
$stmt->execute([
    ':name' => $new_name,
    ':age' => $new_age,
    ':auth_id' => $_SESSION['auth_user']['auth_id']
]);
```

---

## Security Notes

1. **Passwords:** Never stored locally; Supabase Auth handles hashing.
2. **JWTs:** Stored in `$_SESSION['auth_user']['token']`; include in API calls via `Authorization: Bearer` header.
3. **Session cookies:** Automatically set as `HttpOnly`, `Secure`, `SameSite=Strict` when `LIVE=true`.
4. **CSRF:** All auth endpoints require valid CSRF token (validated in `csrf_validate.php`).
5. **Email verification:** Supabase Auth sends confirmation email; link handled by Supabase dashboard.

---

## Troubleshooting

| Issue | Solution |
|-------|----------|
| "Supabase not configured" | Check `SUPABASE_URL` and `SUPABASE_ANON_KEY` env vars |
| User creation fails in Supabase | Check password complexity; Supabase has min 6 chars |
| Profile insert fails | Verify `users_profile` table exists and migration ran |
| JWT invalid on API call | Ensure token is recent; Supabase tokens expire in 1 hour |
| "Email already exists" | Check Supabase dashboard; user may exist |

---

## Files Modified/Created

| File | Type | Purpose |
|------|------|---------|
| `audit/migrations_pg/007_create_users_profile_pg.sql` | SQL Migration | New `users_profile` table |
| `scripts/auth_migrate.php` | PHP Script | Migrate existing users to Supabase Auth |
| `includes/auth/supabase_register.php` | PHP Handler | Supabase Auth registration |
| `includes/auth/supabase_login.php` | PHP Handler | Supabase Auth login |
| `includes/auth/supabase_logout.php` | PHP Handler | Supabase Auth logout |

---

## Next Steps

- **Phase 4:** Code conversion — update all existing auth/profile queries to use new schema
- **Phase 5:** Storage migration — move file uploads to Supabase Storage
- **Phase 6:** Deploy to Vercel with Supabase credentials configured

---

**Status:** ✅ Phase 3A complete. Supabase Auth infrastructure ready for testing and integration.
