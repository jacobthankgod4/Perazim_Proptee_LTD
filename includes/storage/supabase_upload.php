<?php
/**
 * Supabase Storage Upload Handler
 * Handles file uploads to Supabase Storage bucket with validation, error handling, and database tracking.
 * 
 * Usage:
 *   require_once __DIR__ . '/../../includes/storage/supabase_upload.php';
 *   $result = uploadToSupabase($_FILES['file'], 'property-images', ['jpg', 'png'], 5 * 1024 * 1024);
 *   if ($result['success']) {
 *       echo $result['path']; // e.g., 'property-images/abc123.jpg'
 *   } else {
 *       echo $result['error'];
 *   }
 */

/**
 * Upload a single file to Supabase Storage
 * 
 * @param array $file $_FILES array element (single file)
 * @param string $bucket Supabase Storage bucket name (e.g., 'uploads', 'property-images')
 * @param array $allowedExtensions Allowed file extensions without dots (e.g., ['jpg', 'png', 'pdf'])
 * @param int $maxFileSize Maximum file size in bytes (default: 5MB)
 * @param bool $useRandomName Use random name instead of original (recommended for security)
 * 
 * @return array ['success' => bool, 'path' => string, 'error' => string, 'publicUrl' => string]
 */
function uploadToSupabase($file, $bucket, $allowedExtensions, $maxFileSize = 5242880, $useRandomName = true) {
    $result = [
        'success' => false,
        'path' => null,
        'error' => null,
        'publicUrl' => null
    ];

    // Validate file upload
    if (!isset($file['error']) || !isset($file['tmp_name']) || !isset($file['name'])) {
        $result['error'] = 'Invalid file upload structure';
        return $result;
    }

    // Check upload errors
    if ($file['error'] !== UPLOAD_ERR_OK) {
        $errors = [
            UPLOAD_ERR_INI_SIZE => 'File exceeds server upload size limit',
            UPLOAD_ERR_FORM_SIZE => 'File exceeds form size limit',
            UPLOAD_ERR_PARTIAL => 'File was partially uploaded',
            UPLOAD_ERR_NO_FILE => 'No file was uploaded',
            UPLOAD_ERR_NO_TMP_DIR => 'Missing temporary directory',
            UPLOAD_ERR_CANT_WRITE => 'Cannot write to disk',
            UPLOAD_ERR_EXTENSION => 'PHP extension rejected the file'
        ];
        $result['error'] = $errors[$file['error']] ?? 'Unknown upload error';
        return $result;
    }

    // Validate file size
    if ($file['size'] > $maxFileSize) {
        $result['error'] = 'File exceeds maximum size of ' . round($maxFileSize / 1024 / 1024, 1) . ' MB';
        return $result;
    }

    // Validate file extension
    $fileExt = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($fileExt, array_map('strtolower', $allowedExtensions), true)) {
        $result['error'] = 'File type not allowed. Allowed types: ' . implode(', ', $allowedExtensions);
        return $result;
    }

    // Get Supabase credentials from environment
    $supabaseUrl = getenv('SUPABASE_URL');
    $supabaseAnonKey = getenv('SUPABASE_ANON_KEY');
    $supabaseServiceKey = getenv('SUPABASE_SERVICE_KEY');

    if (!$supabaseUrl || !$supabaseAnonKey) {
        $result['error'] = 'Supabase configuration missing';
        error_log('Supabase upload error: Missing SUPABASE_URL or SUPABASE_ANON_KEY');
        return $result;
    }

    // Generate file name
    if ($useRandomName) {
        $fileName = bin2hex(random_bytes(16)) . '.' . $fileExt;
    } else {
        // Sanitize original filename
        $fileName = preg_replace('/[^a-zA-Z0-9._-]/', '_', $file['name']);
        // Add timestamp to avoid collisions
        $fileName = time() . '_' . $fileName;
    }

    // Read file contents
    $fileContents = file_get_contents($file['tmp_name']);
    if ($fileContents === false) {
        $result['error'] = 'Failed to read uploaded file';
        return $result;
    }

    // Build Supabase Storage REST API endpoint
    // Reference: https://supabase.com/docs/reference/javascript/storage-from-upload
    $storageEndpoint = rtrim($supabaseUrl, '/') . '/storage/v1/object/' . $bucket . '/' . urlencode($fileName);

    // Prepare request headers
    $headers = [
        'Authorization: Bearer ' . $supabaseAnonKey,
        'Content-Type: ' . mime_content_type($file['tmp_name']),
        'apikey: ' . $supabaseAnonKey
    ];

    // Prepare curl request
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $storageEndpoint,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_POST => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $fileContents,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_SSL_VERIFYHOST => 2
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);

    // Handle curl errors
    if ($curlError) {
        $result['error'] = 'Upload request failed: ' . $curlError;
        error_log('Supabase upload curl error: ' . $curlError);
        return $result;
    }

    // Handle HTTP errors (201 = Created, 200 = OK)
    if ($httpCode !== 200 && $httpCode !== 201) {
        $errorMsg = is_string($response) ? $response : 'HTTP ' . $httpCode;
        $result['error'] = 'Upload failed: ' . $errorMsg;
        error_log('Supabase upload HTTP ' . $httpCode . ': ' . $errorMsg);
        return $result;
    }

    // Success - build object path
    $objectPath = $bucket . '/' . $fileName;
    
    // Build public URL (assumes bucket is set to public)
    // Private buckets require signed URLs generated server-side
    $publicUrl = rtrim($supabaseUrl, '/') . '/storage/v1/object/public/' . $objectPath;

    $result['success'] = true;
    $result['path'] = $objectPath;
    $result['publicUrl'] = $publicUrl;

    return $result;
}

