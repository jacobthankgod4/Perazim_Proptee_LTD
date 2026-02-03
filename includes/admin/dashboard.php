<main class="main">
    
<div class="mt001" >
<hr>
<div class="container">
<span class="site-title-tagline" style="color:#0e2e50 !important;font-size:12px;">Total Investments </a> <img src="i/eye1.png" alt="" width="20px" height="auto"></span>
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
<div class=" dash0 button-row pagin">
<div class="  dash1" >
<a href="property" class="theme-btn" >PROPERTY <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
</div>
<div class="  dash1" >
    <a href="subscribers" class="theme-btn" >SUBSCRIBERS <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
</div>
<div class="  dash1" >
    <a href="#" class="theme-btn" ><span>MESSAGES</span>  <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
</div>
<div class=" dash1" >
    <a href="#" class="theme-btn" ><span>BLOG</span> <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
</div>
</div>
</div>

<div class="row dash0 row mt003">
<div class="  col-3 mt004" >
<a href="property" class="theme-btn wt001" >PROPERTY <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
</div>
<div class="  col-3 mt004" >
    <a href="subscribers" class="theme-btn wt001" >SUBSCRIBERS <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
</div>
<div class="  col-3 mt004" >
    <a href="#" class="theme-btn wt001" >MESSAGES  <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
</div>
<div class=" col-3 mt004" >
    <a href="#" class="theme-btn wt001" ><span>BLOG</span> <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
</div>
</div>
    
    <!--  -->
    <div class="pagin col-lg-12">
        <div class="user-profile-wrapper">
        <div class="user-profile-card user-profile-property">
        <div class="user-profile-card-header">
        <h4 class="user-profile-card-title">Investors</h4>
        <div class="user-profile-card-header-right">
        <div class="user-profile-search">
        <!-- <div class="form-group">
        <input type="text" class="form-control" placeholder="Search...">
        <i class="far fa-search"></i>
        </div> -->
        </div>
        <!-- <a href="#" class="theme-btn"><span class="far fa-plus-circle"></span>Add Property</a> -->
        </div>
        </div>
        <div class="col-lg-12">
        <div class="table-responsive">
        <table class="table text-nowrap">
        <thead>
        <tr>
        <th>Investments</th>
        <th>Interest</th>
        <th>Start Date</th>
        <th>Duration</th>
        <th>Status</th>
        </tr>
        </thead>
        <tbody>
        <?php 
        $countDown=0;
        while($countDown < $count_fetch_proptee) : ?>
        <tr>
        <td style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
        <div class="table-property-info">
        <a href="#">
        <img src="includes/admin/<?=$fetch_array_images[$countDown][0] ?>" alt>
        <div class="table-property-content">
        <h6 class='wr'><?=$fetch_array_title[$countDown] ?> [ <?=$fetch_array_name[$countDown] ?> ] </h6>
        <p><?//=$interest_build_up[$countDown] ?></p>
        <!--<p><?//=$fetch_array_address[$countDown] ?></p>-->
        <h6 class='wr'>Share Cost : ₦<?=$fetch_array_share_cost[$countDown] ?></h6>
        </div>
        </a>
        </div>
        </td>
        <td>
        <h6 class="fw-bold">₦<?=number_format($interest_build_up[$countDown], 2) ?></h6>
        <!-- <span>15 Days Ago</span> -->
        </td>
        <td>
        <h6 class="fw-bold"><?=$fetch_array_start[$countDown] ?></h6>
        
        </td>
        <td>
        <h6 class="fw-bold"><?=$fetch_array_duration[$countDown] ?>Months</h6>
        <!-- <span>15 Days Ago</span> -->
        </td>
        <td>
        <span class="badge bg-success">Active</span>
        </td>
        
        </tr>
        <?php     
        $countDown=$countDown+1;
        endwhile; 
        ?>
        </tbody>
        </table>
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

