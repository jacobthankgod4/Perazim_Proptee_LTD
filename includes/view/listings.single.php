<main class="main">    
    
    <div class="property-single pt-70">
    <div class="container">
    <div class="row">
    <div class="col-lg-8 mb-5">
    <div class="property-single-wrapper">
    <div class="property-single-slider owl-carousel owl-theme">
    <?php
        foreach ($fetch_array_images as $image) : ?>                            
            <img src="includes/admin/<?=htmlspecialchars($image) ?> " alt>
        <?php endforeach;  ?>    
        
    </div>
    <div class="property-single-meta">
    <div class="property-single-meta-left">
    <h4><?=$fetch_array['Title'] ?></h4>
    <p><i class="far fa-location-dot"></i> <?=$fetch_array['Address'] ?></p>
    <!-- <span>For</span> -->
    </div>
    <div class="property-single-meta-right">
    <div class="property-single-rating-box">
        <h6 class="listing-price-amount">₦5,000 to ₦5,000,000</h6>
        <span class="listing-price-title">Cost of Share</span>
    <div class="property-single-rating">
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <i class="fas fa-star"></i>
    <span>5.0</span>
    <div class="booking-btn mt-10">
    <a href="packages.php?identity=<?=$id; ?>" class="theme-btn">Invest Now <i class="far fa-arrow-right"></i></a>
    </div>
    </div>
    </div>
    <div class="property-single-meta-option">
    
    </div>
    
    </div>
    
    </div>
    <hr>

    <div class="property-single-content">
    <h4>Description</h4>
    <div class="property-single-description">
    <p>
    <?=$fetch_array['Description'] ?>
    </p>

    </div>
    </div>
    <div class="property-single-content">
    <h4>Property Info</h4>
    <div class="property-single-info">
    <div class="row">
    <div class="col-6 col-md-6 col-lg-4">
    <div class="property-single-info-item">
    <i class="far fa-bed-front"></i> <?=$fetch_array['Bedroom'] ?> Bedrooms
    </div>
    </div>
    <div class="col-6 col-md-6 col-lg-4">
    <div class="property-single-info-item">
    <i class="far fa-bath"></i> <?=$fetch_array['Bathroom'] ?> Bathrooms
    </div>
    </div>
    <div class="col-6 col-md-6 col-lg-4">
    <div class="property-single-info-item">
    <i class="far fa-expand-arrows"></i> <?=$fetch_array['Area'] ?> Sq Ft
    </div>
    </div>
    <!-- <div class="col-6 col-md-6 col-lg-4">
    <div class="property-single-info-item">
    <i class="far fa-home"></i> 10 Rooms
    </div>
    </div> -->
    <div class="col-6 col-md-6 col-lg-4">
    <div class="property-single-info-item">
    <i class="far fa-building"></i> <?=$fetch_array['Built_Year'] ?> 
    </div>
    </div>
    <!-- <div class="col-6 col-md-6 col-lg-4">
    <div class="property-single-info-item">
    <i class="far fa-utensils"></i> 2 Kitchens
    </div>
    </div>
    <div class="col-6 col-md-6 col-lg-4">
    <div class="property-single-info-item">
    <i class="far fa-garage"></i> Garage
    </div>
    </div>
    <div class="col-6 col-md-6 col-lg-4">
    <div class="property-single-info-item">
    <i class="far fa-suitcase-medical"></i> Free Medical
    </div>
    </div>
    <div class="col-6 col-md-6 col-lg-4">
    <div class="property-single-info-item">
    <i class="far fa-fire"></i> Fireplace
    </div>
    </div>
    <div class="col-6 col-md-6 col-lg-4">
    <div class="property-single-info-item">
    <i class="far fa-layer-group"></i> Residential
    </div>
    </div>
    <div class="col-6 col-md-6 col-lg-4">
    <div class="property-single-info-item">
    <i class="far fa-tv"></i> TV Cable
    </div>
    </div>
    <div class="col-6 col-md-6 col-lg-4">
    <div class="property-single-info-item">
    <i class="far fa-spa"></i> Free Spa
    </div>
    </div> -->
    </div>
    </div>
    </div>
    <div class="property-single-content">
    <h4>Ameneties</h4>
    <div class="property-single-info">
    <div class="row">
    <div class="col-6 col-md-6 col-lg-4">
    <div class="property-single-info-item">
    <i class="fad fa-circle-check"></i> Air Conditioning
    </div>
    </div>
    <div class="col-6 col-md-6 col-lg-4">
    <div class="property-single-info-item">
    <i class="fad fa-circle-check"></i> Swimming Pool
    </div>
    </div>
    <div class="col-6 col-md-6 col-lg-4">
    <div class="property-single-info-item">
    <i class="fad fa-circle-check"></i> 12500 Sq Ft
    </div>
    </div>
    <div class="col-6 col-md-6 col-lg-4">
    <div class="property-single-info-item">
    <i class="fad fa-circle-check"></i> 10 Rooms
    </div>
    </div>
    <div class="col-6 col-md-6 col-lg-4">
    <div class="property-single-info-item">
    <i class="fad fa-circle-check"></i> Built Year 2022
    </div>
    </div>
    <div class="col-6 col-md-6 col-lg-4">
    <div class="property-single-info-item">
    <i class="fad fa-circle-check"></i> 2 Kitchens
    </div>
    </div>
    <div class="col-6 col-md-6 col-lg-4">
    <div class="property-single-info-item">
    <i class="fad fa-circle-check"></i> Garage
    </div>
    </div>
    <div class="col-6 col-md-6 col-lg-4">
    <div class="property-single-info-item">
    <i class="fad fa-circle-check"></i> Free Medical
    </div>
    </div>
    <div class="col-6 col-md-6 col-lg-4">
    <div class="property-single-info-item">
    <i class="fad fa-circle-check"></i> Fireplace
    </div>
    </div>
    <div class="col-6 col-md-6 col-lg-4">
    <div class="property-single-info-item">
    <i class="fad fa-circle-check"></i> Residential
    </div>
    </div>
    <div class="col-6 col-md-6 col-lg-4">
    <div class="property-single-info-item">
    <i class="fad fa-circle-check"></i> TV Cable
    </div>
    </div>
    <div class="col-6 col-md-6 col-lg-4">
    <div class="property-single-info-item">
    <i class="fad fa-circle-check"></i> Free Spa
    </div>
    </div>
    </div>
    </div>
    </div>
    <!-- <div class="property-single-content">
    <h4>Floor Plans</h4>
    <div class="property-single-info">
    <div class="property-single-floor">
    <div class="row">
    <div class="col-6 col-md-3">
    <div class="property-single-floor-item">
    <i class="far fa-bed-front"></i> 4 Bedrooms
    </div>
    </div>
    <div class="col-6 col-md-3">
    <div class="property-single-floor-item">
    <i class="far fa-bath"></i> 3 Bathrooms
    </div>
    </div>
    <div class="col-6 col-md-3">
    <div class="property-single-floor-item">
    <i class="far fa-expand-arrows"></i> 1400 Sq Ft
    </div>
    </div>
    <div class="col-6 col-md-3">
    <div class="property-single-floor-item">
    <i class="far fa-garage"></i> 1 Garage
    </div>
    </div>
    </div>
    <div class="property-single-floor-img">
    <img src="assets/img/floor-plan/01.png" alt>
    </div>
    </div>
    </div>
    </div> -->
    <?php
