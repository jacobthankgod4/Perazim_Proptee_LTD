<?php require_once __DIR__ . '/security_headers.php'; ?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php include "dynamic_title.php"; ?></title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;display=swap" rel="stylesheet">

    <!-- inject:css-->

    <link rel="stylesheet" href="css/plugin.min.css">

    <script src="JavaScript/sweetalert2/dist/sweetalert2.all.min.js"></script>

    <link rel="stylesheet" href="JavaScript/sweetalert2/dist/sweetalert2.min.css">


    <link rel="stylesheet" href="style.css">

    <link rel="stylesheet" href="css/animate.css/animate.css">

    <!-- endinject -->

    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon.png">
    <style>

        .d-flexer{
            display:flex;
            align-items:center !important;
            justify-content:space-between !important;
            
        }
        .clocking{
            display:none !important;
        }

        .unclocking{
            display:block !important;
        }

        .pointer{
            cursor: pointer;
        }
        .ova{
            max-width:1000px !important;
        }
        .camb__font{
            font-family:cambria !important;
        }

        #form .success{
            border-color:#09c372;
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
        .table-social tbody tr:hover{
            background-color: #fff;
        }
        *{
            font-family: Courgette;
        }
        h1,h2,h3,h4,h5,h6{
            font-family: Courgette;
        }
        .signUP-admin form .error-txt{
            font-family:cambria;
            color:#721c24;
            background:#f8d7da;
            padding:10px 11px;
            text-align:center;
            border-radius:5px;
            margin-bottom:10px;
            border:1px solid #f5c6cb;
            
        }

        .stylo{
            color: #6c757d;

            border: 2px solid #333;
        }

        .error-txt{
            font-family:cambria;
            color:#721c24;
            background:#f8d7da;
            padding:10px 11px;
            text-align:center;
            border-radius:5px;
            margin-top: 10px;
            margin-bottom:10px;
            border:1px solid #f5c6cb;
            
        }
        .error-txt1{
            font-family:cambria;
            color:#721c24;
            background:#f8d7da;
            padding:10px 11px;
            text-align:center;
            border-radius:5px;
            font-size: 20px;
            margin-top: 10px;
            margin-bottom:10px;
            border:1px solid #f5c6cb;
      
            
        }
        .magan{
            margin-bottom: 70px;
        }

        .butmag{
            margin-left: 150px;
        }
         .butmaga{
            margin-left: 365px;
        }
        .monbo{
            text-align: left;
            
        }
        .musa{
            margin-bottom: 80px;
            max-height: 1000px;
        }
        .form form .form-group i.active::before{
            content: "\f070";
        }

        .form form .form-group span.active::before{
            content: "\f070";
        }
        .stylo a{
            color: #333;
        }
        .stylo a:hover{
            color: #fff;
        }
        /* .clock__show{
            display: block;
        }
        .clock__hide{
            display: none;
        } */
        .trigad{
            display:none;
        }
        .trigas{
            display:block;
        }
        .select_fix{
            width:100px;
        }
    </style>
    
</head>

<?php

    $boot_page = basename($_SERVER['PHP_SELF']);

    if ($boot_page=="index.php"  || $boot_page=="signup.php" || $boot_page=="enrollment.login.php"  || $boot_page=="enrollment.signup.php"  ) :  ?>
        <body class="">
<?php else : ?>
        <body class="layout-light side-menu overlayScroll">
<?php endif; ?>
    




