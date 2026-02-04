# Vercel Environment Variables Setup

## Required Environment Variables

Add these to your Vercel project settings:

1. **DATABASE_URL**
   ```
   postgresql://postgres:YOUR_PASSWORD@db.vqlybihufqliujmgwcgz.supabase.co:5432/postgres
   ```

2. **SUPABASE_URL**
   ```
   https://vqlybihufqliujmgwcgz.supabase.co
   ```

3. **SUPABASE_ANON_KEY**
   ```
   eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InZxbHliaWh1ZnFsaXVqbWd3Y2d6Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3MzQ5NzE5NzQsImV4cCI6MjA1MDU0Nzk3NH0.YOUR_ANON_KEY
   ```

## How to Add Environment Variables in Vercel:

1. Go to your Vercel dashboard
2. Select your project
3. Go to Settings → Environment Variables
4. Add each variable with the values above
5. Redeploy your application

## Test URLs:

After deployment, test these URLs:
- `/debug-env.php` - Check if environment variables are set
- `/test-db.php` - Test database connection
- `/` - Main application

## If Still Getting Blank Page:

1. Check Vercel function logs
2. Ensure all environment variables are set correctly
3. Verify Supabase database password
4. Check if tables exist in your Supabase database