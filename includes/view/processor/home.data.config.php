<?php

require_once __DIR__ . '/../../../includes/db/pdo_pg.php';
$pdo = getPdoPostgres();

$stmt = $pdo->prepare('SELECT p."Id", p."Title", p."Type", p."Address", p."City", p."State", p."Zip_Code", p."Images", p."Video", i."interest", i."share_cost", i."expected_inv", i."current_inv" FROM public.property p LEFT JOIN public.investment i ON p."Id"=i.property_id ORDER BY RANDOM() LIMIT 4');
$stmt->execute();
$r51 = $stmt->fetchAll(PDO::FETCH_ASSOC);

$fetch_array_id = [];
$fetch_array_title = [];
$fetch_array_type = [];
$fetch_array_address = [];
$fetch_array_city = [];
$fetch_array_state = [];
$fetch_array_zip = [];
$fetch_array_img = [];
$fetch_array_video = [];
$fetch_array_interest = [];
$fetch_array_share_cost = [];
$fetch_array_expected_inv = [];
$fetch_array_current_inv = [];

$count_fetch_proptee=0;

$countDown=0;
if (count($r51) > 0) {
foreach ($r51 as $fetch_array) {  
    $fetch_array_id[$count_fetch_proptee]=$fetch_array['Id'];
    $fetch_array_title[$count_fetch_proptee]=$fetch_array['Title'];
$fetch_array_type[$count_fetch_proptee]=$fetch_array['Type'];
$fetch_array_address[$count_fetch_proptee]=$fetch_array['Address'];
$fetch_array_city[$count_fetch_proptee]=$fetch_array['City'];
$fetch_array_state[$count_fetch_proptee]=$fetch_array['State'];
$fetch_array_zip[$count_fetch_proptee]=$fetch_array['Zip_Code'];
$fetch_array_images[$count_fetch_proptee] = explode(',', $fetch_array['Images']);
$fetch_array_video[$count_fetch_proptee]=$fetch_array['Video'];

$fetch_array_share_cost[$count_fetch_proptee]=$fetch_array['share_cost'];
$fetch_array_expected_inv[$count_fetch_proptee]=$fetch_array['expected_inv'];
$fetch_array_current_inv[$count_fetch_proptee]=$fetch_array['current_inv'];

$fetch_array_no_of[$count_fetch_proptee]=round($fetch_array_current_inv[$count_fetch_proptee]/$fetch_array_share_cost[$count_fetch_proptee]);

$fetch_array_percent[$count_fetch_proptee]=round(($fetch_array_current_inv[$count_fetch_proptee]/$fetch_array_expected_inv[$count_fetch_proptee])*100);

$fetch_array_generated[$count_fetch_proptee]=round($fetch_array_current_inv[$count_fetch_proptee]/1000000);

    
    if ($fetch_array_share_cost[$count_fetch_proptee] <= 500000) {
            
            $fetch_array_interest[$count_fetch_proptee]=18.5;
        
    } elseif ($fetch_array_share_cost[$count_fetch_proptee] >= 500000) {
        
            $fetch_array_interest[$count_fetch_proptee]=16;
            
    } 
    
    $count_fetch_proptee++;
    
}
}