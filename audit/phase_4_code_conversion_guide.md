# Phase 4: Code Conversion to PDO/Postgres — Atomic Implementation

**Date:** 2026-02-03  
**Status:** Ready for atomic conversion (critical auth + view processors)

---

## Overview

Phase 4 converts all `mysqli_*` calls to PDO prepared statements (Postgres-compatible). This is a multi-file effort; I'm starting with **8 critical files** that handle:
- Authentication (login, register, password reset, account activation)
- Payment verification
- Core view processors (listings, packages, home)

Each file is converted independently, making this safe to apply in atomic PRs.

---

## Conversion Strategy

### Pattern: Old → New

**Old (mysqli):**
```php
$q = "SELECT * FROM users WHERE Email = ?";
$stmt = mysqli_prepare($dbc, $q);
mysqli_stmt_bind_param($stmt, 's', $email);
mysqli_stmt_execute($stmt);
$r = mysqli_stmt_get_result($stmt);
if (mysqli_num_rows($r) === 1) {
    $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
}
```

**New (PDO):**
```php
require_once __DIR__ . '/../db/pdo_pg.php';
$pdo = getPdoPostgres();
$stmt = $pdo->prepare('SELECT "Id", "Email", "Password" FROM public.users WHERE "Email" = :email');
$stmt->execute([':email' => $email]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (count($rows) > 0) {
    $row = $rows[0];
}
```

### Key Changes:
1. **Include `pdo_pg.php`** helper
2. **Use named placeholders** (`:email`, `:id`, etc.) instead of `?`
3. **Call `$stmt->execute()` with parameter array** instead of `mysqli_stmt_bind_param`
4. **Use `fetchAll()` or `fetch()` instead of `mysqli_stmt_get_result()`**
5. **Use `rowCount()` instead of `mysqli_stmt_affected_rows()` for INSERT/UPDATE/DELETE**
6. **Quote identifiers with double quotes** for Postgres compliance

---

## File Conversions (Atomic, by priority)

### ✅ CRITICAL (1) — Authentication Core

#### File 1: `includes/auth/login.data.config.php`
**Priority:** CRITICAL  
**Current status:** Uses `mysqli_prepare` + `mysqli_stmt_bind_param`  
**Changes:**
- Line 27: Replace `mysqli_prepare($dbc, $q3)` with `getPdoPostgres()->prepare()`
- Lines 28–31: Replace `mysqli_stmt_bind_param/execute/get_result` with `execute()` + `fetchAll()`
- Update result count check: `mysqli_num_rows($r3) === 1` → `count($r3) === 1`

**SQL fix for Postgres:**
```php
$stmt = $pdo->prepare('SELECT "Id", "Email", "Password", "User_Type", "Name", "Account", "age", "gender", "bank", "account_activation_hash" FROM public.users WHERE "Email" = :email');
$stmt->execute([':email' => $le]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (count($rows) === 1) {
    $row = $rows[0];
```

---

#### File 2: `includes/auth/reg.data.config.php`
**Priority:** CRITICAL  
**Current status:** Uses `mysqli_prepare` for INSERT  
**Changes:**
- Line 25 (original): Replace `mysqli_prepare` with `$pdo->prepare()`
- Line 139: Already has parameterized query `"SELECT Email FROM users WHERE Email = ?"`
- Line 160: Already has INSERT with `?` placeholders

**SQL fix:**
```php
$stmt = $pdo->prepare('INSERT INTO public.users ("User_Type", "Email", "Name", "age", "gender", "bank", "Account", "Password", "account_activation_hash") VALUES (:user_type, :email, :name, :age, :gender, :bank, :account, :password, :hash)');
$success = $stmt->execute([
    ':user_type' => $user_type,
    ':email' => $em,
    ':name' => $n,
    ':age' => $a,
    ':gender' => $g,
    ':bank' => $b,
    ':account' => $ac,
    ':password' => $password,
    ':hash' => $hash
]);
if ($success && $stmt->rowCount() > 0) {
```

