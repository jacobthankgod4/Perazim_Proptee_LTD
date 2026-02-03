<main class="main">

    <div class="hero-section">
    <div class="hero-slider owl-carousel owl-theme">
    <!-- <div class="hero-single" style="background: url(assets/img/hero/hero-1.jpg)"> -->
    <div class="hero-single" style="background: url(i/a3.jpg)">
    <div class="container">
    <div class="row align-items-center">
    <div class="col-lg-12 mx-auto">
    <div class="hero-content text-center">
    <div class="hero-content-wrapper">
    <h3 class="hero-title" style="font-size:40px !important;" data-animation="fadeInUp" data-delay=".25s">Invest as low as <span> ₦5,000 </span>and earn up to<span> 25% </span>returns in high-yield properties</h3>
    <p data-animation="fadeInUp" data-delay=".50s"></p>
    <div class="hero-btn d-block mt-5" data-animation="fadeInUp" data-delay=".75s">
    <a href="listings" class="theme-btn">Invest Now <i class="far fa-arrow-right"></i></a>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <div class="hero-single" style="background: url(i/16.jpg)">
    <div class="container">
    <div class="row align-items-center">
    <div class="col-lg-12 mx-auto">
    <div class="hero-content text-center">
    <div class="hero-content-wrapper">
    <h3 class="hero-title" style="font-size:40px !important;" data-animation="fadeInUp" data-delay=".25s">Invest as low as <span> ₦5,000 </span>and earn up to<span> 25% </span>returns in high-yield properties</h3>
    <p data-animation="fadeInUp" data-delay=".50s"></p>
    <div class="hero-btn d-block mt-5" data-animation="fadeInUp" data-delay=".75s">
    <a href="listings" class="theme-btn">Invest Now <i class="far fa-arrow-right"></i></a>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <!-- <div class="hero-single" style="background: url(i/18.jpg)">
    <div class="container">
    <div class="row align-items-center">
    <div class="col-lg-12 mx-auto">
    <div class="hero-content text-center">
    <div class="hero-content-wrapper">
    <h1 class="hero-title" data-animation="fadeInUp" data-delay=".25s">Find Your <span>Dream</span> Home</h1>
    <p data-animation="fadeInUp" data-delay=".50s">Find new & featured property located in your local city</p>
    <div class="hero-btn d-block mt-5" data-animation="fadeInUp" data-delay=".75s">
    <a href="listings" class="theme-btn">Invest Now <i class="far fa-arrow-right"></i></a>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div> -->
    </div>
    </div>
    
    <div class="about-area pt-100 pb-30">
        <div class="container">
        <div class="row align-items-center">
    
        <div class="col-lg-6">
        <div class="about-left wow fadeInUp" data-wow-duration="1s" data-wow-delay=".25s">
        <div class="site-heading mb-3">
        <!-- <span class="site-title-tagline">About Us</span> -->
        <h2 class="site-title">
            Peravest unlocks professional real estate investments for everyone
        </h2>
        </div>
        <p class="about-text">Real estate investing has long been limited to big institutions and high-net-worth individuals. Now, with just N5,000, anyone can enter the  world of profesional real estate investment
        </p>
        <hr>
        <div class="about-bottom">
            <a href="listings" class="theme-btn">See our crowdfunding offers <i class="far fa-arrow-right"></i></a>
            </div>
            
        </div>
        </div>
        <div class="col-lg-6">
            <div class="about-right wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".25s">
            <!--  -->
    
            <div class="about-left wow fadeInUp" data-wow-duration="1s" data-wow-delay=".25s">
                <div class="site-heading mb-3">
                <!-- <span class="site-title-tagline">About Us</span> -->
                <h2 class="site-title">
                    A great investment shouldn’t keep you up at night
                </h2>
                </div>
                <p class="about-text">Invest with confidence, thanks to peravest’s rigorous pre-vetting processes. Every project completes a thorough due diligence so that you can invest easily.
                </p>    
                <hr>          
                <div class="about-bottom">
                    <a href="register" class="theme-btn">Sign Up <i class="far fa-arrow-right"></i></a>
                    </div>
                </div>
            <!--  -->
            </div>
            </div>
        </div>
        </div>
        </div>
        
        <div class="property-listing pb-30">
            <div class="container"> 
            <div class="property-listing-slider owl-carousel owl-theme">
            <?php while($countDown < $count_fetch_proptee) : ?>
            <div class="listing-item">
            <span class="listing-badge"><?=$fetch_array_interest[$countDown] ?>% p.a</span>
            <div class="listing-img">
            <img class="img_list" src="includes/admin/<?=$fetch_array_images[$countDown][0] ?>" alt>
            </div>
            <div class="listing-content">
            <h4 class="listing-title"><a href="#"><?=$fetch_array_title[$countDown] ?></a></h4>
            <p class="listing-sub-title"><i class="far fa-location-dot"></i><?=$fetch_array_address[$countDown] ?></p>
            <div class="listing-price">
            <div class="listing-price-info">
            <h6 class="listing-price-amount">₦<?=number_format($fetch_array_share_cost[$countDown]) ?></h6>
            <span class="listing-price-title">Cost of Share</span>
            </div>
            <div class="">
            <!-- <a href="#"><i class="far fa-arrows-repeat"></i></a>
            <a href="#"><i class="far fa-heart"></i></a> -->
            <a href="packages.php?identity=<?=$fetch_array_id[$countDown] ?>" class="listing-btn">Invest Now</a>
            </div>
            </div>
            <div class="listing-feature">
            <!-- <ul class="listing-feature-list">
            <li><i class="far fa-bed-front"></i>3 Beds</li>
            <li><i class="far fa-bath"></i>2 Baths</li>
            <li><i class="far fa-compass-drafting"></i>600 Sq Ft</li>
            </ul> -->
            </div>
            <hr>
            <div class="">
                <div class="progressbar-item">            
                    <div progress-bar data-percentage="<?=$fetch_array_percent[$countDown]; ?>%">
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
                  <div class="d-flexa">
                    <div >             
                    <h5><?=number_format($fetch_array_no_of[$countDown]); ?> Investors</h5>
                    </div>
                    <div >  
                    <h4><?=number_format($fetch_array_current_inv[$countDown]); ?> Raised</h4>
                    </div>
                  </div>
                    
            </div>
            </div>
            </div>
            <?php     
        $countDown++;
        endwhile; 
        ?>

            </div>
            </div>
            </div>
            
    
    <div class="search-area">
    <div class="container">
    <div class="search-wrapper">
    <!-- <div class="search-nav">
    <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
    <button class="nav-link active" id="pills-tab-1" data-bs-toggle="pill" data-bs-target="#pills-1" type="button" role="tab" aria-controls="pills-1" aria-selected="true">For Buy</button>
    </li>
    <li class="nav-item" role="presentation">
    <button class="nav-link" id="pills-tab-2" data-bs-toggle="pill" data-bs-target="#pills-2" type="button" role="tab" aria-controls="pills-2" aria-selected="false">For Sale</button>
    </li>
    <li class="nav-item" role="presentation">
    <button class="nav-link" id="pills-tab-3" data-bs-toggle="pill" data-bs-target="#pills-3" type="button" role="tab" aria-controls="pills-3" aria-selected="false">12% p.a</button>
    </li>
    </ul>
    </div> -->
    <div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show " id="pills-1" role="tabpanel" aria-labelledby="pills-tab-1" tabindex="0">
    <div class="search-form">
    <form action="#">
    <div class="row align-items-center">
    <div class="col-lg-3">
    <div class="form-group">
    <input type="text" class="form-control" placeholder="Type Keyword...">
    <i class="far fa-search"></i>
    </div>
    </div>
    <div class="col-lg-3">
    <div class="form-group">
    <select class="select">
    <option value>Location</option>
    <option value="1">New York</option>
    <option value="2">California</option>
    <option value="3">London</option>
    <option value="4">Maxico</option>
    <option value="5">Los Angeles</option>
    <option value="6">Washington</option>
    </select>
    <i class="far fa-location-dot"></i>
    </div>
    </div>
    <div class="col-lg-3">
    <div class="form-group">
    <select class="select">
    <option value>Property Type</option>
    <option value="1">All Category</option>
    <option value="2">Apartment</option>
    <option value="3">Villas</option>
    <option value="4">Commercial</option>
    <option value="5">Offices</option>
    <option value="6">Garage</option>
    </select>
    <i class="far fa-home"></i>
    </div>
    </div>
    <div class="col-lg-1">
    <div class="advanced-search-wrapper">
    <div class="advanced-search">
    <i class="fa-regular fa-sliders"></i> Advanced
    </div>
    <div class="advanced-search-menu">
    <h4 class="mb-4">Advanced Options</h4>
    <div class="row">
    <div class="col-md-6 col-lg-3">
    <div class="form-group">
    <select class="select">
    <option value>Bathrooms</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    </select>
    <i class="far fa-bath"></i>
    </div>
    </div>
    <div class="col-md-6 col-lg-3">
    <div class="form-group">
    <select class="select">
    <option value>Bedrooms</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    </select>
    <i class="far fa-bed-front"></i>
    </div>
    </div>
    <div class="col-md-6 col-lg-3">
    <div class="form-group">
    <input type="text" class="form-control" placeholder="Min Area (Sq Ft)">
    <i class="far fa-compass-drafting"></i>
    </div>
    </div>
    <div class="col-md-6 col-lg-3">
    <div class="form-group">
    <input type="text" class="form-control" placeholder="Max Area (Sq Ft)">
    <i class="far fa-compass-drafting"></i>
    </div>
    </div>
    <div class="col-md-6 col-lg-3">
    <div class="form-group mt-lg-4">
    <select class="select">
    <option value>Built Year</option>
    <option value="1">2022</option>
    <option value="2">2021</option>
    <option value="3">2020</option>
    <option value="4">2019</option>
    <option value="5">2018</option>
    </select>
    <i class="far fa-building"></i>
    </div>
    </div>
    <div class="col-md-6 col-lg-5">
    <div class="price-range-slider mt-lg-4">
    <div class="mb-10 text-start">
    <label for="priceRange1">Price Range:</label>
    <input type="text" class="priceRange" id="priceRange1" readonly>
    </div>
    <div id="price-range1" class="price-range slider"></div>
    </div>
    </div>
    <div class="col-lg-4">
    <div class="form-group mt-lg-4">
    <input type="text" class="form-control" placeholder="Property Id (RFH 32548)">
    <i class="far fa-badge-check"></i>
    </div>
    </div>
    <div class="col-lg-12">
    <h5 class="pt-5 pb-4">Aminities</h5>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
    <div class="form-check">
    <input class="form-check-input" name="buy-aminity" type="checkbox" value id="buy-aminity1">
    <label class="form-check-label" for="buy-aminity1">
    Air Conditioning
    </label>
    </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
    <div class="form-check">
    <input class="form-check-input" name="buy-aminity" type="checkbox" value id="buy-aminity2">
    <label class="form-check-label" for="buy-aminity2">
    Barbeque
    </label>
    </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
    <div class="form-check">
    <input class="form-check-input" name="buy-aminity" type="checkbox" value id="buy-aminity3">
    <label class="form-check-label" for="buy-aminity3">
    Dryer
    </label>
    </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
    <div class="form-check">
    <input class="form-check-input" name="buy-aminity" type="checkbox" value id="buy-aminity4">
    <label class="form-check-label" for="buy-aminity4">
    Gym
    </label>
    </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
    <div class="form-check">
    <input class="form-check-input" name="buy-aminity" type="checkbox" value id="buy-aminity5">
    <label class="form-check-label" for="buy-aminity5">
    Laundry
    </label>
    </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
    <div class="form-check">
    <input class="form-check-input" name="buy-aminity" type="checkbox" value id="buy-aminity6">
    <label class="form-check-label" for="buy-aminity6">
    Lawn
    </label>
    </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
    <div class="form-check">
    <input class="form-check-input" name="buy-aminity" type="checkbox" value id="buy-aminity7">
    <label class="form-check-label" for="buy-aminity7">
    Microwave
    </label>
    </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
    <div class="form-check">
    <input class="form-check-input" name="buy-aminity" type="checkbox" value id="buy-aminity8">
    <label class="form-check-label" for="buy-aminity8">
    Outdoor Shower
    </label>
    </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
    <div class="form-check">
    <input class="form-check-input" name="buy-aminity" type="checkbox" value id="buy-aminity9">
    <label class="form-check-label" for="buy-aminity9">
    Refrigerator
    </label>
    </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
    <div class="form-check">
    <input class="form-check-input" name="buy-aminity" type="checkbox" value id="buy-aminity10">
    <label class="form-check-label" for="buy-aminity10">
    Sauna
    </label>
    </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
    <div class="form-check">
    <input class="form-check-input" name="buy-aminity" type="checkbox" value id="buy-aminity11">
    <label class="form-check-label" for="buy-aminity11">
    Swimming Pool
    </label>
    </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
    <div class="form-check">
    <input class="form-check-input" name="buy-aminity" type="checkbox" value id="buy-aminity12">
    <label class="form-check-label" for="buy-aminity12">
    TV Cable
    </label>
    </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
    <div class="form-check">
    <input class="form-check-input" name="buy-aminity" type="checkbox" value id="buy-aminity13">
    <label class="form-check-label" for="buy-aminity13">
    Washer
    </label>
    </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
    <div class="form-check">
    <input class="form-check-input" name="buy-aminity" type="checkbox" value id="buy-aminity14">
    <label class="form-check-label" for="buy-aminity14">
    WiFi
    </label>
    </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
    <div class="form-check">
    <input class="form-check-input" name="buy-aminity" type="checkbox" value id="buy-aminity15">
    <label class="form-check-label" for="buy-aminity15">
    Window Cover
    </label>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <div class="col-lg-2">
    <button type="submit" class="theme-btn"><span class="far fa-search"></span>Search</button>
    </div>
    </div>
    </form>
    </div>
    </div>
    <div class="tab-pane fade" id="pills-2" role="tabpanel" aria-labelledby="pills-tab-2" tabindex="0">
    <div class="search-form">
    <form action="#">
    <div class="row align-items-center">
    <div class="col-lg-3">
    <div class="form-group">
    <input type="text" class="form-control" placeholder="Type Keyword...">
    <i class="far fa-search"></i>
    </div>
    </div>
    <div class="col-lg-3">
    <div class="form-group">
    <select class="select">
    <option value>Location</option>
    <option value="1">New York</option>
    <option value="2">California</option>
    <option value="3">London</option>
    <option value="4">Maxico</option>
    <option value="5">Los Angeles</option>
    <option value="6">Washington</option>
    </select>
    <i class="far fa-location-dot"></i>
    </div>
    </div>
    <div class="col-lg-3">
    <div class="form-group">
    <select class="select">
    <option value>Property Type</option>
    <option value="1">All Category</option>
    <option value="2">Apartment</option>
    <option value="3">Villas</option>
    <option value="4">Commercial</option>
    <option value="5">Offices</option>
    <option value="6">Garage</option>
    </select>
    <i class="far fa-home"></i>
    </div>
    </div>
    <div class="col-lg-1">
    <div class="advanced-search-wrapper">
    <div class="advanced-search">
    <i class="fa-regular fa-sliders"></i> Advanced
    </div>
    <div class="advanced-search-menu">
    <h4 class="mb-4">Advanced Options</h4>
    <div class="row">
    <div class="col-md-6 col-lg-3">
    <div class="form-group">
    <select class="select">
    <option value>Bathrooms</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    </select>
    <i class="far fa-bath"></i>
    </div>
    </div>
    <div class="col-md-6 col-lg-3">
    <div class="form-group">
    <select class="select">
    <option value>Bedrooms</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    </select>
    <i class="far fa-bed-front"></i>
    </div>
    </div>
    <div class="col-md-6 col-lg-3">
    <div class="form-group">
    <input type="text" class="form-control" placeholder="Min Area (Sq Ft)">
    <i class="far fa-compass-drafting"></i>
    </div>
    </div>
    <div class="col-md-6 col-lg-3">
    <div class="form-group">
    <input type="text" class="form-control" placeholder="Max Area (Sq Ft)">
    <i class="far fa-compass-drafting"></i>
    </div>
    </div>
    <div class="col-md-6 col-lg-3">
    <div class="form-group mt-lg-4">
    <select class="select">
    <option value>Built Year</option>
    <option value="1">2022</option>
    <option value="2">2021</option>
    <option value="3">2020</option>
    <option value="4">2019</option>
    <option value="5">2018</option>
    </select>
    <i class="far fa-building"></i>
    </div>
    </div>
    <div class="col-md-6 col-lg-5">
    <div class="price-range-slider mt-lg-4">
    <div class="mb-10 text-start">
    <label for="priceRange2">Price Range:</label>
    <input type="text" class="priceRange" id="priceRange2" readonly>
    </div>
    <div id="price-range2" class="price-range slider"></div>
    </div>
    </div>
    <div class="col-lg-4">
    <div class="form-group mt-lg-4">
    <input type="text" class="form-control" placeholder="Property Id (RFH 32548)">
    <i class="far fa-badge-check"></i>
    </div>
    </div>
    <div class="col-lg-12">
    <h5 class="pt-5 pb-4">Aminities</h5>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
    <div class="form-check">
    <input class="form-check-input" name="sale-aminity" type="checkbox" value id="sale-aminity1">
    <label class="form-check-label" for="sale-aminity1">
    Air Conditioning
    </label>
    </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
    <div class="form-check">
    <input class="form-check-input" name="sale-aminity" type="checkbox" value id="sale-aminity2">
    <label class="form-check-label" for="sale-aminity2">
    Barbeque
    </label>
    </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
    <div class="form-check">
    <input class="form-check-input" name="sale-aminity" type="checkbox" value id="sale-aminity3">
    <label class="form-check-label" for="sale-aminity3">
    Dryer
    </label>
    </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
    <div class="form-check">
    <input class="form-check-input" name="sale-aminity" type="checkbox" value id="sale-aminity4">
    <label class="form-check-label" for="sale-aminity4">
    Gym
    </label>
    </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
    <div class="form-check">
    <input class="form-check-input" name="sale-aminity" type="checkbox" value id="sale-aminity5">
    <label class="form-check-label" for="sale-aminity5">
    Laundry
    </label>
    </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
    <div class="form-check">
    <input class="form-check-input" name="sale-aminity" type="checkbox" value id="sale-aminity6">
    <label class="form-check-label" for="sale-aminity6">
    Lawn
    </label>
    </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
    <div class="form-check">
    <input class="form-check-input" name="sale-aminity" type="checkbox" value id="sale-aminity7">
    <label class="form-check-label" for="sale-aminity7">
    Microwave
    </label>
    </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
    <div class="form-check">
    <input class="form-check-input" name="sale-aminity" type="checkbox" value id="sale-aminity8">
    <label class="form-check-label" for="sale-aminity8">
    Outdoor Shower
    </label>
    </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
    <div class="form-check">
    <input class="form-check-input" name="sale-aminity" type="checkbox" value id="sale-aminity9">
    <label class="form-check-label" for="sale-aminity9">
    Refrigerator
    </label>
    </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
    <div class="form-check">
    <input class="form-check-input" name="sale-aminity" type="checkbox" value id="sale-aminity10">
    <label class="form-check-label" for="sale-aminity10">
    Sauna
    </label>
    </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
    <div class="form-check">
    <input class="form-check-input" name="sale-aminity" type="checkbox" value id="sale-aminity11">
    <label class="form-check-label" for="sale-aminity11">
    Swimming Pool
    </label>
    </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
    <div class="form-check">
    <input class="form-check-input" name="sale-aminity" type="checkbox" value id="sale-aminity12">
    <label class="form-check-label" for="sale-aminity12">
    TV Cable
    </label>
    </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
    <div class="form-check">
    <input class="form-check-input" name="sale-aminity" type="checkbox" value id="sale-aminity13">
    <label class="form-check-label" for="sale-aminity13">
    Washer
    </label>
    </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
    <div class="form-check">
    <input class="form-check-input" name="sale-aminity" type="checkbox" value id="sale-aminity14">
    <label class="form-check-label" for="sale-aminity14">
    WiFi
    </label>
    </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
    <div class="form-check">
    <input class="form-check-input" name="sale-aminity" type="checkbox" value id="sale-aminity15">
    <label class="form-check-label" for="sale-aminity15">
    Window Cover
    </label>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <div class="col-lg-2">
    <button type="submit" class="theme-btn"><span class="far fa-search"></span>Search</button>
    </div>
    </div>
    </form>
    </div>
    </div>
    <div class="tab-pane fade" id="pills-3" role="tabpanel" aria-labelledby="pills-tab-3" tabindex="0">
    <div class="search-form">
    <form action="#">
    <div class="row align-items-center">
    <div class="col-lg-3">
    <div class="form-group">
    <input type="text" class="form-control" placeholder="Type Keyword...">
    <i class="far fa-search"></i>
    </div>
    </div>
    <div class="col-lg-3">
    <div class="form-group">
    <select class="select">
    <option value>Location</option>
    <option value="1">New York</option>
    <option value="2">California</option>
    <option value="3">London</option>
    <option value="4">Maxico</option>
    <option value="5">Los Angeles</option>
    <option value="6">Washington</option>
    </select>
    <i class="far fa-location-dot"></i>
    </div>
    </div>
    <div class="col-lg-3">
    <div class="form-group">
    <select class="select">
    <option value>Property Type</option>
    <option value="1">All Category</option>
    <option value="2">Apartment</option>
    <option value="3">Villas</option>
    <option value="4">Commercial</option>
    <option value="5">Offices</option>
    <option value="6">Garage</option>
    </select>
    <i class="far fa-home"></i>
    </div>
    </div>
    <div class="col-lg-1">
    <div class="advanced-search-wrapper">
    <div class="advanced-search">
    <i class="fa-regular fa-sliders"></i> Advanced
    </div>
    <div class="advanced-search-menu">
    <h4 class="mb-4">Advanced Options</h4>
    <div class="row">
    <div class="col-md-6 col-lg-3">
    <div class="form-group">
    <select class="select">
    <option value>Bathrooms</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    </select>
    <i class="far fa-bath"></i>
    </div>
    </div>
    <div class="col-md-6 col-lg-3">
    <div class="form-group">
    <select class="select">
    <option value>Bedrooms</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    </select>
    <i class="far fa-bed-front"></i>
    </div>
    </div>
    <div class="col-md-6 col-lg-3">
    <div class="form-group">
    <input type="text" class="form-control" placeholder="Min Area (Sq Ft)">
    <i class="far fa-compass-drafting"></i>
    </div>
    </div>
    <div class="col-md-6 col-lg-3">
    <div class="form-group">
    <input type="text" class="form-control" placeholder="Max Area (Sq Ft)">
    <i class="far fa-compass-drafting"></i>
    </div>
    </div>
    <div class="col-md-6 col-lg-3">
    <div class="form-group mt-lg-4">
    <select class="select">
    <option value>Built Year</option>
    <option value="1">2022</option>
    <option value="2">2021</option>
    <option value="3">2020</option>
    <option value="4">2019</option>
    <option value="5">2018</option>
    </select>
    <i class="far fa-building"></i>
    </div>
    </div>
    <div class="col-md-6 col-lg-5">
    <div class="price-range-slider mt-lg-4">
    <div class="mb-10 text-start">
    <label for="priceRange3">Price Range:</label>
    <input type="text" class="priceRange" id="priceRange3" readonly>
    </div>
    <div id="price-range3" class="price-range slider"></div>
    </div>
    </div>
    <div class="col-lg-4">
    <div class="form-group mt-lg-4">
    <input type="text" class="form-control" placeholder="Property Id (RFH 32548)">
    <i class="far fa-badge-check"></i>
    </div>
    </div>
    <div class="col-lg-12">
    <h5 class="pt-5 pb-4">Aminities</h5>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
    <div class="form-check">
    <input class="form-check-input" name="rent-aminity" type="checkbox" value id="rent-aminity1">
    <label class="form-check-label" for="rent-aminity1">
    Air Conditioning
    </label>
    </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
    <div class="form-check">
    <input class="form-check-input" name="rent-aminity" type="checkbox" value id="rent-aminity2">
    <label class="form-check-label" for="rent-aminity2">
    Barbeque
    </label>
    </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
    <div class="form-check">
    <input class="form-check-input" name="rent-aminity" type="checkbox" value id="rent-aminity3">
    <label class="form-check-label" for="rent-aminity3">
    Dryer
    </label>
    </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
    <div class="form-check">
    <input class="form-check-input" name="rent-aminity" type="checkbox" value id="rent-aminity4">
    <label class="form-check-label" for="rent-aminity4">
    Gym
    </label>
    </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
    <div class="form-check">
    <input class="form-check-input" name="rent-aminity" type="checkbox" value id="rent-aminity5">
    <label class="form-check-label" for="rent-aminity5">
    Laundry
    </label>
    </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
    <div class="form-check">
    <input class="form-check-input" name="rent-aminity" type="checkbox" value id="rent-aminity6">
    <label class="form-check-label" for="rent-aminity6">
    Lawn
    </label>
    </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
    <div class="form-check">
    <input class="form-check-input" name="rent-aminity" type="checkbox" value id="rent-aminity7">
    <label class="form-check-label" for="rent-aminity7">
    Microwave
    </label>
    </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
    <div class="form-check">
    <input class="form-check-input" name="rent-aminity" type="checkbox" value id="rent-aminity8">
    <label class="form-check-label" for="rent-aminity8">
    Outdoor Shower
    </label>
    </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
    <div class="form-check">
    <input class="form-check-input" name="rent-aminity" type="checkbox" value id="rent-aminity9">
    <label class="form-check-label" for="rent-aminity9">
    Refrigerator
    </label>
    </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
    <div class="form-check">
    <input class="form-check-input" name="rent-aminity" type="checkbox" value id="rent-aminity10">
    <label class="form-check-label" for="rent-aminity10">
    Sauna
    </label>
    </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
    <div class="form-check">
    <input class="form-check-input" name="rent-aminity" type="checkbox" value id="rent-aminity11">
    <label class="form-check-label" for="rent-aminity11">
    Swimming Pool
    </label>
    </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
    <div class="form-check">
    <input class="form-check-input" name="rent-aminity" type="checkbox" value id="rent-aminity12">
    <label class="form-check-label" for="rent-aminity12">
    TV Cable
    </label>
    </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
    <div class="form-check">
    <input class="form-check-input" name="rent-aminity" type="checkbox" value id="rent-aminity13">
    <label class="form-check-label" for="rent-aminity13">
    Washer
    </label>
    </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
    <div class="form-check">
    <input class="form-check-input" name="rent-aminity" type="checkbox" value id="rent-aminity14">
    <label class="form-check-label" for="rent-aminity14">
    WiFi
    </label>
    </div>
    </div>
    <div class="col-6 col-md-3 col-lg-2">
    <div class="form-check">
    <input class="form-check-input" name="rent-aminity" type="checkbox" value id="rent-aminity15">
    <label class="form-check-label" for="rent-aminity15">
    Window Cover
    </label>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <div class="col-lg-2">
    <button type="submit" class="theme-btn"><span class="far fa-search"></span>Search</button>
    </div>
    </div>
    </form>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    
    
    <!-- <div class="about-area py-120 mb-30">
    <div class="container">
    <div class="row align-items-center">
    <div class="col-lg-6">
    <div class="about-left wow fadeInLeft" data-wow-duration="1s" data-wow-delay=".25s">
    <div class="about-img">
    <img src="assets/img/about/01.jpg" alt>
    </div>
    <div class="about-experience">
    <h1>25 <span>+</span></h1>
    <span class="about-experience-text">Years Of Experience</span>
    </div>
    <div class="about-shape">
    <img src="assets/img/shape/01.svg" alt>
    </div>
    </div>
    </div>
    <div class="col-lg-6">
    <div class="about-right wow fadeInUp" data-wow-duration="1s" data-wow-delay=".25s">
    <div class="site-heading mb-3">
    <span class="site-title-tagline">About Us</span>
    <h2 class="site-title">
    We have the most listings and constant updates.
    </h2>
    </div>
    <p class="about-text">There are many variations of passages of Lorem Ipsum available,
    but the majority have suffered alteration in some form, by injected humour, or
    randomised words which don't look even.</p>
    <div class="about-list-wrapper">
    <ul class="about-list list-unstyled">
    <li>
    <div class="about-icon"><span class="fas fa-check-circle"></span></div>
    <div class="about-list-text">
    <p>Take a look at our round up of the best shows</p>
    </div>
    </li>
    <li>
    <div class="about-icon"><span class="fas fa-check-circle"></span></div>
    <div class="about-list-text">
    <p>It has survived not only five centuries</p>
    </div>
    </li>
    <li>
    <div class="about-icon"><span class="fas fa-check-circle"></span></div>
    <div class="about-list-text">
    <p>Lorem Ipsum has been the ndustry standard dummy text</p>
    </div>
    </li>
    </ul>
    </div>
    <div class="about-bottom">
    <div class="about-call">
    <div class="about-call-icon">
    <i class="fal fa-user-headset"></i>
    </div>
    <div class="about-call-content">
    <span>Call Us Anytime</span>
    <h5 class="about-call-number"><a href="tel:+2123654789">+2 123 654 789</a></h5>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div> -->
    
    <div class="service-area mag001">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto wow fadeInDown" data-wow-duration="1s" data-wow-delay=".25s">
                <div class="site-heading text-center mb-30">
                <span class="site-title-tagline">Your way to your investment</span>
                <h2 class="site-title">How it works</h2>
                </div>
                </div>
                </div>
        <div class="row">
        <div class="col-md-6 col-lg-3">
        <div class="service-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".25s">
        <div class="service-icon p-3 text-white 700"  style="font-size: 40px">
        1.
        </div>
        <div class="service-content">
        <h3 class="service-title">
        <a href="#">Register</a>
        </h3>
        <p class="service-text">
            Subscribe for free and become a member of our community
        </p>
        <div class="service-arrow">
        <a href="#"><i class="far fa-arrow-right"></i></a>
        </div>
        </div>
        </div>
        </div>
        <div class="col-md-6 col-lg-3">
        <div class="service-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".50s">
        <div class="service-icon p-3 text-white 700"  style="font-size: 40px">
        2.
        </div>
        <div class="service-content">
        <h3 class="service-title">
        <a href="#">Explore</a>
        </h3>
        <p class="service-text">
            Explore our different investment deals and options
        </p>
        <div class="service-arrow">
        <a href="#"><i class="far fa-arrow-right"></i></a>
        </div>
        </div>
        </div>
        </div>
        <div class="col-md-6 col-lg-3">
        <div class="service-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".75s">
        <div class="service-icon p-3 text-white 700"  style="font-size: 40px">
        3.
        </div>
        <div class="service-content">
        <h3 class="service-title">
        <a href="#">Get verified</a>
        </h3>
        <p class="service-text">
            Go through our KYC process and become a verified member.
        </p>
        <div class="service-arrow">
        <a href="#"><i class="far fa-arrow-right"></i></a>
        </div>
        </div>
        </div>
        </div>
        <div class="col-md-6 col-lg-3">
        <div class="service-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".75s">
        <div class="service-icon p-3 text-white 700"  style="font-size: 40px">
        4.
        </div>
        <div class="service-content">
        <h3 class="service-title">
        <a href="#">Invest</a>
        </h3>
        <p class="service-text">
            Pick a deal and amount and invest in your first property
        </p>
        <div class="service-arrow">
        <a href="#"><i class="far fa-arrow-right"></i></a>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
    
    <div class="property-listing" style="margin-top: 0px !important" >
    <div class="container">
    <div class="row">
    <div class="col-lg-6 mx-auto wow fadeInDown" data-wow-duration="1s" data-wow-delay=".25s">
    <div class="site-heading text-center mb-30">
    <!-- <span class="site-title-tagline">Property</span> -->
    <!-- <h2 class="site-title">Our Featured Property</h2> -->
    <!-- <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p> -->
    
    
    </div>
    </div>
    </div>
    
    </div>
    </div>
    </div>
    </div>
    
    
    <!-- <div class="video-area">
    <div class="container-fluid px-0">
    <div class="video-content" style="background-image: url(i/13.jpg);">
    <div class="row align-items-center">
    <div class="col-lg-12">
    <div class="container video-wrapper mt-5">
    <a class="play-btn popup-youtube" href="assets/vid.mp4">
        
    <i class="fas fa-play"></i>
    </a>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div> -->
    
    <div class="location-area py-80">
        <div class="container">
        <div class="row">
        <div class="col-lg-6 mx-auto wow fadeInDown" data-wow-duration="1s" data-wow-delay=".25s">
        <div class="site-heading text-center">
        <!-- <span class="site-title-tagline">Location</span> -->
        <!-- <h2 class="site-title">Our Top Location</h2> -->
        </div>
        </div>
        </div>
        <div class="row align-items-center">
        <!-- <div class="col-md-12 col-lg-6">
        <div class="location-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".25s">
        <div class="location-img">
        <img src="i/13.jpg" class="img-fluid" alt>
        </div>
        <div class="location-info">
        <h3>New York City</h3>
        <span>56 Properties</span>
        </div>
        <a href="#" class="location-btn"><i class="far fa-arrow-right"></i></a>
        </div>
        </div> -->
        <div class="col-md-12 col-lg-12">
        <div class="location-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".50s">
        <div class="location-img">
            <img src="i/splash-bg.webp" class="img-fluid" alt>
        </div>
        <div class="location-info">
        <h3>Peravest unlocks professional real estate investments for everyone.</h3>
        <!-- <span>ipsum Properties</span> -->
        </div>
        <a href="#" class="location-btn"><i class="far fa-arrow-right"></i></a>
        </div>
        </div>
        <!-- <div class="col-md-6 col-lg-3">
        <div class="location-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".75s">
        <div class="location-img">
            <img src="i/16.jpg" alt>
        </div>
        <div class="location-info">
        <h3>Las Vegas</h3>
        <span>30 Properties</span>
        </div>
        <a href="#" class="location-btn"><i class="far fa-arrow-right"></i></a>
        </div>
        </div> -->
    
        <div class="d-flex align-items-center justify-content-center mb-4">
            <a href="about" class="theme-btn mt-4">About Us <i class="far fa-arrow-right"></i></a>                
          </div>
        
        </div>
        </div>
        </div>
    
    
    <!-- <div class="location-area pb-120">
    <div class="container">
    <div class="row">
    <div class="col-lg-6 mx-auto wow fadeInDown" data-wow-duration="1s" data-wow-delay=".25s">
    <div class="site-heading text-center">
    <span class="site-title-tagline">Location</span>
    <h2 class="site-title">Our Top Location</h2>
    </div>
    </div>
    </div>
    <div class="row align-items-center">
    <div class="col-md-12 col-lg-6">
    <div class="location-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".25s">
    <div class="location-img">
    <img src="assets/img/location/01.jpg" alt>
    </div>
    <div class="location-info">
    <h3>New York City</h3>
    <span>56 Properties</span>
    </div>
    <a href="#" class="location-btn"><i class="far fa-arrow-right"></i></a>
    </div>
    </div>
    <div class="col-md-6 col-lg-3">
    <div class="location-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".50s">
    <div class="location-img">
    <img src="assets/img/location/02.jpg" alt>
    </div>
    <div class="location-info">
    <h3>San Francisco</h3>
    <span>25 Properties</span>
    </div>
    <a href="#" class="location-btn"><i class="far fa-arrow-right"></i></a>
    </div>
    </div>
    <div class="col-md-6 col-lg-3">
    <div class="location-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".75s">
    <div class="location-img">
    <img src="assets/img/location/03.jpg" alt>
    </div>
    <div class="location-info">
    <h3>Las Vegas</h3>
    <span>30 Properties</span>
    </div>
    <a href="#" class="location-btn"><i class="far fa-arrow-right"></i></a>
    </div>
    </div>
    <div class="col-md-6 col-lg-3">
    <div class="location-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".25s">
    <div class="location-img">
    <img src="assets/img/location/04.jpg" alt>
    </div>
    <div class="location-info">
    <h3>Los Angeles</h3>
    <span>35 Properties</span>
    </div>
    <a href="#" class="location-btn"><i class="far fa-arrow-right"></i></a>
    </div>
    </div>
    <div class="col-md-6 col-lg-3">
    <div class="location-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".50s">
    <div class="location-img">
    <img src="assets/img/location/05.jpg" alt>
    </div>
    <div class="location-info">
    <h3>Sydney</h3>
    <span>28 Properties</span>
    </div>
    <a href="#" class="location-btn"><i class="far fa-arrow-right"></i></a>
    </div>
    </div>
    <div class="col-md-12 col-lg-6">
    <div class="location-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".75s">
    <div class="location-img">
    <img src="assets/img/location/06.jpg" alt>
    </div>
    <div class="location-info">
    <h3>New Orleans</h3>
    <span>50 Properties</span>
    </div>
    <a href="#" class="location-btn"><i class="far fa-arrow-right"></i></a>
    </div>
    </div>
    </div>
    </div>
    </div> -->
    
    
    <div class="choose-area bg pt-70 pb-70">
    <div class="container">
    <div class="row">
    <div class="col-lg-6 mx-auto wow fadeInDown" data-wow-duration="1s" data-wow-delay=".25s">
    <div class="site-heading text-center">
    <span class="site-title-tagline">Choose</span>
    <h2 class="site-title">Why Choose Us</h2>
    <p>At Peravest, we're committed to providing a secure, flexible, and successful investment experience for Nigerians at home and abroad. Here are just a few reasons why thousands of investors choose to invest with us:

