<main class="main">

<div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/01.jpg)">
<div class="container">
<h2 class="breadcrumb-title">Properties</h2>
<ul class="breadcrumb-menu">
<li><a href="index.html">Home</a></li>
<li class="active">Properties</li>
</ul>
</div>
</div>

<div class="property-listing  py-120">
<div class="container">
<div class="row">        
<div class="col-lg-12">
<div class="col-md-12">
<div class="property-sort">
<h5>Showing 1-1 of 1 Results</h5>
<div class="col-md-3 d-flex sach">           
    <div style="margin-right: 20px">
        <input type="text" class="form-control" placeholder="Search listing here...">                    
    </div>             
    <button type="submit" class="btn btn-outline-success"><span class="far fa-search"></span></button>           
</div>
<!-- <div class="col-md-3 property-sort-box">
    <select class="select">
    <option value="1">Sort By Default</option>
    <option value="5">Sort By Featured</option>
    <option value="2">Sort By Latest</option>
    <option value="3">Sort By Low Price</option>
    <option value="4">Sort By High Price</option>
    </select>
    </div> -->
</div>
</div>
<div class="row listing-list">
<?php while($countDown < $count_fetch_proptee) : ?>
<div class="col-md-6 col-lg-12">

<div class="listing-item">
<div class="listing-img">
<img class="img_list" src="includes/admin/<?=$fetch_array_images[$countDown][0] ?>" alt>
<!-- <span class="listing-badge">12% p.a</span> -->
</div>
<div class="listing-content">
<h4 class="listing-title"><a href="#"><?=$fetch_array_title[$countDown] ?></a></h4>
<p class="listing-sub-title"><i class="far fa-location-dot"></i><?=$fetch_array_address[$countDown] ?></p>
<div class="listing-price">
<div class="listing-price-info">
    <a href="listings.single.php?identity=<?=$fetch_array_id[$countDown] ?>" class="text-success"><u>about this opportunity</u> <i class="far fa-arrow-right"></i></a>
</div>
<div class="">
    
</div>
</div>
<div class="listing-feature">        
</div>
<hr>
<!-- <div class="">
    <div class="progressbar-item">            
        <div progress-bar data-percentage="80%">
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
      </div> -->
      <div class="d-flexa">
        <div class="listing-author"> 
            <a href="packages.php?identity=<?=$fetch_array_id[$countDown] ?>" class="listing-btn">See Investment Packages</a>
        
        </div>
        <!-- <h5>208 Investors</h5> -->
        </div>
        
</div>
</div>

</div>
<?php     
        $countDown++;
        endwhile; 
        ?>
</div>


<div class="pagination-area">
<div aria-label="Page navigation example">
<ul class="pagination">
<li class="page-item">
<a class="page-link" href="#" aria-label="Previous">
<span aria-hidden="true"><i class="far fa-angle-double-left"></i></span>
</a>
</li>
<li class="page-item active"><a class="page-link" href="#">1</a></li>
<li class="page-item"><a class="page-link" href="#">2</a></li>
<li class="page-item"><a class="page-link" href="#">3</a></li>
<li class="page-item">
<a class="page-link" href="#" aria-label="Next">
<span aria-hidden="true"><i class="far fa-angle-double-right"></i></span>
</a>
</li>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

</main>

