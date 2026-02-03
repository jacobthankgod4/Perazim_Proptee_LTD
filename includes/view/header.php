<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// include escape helper
require_once __DIR__ . '/../helpers/escape.php';
// Generate a CSRF token per session if not present
if (empty($_SESSION['csrf_token'])) {
    try {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    } catch (Exception $e) {
        $_SESSION['csrf_token'] = bin2hex(openssl_random_pseudo_bytes(32));
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">
<meta name="description" content>
<meta name="keywords" content>

<title>
    <?php if (isset($page_title)) {
        echo escape($page_title);
    } else {
        echo escape('Peravest - Home Page');
    } ?>
</title>

<script src="JavaScript/sweetalert2/dist/sweetalert2.all.min.js"></script>

<script src="assets/js/csrf_helper.js"></script>

<link rel="stylesheet" href="JavaScript/sweetalert2/dist/sweetalert2.min.css">

<link rel="stylesheet" href="css/animate.css/animate.css">

<link rel="icon" type="image/x-icon" href="assets/img/logo/icon.png">
<link rel="stylesheet" href="progress-bar-counter/animated-counter-prograssbar.css" />
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

    .disp2{
        display: none;
    }
    .responsive-text1 {
  font-size: 1.2vw; /* Text will be 5% of viewport width */
}
    .dflex2{
        display: flex;
            justify-content: space-between;
            align-items: center; /* Optional: Aligns items vertically */
            width: 100%;                   
    }
    .m{
        margin-left: 10px;
    }
    body {
            transition: background 0.3s ease-in-out;
        }
        .image-c {
            position: relative;
            cursor: pointer;
            margin: 10px;
        }

        .image-c img {
            width: 100px;
            height: 100px;
            border-radius: 10px;
            transition: border 0.3s ease-in-out;
        }

        /* Green Border When Selected */
        .selected {
            border: 5px solid #28a745 !important;
            position: relative;
            border-radius: 15px;
        }

        /* Check Icon */
        .check-icon {
            position: absolute;
            top: -5px;
            right: -5px;
            width: 24px;
            height: 24px;
            background: green;
            color: white;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            border-radius: 50%;
            display: none;
        }

        .selected .check-icon {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Invisible Radio Button */
        .hidden-radio {
            display: none;
        }

        /* Join Target Button (Fixed at Bottom) */
        .join-btn-container {
            position: absolute;
            bottom: 10px;
            left: 0;
            width: 100%;
            text-align: center;
        }


        /* Button to trigger modal1 */
        .open-modal1-btn {                                                    
            
        }

        /* Modal1 Overlay */
        .modal1-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
            z-index: 12;
        }

        /* Modal1 Container */
        .modal1 {
            position: fixed;
            bottom: -70%;
            left: 0;
            width: 100%;
            height: 70vh; /* 70% of the viewport height */
            color: #fff !important;
            background: #0e2e50;
            border-top-left-radius: 45px;
            border-top-right-radius: 45px;
            overflow: hidden; /* Prevent overflowing */
            transform: translateY(0);
            transition: bottom 0.4s ease-in-out;
            z-index: 13;
            transform: translateY(100%); /* Hide modal initially */
    
        }

        /* Modal Content: Enable scrolling */
.modal-content {
    height: calc(70vh); /* Account for padding and header */
    overflow-y: auto; /* Enables vertical scrolling */
    padding: 20px;
}

/* Hide body scroll when modal is open */
body.modal-open {
    overflow: hidden;
}

/* Custom Scrollbar */
.modal-content::-webkit-scrollbar {
    width: 8px;
}

.modal-content::-webkit-scrollbar-track {
    background: #0e2e50;
    border-radius: 10px;
}

.modal-content::-webkit-scrollbar-thumb {
    background:  #fff;
    border-radius: 10px;
    transition: background 0.3s ease-in-out;
}

.modal-content::-webkit-scrollbar-thumb:hover {
    background: #ccc;
}

        /* White horizontal clip */
        .modal1::before {
            content: "";
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 5px;
            background: white;
            border-radius: 5px;
        }

        /* Close button */
        .close-modal1-btn {
            position: absolute;
            top: 15px;
            right: 20px;
            background: #0e2e50;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        /* Active states */
        .modal1-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .modal1.active {
            bottom: 0;
        }
/*  */
.toggle-container {
            display: flex;
            width: 100vw;
            height: 50px;
            border-bottom: 2px solid #ddd;
        }

        .toggle-btn {
            flex: 1;
            text-align: center;
            padding: 15px;
            font-size: 18px;
            cursor: pointer;
            transition: all 0.3s ease;
            border-bottom: 3px solid transparent;
        }

        .toggle-btn.active {
            border-bottom: 3px solid green;
            font-weight: bold;
        }
.pp{
    padding: 0px 14px;    
    border-radius: 18px;
    color: #008d6b;
    
    
}
        .content {
            display: none;
            padding: 20px;
            text-align: center;
            font-size: 20px;
            opacity: 0;
            transform: translateY(10px);
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        .content.active {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }
/*  */

    .ddd{
        width: 200px;
        height: 200px;
        object-fit: cover;
    }
    .hyt{
        max-width: 200px;
  white-space: break-word;    
    }
.d-flex1{
    display: flex;
    justify-content: space-between;
}
    .flex2{
        display: flex;
        justify-content: space-between;
        gap:10px;
    }
    .bg-n{
    background: #fff !important;
    border: 2px solid #0E2E50;    
}
.prf{
    display: flex;
    justify-content: right;
    align-items: right;
}
.bg-n2{
    background: #09c372 !important;    
}
.custom-alert {
        background-color: rgba(0, 141, 107, 0.2); /* Transparent dark green */        
        color: #008d6b; /* Light green text for contrast */
    }
.bg-n1{
    color: #0E2E50 !important;
}
.cd{
    width: 300px; /* Fixed or desired width */
  max-width: 100%; /* Responsive handling */
  height: 160px; /* Fixed or desired height */
  max-height: 100%; /* Prevents growing beyond a set height */
}
    /* Container for the image */
  .image-container {
    display: inline-block;
    width: 370px; /* Fixed container width */
    height: 210px; /* Fixed container height */
  }
 /* Image Styling */
 .fixed-image {
    width: 100%; /* Stretch to fit container width */
    height: 100% !important; /* Stretch to fit container height */
    object-fit: cover; /* Maintain aspect ratio while filling the box */
    object-position: center; /* Center the image if cropped */
  }
.mpt{
    display: flex;
    align-items: left;
    gap: 23px;
}
  .round-image {
    width: 30vw;  /* Responsive width (adjust as needed) */
    height: 30vw; /* Keep height equal to width */
    max-width: 90px; /* Prevent it from getting too large */
    max-height: 90px;
    border-radius: 50%;
    object-fit: cover;
    display: block;
    margin: auto; /* Center alignment */
  }
  .round-image1 {
    width: 20vw;  /* Responsive width (adjust as needed) */
    height: 20vw; /* Keep height equal to width */
    max-width: 90px; /* Prevent it from getting too large */
    max-height: 90px;
    border-radius: 50%;
    object-fit: cover;
    display: block;
    margin: auto; /* Center alignment */
  }

  @media (max-width: 1024px) {
    .image-container {
      width: 29vw; /* Take full width on mobile */
      height: 19vw;
      /* aspect-ratio: 4 / 5; */
    }
  }
  @media (max-width: 820px) {    
    .image-container {
      width: 26vw; /* Take full width on mobile */
      height: 31vw;
      /* aspect-ratio: 4 / 5; */
    }
  }
  @media (max-width: 768px) {    
    .image-container {
      width: 28vw; /* Take full width on mobile */
      height: 36vw;
      /* aspect-ratio: 4 / 5; */
    }
  }
  @media (max-width: 567px) {    
    .image-container2 {
      width: 100%; /* Take full width on mobile */
      height: 44vw;
      /* aspect-ratio: 4 / 5; */
    }
  }
  @media (max-width: 412px) {    
    /* .image-container {
      width: 29vw; 
      height: 49vw;      
    } */
  }
   /* Responsive for mobile */
   @media (max-width: 1023px) {
    .disp1{
        display: none;
    }
    .disp2{
        display: flex;
    }
}
   /* Responsive for mobile */
   @media (max-width: 567px) {

.responsive-text2 {
  font-size: 12px !important; /* Text will be 5% of viewport width */
}
}
   @media (max-width: 1024px) {    
    .responsive-text1 {
  font-size: 12px; /* Text will be 5% of viewport width */
}

    .image-container1 {
        position: absolute;
      width: 200px; /* Take full width on mobile */
      height: 200px;
      
    }
  }

/* Button styles */
.responsive-btn {
    width: 100%;  
  font-size: 16px;
  text-align: center;
}

/* Responsive design for smaller screens */
@media (max-width: 768px) {
  .responsive-btn {
    font-size: 10px;    
  }
  .mobile-break {
    display: block; /* Forces a new line */
  }
}


.agin1{
    margin-top: 34px;    
}

.agin10{
    margin-top: 14px;    
}
    .df1{
        display: flex;
        align-items: flex-end;
        justify-content: right;   
        margin-bottom: 8.7
        px;     
    }
    .image-c {
    position: relative;
    display: inline-block; /* Keeps the container size based on the image */
}
.top-right-btn {
    position: absolute;
    top: 10px;  /* Distance from the top */
    right: 10px; /* Distance from the right */
    padding: 4px 7px;
    border-radius: 15px;
    cursor: pointer;
    font-size: 13px;
}
    .spc{
        display: flex;        
        gap:145px;
    }
    .imago1{
        margin: 2px;
        border-radius: 6px;
    }
    .imago11{
        width: 200px; /* Fixed width */
    height: 200px; /* Fixed height */
    object-fit: cover; /* Ensures the image fills the space without distortion */
    display: block;
        border-radius: 10px;
    }
    .spc-1{
        margin-right: 10px;
    }
    .txt{
        font-size: 15px;
    }
    .imago12{
        width: 100px; /* Fixed width */
    height: 100px; /* Fixed height */
    object-fit: cover; /* Ensures the image fills the space without distortion */
    display: block;
        border-radius: 10px;
    }

    .flt1{
        position: absolute;
        right: 10 !important;        
        bottom: 10 !important;
    }

.wr {
width: 200px;
      padding: 10px;
      word-wrap: break-word;
      overflow-wrap: break-word;
      white-space: normal;
}

    .wt001{
        width: 100%;
    }
    .mt001{
        
    }
    .mt002{
        display: none;
    }

    .mt004{
        display: flex ;
        align-items: center;
        justify-content: center;
        padding-right: 0px;
        padding-left: 10px;

    }
            .button-row {
            display: flex;
            gap: 16px;        
            overflow-x: auto;
            scroll-behavior: smooth;
            scrollbar-width: none; /* Hide scrollbar in Firefox */
        }


        .button-row::-webkit-scrollbar {
            display: none; /* Hide scrollbar in Chrome, Safari, and Edge */
        }

        .scroll-arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
        }

        .scroll-arrow.left {
            left: -40px;
        }
        @media (max-width: 540px) {

            .button-row {
                overflow-x: auto;
                scrollbar-width: none;
            }

            .button-row::-webkit-scrollbar {
                display: none;
            }

            .scroll-arrow {
                display: flex;
            }
        }
        @media (max-width : 912px) {
            .mt002{
                display: block;
            }
            .mt003{
                display: none;
            }
        }
        @media (min-width: 541px) {
            .scroll-arrow {
                display: none;
            }
        }
    .dash1{

        padding:0px !important;
    }
    .dash{
    width:150px !important;
    white-space:nowrap !important;
    overflow:hidden !important;
    }
    .pagin{
        margin-top: 30px;        
    }
    @media(max-width:576px){
       
            .mt001{
                margin-top: 80px;
            }    
.dash1{            
    display: flex;
    justify-content: center;
    align-items: center;
padding-left: 0px !important;
padding-right: 0px !important;
max-width: 400px !important ;
width:200px !important;
    white-space:nowrap !important;
        }

    }

    .img_list{
        width: 200px; /* Fixed width */
    height: 200px; /* Fixed height */
    object-fit: cover; /* Ensures the image fills the box and crops if needed */
    }
    .img_list1{
        width: 100%; /* Fixed width */
    height: 300px; /* Fixed height */
    object-fit: cover; /* Ensures the image fills the box and crops if needed */
    }
    @media (max-width:920px){
        .img_list{
        width: 100vw; /* Fixed width */
    height: 30vh; /* Fixed height */
    object-fit: cover; /* Ensures the image fills the box and crops if needed */
    }
}
.d-flexa{
    display: flex;        
    justify-content: space-between
}
.img-f {
  max-width: 100%;
  height: auto;
  object-fit: cover;
}
    .mag001{
        margin-top: 200px !important;
        margin-bottom: 0 !important;
    }
    .centa001{
        display: flex;
        align-items: center;
        justify-content: center;
    }

#main_nav{
    max-height: 80vh !important;
}
#form .success{
    border-color:#09c372;
}
#form .error{
    border-color:#ff3860;
}
.errorMessage{
    display: none;
}
@media (min-width:567px){
    .scratch{
        display: none;
    }
}

