<main class="main">

<div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/01.jpg)">
<div class="container">
<h2 class="breadcrumb-title">Edit Property</h2>
<ul class="breadcrumb-menu">
<li><a href="index.html">Home</a></li>
<li class="active">Edit Property</li>
</ul>
</div>
</div>

<div class="user-profile py-120">
<div class="container">
<div class="row">

<div class="col-lg-12">
<div class="user-profile-wrapper">
<div class="user-profile-card add-property">
<h4 class="user-profile-card-title">Edit Property</h4>
<div class="col-lg-12">
<div class="add-property-form">
<h5 class="fw-bold mb-4">Basic Information</h5>
<form method="get" id="form" enctype="multipart/form-data"  accept-charset="utf-8">       
    <input type="hidden" name="Id" value="<?=$fetch_array['Id'] ?>">         
                        <div class="row align-items-center">
                        <div class="col-lg-12">
                        <div class="form-group">
                        <label>Property Title</label>
                        <input type="text" class="form-control" id="title"  name="title" value="<?=$fetch_array['Title'] ?>" placeholder="Enter title" >
                        <div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
                        </div>
                        
                        </div>
                        <div class="col-lg-6">
                        <div class="form-group">
                        <label>Property Status</label>
                        <select class="select"  name="status" id="_status">
                        <?php status_dropdown($fetch_array['Status']); ?>
                        </select>
                        <div class="alert alert-danger mt-5 mb-3 errorMessage"></div>
                        </div>                        
                        </div>
                        <div class="col-lg-6">
                        <div class="form-group">
                        <label>Property Type</label>
                        <select class="select" name="type" id="type" >
                        <?php type_dropdown($fetch_array['Type']); ?>
                        </select>
                        <div class="alert alert-danger mt-5 mb-3 errorMessage"></div>
                        </div>                        
                        </div>
                        <div class="col-lg-6">
                        <div class="form-group">
                        <label>Price (₦)</label>
                        <input type="number" class="form-control" name="price" value="<?=$fetch_array['Price'] ?>"  placeholder="Enter price"  id="price" >                        
                        <div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
                        </div>
                        
                        </div>
                        <div class="col-lg-6">
                        <div class="form-group">
                        <label>Area (Sq Ft)</label>
                        <input type="number" class="form-control" name="area" value="<?=$fetch_array['Area'] ?>"  placeholder="Enter area" id="area" >                        
                        <div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
                        </div>
                        
                        </div>
                        <div class="col-lg-6">
                        <div class="form-group">
                        <label>Bedrooms</label>
                        <select class="select" name="bed" id="bed">
                        <?php bed_dropdown($fetch_array['Bedroom']); ?>
                        </select>
                        <div class="alert alert-danger mt-5 mb-3 errorMessage"></div>
                        </div>
                        
                        </div>
                        <div class="col-lg-6">
                        <div class="form-group">
                        <label>Bathrooms</label>
                        <select class="select" name="bath"  id="bath" >
                        <?php bath_dropdown($fetch_array['Bathroom']); ?>
                        </select>
                        <div class="alert alert-danger mt-5 mb-3 errorMessage"></div>
                        </div>
                        
                        </div>            
                        <h5 class="fw-bold my-4">Location</h5>
                        <div class="col-lg-6">
                        <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" name="address"  value="<?=$fetch_array['Address'] ?>"  placeholder="Enter address"  id="address" >
                        <div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
                        </div>                        
                        </div>
                        <div class="col-lg-6">
                        <div class="form-group">
                        <label>City</label>
                        <input type="text" class="form-control" name="city"  value="<?=$fetch_array['City'] ?>"  placeholder="Enter city" id="city" >                        
                        <div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
                        </div>
                        
                        </div>
                        <div class="col-lg-6">
                        <div class="form-group">
                        <label>State</label>
                        <input type="text" class="form-control" name="state" value="<?=$fetch_array['State'] ?>"   placeholder="Enter state"  id="state" >                        
                        <div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
                        </div>
                        
                        </div>
                        <div class="col-lg-6">
                        <div class="form-group">
                        <label>Zip Code</label>
                        <input type="text" class="form-control" name="zip_code"  value="<?=$fetch_array['Zip_Code'] ?>"  placeholder="Enter zip code"  id="zip_code" >
                        <div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
                        </div>                        
                        </div>
                        <h5 class="fw-bold my-4">Detailed Information</h5>
                        <div class="col-lg-12">
                        <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control"  name="description"  id="description" placeholder="Write description" cols="30" rows="5" > <?=$fetch_array['Description'] ?> </textarea>
                        <div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
                        </div>
                        
                        </div>
                        <div class="col-lg-12">
                        <div class="form-group">
                        <label>Built Years</label>
                        <input type="date" name="year" class="form-control" value="<?=$fetch_array['Built_Year'] ?>"    id="year" >                        
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
                            
                        <input class="form-check-input" name="aminity[]" type="checkbox" <?php box('smart-home',$fetch_array_ammeniities); ?> >
                        <div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
                        <label class="form-check-label" for="property-aminity1">
                        smart home
                        </label>
                        </div>
                        </div>
                        <div class="col-6">
                        <div class="form-check">
                        <input class="form-check-input" name="aminity[]" type="checkbox" value="energy-efficient" <?php box('energy-efficient',$fetch_array_ammeniities); ?>>
                        <div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
                        <label class="form-check-label" for="property-aminity2">
                        energy-efficient
                        </label>
                        </div>
                        </div>
                        <div class="col-6">
                        <div class="form-check">
                        <input class="form-check-input" name="aminity[]" type="checkbox" value="24-hours-light"<?php box('24-hours-light',$fetch_array_ammeniities); ?>>
                        <div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
                        <label class="form-check-label" for="property-aminity3">
                        24 hours light
                        </label>
                        </div>
                        </div>
                        <div class="col-6">
                        <div class="form-check">
                        <input class="form-check-input" name="aminity[]" type="checkbox" value="security" <?php box('security',$fetch_array_ammeniities); ?>>
                        <div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
                        <label class="form-check-label" for="property-aminity4">
                        security
                        </label>
                        </div>
                        </div>
                        <div class="col-6">
                        <div class="form-check">
                        <input class="form-check-input" name="aminity[]" type="checkbox" value="fully-furnished" <?php box('fully-furnished',$fetch_array_ammeniities); ?>>
                        <div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
                        <label class="form-check-label" for="property-aminity5">
                        fully furnished
                        </label>
                        </div>
                        </div>
                        <div class="col-6">
                        <div class="form-check">
                        <input class="form-check-input" name="aminity[]" type="checkbox" value="furnished" <?php box('furnished',$fetch_array_ammeniities); ?>>
                        <div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
                        <label class="form-check-label" for="property-aminity6">
                        furnished
                        </label>
                        </div>
                        </div>
                        <div class="col-6">
                        <div class="form-check">
                        <input class="form-check-input" name="aminity[]" type="checkbox" value="Swimming-Pool" <?php box('Swimming-Pool',$fetch_array_ammeniities); ?>>
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
                        <button type="submit" class="theme-btn">Edit This Property</button>
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

</main>
<script src="assets/js/property_create_validator.js"></script>