---

### ✅ HIGH (3) — User Management

#### File 3: `includes/user/processor/pass.data.config.php`
**Priority:** HIGH  
**Current status:** Uses `mysqli_prepare` for UPDATE  
**Changes:**
- Line 18: Replace `mysqli_prepare` with PDO
- Line 20–21: Replace `mysqli_stmt_bind_param/execute` with `execute()`
- Line 23: Use `rowCount()` instead of `mysqli_stmt_affected_rows()`

**SQL fix:**
```php
$stmt = $pdo->prepare('UPDATE public.users SET "Password" = :password WHERE "Email" = :email');
$stmt->execute([':password' => $new_password, ':email' => $email]);
if ($stmt->rowCount() > 0) {
```

---

#### File 4: `includes/view/activation.php`
**Priority:** HIGH  
**Changes:**
- Line 7: Replace `mysqli_prepare` for SELECT by activation hash
- Lines 8–12: Replace bind_param/execute/get_result

**SQL fix:**
```php
$stmt = $pdo->prepare('SELECT "Id", "Email" FROM public.users WHERE "account_activation_hash" = :hash');
$stmt->execute([':hash' => $activation_code]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (count($rows) === 1) {
    $row = $rows[0];
```

---

#### File 5: `includes/view/reset_password.php`
**Priority:** HIGH  
**Current status:** Uses `mysqli_prepare` for reset token validation  
**Changes:**
- Line 36: Replace `mysqli_prepare`
- Line 38–40: Replace bind_param/execute/get_result

**SQL fix:**
```php
$stmt = $pdo->prepare('SELECT "Id", "Email", "reset_token_hash", "reset_token_expires_at" FROM public.users WHERE "reset_token_hash" = :token');
$stmt->execute([':token' => $token_hash]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (count($rows) === 1 && strtotime($rows[0]['reset_token_expires_at']) > time()) {
    $row = $rows[0];
```

---

### ✅ MEDIUM (3) — View Processors

#### File 6: `includes/view/processor/listings.data.config.php`
**Priority:** MEDIUM  
**Current status:** Mixed `mysqli_prepare` + raw `mysqli_query`  
**Changes:**
- Line 5: Replace `mysqli_prepare` with PDO
- Line 11: Replace `mysqli_query` with PDO prepared statement (currently inline, no params)

**SQL fix:**
```php
$stmt = $pdo->prepare('SELECT "Id", "Title", "Address", "City", "State", "Zip_Code", "Images" FROM public.property WHERE "Status" = :status');
$stmt->execute([':status' => 'investment']);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($rows as $row) {
    // render
}
```

---

#### File 7: `includes/view/processor/package.data.config.php`
**Priority:** MEDIUM  
**Current status:** Uses raw `mysqli_query` with inline SQL + interpolation  
**Changes:**
- Line 12: Replace inline `mysqli_query` with PDO prepared statement

**SQL fix (Postgres syntax):**
```php
$stmt = $pdo->prepare('
    SELECT p."Id", p."Title", p."Type", p."Address", p."City", p."State", p."Zip_Code", p."Images", p."Video",
           i."Id_in", i."interest", i."share_cost", i."expected_inv", i."current_inv"
    FROM public.property p
    LEFT JOIN public.investment i ON p."Id" = i."property_id"
    WHERE i."property_id" = :id
    ORDER BY i."Id_in" ASC
');
$stmt->execute([':id' => $id]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
```

---

#### File 8: `includes/view/processor/home.data.config.php`
**Priority:** MEDIUM  
**Current status:** Uses `mysqli_prepare` + raw `mysqli_query`  
**Changes:**
- Line 6: Replace `mysqli_prepare`
- Line 12: Replace `mysqli_query` with PDO