</style>
</head>

<body class="home-3">
    
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
            <a href="#"><i class="far fa-map-marker-alt"></i> 16,Afolabi Aina street, Off Allen Road Ikeja Lagos</a>
            </div>
            </li>
            <li>
            <!-- <div class="header-top-contact-info">
            <a href="https://live.themewild.com/cdn-cgi/l/email-protection#4920272f26092c31282439252c672a2624"><i class="far fa-envelopes"></i>
            <span class="__cf_email__" data-cfemail="bbd2d5ddd4fbdec3dad6cbd7de95d8d4d6">[email&#160;protected]</span></a>
            </div> -->
            </li>
            <li>
            <div class="header-top-contact-info">
            <a href="tel:+21236547898"><i class="far fa-phone-arrow-down-left"></i> (+234) 810 934 4800</a>
            </div>
            </li>
            </ul>
    </div>
    </div>
    <div class="header-top-right">     

    <?php if (isset($_SESSION['admin_id'])) : ?>
        <a href="app-users" class="header-top-link"><i class="far fa-arrow-right-to-bracket"></i> App Users</a>
    <?php elseif (isset($_SESSION['user_id'])) : ?>
        <a href="my-investments" class="header-top-link"><i class="far fa-arrow-right-to-bracket"></i> Dashborad</a>
    <?php else: ?>
        <a href="login" class="header-top-link"><i class="far fa-arrow-right-to-bracket"></i> Login</a>
        <a href="register" class="header-top-link"><i class="far fa-user-tie"></i> Register</a>        
    <?php endif; ?>

        

    <div class="header-top-social">
    <a href="https://facebook.com/Perazim Proptee limited"><i class="fab fa-facebook-f"></i></a>
    <!-- <a href="#"><i class="fab fa-twitter"></i></a> -->
    <a href="https://www.instagram.com/Perazim_proptee"><i class="fab fa-instagram"></i></a>
    <!-- <a href="#"><i class="fab fa-linkedin-in"></i></a> -->
    </div>
    </div>
    
    </div>
    </div>
    </div>
    <div class="main-navigation">
    <nav class="navbar navbar-expand-lg">
    <div class="container">
    <a class="navbar-brand" href="home">
        <img src="assets/img/logo/logo_a.png" class="img-f" alt="logo" width="10px" height="10px">
    </a>
    <?php if (isset($_SESSION['admin_id'])) : ?>    
        <div class="mobile-menu-right">
            <div class="header-account">
            <div class="dropdown">
            <div data-bs-toggle="dropdown" aria-expanded="false">
            <img src="assets/img/profile.webp" alt>
            <i class="fa fa-caret-down" aria-hidden="true"></i>
            </div>
            <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="app-users"><i class="far fa-user"></i> App Users</a></li>
            <?php
            if ($_SESSION['email']=="jacobthankgod4@gmail.com") : ?>
                <li><a class="dropdown-item" href="maintenance-fee"><i class="far fa-dollar"></i> Maintenance Fee</a></li>
            
            <?php    endif;
            
            ?>
            
            <!-- <li><a class="dropdown-item" href="profile-property.html"><i class="far fa-home"></i> My Property</a></li> -->
            <li><a class="dropdown-item" href="property"><i class="far fa-plus-circle"></i> Property</a></li>
            <li><a class="dropdown-item" href="#"><i class="far fa-plus-circle"></i> Blog</a></li>
            <li><a class="dropdown-item" href="subscribers"><i class="far fa--thumbs-up"></i> Subscribers <span class="badge bg-danger">02</span></a></li>
            <li><a class="dropdown-item" href="#"><i class="far fa-bookmark"></i> Messages</a></li>
            <!-- <li><a class="dropdown-item" href="profile-setting.html"><i class="far fa-cog"></i> Profile Settings</a></li> -->
            <li><a class="dropdown-item" href="logout"><i class="far fa-sign-out"></i> Log Out</a></li>
            </ul>
            </div>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-btn-icon"><i class="far fa-bars"></i></span>
            </button>
        </div>
    <?php else: ?>
        <div class="mobile-menu-right">
        <div class="header-account">
            <div class="">
                <a href="listings" class="theme-btn mt-2"><span class="far fa-plus-circle"></span>Invest
                Now</a>
                </div>        
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-btn-icon"><i class="far fa-bars"></i></span>
        </button>
        </div>
    <?php endif; ?>


    <div class="collapse navbar-collapse" id="main_nav">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
            <a class="nav-link switch" href="home" >Home</a>
            </li>

            <li class="nav-item"><a class="nav-link switch" href="about">About</a></li>
            
            <li class="nav-item"><a class="nav-link switch" href="listings">Listings</a></li>
            
            <li class="nav-item"><a class="nav-link switch" href="faq">Faq</a></li>
            
            <li class="nav-item"><a class="nav-link switch" href="contact">Contact</a></li>   

            <?php if (isset($_SESSION['admin_id'])) : ?>       
                
                

            <?php elseif (isset($_SESSION['user_id'])) : ?>

                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Dashboard</a>
                <ul class="dropdown-menu fade-down">
                <li><a class="dropdown-item" href="my-investments">My Investments</a></li>
                <li><a class="dropdown-item" href="profile">Profile</a></li>
                <li><a class="dropdown-item" href="edit-password">Edit Password</a></li>   
                               
                <li><a class="dropdown-item" href="logout">Logout</a></li>
                </ul>
                </li>

                <li class="nav-item scratch"><a class="nav-link switch" href="logout">Logout</a></li>

            <?php else: ?>

                <li class="nav-item scratch"><a class="nav-link switch" href="login">Login</a></li>

                <li class="nav-item scratch"><a class="nav-link switch" href="register">Sign Up</a></li>

    <?php endif; ?>
        

            <!-- <li class="nav-item scratch"><a class="nav-link switch" href="">Dashboard</a></li>

            <li class="nav-item scratch"><a class="nav-link switch" href="">Dashboard</a></li>             -->            
            
            
            <!-- <li class="nav-item scratch"><a href="add-property.html" class="theme-btn mt-2"><span class="far fa-plus-circle"></span>Invest
                Now</a></li> -->
        </ul>  
        <?php if (isset($_SESSION['admin_id'])) : ?>    
        <div class="header-nav-right">
        <div class="header-account">
        <div class="dropdown">
        <div data-bs-toggle="dropdown" aria-expanded="false">
        <img src="assets/img/profile.webp" alt>
        <i class="fa fa-caret-down" aria-hidden="true"></i>
        </div>
        <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="app-users"><i class="far fa-user"></i> App Users</a></li>
            <?php
            if ($_SESSION['email']=="jacobthankgod4@gmail.com") : ?>
                <li><a class="dropdown-item" href="maintenance-fee"><i class="far fa-dollar"></i> Maintenance Fee</a></li>
            
            <?php    endif;
            
            ?>
            <!-- <li><a class="dropdown-item" href="profile-property.html"><i class="far fa-home"></i> My Property</a></li> -->
            <li><a class="dropdown-item" href="property"><i class="far fa-plus-circle"></i> Property</a></li>
            <li><a class="dropdown-item" href="#"><i class="far fa-heart"></i> Blog</a></li>
            <li><a class="dropdown-item" href="subscribers"><i class="far fa-thumbs-up"></i> Subscribers</a></li>
            <li><a class="dropdown-item" href="#"><i class="far fa-envelope"></i> Messages</a></li>
            <!-- <li><a class="dropdown-item" href="profile-setting.html"><i class="far fa-cog"></i> Profile Settings</a></li> -->
            <li><a class="dropdown-item" href="logout"><i class="far fa-sign-out"></i> Log Out</a></li>
            </ul>
        </div>
        </div>
        </div>
    <?php else: ?>
        <div class="header-nav-right">
        <div class="header-account">
            <div class="header-btn">
                <a href="listings" class="theme-btn mt-2"><span class="far fa-plus-circle"></span>Invest
                Now</a>
                </div>
        </div>
        </div>
    <?php endif; ?>

    </div>
    </div>
    </nav>
    </div>
    </header>
