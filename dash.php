<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from live.themewild.com/homfind/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 18 Oct 2024 23:17:25 GMT -->
<head>

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content>
<meta name="keywords" content>

<title>Homfind - Real Estate HTML5 Template</title>

<link rel="icon" type="image/x-icon" href="assets/img/logo/favicon.png">

<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/all-fontawesome.min.css">
<link rel="stylesheet" href="assets/css/flaticon.css">
<link rel="stylesheet" href="assets/css/animate.min.css">
<link rel="stylesheet" href="assets/css/magnific-popup.min.css">
<link rel="stylesheet" href="assets/css/owl.carousel.min.css">
<link rel="stylesheet" href="assets/css/nice-select.min.css">
<link rel="stylesheet" href="assets/css/jquery-ui.min.css">
<link rel="stylesheet" href="assets/css/style.css">
<style>
    :root {
  --font-color: #fff;
  --bg-color: #f2f3f7;
  --button-bg-color: #0e2e50;
  --button-shadow:
    -6px -6px 8px rgba(255, 255, 255, 0.07),
    5px 5px 8px rgba(255, 255, 255, 0.07);
}

[data-theme="dark"] {
  --font-color: #fff;
  --bg-color: #181818;
  --button-bg-color: #121212;
  --button-shadow:
    -2px -2px 4px rgba(255, 255, 255, 0.05),
    0 0 10px 10px rgba(255, 255, 255, 0.005),
    2px 2px 8px rgba(60, 60, 60, 0.1);
}

.btn-dash{
    background-color: #0e2e50;
    border-radius: 30px;
    padding-right: 17px;
    padding-left: 17px;
}

.btn-dash img{    
    padding-right: 10px;
    padding-left: 10px;
}

.button {
  color: var(--font-color);
  position: relative;
  border-radius: 24px;
  background: var(--button-bg-color);
  font-weight: 700;
  transition: all 100ms cubic-bezier(0.175, 0.885, 0.32, 1.275);
  box-shadow: var(--button-shadow);
  cursor: pointer;
  
  &.button-link {
    color: #067CF8;
    display: block;
    font-size: 17px;
    margin: 30px 0 0;
    padding: 20px 0;
    width: 100%;
  }
  
  &.button-small {
    color: #6D6E74;
    font-size: 22px;
    line-height: 40px;
    width: 40px;
    height: 40px;
  }
  
  &.button-large {
    display: flex;
    font-size: 20px;
    flex-direction: column;
    padding: 15px;
    text-align: left;
    width: 45%;
    
    & svg {
      margin-bottom: 40px;
      width: 30px;
    }
  }
}
  
.button-dial {
  border-radius: 50%;
  display: flex;
  height: 270px;
  margin: 35px auto;
  align-items: center;
  justify-content: center;
  width: 270px;
}

.button-dial-top {
  background: var(--button-bg-color);
  box-shadow: var(--button-shadow);
  border-radius: 50%;
  width: 70%;
  height: 70%;
  margin: 0 auto;
  position: absolute;
  top: 15%;
  left: 15%;
  text-align: center;
  z-index: 5;
}

.button-dial-label {
  color: #067CF8;
  font-size: 28px;
  fill: #067CF8;
  position: relative;
  z-index: 10;
}

.button-dial-spoke {
  background-color: rgba(96, 171, 254, 0.6);
  display: block;
  height: 2px;
  width: 83%;
  position: absolute;
  margin: 0 auto;
  z-index: 5;
  top: 50%;
  
  &:nth-child(2) {
    transform: rotate(30deg);
  }
  &:nth-child(3) {
    transform: rotate(60deg);
  }
  &:nth-child(4) {
    transform: rotate(90deg);
  }
  &:nth-child(5) {
    transform: rotate(120deg);
  }
  &:nth-child(6) {
    transform: rotate(150deg);
  }
}



.button-block {
  align-items: center !important;
  display: flex;
  justify-content: space-between;
  padding: 15px 24px;
  width: 100%;
  
  span {
    font-size: 16px;
  }
}


</style>
</head>
<body>

