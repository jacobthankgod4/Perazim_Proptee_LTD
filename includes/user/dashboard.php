<main class="main">
<!-- #0e2e50;" -->
 
<div class="mt001" >
<hr>
<div class="container">
<span class="site-title-tagline" style="color:#0e2e50 !important;font-size:12px;">My Balance </a> <img src="i/eye1.png" alt="" width="20px" height="auto"></span>
<!-- <li class="active">Dashboard</li> -->

<h2 class="site-title" style="font-size:42px;">₦<?=number_format($aggr_invest, 2)?></h2>

</div>
</div>

<div class="user-profile pagin">
<div class="container">
<div class="row">

<div class="col-lg-12">
<div class="user-profile-wrapper">
    <div class="mt002">
<div class=" dash0 button-row ">
<div class="  dash1" >
<a href="listings" class="theme-btn" >INVEST <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
</div>
<div class="  dash1" >
    <a href="#withdraw" class="theme-btn" >WITHDRAW <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
</div>
<div class="  dash1" >
    <a href="#" class="theme-btn" ><span>REFER & EARN</span>  <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
</div>
<div class=" dash1" >
    <a href="#" class="theme-btn" ><span>KYC</span> <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
</div>
</div>
</div>

<div class="row dash0 row mt003">
<div class="  col-3 mt004" >
<a href="listings" class="theme-btn wt001" >INVEST <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
</div>
<div class="  col-3 mt004" >
    <a href="#withdraw" class="theme-btn wt001" >WITHDRAW <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
</div>
<div class="  col-3 mt004" >
    <a href="#" class="theme-btn wt001" >REFER & EARN  <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
</div>
<div class=" col-3 mt004" >
    <a href="#" class="theme-btn wt001" ><span>KYC</span> <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
</div>
</div>

<div class="row pagin">

<div class="col-lg-12">
<div class="user-profile-card">
<h4 class="user-profile-card-title">Savings & Investments</h4>

<div class="counter-area mt-4">
<div class="container mb-3">
    <div class="row">
        <div class="col-6">
        
        <a href='#' class="counter-wrapper   h-100  d-flex align-items-center justify-content-center text-center">
            
            <h6 class="text-white">PeraSave</h6>
            
        </a>
        
        </div>
        <div class="col-6">
        <a href='/ajo' class="counter-wrapper h-100 d-flex align-items-center justify-content-center text-center">            
            <h6 class="text-white">Ajo for property ownershi</h6>
        </a>
    </div>
    </div>
</div>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <a href='#' class="counter-wrapper h-100 d-flex flex-column align-items-center justify-content-center text-center">
                 <h6 class="text-white">Save to own land</h6>
                </a>
                <br>
            </div>
            <div class="col-6">
                <a href='#' class="counter-wrapper h-100 d-flex flex-column align-items-center justify-content-center text-center">
                <h6 class="text-white">SafeLock</h6>
                </a>
                <br>
            </div>
        </div>
    </div>
</div>

</div>
</div>
</div>

<div class="row pagin">

<div class="col-lg-12">
<div class="user-profile-card">
<h4 class="user-profile-card-title">My Investments</h4>
<div class="">
<div class="">
            <?php 
        $countDown=0;
        while($countDown < $count_fetch_proptee) : ?>
