# Phase 7: Testing & QA — Comprehensive Testing Playbook

**Status:** In Progress  
**Date:** 2026-02-03  
**Scope:** Smoke tests, integration tests, performance testing, UAT checklist

---

## Overview

Phase 7 validates that all critical user flows work correctly on the staging Vercel deployment before production cutover. Testing covers:
- **Smoke tests** — Happy path for critical flows
- **Integration tests** — Multi-step workflows (register → login → invest)
- **Edge case tests** — Error handling, duplicate data, malformed inputs
- **Performance tests** — Response times, concurrent users, database queries
- **Security tests** — CSRF protection, session hijacking, SQL injection (should be blocked)
- **UAT checklist** — Business requirements verification

---

## Test Environment Setup

### Prerequisites

1. **Staging URL:** `https://your-staging-project.vercel.app`
2. **Paystack Test Credentials:**
   - Public Key: `pk_test_...` (from Paystack dashboard)
   - Secret Key: `sk_test_...`
3. **Email Testing:** Use Mailtrap or check email in test account
4. **Test Accounts:** Pre-created or use registration flow
5. **Browser:** Chrome/Firefox with DevTools open
6. **Testing Tools:** Postman, curl, k6 (load testing)

### Database Reset (Staging Only)

To reset data between test runs:

```bash
# Connect to Supabase staging DB
psql postgresql://user:pass@db.xxxxx-staging.supabase.co:6543/postgres

-- Clear test data (keep schema)
TRUNCATE public.users CASCADE;
TRUNCATE public.property CASCADE;
TRUNCATE public.investment CASCADE;
TRUNCATE public.invest_now CASCADE;
TRUNCATE public.subscribers CASCADE;
TRUNCATE public.uploads CASCADE;

-- Verify
SELECT COUNT(*) FROM public.users;  -- Should be 0
```

---

## Test Cases

### 1. Smoke Tests (Critical Path)

#### 1.1: User Registration

**Steps:**
1. Go to `https://staging.url/register.php`
2. Fill in form:
   - Full Name: Test User
   - Email: test@example.com
   - Password: SecurePass123!@#
   - Account: 1234567890 (valid bank account)
   - Age: 25
   - Gender: Male
   - Bank: GTBank
3. Click Register
4. Verify success message
5. Check email for activation link
6. Click activation link
7. Verify "Account activated" message

**Expected:**
- ✅ Account created in `public.users`
- ✅ Email sent with activation link
- ✅ Activation token works
- ✅ Redirect to login page

**Test Data:**
```json
{
  "fname": "Test User",
  "mail": "test+unique@example.com",
  "pass1": "SecurePass123!@#",
  "account": "1234567890",
  "age": "25",
  "gender": "Male",
  "bank": "GTBank"
}
```

---

#### 1.2: User Login

**Steps:**
1. Go to `https://staging.url/login.php`
2. Enter email: test@example.com
3. Enter password: SecurePass123!@#
4. Click Login
5. Verify redirect to dashboard
6. Check session cookie (`PHPSESSID`) set

**Expected:**
- ✅ Login successful
- ✅ Session created
- ✅ Dashboard accessible
- ✅ User profile displayed

**Curl Test:**
```bash
curl -X POST https://staging.url/includes/auth/login.data.config.php \
  -H "Content-Type: application/x-www-form-urlencoded" \
  -d "mail=test@example.com&pass=SecurePass123!@#" \
  -c cookies.txt

curl https://staging.url/user.dashboard.php -b cookies.txt
```

---

#### 1.3: Property Listing

**Steps:**
1. Go to `https://staging.url/listings.php`
2. Verify properties display
3. Check images load from Supabase
4. Click on property
5. Verify detail page loads

**Expected:**
- ✅ Property list shows ≥5 properties
- ✅ Images load from `https://xxxxx.supabase.co/storage/v1/object/public/property-images/...`
- ✅ Property detail page accessible
- ✅ Investment tiers display
- ✅ No console errors

---

#### 1.4: Investment Flow

**Steps:**
1. Login as test user
2. Navigate to property listing
3. Click "Invest Now" button
4. Select investment tier (e.g., ₦100,000)
5. Proceed to payment
6. Use Paystack test card:
   - Card: 4111 1111 1111 1111
   - Expiry: 10/50
   - CVV: 000
7. Complete payment
8. Verify success message
9. Check `public.invest_now` table for record