if ($fetch_array_video != 0) : ?>   
                        <div class="video-area mt-4">
<div class="container-fluid px-0">
<div class="video-content" style="background-image: url(includes/admin/<?=$fetch_array_images[0] ?>);">
<div class="row align-items-center">
<div class="col-lg-12">
    
<div class="container video-wrapper mt-5">
<?php
foreach ($fetch_array_video as $vid) : ?>                                                        
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
    <div class="property-single-content">
    <h4>Property Location</h4>
    <div class="property-single-info">
    <div class="property-single-map">
    <div class="contact-map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d96708.34194156103!2d-74.03927096447748!3d40.759040329405195!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x4a01c8df6fb3cb8!2sSolomon%20R.%20Guggenheim%20Museum!5e0!3m2!1sen!2sbd!4v1619410634508!5m2!1sen!2s" style="border:0;" allowfullscreen loading="lazy"></iframe>
    </div>
    </div>
    </div>
    </div>
    <!-- <div class="property-single-content">
    <h4>Nearby Places</h4>
    <div class="property-single-info">
    <div class="property-single-nearby">
    <div class="property-single-nearby-item">
    <h5><i class="far fa-school"></i> Education</h5>
    <div class="property-single-nearby-list">
    <div class="property-single-nearby-title">
    Florida Senior High School
    </div>
    <div class="property-single-nearby-info">
    <div class="property-single-nearby-rate">
    <i class="far fa-star"></i> 4.5
    </div>
    <span>2.5 Km</span>
    </div>
    </div>
    <div class="property-single-nearby-list">
    <div class="property-single-nearby-title">
    Arizona Techo High Scool
    </div>
    <div class="property-single-nearby-info">
    <div class="property-single-nearby-rate">
    <i class="far fa-star"></i> 4.5
    </div>
    <span>2.5 Km</span>
    </div>
    </div>
    <div class="property-single-nearby-list">
    <div class="property-single-nearby-title">
    Lowa Senior High Scool
    </div>
    <div class="property-single-nearby-info">
    <div class="property-single-nearby-rate">
    <i class="far fa-star"></i> 4.5
    </div>
    <span>2.5 Km</span>
    </div>
    </div>
    </div>
    <div class="property-single-nearby-item mt-4">
    <h5><i class="far fa-briefcase-medical"></i> Health & Medical</h5>
    <div class="property-single-nearby-list">
    <div class="property-single-nearby-title">
    Northern Mariana Hospital
    </div>
    <div class="property-single-nearby-info">
    <div class="property-single-nearby-rate">
    <i class="far fa-star"></i> 4.5
    </div>
    <span>2.5 Km</span>
    </div>
    </div>
    <div class="property-single-nearby-list">
    <div class="property-single-nearby-title">
    Georgia Private Hospital
    </div>
    <div class="property-single-nearby-info">
    <div class="property-single-nearby-rate">
    <i class="far fa-star"></i> 4.5
    </div>
    <span>2.5 Km</span>
    </div>
    </div>
    <div class="property-single-nearby-list">
    <div class="property-single-nearby-title">
    Alabama Colorado Hospital
    </div>
    <div class="property-single-nearby-info">
    <div class="property-single-nearby-rate">
    <i class="far fa-star"></i> 4.5
    </div>
    <span>2.5 Km</span>
    </div>
    </div>
    </div>
    <div class="property-single-nearby-item mt-4">
    <h5><i class="far fa-utensils"></i> Hotel & Restaurant</h5>
    <div class="property-single-nearby-list">
    <div class="property-single-nearby-title">
    Hotel American Samoa
    </div>
    <div class="property-single-nearby-info">
    <div class="property-single-nearby-rate">
    <i class="far fa-star"></i> 4.5
    </div>
    <span>2.5 Km</span>
    </div>
    </div>
    <div class="property-single-nearby-list">
    <div class="property-single-nearby-title">
    Oregon Bar & Restaurant
    </div>
    <div class="property-single-nearby-info">
    <div class="property-single-nearby-rate">
    <i class="far fa-star"></i> 4.5
    </div>
    <span>2.5 Km</span>
    </div>
    </div>
    <div class="property-single-nearby-list">
    <div class="property-single-nearby-title">
    Rhode Island Restaurant
    </div>
    <div class="property-single-nearby-info">
    <div class="property-single-nearby-rate">
    <i class="far fa-star"></i> 4.5
    </div>
    <span>2.5 Km</span>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div> -->
    <div class="property-single-content">
    <!--<h4>Reviews (20)</h4>-->
    <!--<div class="property-single-info">-->
    <!--<div class="property-single-comments">-->
    <!--<div class="blog-comments mb-0">-->
    <!--<div class="blog-comments-wrapper">-->
    <!--<div class="blog-comments-single">-->
    <!--<div class="blog-comments-img"><img src="assets/img/blog/com-1.jpg" alt="thumb"></div>-->
    <!--<div class="blog-comments-content">-->
    <!--<h5>Jesse Sinkler</h5>-->
    <!--<span><i class="far fa-clock"></i> 29 August, 2022</span>-->
    <!--<p>There are many variations of passages the majority have-->
    <!--suffered in some injected humour or randomised words which-->
    <!--don't look even slightly believable.</p>-->
    <!--<a href="#"><i class="far fa-reply"></i> Reply</a>-->
    <!--</div>-->
    <!--</div>-->
    <!--<div class="blog-comments-single blog-comments-reply">-->
    <!--<div class="blog-comments-img"><img src="assets/img/blog/com-2.jpg" alt="thumb"></div>-->
    <!--<div class="blog-comments-content">-->
    <!--<h5>Daniel Wellman</h5>-->
    <!--<span><i class="far fa-clock"></i> 29 August, 2022</span>-->
    <!--<p>There are many variations of passages the majority have-->
    <!--suffered in some injected humour or randomised words which-->
    <!--don't look even slightly believable.</p>-->
    <!--<a href="#"><i class="far fa-reply"></i> Reply</a>-->
    <!--</div>-->
    <!--</div>-->
    <!--<div class="blog-comments-single">-->
    <!--<div class="blog-comments-img"><img src="assets/img/blog/com-3.jpg" alt="thumb"></div>-->
    <!--<div class="blog-comments-content">-->
    <!--<h5>Kenneth Evans</h5>-->
    <!--<span><i class="far fa-clock"></i> 29 August, 2022</span>-->
    <!--<p>There are many variations of passages the majority have-->
    <!--suffered in some injected humour or randomised words which-->
    <!--don't look even slightly believable.</p>-->
    <!--<a href="#"><i class="far fa-reply"></i> Reply</a>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    <!--<div class="blog-comments-form">-->
    <!--<h3>Leave A Review</h3>-->
    <!--<form action="#">-->
    <!--<div class="row">-->
    <!--<div class="col-md-12">-->
    <!--<div class="form-group review-rating">-->
    <!--<label>Your Rating</label>-->
    <!--<div>-->
    <!--<i class="far fa-star"></i>-->
    <!--<i class="far fa-star"></i>-->
    <!--<i class="far fa-star"></i>-->
    <!--<i class="far fa-star"></i>-->
    <!--<i class="far fa-star"></i>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    <!--<div class="col-md-6">-->
    <!--<div class="form-group">-->
    <!--<input type="text" class="form-control" placeholder="Your Name*">-->
    <!--</div>-->
    <!--</div>-->
    <!--<div class="col-md-6">-->
    <!--<div class="form-group">-->
    <!--<input type="email" class="form-control" placeholder="Your Email*">-->
    <!--</div>-->
    <!--</div>-->
    <!--<div class="col-md-12">-->
    <!--<div class="form-group">-->
    <!--<textarea class="form-control" rows="5" placeholder="Your Comment*"></textarea>-->
    <!--</div>-->
    <!--<button type="submit" class="theme-btn">Submit Review <i class="far fa-paper-plane"></i></button>-->
    <!--</div>-->
    <!--</div>-->
    <!--</form>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    <!--</div>-->
    </div>
    </div>
    </div>
    <div class="col-lg-4">
    <div class="property-single-sidebar">
    <div class="property-single-content mt-0">
    <h4>Invest in this Property</h4>
    <div class="property-single-info">
    <div class="booking-btn mt-30">
    <a href="#" class="theme-btn">Invest Now <i class="far fa-arrow-right"></i></a>
    </div>
    </div>
    </div>
    <!-- <div class="property-single-content">
    <h4>Contact Agent</h4>
    <div class="property-single-info">
    <div class="property-single-agent">
    <div class="property-single-agent-content">
    <div class="property-single-agent-img">
    <img src="assets/img/account/user.jpg" alt>
    </div>
    <div class="property-single-agent-info">
    <h5>Audrey Gadis</h5>
    <ul>
    <li><a href="tel:+21236547898"><i class="far fa-phone"></i>+2 123
    654 7898</a></li>
    <li><a href="https://live.themewild.com/cdn-cgi/l/email-protection#89e0e7efe6c9ecf1e8e4f9e5eca7eae6e4"><i class="far fa-envelope"></i><span class="__cf_email__" data-cfemail="d5bcbbb3ba95b0adb4b8a5b9b0fbb6bab8">[email&#160;protected]</span></a></li>
    </ul>
    </div>
    </div>
    <div class="property-single-agent-form">
    <form action="#">
    <div class="form-group">
    <input type="text" class="form-control" placeholder="Enter Name">
    </div>
    <div class="form-group">
    <input type="text" class="form-control" placeholder="Enter Phone">
    </div>
    <div class="form-group">
    <input type="email" class="form-control" placeholder="Enter Email">
    </div>
    <div class="form-group">
    <textarea class="form-control" cols="30" rows="5" placeholder="Write Message"></textarea>
    </div>
    <div class="form-group">
    <button type="submit" class="theme-btn"><span class="far fa-paper-plane"></span> Send Message</button>
    </div>
    </form>
    </div>
    </div>
    </div>
    </div> -->
    <!-- <div class="property-single-content">
    <h4>Mortgage Calculator</h4>
    <div class="property-single-info">
    <div class="property-single-agent">
    <div class="property-single-agent-form">
    <form action="#">
    <div class="form-group">
    <input type="text" class="form-control" placeholder="Sale Price (USD)">
    </div>
    <div class="form-group">
    <input type="text" class="form-control" placeholder="Down Payment (USD)">
    </div>
    <div class="form-group">
    <input type="text" class="form-control" placeholder="Loan Term (Years)">
    </div>
    <div class="form-group">
    <input type="text" class="form-control" placeholder="Interest Rate (%)">
    </div>
    <div class="form-group">
    <input type="text" class="form-control" value="Monthly Payment: $3050.45" readonly>
    </div>
    <div class="form-group">
    <button type="submit" class="theme-btn">Calculate Now</button>
    </div>
    </form>
    </div>
    </div>
    </div>
    </div> -->
    <!-- <div class="property-single-content">
    <h4>Similar Property</h4>
    <div class="property-single-info">
    <div class="property-single-similar">
    <div class="property-similar-slider owl-carousel owl-theme">
    <div class="listing-item">
    <span class="listing-badge">12% p.a</span>
    <div class="listing-img">
    <img src="assets/img/property/01.jpg" alt>
    </div>
    <div class="listing-content">
    <h4 class="listing-title"><a href="#">New Modern Apartment</a></h4>
    <p class="listing-sub-title"><i class="far fa-location-dot"></i>25/B Milford Road, New York, USA</p>
    <div class="listing-price">
    <div class="listing-price-info">
        <h6 class="listing-price-amount">$5,000</h6>
        <span class="listing-price-title">Cost of Share</span>
    </div>
    <div class="">
        <a href="packages" class="listing-btn"> Invest Now</a>
    </div>
    </div>

    <hr>
        <div class="">
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
              </div>
              <div class="d-flexa">
                <div class="listing-author">             
                <h5>208<br> Investors</h5>
                </div>
                <h4>72 Million<br> Raised</h4>
                </div>
                
        </div>
    </div>
    </div>
    <div class="listing-item">
        <span class="listing-badge">12% p.a</span>
        <div class="listing-img">
        <img src="assets/img/property/01.jpg" alt>
        </div>
        <div class="listing-content">
        <h4 class="listing-title"><a href="#">New Modern Apartment</a></h4>
        <p class="listing-sub-title"><i class="far fa-location-dot"></i>25/B Milford Road, New York, USA</p>
        <div class="listing-price">
        <div class="listing-price-info">
            <h6 class="listing-price-amount">$5,000</h6>
            <span class="listing-price-title">Cost of Share</span>
        </div>
        <div class="">
            <a href="packages" class="listing-btn"> Invest Now</a>
        </div>
        </div>
    
        <hr>
            <div class="">
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
                  </div>
                  <div class="d-flexa">
                    <div class="listing-author">             
                    <h5>208<br> Investors</h5>
                    </div>
                    <h4>72 Million<br> Raised</h4>
                    </div>
                    
            </div>
        </div>
        </div>
    <div class="listing-item">
    <span class="listing-badge">12% p.a</span>
    <div class="listing-img">
    <img src="assets/img/property/01.jpg" alt>
    </div>
    <div class="listing-content">
    <h4 class="listing-title"><a href="#">New Modern Apartment</a></h4>
    <p class="listing-sub-title"><i class="far fa-location-dot"></i>25/B Milford Road, New York, USA</p>
    <div class="listing-price">
    <div class="listing-price-info">
        <h6 class="listing-price-amount">$5,000</h6>
        <span class="listing-price-title">Cost of Share</span>
    </div>
    <div class="">
        <a href="packages" class="listing-btn"> Invest Now</a>
    </div>
    </div>

    <hr>
        <div class="">
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
              </div>
              <div class="d-flexa">
                <div class="listing-author">             
                <h5>208<br> Investors</h5>
                </div>
                <h4>72 Million<br> Raised</h4>
                </div>
                
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div> -->
    </div>
    </div>
    </div>
    </div>
    
    </main>