</p>
    </div>
    </div>
    </div>
    <div class="choose-wrapper">
    <div class="row justify-content-center">
    <div class="col-md-6 col-lg-4">
    <div class="choose-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".25s">
    <div class="choose-icon">
    <i class="flaticon-discord"></i>
    </div>
    <h4 class="choose-title">Rigorous Project Vetting</h4>
    <p>We understand that investing in Nigerian real estate can come with unique challenges. That's why we carefully vet every project before listing it on our platform. Our team of experts conducts thorough research and due diligence to ensure that every project meets our high standards.
    </p>
    </div>
    </div>
    <div class="col-md-6 col-lg-4">
    <div class="choose-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".50s">
    <div class="choose-icon">
    <i class="flaticon-calculator"></i>
    </div>
    <h4 class="choose-title">Variety of Investment Options</h4>
    <p>We offer a range of investment deals in Nigeria's most promising real estate markets, including Lagos, Abuja, and Port Harcourt. From residential to commercial properties, our platform provides access to a diverse portfolio of investment opportunities.
</p>
    </div>
    </div>
    <div class="col-md-6 col-lg-4">
    <div class="choose-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".75s">
    <div class="choose-icon">
    <i class="flaticon-house"></i>
    </div>
    <h4 class="choose-title">Expert Support and Guidance</h4>
    <p>Our experienced team is dedicated to providing personalized support and guidance throughout your investment journey. From helping you choose the right investment to providing regular updates on your portfolio, we're here to help.</p>
    </div>
    </div>
    <div class="col-md-6 col-lg-4">
    <div class="choose-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".25s">
    <div class="choose-icon">
    <i class="flaticon-discord"></i>
    </div>
    <h4 class="choose-title">Regulatory Compliance</h4>
    <p>We're committed to complying with all relevant Nigerian regulations and laws, including the Nigerian Investment Promotion Commission (NIPC) and the Securities and Exchange Commission (SEC)</p>
    </div>
    </div>
    <div class="col-md-6 col-lg-4">
    <div class="choose-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".50s">
    <div class="choose-icon">
    <img src="i/trans.png" width="60px" height="auto" alt="">
    </div>
    <h4 class="choose-title">Transparent and Secure Transactions</h4>
    <p>We prioritize transparency and security in all our transactions. Our platform uses state-of-the-art technology to ensure that all investments are secure, and our transparent fee structure means you'll never be caught off guard by hidden charges.
    </p>
    </div>
    </div>
    <div class="col-md-6 col-lg-4">
    <div class="choose-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".75s">
    <div class="choose-icon">
    <img src="i/diaspora.png" width="60px" height="auto" alt="">
    </div>
    <h4 class="choose-title">Diaspora Friendly</h4>
    <p>We welcome investors from the Nigerian diaspora, providing a secure and convenient way to invest in Nigerian real estate from anywhere in the world.
    </p>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    
    <div class="cta-area">
        <div class="container">
        <div class="row">
        <div class="col-lg-7 mx-auto text-center">
        <div class="cta-text">
        <h1>Looking To Invest in a Property?</h1>
        <p></p>
        </div>
        <a href="listingd" class="theme-btn mt-30">Invest Now <i class="far fa-arrow-right"></i></a>
        </div>
        </div>
        </div>
    </div>

    
    <div class="team-area py-120">
