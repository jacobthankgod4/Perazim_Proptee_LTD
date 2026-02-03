<?php

$ide4= $_SESSION['user_id'];

    
// $q511 = "SELECT  `package_id` FROM `invest_now` WHERE Usa_Id=$ide4 ";

// $r511 = mysqli_query($dbc, $q511);

// $fetch_array1 = mysqli_fetch_array($r511, MYSQLI_ASSOC);

// $ide_fix=$fetch_array1['package_id'];


$q51 = "SELECT `Title`, `Address`, `Images`, `proptee_id`, `package_id`, `start_date`, `period`, `interest`, `share_cost` FROM `invest_now` INNER JOIN investment ON invest_now.package_id=investment.Id_in INNER JOIN property ON investment.property_id=property.Id WHERE Usa_Id = ?";
$stmt = mysqli_prepare($dbc, $q51);
if ($stmt) {
    $uid = (int)$ide4;
    mysqli_stmt_bind_param($stmt, 'i', $uid);
    mysqli_stmt_execute($stmt);
    $r51 = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);
} else {
    $r51 = mysqli_query($dbc, "SELECT `Title`, `Address`, `Images`, `proptee_id`, `package_id`, `start_date`, `period`, `interest`, `share_cost` FROM `invest_now` INNER JOIN investment ON invest_now.package_id=investment.Id_in INNER JOIN property ON investment.property_id=property.Id WHERE Usa_Id=$ide4");
}



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
if (mysqli_num_rows($r51) > 0) {
while ($fetch_array = mysqli_fetch_array($r51, MYSQLI_ASSOC)) {  
    
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

    // Get the current time
    $currentDate[$count_fetch_proptee] = new DateTime();

    // Calculate the difference
    $interval[$count_fetch_proptee] = $currentDate[$count_fetch_proptee]->diff($dbDate[$count_fetch_proptee]);

    // Get the difference in days
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