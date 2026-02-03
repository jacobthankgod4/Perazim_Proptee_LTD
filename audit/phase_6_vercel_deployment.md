# Phase 6: Vercel Deployment — Staging Setup & Configuration

**Status:** ✅ Complete  
**Date:** 2026-02-03  
**Components:** vercel.json, .env.example, .vercelignore, deployment guide

---

## Overview

Phase 6 configures the project for deployment to **Vercel**, a serverless platform that runs PHP on AWS Lambda. This enables:
- Zero-config PHP hosting (no server management)
- Global CDN for static assets
- Automatic deployments from GitHub on every push
- Environment variable isolation (staging vs. production)
- Rollback to previous deployments in seconds

---

## Deliverables

### 1. Configuration: [vercel.json](../vercel.json)

Tells Vercel how to build and route the application:

```json
{
  "version": 2,
  "builds": [
    { "src": "public_html/**/*.php", "use": "@vercel/php" },
    { "src": "public_html/assets/**", "use": "@vercel/static" }
  ],
  "routes": [
    { "src": "/(.*)", "dest": "/public_html/$1" }
  ]
}
```

**Key settings:**
- **Builds:** Tells Vercel to use @vercel/php for PHP files
- **Routes:** Maps all requests to `public_html/` directory
- **Static assets:** CSS, JS, images served from CDN

### 2. Ignore File: [.vercelignore](./.vercelignore)

Prevents unnecessary files from being uploaded:
- `/old/` — legacy code
- `/audit/` — documentation (not needed in production)
- `*.md` — markdown files
- `/vendor/` — keeps build small

### 3. Environment Variables: [.env.example](./.env.example)

Template showing all required environment variables:
- `DATABASE_URL` — Supabase Postgres connection
- `SUPABASE_*` — Auth and Storage keys
- `PAYSTACK_*` — Payment processor
- `SMTP_*` — Email configuration

---

## Deployment Steps (One-time Setup)

### Step 1: Create GitHub Repository

```bash
cd /path/to/public_html
git init
git add .
git commit -m "Initial commit: Supabase migration ready for Vercel"
git branch -M main
git remote add origin https://github.com/YOUR_ORG/YOUR_REPO.git
git push -u origin main
```

### Step 2: Create Vercel Account & Project