<div class="container">
<div class="row">
<div class="col-lg-6 mx-auto wow fadeInDown" data-wow-duration="1s" data-wow-delay=".25s">
<div class="site-heading text-center">
    <span class="site-title-tagline">Our Team</span>
    <h2 class="site-title">Meet With Our Team</h2>
    </div>
</div>
</div>
<div class="row">
<div class="col-md-6 col-lg-4">
<div class="team-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".50s">
<div class="team-img">
<img src="i/1.jpg" alt="thumb">
</div>
<div class="team-content">
<div class="team-bio">
    <h5><a href="#"> OWOLABI ENOCH OLAWALE
    </a></h5>
    <span>CEO/DIRECTOR
    </span>
    </div>
<div class="team-social">
<ul class="team-social-btn">
<li><span><i class="far fa-share-alt"></i></span></li>
<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
<li><a href="#"><i class="fab fa-twitter"></i></a></li>
<li><a href="#"><i class="fab fa-instagram"></i></a></li>
<li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
</ul>
</div>
</div>
</div>
</div>
<div class="col-md-6 col-lg-4">
<div class="team-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".75s">
<div class="team-img">
<img src="i/7.jpg" alt="thumb">
</div>
<div class="team-content">
<div class="team-bio">
    <h5><a href="#">Adisa Fatai Oluwasegun</a></h5>
    <span>Operation Manager at Perazim Proptee Ltd | Realtor | Lifelong Learner | Family-Oriented
    </span>
    </div>
