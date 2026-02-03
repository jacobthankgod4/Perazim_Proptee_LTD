
<main class="main">

<!--<div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/01.jpg)">-->
<!--<div class="container">-->
<!--<h2 class="breadcrumb-title">App Users</h2>-->
<!--<ul class="breadcrumb-menu">-->
<!--<li><a href="index.html">Home</a></li>-->
<!--<li class="active">App Users</li>-->
<!--</ul>-->
<!--</div>-->
<!--</div>-->

<div class="user-profile py-120">
<div class="container">
<div class="row">        
<div class="col-lg-12">
<div class="user-profile-wrapper">
<div class="row">
<!--<div class="col-md-6 col-lg-4">-->
<!--<div class="dashboard-widget dashboard-widget-color-1">-->
<!--<div class="dashboard-widget-info">-->
<!--<h1>650</h1>-->
<!--<span>Listed Property</span>-->
<!--</div>-->
<!--<div class="dashboard-widget-icon">-->
<!--<i class="fal fa-home"></i>-->
<!--</div>-->
<!--</div>-->
<!--</div>-->
<!--<div class="col-md-6 col-lg-4">-->
<!--<div class="dashboard-widget dashboard-widget-color-2">-->
<!--<div class="dashboard-widget-info">-->
<!--<h1>Gold</h1>-->
<!--<span>Your Package</span>-->
<!--</div>-->
<!--<div class="dashboard-widget-icon">-->
<!--<i class="fal fa-box-check"></i>-->
<!--</div>-->
<!--</div>-->
<!--</div>-->
<!--<div class="col-md-6 col-lg-4">-->
<!--<div class="dashboard-widget dashboard-widget-color-3">-->
<!--<div class="dashboard-widget-info">-->
<!--<h1>$60,050</h1>-->
<!--<span>You Earned</span>-->
<!--</div>-->
<!--<div class="dashboard-widget-icon">-->
<!--<i class="fal fa-sack-dollar"></i>-->
<!--</div>-->
<!--</div>-->
<!--</div>-->
</div>

