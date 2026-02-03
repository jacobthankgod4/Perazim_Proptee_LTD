<?php

require_once __DIR__ . '/../../../includes/db/pdo_pg.php';
$pdo = getPdoPostgres();

$ide = isset($_POST['Id']) ? (int)$_POST['Id'] : 0;

$stmt = $pdo->prepare('SELECT "Id", "Title", "Type", "Status", "Address", "City", "State", "Zip_Code", "Description", "Price", "Area", "Ammenities", "Bedroom", "Bathroom", "Built_Year", "Images", "Video" FROM public.property WHERE "Id" = :id');
$stmt->execute([':id' => $ide]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$fetch_array = count($rows) > 0 ? $rows[0] : [];

$fetch_array_ammeniities = !empty($fetch_array['Ammenities']) ? explode(',', $fetch_array['Ammenities']) : [];


