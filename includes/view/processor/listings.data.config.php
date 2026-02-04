<?php

$pdo = require __DIR__ . '/../../../includes/db/pdo_pg.php';

$stmt = $pdo->prepare('SELECT "Id", "Title", "Address", "City", "State", "Zip_Code", "Images" FROM public.property WHERE "Status" = :status');
$stmt->execute([':status' => 'investment']);
$r51 = $stmt->fetchAll(PDO::FETCH_ASSOC);

$fetch_array_id = [];
$fetch_array_title = [];
$fetch_array_address = [];
$fetch_array_city = [];
$fetch_array_state = [];
$fetch_array_zip = [];
$fetch_array_img = [];

$count_fetch_proptee=0;

$countDown=0;
foreach ($r51 as $fetch_array) {  

    $fetch_array_id[$count_fetch_proptee]=$fetch_array['Id'];
    $fetch_array_title[$count_fetch_proptee]=$fetch_array['Title'];
    $fetch_array_address[$count_fetch_proptee]=$fetch_array['Address'];
    $fetch_array_city[$count_fetch_proptee]=$fetch_array['City'];
    $fetch_array_state[$count_fetch_proptee]=$fetch_array['State'];
    $fetch_array_zip[$count_fetch_proptee]=$fetch_array['Zip_Code'];
    $fetch_array_images[$count_fetch_proptee] = explode(',', $fetch_array['Images']);

    $count_fetch_proptee++;
    
}