<div class="col-lg-12">
    <div class="user-profile-wrapper">
    <div class="user-profile-card user-profile-property">
    <div class="user-profile-card-header">
    <h4 class="user-profile-card-title">Listed Properties</h4>
    <div class="user-profile-card-header-right">
    <div class="user-profile-search">
    <!--<div class="form-group">-->
    <!--<input type="text" class="form-control" placeholder="Search...">-->
    <!--<i class="far fa-search"></i>-->
    <!--</div>-->
    </div>
    <button type="button" class="theme-btn"data-bs-toggle="modal" data-bs-target="#createModal"><span class="far fa-plus-circle"></span>Add Property</button>
    </div>
    </div>
    <div class="col-lg-12">
    <div class="table-responsive">
    <table class="table text-nowrap">
    <thead>
    <tr>
    <th>property</th>
    <th>Views</th>
    <th>Publish On</th>
    <th>Status</th>
    <th>Action</th>
    </tr>
    </thead>
    <tbody>
        <?php 
        $countDown=0;
        while($countDown < $count_fetch_proptee) : ?>
        <tr>                    
            <td>
            <div class="table-property-info">
            <a href="#">
            <img src="includes/admin/<?=$fetch_array_images[$countDown][0] ?>" alt>
            <div class="table-property-content">
            <h6><?=$fetch_array_title[$countDown] ?></h6>
            <p><?=$fetch_array_address[$countDown] ?></p>
            <span>₦<?=number_format($fetch_array_price[$countDown]) ?></span>
            </div>
            </a>
            </div>
            </td>
            
            <td>
            <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal<?=$countDown ?>"><i class="far fa-eye"></i></button>
            <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal<?=$countDown ?>"><i class="far fa-pen"></i></button>
            <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal<?=$countDown ?>"><i class="far fa-trash-can"></i></button>
            </td>
            <td>
            <h6 class="fw-bold">450</h6>
            <span>Total Views</span>
            </td>
            <td>
            <h6 class="fw-bold">Sep 21</h6>
            <span>15 Days Ago</span>
            </td>
            <td>
            <span class="badge bg-danger">Expired</span>
            </td>
            
        </tr>

        <!-- Modal show-->
        <div class="modal fade" id="viewModal<?=$countDown ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">View Property Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            
                <div class="user-profile">
                <div class="container">
                <div class="row">        
                    <div class="col-lg-12">
                        <div class="user-profile-wrapper">
                        <div class="user-profile-card add-property">            
                        <div class="col-lg-12">
                        <div class="add-property-form">
                        <h5 class="fw-bold mb-4">Basic Information</h5>
                        <form method="POST" action="">                
                        <div class="row align-items-center">
                        <div class="col-lg-12">
                        <div class="form-group">
                        <label>Property Title</label>
                        <input type="text" class="form-control"  name="title" value="<?=$fetch_array_title[$countDown] ?>"  placeholder="Enter title">                        
                        </div>
                        </div>
                        <div class="col-lg-6">
                        <div class="form-group">
                        <option value>Select Status</option>
                        <input type="text" class="form-control"  name="title" placeholder="Enter title" value="<?=$fetch_array_status[$countDown] ?>">
                        </div>
                        </div>
                        <div class="col-lg-6">
                        <div class="form-group">
                        <label>Property Type</label>
                        <input type="text" class="form-control"  name="title" placeholder="Enter title" value="<?=$fetch_array_type[$countDown] ?>">
                        </div>
                        </div>
                        <div class="col-lg-6">
                        <div class="form-group">
                        <label>Price (₦)</label>
                        <input type="text" class="form-control"value="<?=$fetch_array_price[$countDown] ?>" placeholder="Enter price">
                        </div>
                        </div>
                        <div class="col-lg-6">
                        <div class="form-group">
                        <label>Area (Sq Ft)</label>
                        <input type="text" class="form-control" placeholder="Enter area" value="<?=$fetch_array_area[$countDown] ?>">
                        </div>
                        </div>
                        <div class="col-lg-6">
                        <div class="form-group">
                        <label>Bedrooms</label>
                        <input type="text" class="form-control" placeholder="Enter area" value="<?=$fetch_array_bed[$countDown] ?>">
                        </div>
                        </div>
                        <div class="col-lg-6">
                        <div class="form-group">
                        <label>Bathrooms</label>
                        <input type="text" class="form-control" placeholder="Enter area" value="<?=$fetch_array_bath[$countDown] ?>">
                        </div>
                        </div>
                
                        <h5 class="fw-bold my-4">Location</h5>
                        <div class="col-lg-6">
                        <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" name="address" placeholder="Enter address" value="<?=$fetch_array_address[$countDown] ?>">
                        </div>
                        </div>
                        <div class="col-lg-6">
                        <div class="form-group">
                        <label>City</label>
                        <input type="text" class="form-control" name="city" placeholder="Enter city" value="<?=$fetch_array_city[$countDown] ?>">
                        </div>
                        </div>
                        <div class="col-lg-6">
                        <div class="form-group">
                        <label>State</label>
                        <input type="text" class="form-control" name="state" placeholder="Enter state" value="<?=$fetch_array_state[$countDown] ?>">
                        </div>
                        </div>
                        <div class="col-lg-6">
                        <div class="form-group">
                        <label>Zip Code</label>
                        <input type="text" class="form-control" name="zip_code" placeholder="Enter zip code" value="<?=$fetch_array_zip[$countDown] ?>">
                        </div>
                        </div>
                        <h5 class="fw-bold my-4">Detailed Information</h5>
                        <div class="col-lg-12">
                        <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control"  name="description"placeholder="Write description" cols="30" rows="5"><?=$fetch_array_desc[$countDown] ?></textarea>
                        </div>
                        </div>

                        <!-- <div class="col-lg-4">
                        <div class="form-group">
                        <label>Garage(Optional)</label>
                        <select class="select">
                        <option value>Select Garage</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        </select>
                        </div>
                        </div>
                        <div class="col-lg-4">
                        <div class="form-group">
                        <label>Rooms(Optional)</label>
                        <select class="select">
                        <option value>Select Rooms</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        </select>
                        </div>
                        </div> -->
                        <h5 class="fw-bold my-4">Amenities</h5>
                        <div class="col-12">                        
                        <div class="form-group">
                        <input class="form-control" name="property-aminity" type="text" id="property-aminity11" value="<?=$fetch_array_ammeniities1[$countDown] ?>">

                        </div>
                        </div>
                        <div class="property-single-slider owl-carousel owl-theme">
                        <?php
                        foreach ($fetch_array_images[$countDown] as $image) : ?>                            
                            <img src="includes/admin/<?=htmlspecialchars($image) ?> " alt>
                        <?php endforeach;  ?>
                    
                        </div>


                        <?php