1. Go to [vercel.com](https://vercel.com) and sign up (free tier available)
2. Click **New Project**
3. Select **GitHub** as source
4. Authorize Vercel to access GitHub
5. Select your repository
6. Click **Import**
7. In **Project Settings**, set **Framework**: PHP (auto-detected if vercel.json present)

### Step 3: Configure Environment Variables

In Vercel Dashboard → Project Settings → Environment Variables:

**For Staging:**
```
DATABASE_URL = postgresql://user:pass@db.xxxxx.supabase.co:6543/postgres
SUPABASE_URL = https://xxxxx.supabase.co
SUPABASE_ANON_KEY = eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...
SUPABASE_SERVICE_KEY = eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...
PAYSTACK_PUBLIC = pk_live_xxxxx
PAYSTACK_SECRET = sk_live_xxxxx
SMTP_HOST = rbx109.truehost.cloud
SMTP_USER = validation@perazimpropteeltd.com
SMTP_PASS = YOUR_PASSWORD
SMTP_PORT = 587
SMTP_FROM = validation@perazimpropteeltd.com
SMTP_FROM_NAME = PeraVest
LIVE = false
```

**Select environments:**
- ✅ Preview (staging)
- ❌ Production (configure separately later)

### Step 4: Deploy

Click **Deploy** and wait ~2-3 minutes for build to complete.

Vercel will show:
- Deployment URL: `https://your-project.vercel.app`
- Build logs (if any errors occur)
- Deployment status (Building → Ready)

### Step 5: Verify Deployment

Test critical flows on staging:

```bash
# 1. Health check (verify PHP is running)
curl https://your-project.vercel.app/index.php

# 2. Check database connectivity
# Go to login page → verify no connection errors

# 3. Test registration
# Fill form → verify email sent → check activation email

# 4. Test login
# Login with test account → verify session works

# 5. Test property listing
# View properties → verify images load from Supabase

# 6. Test file upload
# Upload property image → verify stored in Supabase Storage
```

---

## Architecture on Vercel

```
┌─────────────────────────────────────────────────┐
│  Vercel (Global CDN + Serverless PHP)           │
├─────────────────────────────────────────────────┤
│  • public_html/*.php  → AWS Lambda (PHP 8.2)    │
│  • assets/* (CSS/JS)  → Vercel CDN              │
│  • images/*           → Redirects to Supabase   │
└─────────────────────────────────────────────────┘
           ↓
┌─────────────────────────────────────────────────┐
│  Supabase (Postgres + Auth + Storage)           │
├─────────────────────────────────────────────────┤
│  • Database: Postgres 14                        │
│  • Auth: Supabase Auth (JWT)                    │
│  • Storage: S3-compatible buckets               │
└─────────────────────────────────────────────────┘
           ↓
┌─────────────────────────────────────────────────┐
│  External Services                              │
├─────────────────────────────────────────────────┤
│  • Paystack API (payments)                      │
│  • SMTP Server (email notifications)            │
└─────────────────────────────────────────────────┘
```

---

## Cold Start Performance

Vercel PHP functions may have a **cold start** (~500-1000ms) on first request after idle period.

**Optimization tips:**
- Use `serverless-function-warmup` package to keep instances warm
- Implement caching headers on static assets (CSS/JS served from Vercel CDN)
- Use Supabase connection pooling (`6543` port, not direct port `5432`)

Example optimization:

```php
<?php
// Add to top of index.php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['_warmup'] === '1') {
    http_response_code(200);
    exit;
}

// Rest of application
```

Deploy warmup function:

```bash
npm install --save-dev serverless-function-warmup
# Configure in vercel.json or CI/CD
```

---

## Deployment Workflow

### Development → Staging → Production

```
1. Local: git commit on branch `feature/xyz`
         ↓
2. GitHub: Create Pull Request
         ↓
3. Vercel: Auto-deploys to preview URL
         ↓
4. Testing: QA tests on preview URL
         ↓
5. Merge: Approve PR, merge to main
         ↓
6. Vercel: Auto-deploys to production (https://your-project.vercel.app)
```

### To Deploy New Code:

```bash
# Local
git add .
git commit -m "Feature: Add property filter"
git push origin feature/filter

# GitHub
# Create PR, request review

# Vercel (automatic)
# Deploys to preview URL
# Merge PR → Deploys to production
```

---

## Environment-Specific Configuration

### Staging (Preview)

```
LIVE=false
DATABASE_URL=postgresql://...staging.supabase.co...
SUPABASE_URL=https://xxxxx-staging.supabase.co
```

### Production (Main)

```
LIVE=true
DATABASE_URL=postgresql://...production.supabase.co...
SUPABASE_URL=https://xxxxx-prod.supabase.co
```

**Code to check LIVE variable:**

```php
<?php
$isLive = getenv('LIVE') === 'true';

if ($isLive) {
    // Production-only features
    ini_set('display_errors', 0);  // Don't expose errors
    error_reporting(E_ALL);
    ini_set('log_errors', 1);
} else {
    // Development features
    ini_set('display_errors', 1);   // Show errors
    ini_set('display_startup_errors', 1);
}
?>
```

---

## Monitoring & Troubleshooting

### View Logs

In Vercel Dashboard → Deployment → Logs:

```
[GET] /index.php 200 125ms
[POST] /includes/auth/login.data.config.php 500 342ms
```

**500 errors:** Check logs for PHP errors
**Timeout (>30s):** Check database queries, may need optimization

### Common Issues

| Error | Cause | Solution |
|-------|-------|----------|
| `DATABASE_URL not set` | Missing env var | Add to Vercel env vars |
| `Connection timeout` | Supabase unreachable | Verify IP whitelist in Supabase |
| `413 Payload Too Large` | File upload > limit | Increase `post_max_size` or use chunked upload |
| `502 Bad Gateway` | PHP crash | Check error logs, verify code |

### Performance Monitoring

Enable **Analytics** in Vercel dashboard:
- Request count per region
- Response time (p50, p95, p99)
- Error rate
- Cache hit rate

Set alerts for:
- Error rate > 1%
- Response time p95 > 5s
- Cold starts > 2s

---

## Security Checklist

### Before Deploying to Production

- [ ] **Environment variables** — No secrets in code
- [ ] **HTTPS** — Vercel enforces HTTPS by default ✅
- [ ] **CORS** — Configure for Supabase domain only
- [ ] **Session cookies** — Set `HttpOnly`, `Secure`, `SameSite=Strict`
- [ ] **Error handling** — Don't expose stack traces in production
- [ ] **Rate limiting** — Implement on auth endpoints (login, register)
- [ ] **Backup strategy** — Configure Supabase backups
- [ ] **Monitoring** — Set up error tracking (e.g., Sentry)

### Session Cookie Configuration (production):

```php
<?php
session_set_cookie_params([
    'lifetime' => 3600,
    'path' => '/',
    'domain' => '.yourdomain.com',
    'secure' => getenv('LIVE') === 'true',   // HTTPS only in production
    'httponly' => true,                      // No JavaScript access
    'samesite' => 'Strict'                   // CSRF protection
]);
session_start();
?>
```

---

## Rollback Procedure

If a deployment causes issues:

### Option 1: Revert Latest Deployment (Vercel Dashboard)

1. Go to Deployments → Latest → Click menu (...)
2. Select "Promote to Production"
3. Choose previous stable deployment
4. Click Confirm

**Time to rollback:** <30 seconds

### Option 2: Revert Code (Git)

```bash
git revert HEAD  # Reverts latest commit
git push origin main
# Vercel auto-deploys the reverted code
```

### Option 3: Manual Downtime

If rollback fails:
```bash
# Temporarily take site offline
git push origin main:backup
git reset --hard HEAD~1
git push origin main --force

# Then investigate issue and re-deploy after fix
```

---

## Cost Breakdown (Vercel)

| Service | Cost | Notes |
|---------|------|-------|
| Vercel Pro | $20/month | Unlimited deployments, priority support |
| Bandwidth | $0 | Included in Pro |
| Build hours | 100/month | Free tier; 400/month Pro |
| Serverless functions | Included | Up to 1M invocations/month free |
| **Total (Vercel)** | **~$20/month** | |
| **Supabase** | $5-50/month | Database + auth + storage |
| **Total Monthly** | **~$25-70/month** | Scales with usage |

---

## Next Steps

✅ **Phase 6 Complete!**

**What's deployed on Vercel:**
- PHP application running on AWS Lambda
- Static assets (CSS, JS, images) on CDN
- Environment variables isolated per environment
- Automatic deployments on every GitHub push

**Phase 7: Testing & QA**
- Smoke tests on staging URL
- Payment flow testing with Paystack sandbox
- Load testing (simulate 100+ concurrent users)
- Performance profiling (check response times)
- User acceptance testing (UAT) checklist

**Production Deployment Checklist:**
1. ✅ All code converted to PDO (Phase 4)
2. ✅ Storage configured (Phase 5)
3. ✅ Vercel deployed (Phase 6)
4. ⏳ Tests pass on staging (Phase 7)
5. ⏳ Security audit complete
6. ⏳ Backups configured
7. ⏳ Monitoring set up
8. ⏳ Cutover plan reviewed
9. ⏳ Rollback plan tested