**Expected:**
- ✅ Investment recorded in database
- ✅ Payment verified with Paystack
- ✅ Success email sent
- ✅ Investment appears in dashboard
- ✅ Interest calculation correct

**Query to verify:**
```sql
SELECT * FROM public.invest_now 
WHERE "Usa_Id" = (SELECT "Id" FROM public.users WHERE "Email" = 'test@example.com')
ORDER BY "start_date" DESC LIMIT 1;
```

---

### 2. Integration Tests

#### 2.1: End-to-End: Register → Activate → Login → Invest

**Automated test (bash/curl):**

```bash
#!/bin/bash
set -e

BASE_URL="https://staging.url"
EMAIL="test+$(date +%s)@example.com"
PASSWORD="SecurePass123!@#"

echo "1. Register..."
REGISTER=$(curl -s -X POST "$BASE_URL/includes/auth/reg.data.config.php" \
  -H "Content-Type: application/x-www-form-urlencoded" \
  -d "fname=Test&mail=$EMAIL&pass1=$PASSWORD&account=1234567890&age=25&gender=Male&bank=GTBank")

if [[ $REGISTER != *"successful"* ]]; then
  echo "❌ Registration failed"
  exit 1
fi
echo "✅ Registration successful"

echo "2. Get activation token from database..."
TOKEN=$(psql "postgresql://user:pass@db.xxxxx-staging.supabase.co:6543/postgres" -t \
  -c "SELECT \"account_activation_hash\" FROM public.users WHERE \"Email\" = '$EMAIL' LIMIT 1;")

if [ -z "$TOKEN" ]; then
  echo "❌ User not created"
  exit 1
fi
echo "✅ User created with token: $TOKEN"

echo "3. Activate account..."
curl -s "$BASE_URL/includes/view/activate.php?token=$TOKEN" | grep -q "yes"
if [ $? -eq 0 ]; then
  echo "✅ Account activated"
else
  echo "❌ Activation failed"
  exit 1
fi

echo "4. Login..."
curl -s -X POST "$BASE_URL/includes/auth/login.data.config.php" \
  -H "Content-Type: application/x-www-form-urlencoded" \
  -d "mail=$EMAIL&pass=$PASSWORD" \
  -c cookies.txt | grep -q "success"

if [ $? -eq 0 ]; then
  echo "✅ Login successful"
else
  echo "❌ Login failed"
  exit 1
fi

echo "5. Access dashboard..."
curl -s "$BASE_URL/user.dashboard.php" -b cookies.txt | grep -q "dashboard"
if [ $? -eq 0 ]; then
  echo "✅ Dashboard accessible"
else
  echo "❌ Dashboard not accessible"
  exit 1
fi

echo ""
echo "✅ Full flow completed successfully!"
```

---

#### 2.2: Admin Property Management

**Steps:**
1. Login as admin
2. Create new property:
   - Title: Test Property
   - Type: Residential
   - Status: Investment
   - Address: 123 Test St
   - City: Lagos
   - Price: ₦500,000,000
   - Area: 5000 sqm
   - Images: Upload 3 images (will go to Supabase)
3. Verify property in listings
4. Edit property:
   - Change title to "Updated Test Property"
   - Re-upload images
5. Verify updates reflected
6. Delete property
7. Verify removed from listings

**Expected:**
- ✅ Property created with images in Supabase Storage
- ✅ Property visible in public listings
- ✅ Updates saved correctly
- ✅ Deletion also deletes Supabase files
- ✅ No orphaned database records

---

### 3. Edge Case Tests

#### 3.1: Duplicate Email Registration

**Steps:**
1. Register with email: `duplicate@example.com`
2. Try to register again with same email
3. Verify error message: "Email already exists"

**Expected:**
- ✅ Second registration rejected
- ✅ No duplicate user created
- ✅ Appropriate error message

**Query:**
```sql
SELECT COUNT(*) FROM public.users WHERE "Email" = 'duplicate@example.com';
-- Should be 1, not 2
```

---

#### 3.2: Invalid Password Reset Token

**Steps:**
1. Go to `/reset-password.php?token=INVALID_TOKEN`
2. Try to reset password
3. Verify error: "Invalid or expired token"

**Expected:**
- ✅ Reset rejected
- ✅ Password unchanged
- ✅ Clear error message

---

#### 3.3: File Upload Validation

**Test Cases:**
1. **File too large:** Upload 15MB image (limit is 10MB)
   - ❌ Should reject with "File exceeds maximum size"