<div class="row property-single-content mt-1 mb-4 p-0 disp1" style="background:#0e2e50;">
    <div class="col-4 p-2">
        <div class="image-container">
        <img src="includes/admin/<?=$fetch_array_images[$countDown][0] ?>" class="imago1 fixed-image" />
        </div>
        
        <div class="property-single-description">
        <h6 class="text-white p-2  responsive-text2">
        <?=$fetch_array_title[$countDown] ?>
        </h6>
        </div>
    </div>
    <div class="col-8 flex1">    
    <div class="progressbar-item agin1">            
        <div progress-bar data-percentage="10%">
            <div class="progress-number">
                <div class="progress-number-mark">
                    <span class="percent"></span>
                    <span class="down-arrow"></span>
                </div>
            </div>
            <div class="progress-bg">
                <div class="progress-fill"></div>
            </div>
        </div>    
    </div>
    <div class="row disp1">
        <div class="col-4">
            <h6 class="text-white text-center text-capitalize p-1 agin2">Investment <span class=""> Amount</span> </h6>
        <a href="listings" class="theme-btn wt001 responsive-btn" style="background:#cfe2ff;color:#000;" > ₦<?=number_format($fetch_array_share_cost[$countDown]) ?> </a>
        </div>
        <div class="col-4">
        <h6 class="text-white text-center text-capitalize p-1 agin2">Start<span class="">Date</span> </h6>
        <a href="listings" class="theme-btn wt001 responsive-btn" style="background:#cfe2ff;color:#000;" > 12-10-20 </a>
        </div>
        <div class="col-4">
        <h6 class="text-white text-center text-capitalize p-1 agin2">Ending <span class="">Date</span> </h6>
        <a href="listings" class="theme-btn wt001 responsive-btn" style="background:#cfe2ff;color:#000;" > 12-10-20 </a>
        </div>
    </div>
    <div class="row disp1">
        <div class="col-4">
            <h5 class="text-white text-center text-capitalize p-1">Interest Gained</h5>
        <a href="listings" class="theme-btn wt001 responsive-btn" style="background:#cfe2ff;color:#000;" > ₦ <?=number_format($interest_build_up[$countDown]-$fetch_array_share_cost[$countDown], 2) ?>  </a>
        </div>        
        <div class="col-8 df1" style="margin-top: 24px;">        
            <form action='withdrawal' method='post'>
                <input type='hidden' name='wAmount' value='<?=round($interest_build_up[$countDown])?>' >
                <input type='hidden' name='wProptee_id' value='<?=$fetch_array_proptee[$countDown]?>' >
                <input type='hidden' name='wPackage_id' value='<?=$fetch_array_package[$countDown]?>' >
                <button type='submit' class="theme-btn mb-2"  style="background:#0088ff;color:#fff;font-size:20px;" > Withdraw  <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
            </form>
        
        </div>
    </div>

    <!--<div class="row disp2">-->
    <!--    <div class="col-6">-->
    <!--        <h6 class="text-white text-center text-capitalize p-1 agin2 responsive-text2">Investment <span class=""> Amount</span> </h6>-->
    <!--    <a href="listings" class="theme-btn wt001 responsive-btn" style="background:#cfe2ff;color:#000;" > N17,000 </a>-->
    <!--    </div>-->
    <!--    <div class="col-6">-->
    <!--    <h6 class="text-white text-center text-capitalize p-1 agin2  responsive-text2">Start<span class="">Date</span> </h6>-->
    <!--    <a href="listings" class="theme-btn wt001 responsive-btn" style="background:#cfe2ff;color:#000;" > 12-10-20 </a>-->
    <!--    </div>        -->
    <!--</div>-->
    <!--<div class="row disp2">-->
    <!--    <div class="col-6">-->
    <!--    <h6 class="text-white text-center text-capitalize p-1 agin2  responsive-text2">Ending <span class="">Date</span> </h6>-->
    <!--    <a href="listings" class="theme-btn wt001 responsive-btn" style="background:#cfe2ff;color:#000;" > 12-10-20 </a>-->
    <!--    </div>-->
    <!--    <div class="col-6">-->
    <!--        <h5 class="text-white text-center text-capitalize p-1  responsive-text2">Interest <span class="">Gained</span></h5>-->
    <!--    <a href="listings" class="theme-btn wt001 responsive-btn" style="background:#cfe2ff;color:#000;" > N17,000 </a>-->
    <!--    </div>        -->
    <!--    <div class="container">        -->
        
    <!--    <a href="listings" class="theme-btn mb-2  responsive-text2"  style="width:100%;background:#0088ff;color:#fff;font-size:20px;" > Withdraw  <i class="fa fa-arrow-right" aria-hidden="true"></i></a>-->
    <!--    </div>-->
    <!--</div>-->
    </div>