<div class="preloader">
<div class="loader">
<div class="loader-shadow"></div>
<div class="loader-box"></div>
</div>
</div>


<header class="header">

<div class="header-top">
<div class="container">
<div class="header-top-wrapper">
<div class="header-top-left">
<div class="header-top-contact">
<ul>
<li>
<div class="header-top-contact-info">
<a href="#"><i class="far fa-map-marker-alt"></i> 25/B Milford Road, New
York</a>
</div>
</li>
<li>
<div class="header-top-contact-info">
<a href="https://live.themewild.com/cdn-cgi/l/email-protection#5a33343c351a3f223b372a363f74393537"><i class="far fa-envelopes"></i>
<span class="__cf_email__" data-cfemail="f59c9b939ab5908d9498859990db969a98">[email&#160;protected]</span></a>
</div>
</li>
<li>
<div class="header-top-contact-info">
<a href="tel:+21236547898"><i class="far fa-phone-arrow-down-left"></i> +2 123
654 7898</a>
</div>
</li>
</ul>
</div>
</div>
<div class="header-top-right">
<a href="#" class="header-top-link"><i class="far fa-arrow-right-to-bracket"></i> Login</a>
<a href="#" class="header-top-link"><i class="far fa-user-tie"></i> Register</a>
<div class="header-top-social">
<a href="#"><i class="fab fa-facebook-f"></i></a>
<a href="#"><i class="fab fa-twitter"></i></a>
<a href="#"><i class="fab fa-instagram"></i></a>
<a href="#"><i class="fab fa-linkedin-in"></i></a>
</div>
</div>
</div>
</div>
</div>
<div class="main-navigation">
<nav class="navbar navbar-expand-lg">
<div class="container">
<a class="navbar-brand" href="index.html">
<img src="assets/img/logo/logo.png" alt="logo">
</a>
<div class="mobile-menu-right">
<div class="header-account">
<div class="dropdown">
<div data-bs-toggle="dropdown" aria-expanded="false">
<img src="assets/img/account/user.jpg" alt>
</div>
<ul class="dropdown-menu dropdown-menu-end">
<li><a class="dropdown-item" href="dashboard.html"><i class="far fa-gauge-high"></i> Dashboard</a></li>
<li><a class="dropdown-item" href="profile.html"><i class="far fa-user"></i> My Profile</a></li>
<li><a class="dropdown-item" href="profile-property.html"><i class="far fa-home"></i> My Property</a></li>
<li><a class="dropdown-item" href="add-property.html"><i class="far fa-plus-circle"></i> Add Property</a></li>
<li><a class="dropdown-item" href="profile-favorite.html"><i class="far fa-heart"></i> My Favorite</a></li>
<li><a class="dropdown-item" href="profile-message.html"><i class="far fa-envelope"></i> Messages <span class="badge bg-danger">02</span></a></li>
<li><a class="dropdown-item" href="profile-save-search.html"><i class="far fa-bookmark"></i> Save Search</a></li>
<li><a class="dropdown-item" href="profile-setting.html"><i class="far fa-cog"></i> Profile Settings</a></li>
<li><a class="dropdown-item" href="#"><i class="far fa-sign-out"></i> Log Out</a></li>
</ul>
</div>
</div>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-btn-icon"><i class="far fa-bars"></i></span>
</button>
</div>
<div class="collapse navbar-collapse" id="main_nav">
<ul class="navbar-nav">
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle active" href="#" data-bs-toggle="dropdown">Home</a>
<ul class="dropdown-menu fade-down">
<li><a class="dropdown-item" href="index.html">Home One</a></li>
<li><a class="dropdown-item" href="index-2.html">Home Two</a></li>
<li><a class="dropdown-item" href="index-3.html">Home Three</a></li>
<li><a class="dropdown-item" href="index-4.html">Home Four</a></li>
<li><a class="dropdown-item" href="index-5.html">Home Five</a></li>
</ul>
</li>
<li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Listing</a>
<ul class="dropdown-menu fade-down">
<li class="dropdown-submenu">
<a class="dropdown-item dropdown-toggle" href="#">Listing Grid</a>
<ul class="dropdown-menu">
<li><a class="dropdown-item" href="grid.html">Grid Style One</a></li>
<li><a class="dropdown-item" href="grid-2.html">Grid Style Two</a></li>
<li><a class="dropdown-item" href="grid-3.html">Grid Style Three</a>
</li>
</ul>
</li>
<li class="dropdown-submenu">
<a class="dropdown-item dropdown-toggle" href="#">Listing List</a>
<ul class="dropdown-menu">
<li><a class="dropdown-item" href="list.html">List Style One</a></li>
<li><a class="dropdown-item" href="list-2.html">List Style Two</a></li>
<li><a class="dropdown-item" href="list-3.html">List Style Three</a>
</li>
</ul>
</li>
<li class="dropdown-submenu">
<a class="dropdown-item dropdown-toggle" href="#">Listing Map</a>
<ul class="dropdown-menu">
<li><a class="dropdown-item" href="grid-map.html">Grid Map</a></li>
<li><a class="dropdown-item" href="list-map.html">List Map</a></li>
<li><a class="dropdown-item" href="classical-map.html">Classical Map</a>
</li>
</ul>
</li>
<li><a class="dropdown-item" href="listing-search.html">Listing Search</a></li>
<li><a class="dropdown-item" href="listing-category.html">Listing Category</a></li>
</ul>
</li>
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Property</a>
<ul class="dropdown-menu fade-down">
<li><a class="dropdown-item" href="property-single.html">Property Single One</a>
</li>
<li><a class="dropdown-item" href="property-single-2.html">Property Single Two</a>
</li>
<li><a class="dropdown-item" href="compare.html">Compare Property</a></li>
<li><a class="dropdown-item" href="booking-property.html">Booking Property</a></li>
<li><a class="dropdown-item" href="checkout-property.html">Checkout Property</a>
</li>
<li><a class="dropdown-item" href="booking-confirm.html">Booking Confirm</a></li>
<li><a class="dropdown-item" href="add-property.html">Add Property</a></li>
</ul>
</li>
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Pages</a>
<ul class="dropdown-menu fade-down">
<li><a class="dropdown-item" href="about.html">About Us</a></li>
<li class="dropdown-submenu">
<a class="dropdown-item dropdown-toggle" href="#">My Account</a>
<ul class="dropdown-menu">
<li><a class="dropdown-item" href="login.html">Login</a></li>
<li><a class="dropdown-item" href="register.html">Register</a></li>
<li><a class="dropdown-item" href="forgot-password.html">Forgot Password</a>
<li><a class="dropdown-item" href="dashboard.html">Dashboard</a>
<li><a class="dropdown-item" href="profile.html">My Profile</a>
<li><a class="dropdown-item" href="profile-property.html">My Property</a>
<li><a class="dropdown-item" href="add-property.html">Add Property</a>
<li><a class="dropdown-item" href="profile-favorite.html">My Favorite</a>
<li><a class="dropdown-item" href="profile-message.html">Messages</a>
<li><a class="dropdown-item" href="profile-save-search.html">Save Search</a>
<li><a class="dropdown-item" href="profile-setting.html">Profile
Settings</a>
</li>
</ul>
</li>
<li class="dropdown-submenu">
<a class="dropdown-item dropdown-toggle" href="#">Agent</a>
<ul class="dropdown-menu">
<li><a class="dropdown-item" href="agent.html">Agent One</a></li>
<li><a class="dropdown-item" href="agent-2.html">Agent Two</a></li>
<li><a class="dropdown-item" href="agent-single.html">Agent Single</a></li>
</ul>
</li>
<li class="dropdown-submenu">
<a class="dropdown-item dropdown-toggle" href="#">Services</a>
<ul class="dropdown-menu">
<li><a class="dropdown-item" href="service.html">Services</a></li>
<li><a class="dropdown-item" href="service-single.html">Service Single</a>
</li>
</ul>
</li>
<li><a class="dropdown-item" href="gallery.html">Gallery</a></li>
<li><a class="dropdown-item" href="pricing.html">Pricing Plan</a></li>
<li><a class="dropdown-item" href="faq.html">Faq</a></li>
<li><a class="dropdown-item" href="testimonial.html">Testimonials</a></li>
<li><a class="dropdown-item" href="404.html">404 Error</a></li>
<li><a class="dropdown-item" href="coming-soon.html">Coming Soon</a></li>
<li><a class="dropdown-item" href="terms.html">Terms Of Service</a></li>
<li><a class="dropdown-item" href="privacy.html">Privacy Policy</a></li>
</ul>
</li>
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Agency</a>
<ul class="dropdown-menu fade-down">
<li><a class="dropdown-item" href="agency.html">Agency One</a></li>
<li><a class="dropdown-item" href="agency-2.html">Agency Two</a></li>
<li><a class="dropdown-item" href="agency-single.html">Agency Single</a></li>
</ul>
</li>
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Blog</a>
<ul class="dropdown-menu fade-down">
<li><a class="dropdown-item" href="blog.html">Blog</a></li>
<li><a class="dropdown-item" href="blog-single.html">Blog Single</a></li>
</ul>
</li>
<li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
</ul>
<div class="header-nav-right">
<div class="header-account">
<div class="dropdown">
<div data-bs-toggle="dropdown" aria-expanded="false">
<img src="assets/img/account/user.jpg" alt>
</div>
<ul class="dropdown-menu dropdown-menu-end">
<li><a class="dropdown-item" href="dashboard.html"><i class="far fa-gauge-high"></i> Dashboard</a></li>
<li><a class="dropdown-item" href="profile.html"><i class="far fa-user"></i> My Profile</a></li>
<li><a class="dropdown-item" href="profile-property.html"><i class="far fa-home"></i> My Property</a></li>
<li><a class="dropdown-item" href="add-property.html"><i class="far fa-plus-circle"></i> Add Property</a></li>
<li><a class="dropdown-item" href="profile-favorite.html"><i class="far fa-heart"></i> My Favorite</a></li>
<li><a class="dropdown-item" href="profile-message.html"><i class="far fa-envelope"></i> Messages <span class="badge bg-danger">02</span></a></li>
<li><a class="dropdown-item" href="profile-save-search.html"><i class="far fa-bookmark"></i> Save Search</a></li>
<li><a class="dropdown-item" href="profile-setting.html"><i class="far fa-cog"></i> Profile Settings</a></li>
<li><a class="dropdown-item" href="#"><i class="far fa-sign-out"></i> Log Out</a></li>
</ul>
</div>
</div>
</div>
</div>
</div>
</nav>
</div>
</header>

<main class="main">
<!-- #0e2e50;" -->
 
<div class="mt-5" >
<hr>
<div class="container">
<span class="site-title-tagline" style="color:#0e2e50 !important;font-size:12px;">My Balance </a> <img src="i/eye1.png" alt="" width="20px" height="auto"></span>
<!-- <li class="active">Dashboard</li> -->

<h2 class="site-title" style="font-size:42px;">₦2,412</h2>

</div>
</div>

<div class="user-profile py-120">
<div class="container">
<div class="row">

<div class="col-lg-12">
<div class="user-profile-wrapper">
<div class="row">
<div class="col-md-3 col-lg-3 col-3" >
<div class="table-property-info">
<a href="#">
<button class="btn btn-dash"><img src="i/ib.png" alt=""></button>
<h6 class="text-center">Invest</h6>
</a>
</div>
</div>
<div class="col-md-3 col-lg-3 col-3" >
<div class="table-property-info">
<a href="#">
<button class="btn btn-dash"><img src="i/ia.png" alt=""></button>
<h6 class="text-center">Withdraw</h6>
</a>
</div>
</div>
<div class="col-md-3 col-lg-3 col-3" >
<div class="table-property-info">
<a href="#">
<button class="btn btn-dash"><img src="i/id.png" alt=""></button>
<h6 class="text-center">Refer & Earn</h6>
</a>
</div>
</div>
<div class="col-md-3 col-lg-3 col-3" >
<div class="table-property-info">
<a href="#">
<button class="btn btn-dash"><img src="i/ic.jpg" alt=""></button>
<h6 class="text-center">KYC</h6>
</a>
</div>
</div>
</div>
<div class="row">
<div class="col-lg-8">
<div class="user-profile-card">
<h4 class="user-profile-card-title">Area Chart</h4>
<div class="row">
<div class="col-lg-12">
<div id="chart"></div>
</div>
</div>
</div>
</div>
<div class="col-lg-4">
<div class="user-profile-card">
<h4 class="user-profile-card-title">Notifications</h4>
<div class="user-notification">
<div class="user-notification-item">
<a href="#">
<div class="user-notification-icon">
<i class="far fa-home"></i>
</div>
<div class="user-notification-info">
<p>Your Listing <b>Modern House</b> Has Been Approved!</p>
<span>just now</span>
</div>
</a>
</div>
<div class="user-notification-item">
<a href="#">
<div class="user-notification-icon">
<i class="far fa-envelope"></i>
</div>
<div class="user-notification-info">
<p>Your Listing <b>Modern House</b> Has Been Approved!</p>
<span>15 min ago</span>
</div>
</a>
</div>
<div class="user-notification-item">
<a href="#">
<div class="user-notification-icon">
<i class="far fa-heart"></i>
</div>
<div class="user-notification-info">
<p>Your Listing <b>Modern House</b> Has Been Approved!</p>
<span>15 days ago</span>
</div>
</a>
</div>
<div class="user-notification-item">
<a href="#">
<div class="user-notification-icon">
<i class="far fa-comment"></i>
</div>
<div class="user-notification-info">
<p>Your Listing <b>Modern House</b> Has Been Approved!</p>
<span>2 months ago</span>
</div>
</a>
</div>
</div>
</div>
</div>
<div class="col-lg-12">
<div class="user-profile-card">
<h4 class="user-profile-card-title">Recent Order</h4>
<div class="table-responsive">
<table class="table table-hover text-nowrap">
<thead>
<tr>
<th>Property</th>
<th>Property ID</th>
<th>Date</th>
<th>Status</th>
<th>Price</th>
</tr>
</thead>
<tbody>
<tr>
<td>
<div class="table-property-info">
<a href="#">
<img src="assets/img/property/01.jpg" alt>
<h6>New Modern House</h6>
</a>
</div>
</td>
<td><b>#12453</b></td>
<td>Sep 21, 2022</td>
<td><span class="text-success">Paid</span></td>
<td>$20,000</td>
</tr>
<tr>
<td>
<div class="table-property-info">
<a href="#">
<img src="assets/img/property/02.jpg" alt>
<h6>New Modern House</h6>
</a>
</div>
</td>
<td><b>#12453</b></td>
<td>Sep 21, 2022</td>
<td><span class="text-success">Paid</span></td>
<td>$20,000</td>
</tr>
<tr>
<td>
<div class="table-property-info">
<a href="#">
<img src="assets/img/property/04.jpg" alt>
<h6>New Modern House</h6>
</a>
</div>
</td>
<td><b>#12453</b></td>
<td>Sep 21, 2022</td>
<td><span class="text-warning">Pending</span></td>
<td>$20,000</td>
</tr>
<tr>
<td>
<div class="table-property-info">
<a href="#">
<img src="assets/img/property/05.jpg" alt>
<h6>New Modern House</h6>
</a>
</div>
</td>
<td><b>#12453</b></td>
<td>Sep 21, 2022</td>
<td><span class="text-danger">Cancel</span></td>
<td>$20,000</td>
</tr>
<tr>
<td>
<div class="table-property-info">
<a href="#">
<img src="assets/img/property/03.jpg" alt>
<h6>New Modern House</h6>
</a>
</div>
</td>
<td><b>#12453</b></td>
<td>Sep 21, 2022</td>
<td><span class="text-success">Paid</span></td>
<td>$20,000</td>
</tr>
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

</main>

<footer class="footer-area">
<div class="footer-widget">
<div class="container">
<div class="row footer-widget-wrapper pt-100 pb-70">
<div class="col-md-6 col-lg-4">
<div class="footer-widget-box about-us">
<a href="#" class="footer-logo">
<img src="assets/img/logo/logo-light.png" alt>
</a>
<p class="mb-4">
We are many variations of passages available but the majority have suffered alteration
in some form by injected humour words believable.
</p>
<ul class="footer-contact">
<li><a href="tel:+21236547898"><i class="far fa-phone"></i>+2 123 654 7898</a></li>
<li><i class="far fa-map-marker-alt"></i>25/B Milford Road, New York</li>
<li><a href="https://live.themewild.com/cdn-cgi/l/email-protection#0861666e67486d70696578646d266b6765"><i class="far fa-envelope"></i><span class="__cf_email__" data-cfemail="127b7c747d52776a737f627e773c717d7f">[email&#160;protected]</span></a></li>
</ul>
</div>
</div>
<div class="col-md-6 col-lg-2">
<div class="footer-widget-box list">
<h4 class="footer-widget-title">Quick Links</h4>
<ul class="footer-list">
<li><a href="#"><i class="fas fa-angle-double-right"></i> About Us</a></li>
<li><a href="#"><i class="fas fa-angle-double-right"></i> FAQ's</a></li>
<li><a href="#"><i class="fas fa-angle-double-right"></i> Terms Of Service</a></li>
<li><a href="#"><i class="fas fa-angle-double-right"></i> Privacy policy</a></li>
<li><a href="#"><i class="fas fa-angle-double-right"></i> Our Team</a></li>
<li><a href="#"><i class="fas fa-angle-double-right"></i> Support</a></li>
</ul>
</div>
</div>
<div class="col-md-6 col-lg-3">
<div class="footer-widget-box list">
<h4 class="footer-widget-title">Top Category</h4>
<ul class="footer-list">
<li><a href="#"><i class="fas fa-angle-double-right"></i> Apartment</a></li>
<li><a href="#"><i class="fas fa-angle-double-right"></i> Villas</a></li>
<li><a href="#"><i class="fas fa-angle-double-right"></i> Commercial</a></li>
<li><a href="#"><i class="fas fa-angle-double-right"></i> My Houses</a></li>
<li><a href="#"><i class="fas fa-angle-double-right"></i> Offices</a></li>
<li><a href="#"><i class="fas fa-angle-double-right"></i> Garage</a></li>
</ul>
</div>
</div>
<div class="col-md-6 col-lg-3">
<div class="footer-widget-box list">
<h4 class="footer-widget-title">Newsletter</h4>
<div class="footer-newsletter">
<p>Subscribe Our Newsletter To Get Latest Update And News</p>
<div class="subscribe-form">
<form action="#">
<input type="email" class="form-control" placeholder="Your Email">
<button class="theme-btn" type="submit">
Subscribe Now <i class="far fa-paper-plane"></i>
</button>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="copyright">
<div class="container">
<div class="row">
<div class="col-md-6 align-self-center">
<p class="copyright-text">
&copy; Copyright <span id="date"></span> <a href="#"> HOMFIND </a> All Rights Reserved.
</p>
</div>
<div class="col-md-6 align-self-center">
<ul class="footer-social">
<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
<li><a href="#"><i class="fab fa-twitter"></i></a></li>
<li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
<li><a href="#"><i class="fab fa-youtube"></i></a></li>
</ul>
</div>
</div>
</div>
</div>
</footer>


<a href="#" id="scroll-top"><i class="far fa-angle-up"></i></a>


<script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/modernizr.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/imagesloaded.pkgd.min.js"></script>
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<script src="assets/js/isotope.pkgd.min.js"></script>
<script src="assets/js/jquery.appear.min.js"></script>
<script src="assets/js/jquery.easing.min.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/counter-up.js"></script>
<script src="assets/js/masonry.pkgd.min.js"></script>
<script src="assets/js/jquery.nice-select.min.js"></script>
<script src="assets/js/jquery-ui.min.js"></script>
<script src="assets/js/wow.min.js"></script>
<script src="assets/js/apexcharts.min.js"></script>
<script src="assets/js/apexchart-custom.js"></script>
<script src="assets/js/main.js"></script>
</body>

<!-- Mirrored from live.themewild.com/homfind/dashboard.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 18 Oct 2024 23:17:27 GMT -->
</html>