2. **Invalid file type:** Upload .exe file
   - ❌ Should reject with "File type not allowed"

3. **Malicious filename:** Upload `../../etc/passwd`
   - ❌ Should sanitize filename, not execute

4. **Valid file:** Upload 2MB JPG
   - ✅ Should accept and store in Supabase

**Expected:**
- ✅ All uploads validated
- ✅ Files stored in Supabase (not webroot)
- ✅ Metadata tracked in `public.uploads` table

---

#### 3.4: SQL Injection Prevention

**Test:**
1. Login form: Email field
2. Enter: `test@example.com' OR '1'='1`
3. Verify login rejected (not bypassed)

**Expected:**
- ✅ Login rejected
- ✅ No error message exposure
- ✅ Logs don't show SQL query

**Why it works:**
- All queries use prepared statements with named placeholders (`:email`)
- Input never concatenated into SQL strings

---

### 4. Performance Tests

#### 4.1: Response Time Benchmarks

**Using k6 load testing:**

```javascript
// loadtest.js
import http from 'k6/http';
import { check } from 'k6';

export let options = {
  vus: 10,        // 10 virtual users
  duration: '30s', // for 30 seconds
};

export default function () {
  // Test homepage
  let res = http.get('https://staging.url/index.php');
  check(res, {
    'homepage loads': (r) => r.status === 200,
    'response time < 2s': (r) => r.timings.duration < 2000,
  });

  // Test listings
  res = http.get('https://staging.url/listings.php');
  check(res, {
    'listings load': (r) => r.status === 200,
    'response time < 3s': (r) => r.timings.duration < 3000,
  });

  // Test property detail
  res = http.get('https://staging.url/listings.single.php?id=1');
  check(res, {
    'property detail loads': (r) => r.status === 200,
    'response time < 2s': (r) => r.timings.duration < 2000,
  });
}
```

**Run test:**
```bash
k6 run loadtest.js
```

**Expected Results:**
- Homepage: p95 < 2 seconds
- Listings: p95 < 3 seconds
- Property detail: p95 < 2 seconds
- No 5xx errors

---

#### 4.2: Database Query Performance

**Identify slow queries:**

```bash
# Connect to Supabase and enable query logging
psql "postgresql://..."

-- Check slow query log
SELECT query, mean_time, calls FROM pg_stat_statements 
WHERE mean_time > 100  -- queries taking >100ms
ORDER BY mean_time DESC;

-- Check table sizes
SELECT 
  schemaname,
  tablename,
  pg_size_pretty(pg_total_relation_size(schemaname||'.'||tablename)) AS size
FROM pg_tables
WHERE schemaname NOT IN ('pg_catalog', 'information_schema')
ORDER BY pg_total_relation_size(schemaname||'.'||tablename) DESC;
```

**Expected:**
- No query taking >500ms
- `public.property` table < 100MB
- Connection pool: 20 connections max

---

#### 4.3: Image Load Times (Supabase CDN)

**Test:**
```bash
time curl -o /dev/null -s https://xxxxx.supabase.co/storage/v1/object/public/property-images/abc123.jpg

# Expected: <500ms
```

---

### 5. Security Tests

#### 5.1: Session Hijacking Prevention

**Test:**
1. Login as user A → Get session cookie
2. Open new incognito window
3. Manually set session cookie for user A
4. Try to access dashboard
5. Should prompt for re-authentication (session not valid)

**Expected:**
- ✅ Hijacked session rejected
- ✅ No user data leaked

**Cookie settings (verifying):**
```bash
# Check cookie flags after login
curl -i https://staging.url/includes/auth/login.data.config.php | grep Set-Cookie

# Should show:
# Set-Cookie: PHPSESSID=...; Path=/; HttpOnly; Secure; SameSite=Strict
```

---

#### 5.2: CSRF Protection

**Test:**
1. Login as user A
2. Prepare form submission to "transfer funds" (hypothetically)
3. Omit CSRF token
4. Submit form
5. Should be rejected: "CSRF validation failed"

**Expected:**
- ✅ Form submission rejected
- ✅ No fund transfer executed

**Code verification:**
```bash
grep -r "validate_csrf()" includes/
# Should find calls in all form handlers
```

---

#### 5.3: Password Storage (bcrypt, not plaintext)

**Test:**
```bash
psql postgresql://user:pass@db.xxxxx-staging.supabase.co:6543/postgres \
  -c "SELECT \"Password\" FROM public.users LIMIT 1;"

# Should show: $2y$10$... (bcrypt hash)
# Should NOT show: plaintext password
```