/**
 * Upload multiple files to Supabase Storage (batch upload)
 * 
 * @param array $files Array of $_FILES elements
 * @param string $bucket Supabase Storage bucket name
 * @param array $allowedExtensions Allowed file extensions
 * @param int $maxFileSize Maximum file size per file in bytes
 * 
 * @return array Array of upload results with 'success', 'path', 'error' for each file
 */
function uploadMultipleToSupabase($files, $bucket, $allowedExtensions, $maxFileSize = 5242880) {
    $results = [];

    if (!is_array($files) || empty($files)) {
        return [['success' => false, 'error' => 'No files provided']];
    }

    // Handle single or multiple files
    $fileCount = is_array($files['tmp_name']) ? count($files['tmp_name']) : 1;

    for ($i = 0; $i < $fileCount; $i++) {
        if (is_array($files['tmp_name'])) {
            // Multiple files uploaded
            $singleFile = [
                'name' => $files['name'][$i] ?? 'unknown',
                'tmp_name' => $files['tmp_name'][$i] ?? '',
                'size' => $files['size'][$i] ?? 0,
                'error' => $files['error'][$i] ?? UPLOAD_ERR_NO_FILE,
                'type' => $files['type'][$i] ?? ''
            ];
        } else {
            // Single file uploaded
            $singleFile = $files;
        }

        $results[] = uploadToSupabase($singleFile, $bucket, $allowedExtensions, $maxFileSize);
    }

    return $results;
}

/**
 * Delete a file from Supabase Storage
 * 
 * @param string $objectPath Full object path (e.g., 'property-images/abc123.jpg')
 * @param string $bucket Bucket name
 * 
 * @return array ['success' => bool, 'error' => string]
 */
function deleteFromSupabase($objectPath, $bucket) {
    $result = ['success' => false, 'error' => null];

    $supabaseUrl = getenv('SUPABASE_URL');
    $supabaseServiceKey = getenv('SUPABASE_SERVICE_KEY');

    if (!$supabaseUrl || !$supabaseServiceKey) {
        $result['error'] = 'Supabase configuration missing';
        return $result;
    }

    // Extract filename from object path if full path provided
    if (strpos($objectPath, '/') !== false) {
        $parts = explode('/', $objectPath, 2);
        $fileName = $parts[1] ?? $objectPath;
    } else {
        $fileName = $objectPath;
    }

    $storageEndpoint = rtrim($supabaseUrl, '/') . '/storage/v1/object/' . $bucket . '/' . urlencode($fileName);

    $headers = [
        'Authorization: Bearer ' . $supabaseServiceKey,
        'apikey: ' . $supabaseServiceKey
    ];

    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $storageEndpoint,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_CUSTOMREQUEST => 'DELETE',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_SSL_VERIFYHOST => 2
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);

    if ($curlError || ($httpCode !== 200 && $httpCode !== 204)) {
        $result['error'] = 'Delete failed: ' . ($curlError ?: 'HTTP ' . $httpCode);
        error_log('Supabase delete error: ' . $result['error']);
        return $result;
    }

    $result['success'] = true;
    return $result;
}

/**
 * Get a signed URL for a private bucket file (expires in 1 hour by default)
 * 
 * @param string $objectPath Full object path (e.g., 'private-uploads/abc123.pdf')
 * @param int $expiresIn Expiration time in seconds (default: 3600 = 1 hour)
 * 
 * @return array ['success' => bool, 'url' => string, 'error' => string]
 */
