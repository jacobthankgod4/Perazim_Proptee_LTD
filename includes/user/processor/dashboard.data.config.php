<?php

$ide4= $_SESSION['user_id'];

$pdo = require __DIR__ . '/../../../includes/db/pdo_pg.php';

$stmt = $pdo->prepare('SELECT p."Title", p."Address", p."Images", in."proptee_id", in."package_id", in."start_date", in."period", inv."interest", inv."share_cost" FROM public.invest_now in INNER JOIN public.investment inv ON in."package_id"=inv."Id_in" INNER JOIN public.property p ON inv."property_id"=p."Id" WHERE in."Usa_Id" = :user_id');
$stmt->execute([':user_id' => (int)$ide4]);
$r51 = $stmt->fetchAll(PDO::FETCH_ASSOC);

$fetch_array_title = [];
$fetch_array_address = [];
$fetch_array_proptee = [];
$fetch_array_package = [];
$fetch_array_images = [];
$fetch_array_interest = [];
$fetch_array_share_cost = [];
$fetch_array_start = [];
$fetch_array_duration = [];

$count_fetch_proptee=0;
$aggr_invest=0;
$countDown=0;

if (count($r51) > 0) {
foreach ($r51 as $fetch_array) {  
    
    $fetch_array_title[$count_fetch_proptee]=$fetch_array['Title'];
    $fetch_array_address[$count_fetch_proptee]=$fetch_array['Address'];
    $fetch_array_proptee[$count_fetch_proptee]=$fetch_array['proptee_id'];
    $fetch_array_package[$count_fetch_proptee]=$fetch_array['package_id'];
    $fetch_array_images[$count_fetch_proptee] = explode(',', $fetch_array['Images']);
    $fetch_array_interest[$count_fetch_proptee]=$fetch_array['interest'];
    $fetch_array_share_cost[$count_fetch_proptee]=$fetch_array['share_cost'];
    $fetch_array_start[$count_fetch_proptee]=$fetch_array['start_date'];
    $fetch_array_duration[$count_fetch_proptee]=$fetch_array['period'];

    $dbDate[$count_fetch_proptee] = new DateTime($fetch_array_start[$count_fetch_proptee]);
    $currentDate[$count_fetch_proptee] = new DateTime();
    $interval[$count_fetch_proptee] = $currentDate[$count_fetch_proptee]->diff($dbDate[$count_fetch_proptee]);
    $daysDifference[$count_fetch_proptee] = $interval[$count_fetch_proptee]->days;

    if ($fetch_array_share_cost[$count_fetch_proptee] <= 500000) {
        if ($fetch_array_duration[$count_fetch_proptee]==6) {
            $interest_build_up[$count_fetch_proptee]=($daysDifference[$count_fetch_proptee]
            *
            ($fetch_array_share_cost[$count_fetch_proptee]*(9.25/100))
            /
            (6*30)+$fetch_array_share_cost[$count_fetch_proptee]);
            $aggr_invest+=$interest_build_up[$count_fetch_proptee];
        } elseif ($fetch_array_duration[$count_fetch_proptee]==12) {
            $interest_build_up[$count_fetch_proptee]=($daysDifference[$count_fetch_proptee]
            *
            ($fetch_array_share_cost[$count_fetch_proptee]*(18.5/100))
            /
            (12*30)+$fetch_array_share_cost[$count_fetch_proptee]);
            $aggr_invest+=$interest_build_up[$count_fetch_proptee];
        }elseif($fetch_array_duration[$count_fetch_proptee]==24) {
            $interest_build_up[$count_fetch_proptee]=($daysDifference[$count_fetch_proptee]
            *
            ($fetch_array_share_cost[$count_fetch_proptee]*(37/100))
            /
            (24*30)+$fetch_array_share_cost[$count_fetch_proptee]);
            $aggr_invest+=$interest_build_up[$count_fetch_proptee];
        }elseif($fetch_array_duration[$count_fetch_proptee]==60){
            $interest_build_up[$count_fetch_proptee]=($daysDifference[$count_fetch_proptee]
            *
            ($fetch_array_share_cost[$count_fetch_proptee]*(92.5/100))
            /
            (60*30)+$fetch_array_share_cost[$count_fetch_proptee]);
            $aggr_invest+=$interest_build_up[$count_fetch_proptee];
        }
        
    } elseif ($fetch_array_share_cost[$count_fetch_proptee] >= 500000) {
        if ($fetch_array_duration[$count_fetch_proptee]==6) {
            $interest_build_up[$count_fetch_proptee]=($daysDifference[$count_fetch_proptee]
            *
            ($fetch_array_share_cost[$count_fetch_proptee]*(8.8/100))
            /
            (6*30)+$fetch_array_share_cost[$count_fetch_proptee]);
            $aggr_invest+=$interest_build_up[$count_fetch_proptee];
        } elseif ($fetch_array_duration[$count_fetch_proptee]==12) {
            $interest_build_up[$count_fetch_proptee]=($daysDifference[$count_fetch_proptee]
            *
            ($fetch_array_share_cost[$count_fetch_proptee]*(16/100))
            /
            (12*30)+$fetch_array_share_cost[$count_fetch_proptee]);
            $aggr_invest+=$interest_build_up[$count_fetch_proptee];
        }elseif($fetch_array_duration[$count_fetch_proptee]==24) {
            $interest_build_up[$count_fetch_proptee]=($daysDifference[$count_fetch_proptee]
            *
            ($fetch_array_share_cost[$count_fetch_proptee]*(33/100))
            /
            (24*30)+$fetch_array_share_cost[$count_fetch_proptee]);
            $aggr_invest+=$interest_build_up[$count_fetch_proptee];
        }elseif($fetch_array_duration[$count_fetch_proptee]==60){
            $interest_build_up[$count_fetch_proptee]=($daysDifference[$count_fetch_proptee]
            *
            ($fetch_array_share_cost[$count_fetch_proptee]*(65/100))
            /
            (60*30)+$fetch_array_share_cost[$count_fetch_proptee]);
            $aggr_invest+=$interest_build_up[$count_fetch_proptee];
        }
    } 
    
    $count_fetch_proptee++;
}
}else{
    $fetch_array_title[$count_fetch_proptee]=0;
    $fetch_array_type[$count_fetch_proptee]=0;
    $fetch_array_address[$count_fetch_proptee]=0;
    $fetch_array_city[$count_fetch_proptee]=0;
    $fetch_array_state[$count_fetch_proptee]=0;
    $fetch_array_zip[$count_fetch_proptee]=0;
    $fetch_array_img[$count_fetch_proptee]=0;
    $fetch_array_video[$count_fetch_proptee]=0;
    $fetch_array_interest[$count_fetch_proptee]=0;
    $fetch_array_share_cost[$count_fetch_proptee]=0;
    $fetch_array_expected_inv[$count_fetch_proptee]=0;
    $fetch_array_current_inv[$count_fetch_proptee]=0;
}