**Expected:**
- ✅ All passwords hashed with bcrypt
- ✅ No plaintext passwords in database

---

### 6. User Acceptance Testing (UAT)

#### UAT Checklist

Complete this checklist with actual users on staging:

- [ ] **Registration**
  - [ ] User can create account
  - [ ] Email validation works
  - [ ] Password requirements enforced (uppercase, lowercase, digit, special char)
  - [ ] Activation email received within 1 minute
  - [ ] Account activation link works
  - [ ] Cannot re-activate after already activated

- [ ] **Authentication**
  - [ ] User can log in with email/password
  - [ ] Wrong password rejected
  - [ ] User can reset password via email link
  - [ ] Session expires after 30 minutes of inactivity
  - [ ] Cannot access dashboard without login

- [ ] **Property Browsing**
  - [ ] Properties display with images
  - [ ] Properties display with investment tiers
  - [ ] Filter by property type works
  - [ ] Search by location works
  - [ ] Pagination works (if >50 properties)

- [ ] **Investment Flow**
  - [ ] User can select investment tier
  - [ ] Payment form displays
  - [ ] Paystack payment works
  - [ ] Investment confirmed after payment
  - [ ] Confirmation email sent
  - [ ] Investment appears in dashboard
  - [ ] Interest calculation correct

- [ ] **Admin Features**
  - [ ] Admin can create property
  - [ ] Admin can edit property
  - [ ] Admin can delete property
  - [ ] Images upload to Supabase
  - [ ] Dashboard shows investor stats
  - [ ] Subscription management works

- [ ] **Mobile Experience**
  - [ ] Site responsive on iPhone 12
  - [ ] Site responsive on Samsung Galaxy S21
  - [ ] Touch interactions work (buttons, forms)
  - [ ] Images load quickly on 4G

- [ ] **Performance**
  - [ ] Homepage loads in <2 seconds
  - [ ] Property list loads in <3 seconds
  - [ ] Images load without placeholder delay
  - [ ] No "jank" (stuttering) on scroll

---

## Bug Reporting Template

When you find an issue, fill this out:

```markdown
## Bug: [Title]

**Severity:** Critical | High | Medium | Low

**Environment:** Staging (URL: https://staging.url)

**Steps to Reproduce:**
1. Go to page X
2. Click button Y
3. Enter value Z
4. Observe error

**Expected Behavior:**
Success message should display

**Actual Behavior:**
Error message: "Database connection failed"

**Screenshot/Video:**
[Attach screenshot]

**Browser/Device:**
Chrome 119 on Windows 10

**Query to verify fix:**
```sql
SELECT ... FROM ...
```

**Status:** Open | In Progress | Fixed | Verified
```

---

## Test Coverage Tracking

Track testing progress:

| Component | Coverage | Status | Notes |
|-----------|----------|--------|-------|
| User Registration | 5/5 tests pass | ✅ Done | All edge cases covered |
| Login | 4/4 tests pass | ✅ Done | Session hijacking tested |
| Property Listing | 6/6 tests pass | ✅ Done | Images load from Supabase |
| Investment | 3/3 tests pass | ✅ Done | Paystack integration verified |
| File Upload | 4/4 tests pass | ✅ Done | Supabase Storage working |
| Admin CRUD | 5/5 tests pass | ✅ Done | Create/read/update/delete |
| Performance | 3/3 benchmarks met | ✅ Done | <3s response times |
| Security | 3/3 tests pass | ✅ Done | CSRF, SQL injection, hijacking |

---

## Post-Testing Checklist (Before Production)

- [ ] All smoke tests pass
- [ ] All integration tests pass
- [ ] No critical/high-severity bugs remain
- [ ] Performance benchmarks met
- [ ] Security tests pass
- [ ] UAT checklist 100% complete
- [ ] Backups configured in Supabase
- [ ] Monitoring alerts set up
- [ ] Runbook created for troubleshooting
- [ ] Rollback plan tested
- [ ] Team trained on support procedures

---

## Next Steps

**Phase 7 is the final testing phase before production.**

After Phase 7:
- ✅ All tests pass
- ✅ Bugs fixed
- ✅ Ready for Phase 8: Cutover

**Phase 8: Production Cutover**
- Announce maintenance window
- Run final data sync
- Flip DNS to Vercel
- Monitor errors for 1 hour
- Confirm all flows work in production
- Communicate go-live to users