function getSignedUrl($objectPath, $expiresIn = 3600) {
    $result = ['success' => false, 'url' => null, 'error' => null];

    $supabaseUrl = getenv('SUPABASE_URL');
    $supabaseServiceKey = getenv('SUPABASE_SERVICE_KEY');

    if (!$supabaseUrl || !$supabaseServiceKey) {
        $result['error'] = 'Supabase configuration missing';
        return $result;
    }

    // For Supabase REST API, use the sign endpoint
    $parts = explode('/', $objectPath, 2);
    $bucket = $parts[0] ?? '';
    $fileName = $parts[1] ?? $objectPath;

    $signEndpoint = rtrim($supabaseUrl, '/') . '/storage/v1/object/sign/' . $bucket . '/' . urlencode($fileName);

    $headers = [
        'Authorization: Bearer ' . $supabaseServiceKey,
        'apikey: ' . $supabaseServiceKey,
        'Content-Type: application/json'
    ];

    $payload = json_encode(['expiresIn' => $expiresIn]);

    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $signEndpoint,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $payload,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_SSL_VERIFYHOST => 2
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);

    if ($curlError || $httpCode !== 200) {
        $result['error'] = 'Failed to generate signed URL: ' . ($curlError ?: 'HTTP ' . $httpCode);
        error_log('Supabase signed URL error: ' . $result['error']);
        return $result;
    }

    $responseData = json_decode($response, true);
    if (!isset($responseData['signedURL'])) {
        $result['error'] = 'Invalid response from Supabase';
        return $result;
    }

    $result['success'] = true;
    $result['url'] = $responseData['signedURL'];
    return $result;
}

/**
 * Save upload metadata to database
 * 
 * @param PDO $pdo Database connection
 * @param int $userId User ID (optional)
 * @param string $objectPath Supabase object path
 * @param string $originalFileName Original filename
 * @param int $fileSize File size in bytes
 * @param string $mimeType File MIME type
 * @param string $entityType Entity type (e.g., 'property', 'profile', 'document')
 * @param int $entityId Entity ID reference (optional)
 * 
 * @return array ['success' => bool, 'id' => int, 'error' => string]
 */
function saveUploadMetadata($pdo, $userId, $objectPath, $originalFileName, $fileSize, $mimeType, $entityType, $entityId = null) {
    $result = ['success' => false, 'id' => null, 'error' => null];

    try {
        $stmt = $pdo->prepare('
            INSERT INTO public.uploads ("user_id", "object_path", "original_filename", "file_size", "mime_type", "entity_type", "entity_id", "created_at")
            VALUES (:user_id, :object_path, :original_filename, :file_size, :mime_type, :entity_type, :entity_id, NOW())
            RETURNING "id"
        ');

        $stmt->execute([
            ':user_id' => $userId,
            ':object_path' => $objectPath,
            ':original_filename' => $originalFileName,
            ':file_size' => $fileSize,
            ':mime_type' => $mimeType,
            ':entity_type' => $entityType,
            ':entity_id' => $entityId
        ]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $result['success'] = true;
        $result['id'] = $row['id'] ?? null;
    } catch (PDOException $e) {
        $result['error'] = 'Database error: ' . $e->getMessage();
        error_log('Upload metadata save error: ' . $e->getMessage());
    }

    return $result;
}

/**
 * Example usage for property image upload:
 * 
 * require_once __DIR__ . '/../../includes/storage/supabase_upload.php';
 * require_once __DIR__ . '/../../includes/db/pdo_pg.php';
 * 
 * if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['property_image'])) {
 *     $result = uploadToSupabase($_FILES['property_image'], 'property-images', ['jpg', 'jpeg', 'png', 'webp'], 10 * 1024 * 1024);
 *     
 *     if ($result['success']) {
 *         $pdo = getPdoPostgres();
 *         $metaResult = saveUploadMetadata(
 *             $pdo,
 *             $_SESSION['user_id'],
 *             $result['path'],
 *             $_FILES['property_image']['name'],
 *             $_FILES['property_image']['size'],
 *             $_FILES['property_image']['type'],
 *             'property',
 *             $_POST['property_id']
 *         );
 *         
 *         if ($metaResult['success']) {
 *             echo json_encode(['success' => true, 'url' => $result['publicUrl']]);
 *         } else {
 *             echo json_encode(['success' => false, 'error' => $metaResult['error']]);
 *         }
 *     } else {
 *         echo json_encode(['success' => false, 'error' => $result['error']]);
 *     }
 * }
 */