if ($fetch_array_video[$countDown] != 0) : ?>   
                        <div class="video-area mt-4">
<div class="container-fluid px-0">
<div class="video-content" style="background-image: url(includes/admin/<?=$fetch_array_images[$countDown][0] ?>);">
<div class="row align-items-center">
<div class="col-lg-12">
    
<div class="container video-wrapper mt-5">
<?php
foreach ($fetch_array_video[$countDown] as $vid) : ?>                                                        
    <a class="play-btn popup-youtube" href="includes/admin/<?=htmlspecialchars($vid) ?>">
<?php endforeach;  ?>
    
<i class="fas fa-play"></i>
</a>

</div>
</div>
</div>
</div>
</div>
</div>
<?php endif; ?>   
                        </div>

                        </div>
                        </div>
                        </form>
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

        <!-- Modal Edit-->
        <div class="modal fade" id="editModal<?=$countDown ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Property</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            
                <div class="user-profile">
                <div class="container">
                <div class="row">        
                    <div class="col-lg-12">
                        <div class="user-profile-wrapper">
                        <div class="user-profile-card add-property">            
                        <div class="col-lg-12">
                        <div class="add-property-form">                        
                        <div class="alert alert-danger errMessage1" style="display:none"></div>
                        <form method="post" action="edit-property">                                
                        <div class="row align-items-center">
                            <input type="hidden" name="Id" value="<?=$fetch_array_id[$countDown] ?>" id="">

                        <button type="submit" class="theme-btn">Go to Edit</button>
                        </div>
                        </div>
                        </form>
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

                <!-- Modal Edit-->
                <div class="modal fade" id="deleteModal<?=$countDown ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Property</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            
                <div class="user-profile">
                <div class="container">
                <div class="row">        
                    <div class="col-lg-12">
                        <div class="user-profile-wrapper">
                        <div class="user-profile-card add-property">            
                        <div class="col-lg-12">
                        <div class="add-property-form">                        
                        <div class="alert alert-danger errMessage1" style="display:none"></div>
                        <form method="post" action="">                                
                        <div class="row align-items-center">
                            <input type="hidden" name="Id" value="<?=$fetch_array_id[$countDown] ?>" id="">

                        <button type="submit" class="theme-btn" name="deleteP">Delete Property Permanently</button>
                        </div>
                        </div>
                        </form>
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

        <!-- Modal  Create -->
        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Property</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            
                <div class="user-profile">
                <div class="container">
                <div class="row">        
                    <div class="col-lg-12">
                        <div class="user-profile-wrapper">
                        <div class="user-profile-card add-property">            
                        <div class="col-lg-12">
                        <div class="add-property-form">
                        <h5 class="fw-bold mb-4">Basic Information</h5>
                        
                        <form method="get" id="form" enctype="multipart/form-data"  accept-charset="utf-8">                
                        <div class="row align-items-center">
                        <div class="col-lg-12">
                        <div class="form-group">
                        <label>Property Title</label>
                        <input type="text" class="form-control" id="title"  name="title" placeholder="Enter title" >
                        <div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
                        </div>
                        
                        </div>
                        <div class="col-lg-6">
                        <div class="form-group">
                        <label>Property Status</label>
                        <select class="select"  name="status" id="_status">
                        <option value>Select Status</option>
                        <option value="investment">For Investment</option>
                        <option value="sale">For Sale</option>
                        <option value="rent">For Rent</option>
                        <option value="shortlet">For Shortlet</option>
                        </select>
                        <div class="alert alert-danger mt-5 mb-3 errorMessage"></div>
                        </div>                        
                        </div>
                        <div class="col-lg-6">
                        <div class="form-group">
                        <label>Property Type</label>
                        <select class="select" name="type" id="type" >
                        <option value>Select Type</option>
                        <option value="apartment">Apartment</option>
                        <option value="duplex">Duplex</option>
                        </select>
                        <div class="alert alert-danger mt-5 mb-3 errorMessage"></div>
                        </div>                        
                        </div>
                        <div class="col-lg-6">
                        <div class="form-group">
                        <label>Price (₦)</label>
                        <input type="text" class="form-control" name="price" placeholder="Enter price"  id="price" >                        
                        <div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
                        </div>
                        
                        </div>
                        <div class="col-lg-6">
                        <div class="form-group">
                        <label>Area (Sq Ft)</label>
                        <input type="text" class="form-control" name="area" placeholder="Enter area" id="area" >                        
                        <div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
                        </div>
                        
                        </div>
                        <div class="col-lg-6">
                        <div class="form-group">
                        <label>Bedrooms</label>
                        <select class="select" name="bed" id="bed">
                        <option value>Select Bedrooms</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        </select>
                        <div class="alert alert-danger mt-5 mb-3 errorMessage"></div>
                        </div>
                        
                        </div>
                        <div class="col-lg-6">
                        <div class="form-group">
                        <label>Bathrooms</label>
                        <select class="select" name="bath"  id="bath" >
                        <option value>Select Bathrooms</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        </select>
                        <div class="alert alert-danger mt-5 mb-3 errorMessage"></div>
                        </div>
                        
                        </div>            
                        <h5 class="fw-bold my-4">Location</h5>
                        <div class="col-lg-6">
                        <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" name="address" placeholder="Enter address"  id="address" >
                        <div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
                        </div>                        
                        </div>
                        <div class="col-lg-6">
                        <div class="form-group">
                        <label>City</label>
                        <input type="text" class="form-control" name="city" placeholder="Enter city" id="city" >                        
                        <div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
                        </div>
                        
                        </div>
                        <div class="col-lg-6">
                        <div class="form-group">
                        <label>State</label>
                        <input type="text" class="form-control" name="state" placeholder="Enter state"  id="state" >                        
                        <div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
                        </div>
                        
                        </div>
                        <div class="col-lg-6">
                        <div class="form-group">
                        <label>Zip Code</label>
                        <input type="text" class="form-control" name="zip_code" placeholder="Enter zip code"  id="zip_code" >
                        <div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
                        </div>                        
                        </div>
                        <h5 class="fw-bold my-4">Detailed Information</h5>
                        <div class="col-lg-12">
                        <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control"  name="description"  id="description" placeholder="Write description" cols="30" rows="5" ></textarea>
                        <div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
                        </div>
                        
                        </div>
                        <div class="col-lg-12">
                        <div class="form-group">
                        <label>Built Years</label>
                        <input type="date" name="year" class="form-control"  id="year" >                        
                        <div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
                        </div>
                        
                        </div>
                        <!-- <div class="col-lg-4">
                        <div class="form-group">
                        <label>Garage(Optional)</label>
                        <select class="select">
                        <onvalue>Select Garage</onvalue>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        </select>
                        </div>
                        </div>
                        <div class="col-lg-4">
                        <div class="form-group">
                        <label>Rooms(Optional)</label>
                        <select class="select">
                        <option value>Select Rooms</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        </select>
                        </div>
                        </div> -->
                        <h5 class="fw-bold my-4">Amenities</h5>
                        <div class="col-6">
                        <div class="form-check">
                        <input class="form-check-input" name="aminity[]" type="checkbox" value="smart-home" >
                        <div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
                        <label class="form-check-label" for="property-aminity1">
                        smart home
                        </label>
                        </div>
                        </div>
                        <div class="col-6">
                        <div class="form-check">
                        <input class="form-check-input" name="aminity[]" type="checkbox" value="energy-efficient" >
                        <div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
                        <label class="form-check-label" for="property-aminity2">
                        energy-efficient
                        </label>
                        </div>
                        </div>
                        <div class="col-6">
                        <div class="form-check">
                        <input class="form-check-input" name="aminity[]" type="checkbox" value="24-hours-light">
                        <div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
                        <label class="form-check-label" for="property-aminity3">
                        24 hours light
                        </label>
                        </div>
                        </div>
                        <div class="col-6">
                        <div class="form-check">
                        <input class="form-check-input" name="aminity[]" type="checkbox" value="security">
                        <div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
                        <label class="form-check-label" for="property-aminity4">
                        security
                        </label>
                        </div>
                        </div>
                        <div class="col-6">
                        <div class="form-check">
                        <input class="form-check-input" name="aminity[]" type="checkbox" value="fully-furnished">
                        <div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
                        <label class="form-check-label" for="property-aminity5">
                        fully furnished
                        </label>
                        </div>
                        </div>
                        <div class="col-6">
                        <div class="form-check">
                        <input class="form-check-input" name="aminity[]" type="checkbox" value="furnished">
                        <div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
                        <label class="form-check-label" for="property-aminity6">
                        furnished
                        </label>
                        </div>
                        </div>
                        <div class="col-6">
                        <div class="form-check">
                        <input class="form-check-input" name="aminity[]" type="checkbox" value="Swimming-Pool">
                        <div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
                        <label class="form-check-label" for="property-aminity11">
                        Swimming Pool
                        </label>
                        </div>
                        </div>
                        <h5 class="fw-bold my-4">Upload Images</h5>            
                        <div class="col-12">
                        <div class="form-group">
                        <label>Images</label>
                        <input type="file" class="form-control"  id="img1"name="images[]" multiple>
                        <div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
                        <div class="alert alert-info mt-3 mb-3">select as many images as you want for upload</div>
                        </div>
                        </div>
                        <div class="col-12">
                        <div class="form-group">
                        <label>Upload Video :</label>                        
                        <input type="file" class="form-control" id="img2" name="videos[]" accept="video/*">
                        <div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
                        <div class="alert alert-info mt-3 mb-3">uploaded videos should not exceed 40mb, lest there will be an error</div>
                        </div>
                        </div>
                        <div class="col-12">
                        <div class="form-group">
                        <!-- <label>Upload Video 2:</label>
                        <input type="file" class="form-control"  id="img3" name="videos[]">
                        <div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
                        
                        </div>
                        </div> -->

                        <!-- <div class="col-12">
                        <div class="form-group">
                        <label>Image 2</label>
                        <input type="file" class="form-control" id="img2" name="img2">
                        <div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
                        </div>
                        </div>
                        <div class="col-12">
                        <div class="form-group">
                        <label>Image 3</label>
                        <input type="file" class="form-control" id="img3" name="img3">
                        <div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
                        </div>
                        </div>
                        <div class="col-12">
                        <div class="form-group">
                        <label>Image 4</label>
                        <input type="file" class="form-control" id="img4" name="img4">
                        <div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
                        </div>
                        </div>
                        <div class="col-12">
                        <div class="form-group">
                        <label>Image 5</label>
                        <input type="file" class="form-control" id="img5" name="img5">
                        <div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
                        </div>
                        </div>
                        <div class="col-12">
                        <div class="form-group">
                        <label>Image 6</label>
                        <input type="file" class="form-control" id="img6" name="img6">
                        <div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
                        </div>
                        </div> -->
                        <!-- <div class="col-12">
                        <div class="form-group">
                        <label>Image 7</label>
                        <input type="file" class="form-control" id="img7" name="img7">
                        <div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
                        </div>
                        </div>
                        <div class="col-12">
                        <div class="form-group">
                        <label>Image 8</label>
                        <input type="file" class="form-control" id="img8" name="img8">
                        <div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
                        </div>
                        </div>
                        <div class="col-12">
                        <div class="form-group">
                        <label>Image 9</label>
                        <input type="file" class="form-control" id="img9" name="img9">
                        <div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
                        </div>
                        </div>
                        <div class="col-12">
                        <div class="form-group">
                        <label>Image 10</label>
                        <input type="file" class="form-control" id="img10" name="img10">
                        <div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
                        </div>
                        </div>
                        <div class="col-12">
                        <div class="form-group">
                        <label>Image 11</label>
                        <input type="file" class="form-control" id="img11" name="img11">
                        <div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
                        </div>
                        </div>
                        <div class="col-12">
                        <div class="form-group">
                        <label>Image 12</label>
                        <input type="file" class="form-control" id="img12" name="img12">
                        <div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
                        </div>
                        </div>
                        <div class="col-12">
                        <div class="form-group">
                        <label>Image 13</label>
                        <input type="file" class="form-control" id="img13" name="img13">
                        <div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
                        </div>
                        </div>
                        <div class="col-12">
                        <div class="form-group">
                        <label>Image 14</label>
                        <input type="file" class="form-control" id="img14" name="img14">
                        <div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
                        </div>
                        </div>
                        <div class="col-12">
                        <div class="form-group">
                        <label>Image 15</label>
                        <input type="file" class="form-control" id="img15" name="img15">
                        <div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
                        </div>
                        </div> -->
                        <div class="alert alert-danger errMessage" style="display:none"></div>
                        <button type="submit" class="theme-btn">Submit Your Property</button>
                        </div>
                        </div>
                        </form>
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

<script src="assets/js/property_crud_validator.js"></script>
