<?php
$id = isset($_GET['identity']) ? (int)$_GET['identity'] : 0;

$pdo = require __DIR__ . '/../../../includes/db/pdo_pg.php';

$stmt = $pdo->prepare('SELECT "Title", "Address", "Description", "City", "State", "Bedroom", "Bathroom", "Built_Year", "Area", "Zip_Code", "Images", "Video" FROM public.property WHERE "Id" = :id');
$stmt->execute([':id' => $id]);
$fetch_array = $stmt->fetch(PDO::FETCH_ASSOC) ?: [];

$fetch_array_images = !empty($fetch_array['Images']) ? explode(',', $fetch_array['Images']) : [];
$fetch_array_video = !empty($fetch_array['Video']) ? json_decode($fetch_array['Video']) : null;