<div class="team-social">
<ul class="team-social-btn">
<li><span><i class="far fa-share-alt"></i></span></li>
<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
<li><a href="#"><i class="fab fa-twitter"></i></a></li>
<li><a href="#"><i class="fab fa-instagram"></i></a></li>
<li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
</ul>
</div>
</div>
</div>
</div>
<div class="col-md-6 col-lg-4">
<div class="team-item wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s">
<div class="team-img">
<img src="i/aaa.jpg" alt="thumb">
</div>
<div class="team-content">
<div class="team-bio">
    <h5><a href="#">SOLICITOR 
    OLUWASEUN TEMITOPE ADENUGA  (LL.B)</a></h5>
    <span>Solicitor</span>
    </div>
<div class="team-social">
<ul class="team-social-btn">
<li><span><i class="far fa-share-alt"></i></span></li>
<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
<li><a href="#"><i class="fab fa-twitter"></i></a></li>
<li><a href="#"><i class="fab fa-instagram"></i></a></li>
<li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
    
    <div class="testimonial-area py-120">
    <div class="container">
    <div class="row">
    <div class="col-lg-6 mx-auto wow fadeInDown" data-wow-duration="1s" data-wow-delay=".25s">
    <div class="site-heading text-center">
    <span class="site-title-tagline">Testimonials</span>
    <h2 class="site-title text-white">What Our Client Say's</h2>
    </div>
    </div>
    </div>
    <div class="testimonial-slider owl-carousel owl-theme">
    <div class="testimonial-single">
    <div class="testimonial-content">
    <div class="testimonial-author-img">
    <img src="i/3r.jpg" style="width:70px;height:70px;" alt>
    </div>
    <div class="testimonial-author-info mt-5">
    <h4>Eze Okoro (Igbo)</h4>
    <p>Clients</p>
    </div>
    </div>
    <div class="testimonial-quote">
    <p>
    I was hesitant to invest in Nigerian real estate from abroad, but Peravest made it effortless. Their team guided me through the process, and I'm now enjoying steady returns. Peravest has truly simplified investing in Nigerian real estate
    </p>
    <div class="testimonial-quote-icon">
    <img src="assets/img/icon/quote.svg" alt>
    </div>
    </div>
    <div class="testimonial-rate">
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    </div>
    </div>
    <div class="testimonial-single">
    <div class="testimonial-content">
    <div class="testimonial-author-img" style="margin-bottom:140px;">
    <img src="i/4r.jpg" style="width:70px;height:70px;" alt>
    </div>
    <div class="testimonial-author-info">
    <h4>Adebisi Adeyemi (Yoruba)</h4>
    <p>Clients</p>
    </div>
    </div>
    <div class="testimonial-quote">
    <p>
    Having invested in several Nigerian real estate projects, I can confidently say that Peravest stands out. Their platform is user-friendly, and their support team is always available. Peravest has set a new standard for transparency and security in Nigerian real estate investing
    </p>
    <div class="testimonial-quote-icon">
    <img src="assets/img/icon/quote.svg" alt>
    </div>
    </div>
    <div class="testimonial-rate">
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    </div>
    </div>
    <div class="testimonial-single">
    <div class="testimonial-content">
    <div class="testimonial-author-img" style="margin-bottom:140px;">
    <img src="i/1r.jpg" style="width:70px;height:70px;" alt>
    </div>
    <div class="testimonial-author-info">
    <h4>Ali Abdullahi (Hausa)
    </h4>
    <p>Clients</p>
    </div>
    </div>
    <div class="testimonial-quote">
    <p>
    As someone who's not tech-savvy, I was pleasantly surprised by how easy it was to navigate Peravest's platform. I've invested in two projects so far, and the returns have been impressive. My only suggestion is to add more project options. Overall, I'm delighted with Peraves
    </p>
    <div class="testimonial-quote-icon">
    <img src="assets/img/icon/quote.svg" alt>
    </div>
    </div>
    <div class="testimonial-rate">
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    </div>
    </div>
    <div class="testimonial-single">
    <div class="testimonial-content">
    <div class="testimonial-author-img" style="margin-bottom:140px;">
    <img src="i/2r.jpg" style="width:70px;height:70px;" alt>
    </div>
    <div class="testimonial-author-info">
    <h4>Nneoma Onyekwere (Igbo)
    </h4>
    <p>Clients</p>
    </div>
    </div>
    <div class="testimonial-quote">
    <p>
    I've worked with several Nigerian real estate companies, but Peravest's team is unparalleled. They're professional, responsive, and always willing to help. Their expertise and guidance have been invaluable. I'm grateful to have found Peravest
    </p>
    <div class="testimonial-quote-icon">
    <img src="assets/img/icon/quote.svg" alt>
    </div>
    </div>
    <div class="testimonial-rate">
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    </div>
    </div>
    <div class="testimonial-single">
    <div class="testimonial-content">
    <div class="testimonial-author-img" style="margin-bottom:140px;">
    <img src="i/5r.jpg" style="width:70px;height:70px;" alt>
    </div>
    <div class="testimonial-author-info">
    <h4>Tunde Olanrewaju (Yoruba)
    </h4>
    <p>Clients</p>
    </div>
    </div>
    <div class="testimonial-quote">
    <p>
    As a Nigerian living abroad, I was cautious about investing in real estate back home. But Peravest's platform has been a revelation. Their team is knowledgeable, and the process is straightforward. I've already invested in one project, and I'm planning to invest in more. Peravest has earned my trust
    </p>
    <div class="testimonial-quote-icon">
    <img src="assets/img/icon/quote.svg" alt>
    </div>
    </div>
    <div class="testimonial-rate">
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    </div>
    </div>
    </div>
    </div>
    </div>
    
    
    <!-- <div class="category-area py-120">
    <div class="container">
    <div class="row">
    <div class="col-lg-6 mx-auto wow fadeInDown" data-wow-duration="1s" data-wow-delay=".25s">
    <div class="site-heading text-center">
    <span class="site-title-tagline">Category</span>
    <h2 class="site-title">Choose Your Category</h2>
    </div>
    </div>
    </div>
    <div class="row">
    <div class="col-6 col-md-4 col-lg-2">
    <div class="category-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".25s">
    <a href="#">
    <div class="category-icon">
    <i class="flaticon-apartment"></i>
    </div>
    <div class="category-content">
    <h4 class="category-title">Apartment</h4>
    <span class="category-property">20</span>
    </div>
    </a>
    </div>
    </div>
    <div class="col-6 col-md-4 col-lg-2">
    <div class="category-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".50s">
    <a href="#">
    <div class="category-icon">
    <i class="flaticon-business-and-trade"></i>
    </div>
    <div class="category-content">
    <h4 class="category-title">Offices</h4>
    <span class="category-property">15</span>
    </div>
    </a>
    </div>
    </div>
    <div class="col-6 col-md-4 col-lg-2">
    <div class="category-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".75s">
    <a href="#">
    <div class="category-icon">
    <i class="flaticon-home"></i>
    </div>
    <div class="category-content">
    <h4 class="category-title">My House</h4>
    <span class="category-property">18</span>
    </div>
    </a>
    </div>
    </div>
    <div class="col-6 col-md-4 col-lg-2">
    <div class="category-item wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s">
    <a href="#">
    <div class="category-icon">
    <i class="flaticon-villa"></i>
    </div>
    <div class="category-content">
    <h4 class="category-title">Villas</h4>
    <span class="category-property">12</span>
    </div>
    </a>
    </div>
    </div>
    <div class="col-6 col-md-4 col-lg-2">
    <div class="category-item wow fadeInUp" data-wow-duration="1s" data-wow-delay="1.25s">
    <a href="#">
    <div class="category-icon">
    <i class="flaticon-living-room"></i>
    </div>
    <div class="category-content">
    <h4 class="category-title">Rooms</h4>
    <span class="category-property">10</span>
    </div>
    </a>
    </div>
    </div>
    <div class="col-6 col-md-4 col-lg-2">
    <div class="category-item wow fadeInUp" data-wow-duration="1s" data-wow-delay="1.50s">
    <a href="#">
    <div class="category-icon">
    <i class="flaticon-houses"></i>
    </div>
    <div class="category-content">
    <h4 class="category-title">Garage</h4>
    <span class="category-property">25</span>
    </div>
    </a>
    </div>
    </div>
    </div>
    </div>
    </div> -->
    
    
    <div class="blog-area py-120">
    <div class="container">
    <div class="row">
    <div class="col-lg-6 mx-auto wow fadeInDown" data-wow-duration="1s" data-wow-delay=".25s">
    <div class="site-heading text-center">
    <span class="site-title-tagline">Our Blog</span>
    <h2 class="site-title">Our Latest News & Blog</h2>
    </div>
    </div>
    </div>
    <div class="row">
    <div class="col-md-6 col-lg-4">
    <div class="blog-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".25s">
    <div class="blog-item-img">
    <img class="img_list1" src="assets/img/blog/blogc.jpg" alt="Thumb">
    </div>
    <div class="blog-item-info">
    <h4 class="blog-title">
    <a href="#">There are many variations of passages available suffer</a>
    </h4>
    <div class="blog-item-meta">
    <ul>
    <li><a href="#"><i class="far fa-user-circle"></i> By Alicia Davis</a></li>
    <li><a href="#"><i class="far fa-calendar-alt"></i> May 12, 2024</a></li>
    </ul>
    </div>
    <p>
    There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.
    </p>
    <a class="theme-btn" href="#">Read More<i class="far fa-arrow-right"></i></a>
    </div>
    </div>
    </div>
    <div class="col-md-6 col-lg-4">
    <div class="blog-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".50s">
    <div class="blog-item-img">
    <img class="img_list1" src="assets/img/blog/bloga.jpg" alt="Thumb">
    </div>
    <div class="blog-item-info">
    <h4 class="blog-title">
    <a href="#">The Power of Small Steps: Building Wealth with PeraVest
    </a>
    </h4>
    <div class="blog-item-meta">
    <ul>
    <li><a href="#"><i class="far fa-user-circle"></i> By Alicia Davis</a></li>
    <li><a href="#"><i class="far fa-calendar-alt"></i> May 12, 2024</a></li>
    </ul>
    </div>
    <p>
    When it comes to achieving big goals, whether in life or in finances, we often get overwhelmed by the sheer size of the task...

    </p>
    <a class="theme-btn" href="#">Read More<i class="far fa-arrow-right"></i></a>
    </div>
    </div>
    </div>
    <div class="col-md-6 col-lg-4">
    <div class="blog-item wow fadeInUp" data-wow-duration="1s" data-wow-delay=".75s">
    <div class="blog-item-img">
    <img class="img_list1" src="assets/img/blog/blogb.jpg" alt="Thumb">
    </div>
    <div class="blog-item-info">
    <h4 class="blog-title">
    <a href="#">There are many variations of passages available suffer</a>
    </h4>
    <div class="blog-item-meta">
    <ul>
    <li><a href="#"><i class="far fa-user-circle"></i> By Alicia Davis</a></li>
    <li><a href="#"><i class="far fa-calendar-alt"></i> May 12, 2024</a></li>
    </ul>
    </div>
    <p>
    There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.
    </p>
    <a class="theme-btn" href="#">Read More<i class="far fa-arrow-right"></i></a>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    
    </main>