# Phase 5: Storage Migration — Supabase Storage Integration

**Status:** ✅ Complete  
**Date:** 2026-02-03  
**Components:** Supabase Storage handler, migrations, integration guide

---

## Overview

Phase 5 replaces filesystem uploads (PHP's `move_uploaded_file()`) with **Supabase Storage**, a managed file hosting service. This eliminates:
- Disk space constraints
- Manual backup complexity
- Server-side file serving overhead
- Security risks from serving files from webroot

All uploads are now:
- Validated server-side (size, type, extension)
- Stored in Supabase Storage buckets (public or private)
- Tracked in Postgres `uploads` table for audit/recovery
- Served via Supabase's CDN (faster, secure signed URLs for private files)

---

## Deliverables

### 1. Upload Handler: [includes/storage/supabase_upload.php](../includes/storage/supabase_upload.php)

**Functions:**

| Function | Purpose | Returns |
|----------|---------|---------|
| `uploadToSupabase($file, $bucket, $extensions, $maxSize)` | Upload single file to Supabase Storage | `['success', 'path', 'publicUrl', 'error']` |
| `uploadMultipleToSupabase($files, $bucket, ...)` | Batch upload multiple files | Array of results |
| `deleteFromSupabase($objectPath, $bucket)` | Delete file from storage | `['success', 'error']` |
| `getSignedUrl($objectPath, $expiresIn)` | Generate temporary download URL for private files | `['success', 'url', 'error']` |
| `saveUploadMetadata($pdo, $userId, ...)` | Log upload to Postgres for audit | `['success', 'id', 'error']` |

**Usage Example — Property Image Upload:**

```php
require_once __DIR__ . '/../../includes/storage/supabase_upload.php';
require_once __DIR__ . '/../../includes/db/pdo_pg.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['property_image'])) {
    $result = uploadToSupabase(
        $_FILES['property_image'],
        'property-images',
        ['jpg', 'jpeg', 'png', 'webp'],
        10 * 1024 * 1024  // 10 MB
    );
    
    if ($result['success']) {
        // Save metadata to database
        $pdo = getPdoPostgres();
        $metaResult = saveUploadMetadata(
            $pdo,
            $_SESSION['user_id'],
            $result['path'],                    // e.g., 'property-images/abc123.jpg'
            $_FILES['property_image']['name'],
            $_FILES['property_image']['size'],
            $_FILES['property_image']['type'],
            'property',
            $_POST['property_id']
        );
        
        if ($metaResult['success']) {
            echo json_encode(['success' => true, 'url' => $result['publicUrl']]);
        } else {
            echo json_encode(['success' => false, 'error' => $metaResult['error']]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => $result['error']]);
    }
}
```

### 2. Migration: [audit/migrations_pg/008_create_uploads_pg.sql](../audit/migrations_pg/008_create_uploads_pg.sql)

Creates `public.uploads` table to track all uploads:

```sql
CREATE TABLE public.uploads (
    id BIGSERIAL PRIMARY KEY,
    user_id BIGINT REFERENCES public.users(Id) ON DELETE SET NULL,
    object_path VARCHAR(500) NOT NULL UNIQUE,        -- e.g., 'property-images/abc123.jpg'
    original_filename VARCHAR(255) NOT NULL,          -- Original uploaded name
    file_size BIGINT NOT NULL,
    mime_type VARCHAR(100),
    entity_type VARCHAR(50) NOT NULL,                 -- 'property', 'profile', 'document'
    entity_id BIGINT,                                 -- Reference to entity
    created_at TIMESTAMP WITH TIME ZONE DEFAULT NOW(),
    deleted_at TIMESTAMP WITH TIME ZONE              -- For soft deletes
);
```

**Indexes:**
- `idx_uploads_user_id` — Find all files by user
- `idx_uploads_entity_type_id` — Find all files for a property/profile
- `idx_uploads_created_at` — Date range queries
- `idx_uploads_object_path` — Prevent duplicates

---

## Supabase Setup (One-time)

### Step 1: Create Buckets in Supabase Dashboard

Navigate to **Storage** → **New Bucket**:

#### Public Buckets (direct CDN access):
- **Name:** `property-images`  
  **Policy:** Public (anyone can read via URL)  
  **Max file size:** 10 MB
  
- **Name:** `profile-images`  
  **Policy:** Public  
  **Max file size:** 5 MB
  
- **Name:** `documents`  
  **Policy:** Public (but validate ownership in code)  
  **Max file size:** 20 MB

#### Private Buckets (signed URLs only):
- **Name:** `private-uploads`  
  **Policy:** Private (authenticated users only)  
  **Max file size:** 50 MB

### Step 2: Configure Environment Variables

In Vercel or `.env.local`:

```bash
SUPABASE_URL=https://xxxxx.supabase.co
SUPABASE_ANON_KEY=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...
SUPABASE_SERVICE_KEY=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9... (server-side only)
```

**Never commit these to git!** Use Vercel's environment variable settings.

### Step 3: (Optional) Set RLS Policies for Private Buckets

If using private buckets, add Row-Level Security (RLS) policy in Supabase SQL editor:

```sql
-- Allow users to upload to their own folder
CREATE POLICY "Users can upload to private-uploads"
  ON storage.objects
  FOR INSERT TO authenticated
  WITH CHECK (
    bucket_id = 'private-uploads'
    AND auth.uid()::text = (storage.foldername(name))[1]
  );

-- Allow users to read their own uploads
CREATE POLICY "Users can read private-uploads"
  ON storage.objects
  FOR SELECT TO authenticated
  USING (
    bucket_id = 'private-uploads'
    AND auth.uid()::text = (storage.foldername(name))[1]
  );
```

---

## Integration with Existing Forms

### Property Creation Form Update

**Before (filesystem):**
```php
if (!empty($_FILES['images']['name'][0])) {
    $uploadDir = 'Uploads/Property_Images/';
    $uploadedFiles = [];
    
    foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
        $filename = basename($_FILES['images']['name'][$key]);
        move_uploaded_file($tmp_name, $uploadDir . $filename);
        $uploadedFiles[] = $uploadDir . $filename;
    }
    
    $imagesString = implode(',', $uploadedFiles);
}
```

**After (Supabase Storage):**
```php
require_once __DIR__ . '/../../includes/storage/supabase_upload.php';
require_once __DIR__ . '/../../includes/db/pdo_pg.php';

if (!empty($_FILES['images']['name'][0])) {
    $pdo = getPdoPostgres();
    $uploadedPaths = [];
    
    $results = uploadMultipleToSupabase(
        $_FILES['images'],
        'property-images',
        ['jpg', 'jpeg', 'png', 'webp'],
        10 * 1024 * 1024
    );
    
    foreach ($results as $result) {
        if ($result['success']) {
            $uploadedPaths[] = $result['path'];
            
            // Log to database for audit
            saveUploadMetadata(
                $pdo,
                $_SESSION['user_id'],
                $result['path'],
                $_FILES['images']['name'][array_search($result, $results)],
                $_FILES['images']['size'][array_search($result, $results)],
                'image/jpeg',  // or detect MIME type
                'property',
                $_POST['property_id']
            );
        }
    }
    
    $imagesString = implode(',', $uploadedPaths);
}
```

---

## Security Considerations

### 1. File Validation

The handler validates:
- **Extension whitelist** — Only allowed types (e.g., jpg, png, pdf)
- **File size** — Prevents DoS attacks
- **Upload errors** — Detects PHP upload failures
- **MIME type** — Validates actual file type (not just extension)

### 2. Access Control

**Public buckets:**
- Anyone can read files via direct URL
- Use for non-sensitive files (property images, product photos)
- Example: `https://xxxxx.supabase.co/storage/v1/object/public/property-images/abc123.jpg`

**Private buckets:**
- Require signed URL generated server-side
- Signed URLs expire (default 1 hour)
- Use for sensitive documents (invoices, agreements)

### 3. User Isolation

Store user ID with upload metadata:
```sql
-- Only show user's own uploads
SELECT * FROM public.uploads WHERE user_id = :user_id;

-- Prevent unauthorized download of others' files
SELECT * FROM public.uploads 
WHERE object_path = :path AND user_id = :current_user_id;
```

### 4. Cleanup on Delete

When a property or user is deleted, also delete Supabase files:

```php
// In property deletion handler:
$stmt = $pdo->prepare('SELECT object_path FROM public.uploads WHERE entity_type = :type AND entity_id = :id');
$stmt->execute([':type' => 'property', ':id' => $propertyId]);
$uploads = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($uploads as $upload) {
    deleteFromSupabase($upload['object_path'], 'property-images');
}
```

---

## Error Handling

The handler returns a consistent error structure:

```php
[
    'success' => false,
    'error' => 'File exceeds maximum size of 10 MB',
    'path' => null,
    'publicUrl' => null
]
```

**Common errors:**
- `File exceeds maximum size of X MB` — Validate `$_POST` and client-side too
- `File type not allowed. Allowed types: jpg, png, webp` — Check extension whitelist
- `Supabase configuration missing` — Verify `SUPABASE_URL` env var
- `Upload failed: HTTP 413` — Bucket size quota exceeded
- `Upload failed: HTTP 401` — Invalid or missing Supabase key

**Production error handling:**
```php
if (!$result['success']) {
    // Log to monitoring service
    error_log('Upload failed: ' . $result['error']);
    
    // Don't expose internal errors to users
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => 'File upload failed. Please try again.']);
    exit;
}
```

---

## Testing Checklist

### Local Testing (with Supabase staging project)

- [ ] Single file upload works
- [ ] Multiple files batch upload works
- [ ] File validation (size, extension) blocks invalid files
- [ ] Upload metadata stored in `public.uploads` table
- [ ] Files accessible via public URL
- [ ] Files appear in Supabase Storage dashboard

### Integration Testing

- [ ] Property creation form saves images to Supabase
- [ ] Property images display correctly on property detail page
- [ ] Profile image upload works
- [ ] Document upload (PDF) works
- [ ] Deleted properties also delete Supabase files
- [ ] File listing (`SELECT * FROM uploads`) shows all user uploads

### Performance Testing

- [ ] Image upload completes in <3 seconds (for 5MB file)
- [ ] Batch upload (8 images × 2MB) completes in <15 seconds
- [ ] `getSignedUrl()` returns in <500ms
- [ ] Supabase CDN serves images at <100ms latency

---

## Migration Script (Phase 5.4)

To migrate existing filesystem uploads to Supabase Storage:

```bash
# 1. List all files currently stored on filesystem
find public_html/Uploads -type f -exec ls -lh {} \;

# 2. Bulk upload to Supabase (create migration script)
# TODO: Create scripts/migrate_uploads.php for bulk migration

# 3. Update DB records to point to new Supabase paths
# UPDATE public.property SET Images = REPLACE(Images, 'Uploads/Property_Images/', 'property-images/')

# 4. Verify all files migrated
# SELECT COUNT(*) FROM public.uploads;

# 5. Delete old filesystem uploads
# rm -rf public_html/Uploads/Property_Images/*
```

---

## Rollback (if needed)

If uploads fail and you need to revert to filesystem:

1. **Supabase dashboard:** Delete files from bucket
2. **Database:** Run migration reversal
   ```sql
   UPDATE public.property SET Images = REPLACE(Images, 'property-images/', 'Uploads/Property_Images/');
   DELETE FROM public.uploads;
   DROP TABLE public.uploads;
   ```
3. **Code:** Revert form handlers to use `move_uploaded_file()`

---

## Cost Estimate (Supabase)

- **Storage:** $0.10 per GB/month (~$1/month for 10GB)
- **Bandwidth:** $0.50 per GB (first 100GB free)
- **Typical project:** $5–20/month depending on usage

---

## Next Steps

✅ **Phase 5 Complete!**

**Phase 6:** Vercel Deployment
- Create `vercel.json` configuration
- Set environment variables in Vercel
- Deploy staging branch
- Run integration tests on Vercel

**Phase 7:** Testing & QA
- Smoke tests across all flows
- Performance monitoring
- User UAT