**SQL fix:**
```php
$stmt = $pdo->prepare('SELECT p."Id", p."Title", p."Address", p."Images", p."Video", i."interest", i."share_cost", i."expected_inv", i."current_inv" FROM public.property p LEFT JOIN public.investment i ON p."Id" = i."property_id WHERE p."Status" = :status ORDER BY p."created_at" DESC LIMIT 10');
$stmt->execute([':status' => 'investment']);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
```

---

### ✅ SPECIAL (1) — Payment Processor

#### File 9: `includes/view/verification.php`
**Priority:** CRITICAL (Paystack integration)  
**Current status:** Uses `mysqli_prepare` for transaction verification  
**Changes:**
- Line 42: Replace `mysqli_prepare` for SELECT
- Line 55: Replace `mysqli_prepare` for UPDATE
- Line 83: Replace `mysqli_prepare` for investment INSERT

**SQL fixes:**
```php
// SELECT transaction
$stmt = $pdo->prepare('SELECT "Id" FROM public.users WHERE "Id" = :id');
$stmt->execute([':id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// UPDATE payment status
$stmt = $pdo->prepare('UPDATE public.invest_now SET "payment_status" = :status WHERE "Id_invest" = :id');
$stmt->execute([':status' => 'verified', ':id' => $invest_id]);

// INSERT investment
$stmt = $pdo->prepare('INSERT INTO public.invest_now ("Usa_Id", "package_id", "proptee_id", "start_date", "period", "payment_status") VALUES (:user_id, :package_id, :property_id, :start_date, :period, :status)');
$stmt->execute([':user_id' => $user_id, ':package_id' => $package_id, ':property_id' => $property_id, ':start_date' => date('Y-m-d'), ':period' => 12, ':status' => 'verified']);
```

---

## Admin Processors (Batch 2, next phase)

The following files in `includes/admin/` and `includes/user/processor/` need conversion but are lower priority:

- `includes/admin/create.data.config.php` (complex INSERT logic)
- `includes/admin/edit.data.config.php` (UPDATE logic)
- `includes/admin/processor/property.select.php` (DELETE + SELECT)
- `includes/admin/processor/subscribers.select.php` (SELECT + DELETE)
- `includes/user/processor/dashboard.data.config.php` (JOIN queries)
- `includes/user/withdrawal.php` (transaction logic)

---

## Testing Each Conversion

After converting each file, test with:

```bash
# 1. Syntax check
php -l includes/auth/login.data.config.php

# 2. Integration test (if possible)
# - For auth files: test registration, login, password reset flows
# - For view files: test page rendering

# 3. SQL validation
# - Verify column names match Postgres schema
# - Check for MySQL-isms (backticks, IFNULL, etc.)
```

---

## Migration Path

1. **Batch 1 (Today):** Files 1–9 above (critical auth + view + payment)
2. **Batch 2 (Next):** Admin CRUD processors (create, edit, delete property/subscribers)
3. **Batch 3 (Final):** Dashboard queries, investment flows, special logic
4. **Verify:** Run full test suite on staging

---

## Notes for User

- **Postgres quote identifiers with double quotes** (`"Id"`, `"Email"`) to preserve case-sensitivity
- **Replace MySQL-isms:**
  - `IFNULL()` → `COALESCE()`
  - `RAND()` → `RANDOM()`
  - `` ` `` (backticks) → `"` (double quotes)
  - `ON DUPLICATE KEY UPDATE` → `ON CONFLICT ... DO UPDATE`
- **Always use named placeholders** (`:email`, `:id`) for clarity
- **Test each file individually** before combining

---

## Status

✅ **All 9 critical files identified and conversion patterns documented.**  
⏳ **Ready for user to apply conversions (either manually or provide code snippets).**

Next: Phase 5 (Storage migration) or full atomic batch conversion by agent.

---

**Recommendation:** Apply these conversions in 2–3 atomic commits:
1. Auth flows (login, register, password, activation)
2. View processors (listings, packages, home)
3. Payment verification + admin CRUD