</div>
<div class="row property-single-content mt-1 mb-4 p-0 disp2" style="background:#0e2e50;">
    <div class="col-12 p-2">
        <div class="image-container2">
        <img src="includes/admin/<?=$fetch_array_images[$countDown][0] ?>" class="imago1 fixed-image" />
        </div>
        
        <div class="property-single-description">
        <h6 class="text-white p-2  responsive-text3 ">
        <?=$fetch_array_title[$countDown] ?>
        </h6>
        </div>
    </div>
    <div class="col-12 flex1">   
    <?php 
    $formattedDated = date("d-m-y", strtotime($fetch_array_start[$countDown]));
    $originalDate = $fetch_array_start[$countDown];
$months = $fetch_array_duration[$countDown]; // Change this to any number of months
$newDate = addMonthsToDate($originalDate, $months);
$currentDate = date("d-m-y");
     $perc= 100 - remaining_days_percentage($formattedDated, $newDate, $currentDate);
    ?>
    <div class="progressbar-item agin10">            
        <div progress-bar data-percentage="<?php echo $perc; ?>%">
            <div class="progress-number">
                <div class="progress-number-mark">
                    <span class="percent"></span>
                    <span class="down-arrow"></span>
                </div>
            </div>
            <div class="progress-bg">
                <div class="progress-fill"></div>
            </div>
        </div>    
    </div>

    <div class="row disp2">
        <div class="col-4" style="padding-right:4px !important;">
            <h6 class="text-white text-center text-capitalize p-1 responsive-text2 ">Investment <span class=""> </span> </h6>
        <a href="listings" class="theme-btn wt001 responsive-btn" style="background:#cfe2ff;color:#000;" >  ₦ <?=number_format($fetch_array_share_cost[$countDown]) ?> </a>
        </div>
        <div class="col-4" style="padding-left: 4px !important;padding-right:4px !important;">
        <h6 class="text-white text-center text-capitalize p-1 responsive-text2 ">Start<span class="">Date</span> </h6>
        <a href="listings" class="theme-btn wt001 responsive-btn" style="background:#cfe2ff;color:#000;" ><?php $formattedDate = date("d-m-y", strtotime($fetch_array_start[$countDown])); // Convert to 12-15-24 format
 echo $formattedDate; ?> </a>
        </div>
        <div class="col-4" style="padding-left: 4px !important;">
        <h6 class="text-white text-center text-capitalize p-1 responsive-text2 ">Ending <span class="">Date</span> </h6>
        <a href="listings" class="theme-btn wt001 responsive-btn" style="background:#cfe2ff;color:#000;" ><?php $originalDate = $fetch_array_start[$countDown];
$months = $fetch_array_duration[$countDown]; // Change this to any number of months
$newDate = addMonthsToDate($originalDate, $months);

echo $newDate; // Output: 04-15-25 ?> </a>
        </div>
    </div>
    <div class="row disp2">
        <div class="col-6">
            <h5 class="text-white text-center text-capitalize p-1  responsive-text2">Interest <span class="">Gained</span></h5>
        <a href="listings" class="theme-btn wt001 responsive-btn" style="background:#cfe2ff;color:#000;" >₦ <?=number_format($interest_build_up[$countDown]-$fetch_array_share_cost[$countDown], 2) ?> </a>
        </div>        
        <div class="col-6 df1" style="margin-top: 16px;">                
        <form action='withdrawal' method='post'>
                <input type='hidden' name='wAmount' value='<?=round($interest_build_up[$countDown])?>' >
                <input type='hidden' name='wProptee_id' value='<?=$fetch_array_proptee[$countDown]?>' >
                <input type='hidden' name='wPackage_id' value='<?=$fetch_array_package[$countDown]?>' >
                <button type='submit' class="theme-btn mb-3"  style="background:#0088ff;color:#fff;font-size:18px;" > Withdraw  <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
            </form>
        </div>
    </div>
    </div>
</div>
        <?php     
        $countDown=$countDown+1;
        endwhile; 
        ?>
</div>
</div>
</div>
</div>
</div>



</div>
</div>
</div>

</div>
</div>
</div>
</div>

</main>


