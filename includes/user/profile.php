<main class="main">

<div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/01.jpg)">
<div class="container">
<h2 class="breadcrumb-title">Edit Profile</h2>
<ul class="breadcrumb-menu">
<li><a href="index.html">Home<?=$valid?></a></li>
<li class="active">Edit Profile</li>
</ul>
</div>
</div>

<div class="login-area py-120">
<div class="container">
<div class="col-md-5 mx-auto">
<div class="login-form">
<div class="login-header">
<img src="assets/img/logo/logo_a.png" alt>
<div class="alert alert-danger errMessage" style="display:none;"></div>
</div>
<form action="#" id="form" >
<div class="form-group">
<label>Full Name</label>
<input type="text" class="form-control" id="fname" name="fname" value="<?=$_SESSION['name']?>" placeholder="Your Name" >
<i class="far fa-user"></i>
<div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
</div>

<div class="form-group">
<label>Email Address</label>
<input type="email" class="form-control" id="mail"  name="mail" value="<?=$_SESSION['Email']?>"   placeholder="Your Email" >
<i class="far fa-envelope"></i>
<div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
</div>

<div class="form-group">
<label>Bank Account No</label>
<input type="number" class="form-control"  id="account"  name="account"  value="<?=$_SESSION['account']?>"  placeholder="Your Account Number" >
<i class="far fa-list-ol"></i>
<?php if($valid=='yes'){ ?>
<div class="alert alert-success mt-3 mb-3">Account Number Verified</div>
<?php }else{ ?>
<div class="alert alert-danger mt-3 mb-3">Invalid Account Number</div>
<?php } ?>
<div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
</div>

<div class="form-group">
<label>Bank Name<?=$account?></label>
<select name="bank" id="bank" class="form-select">
    <option value="">-- Select Bank --</option>
<?php 

if (isset($dataArray['data']) && is_array($dataArray['data'])) {    
    foreach ($dataArray['data'] as $bank) {
        // Use the "id" as the value and the "name" as the option text
        if($_SESSION['bank']==$bank['code']){
                        echo '<option value="' . htmlspecialchars($bank['code']) . '" selected>' . htmlspecialchars($bank['name']) . '</option>';
        }else{
            echo '<option value="' . htmlspecialchars($bank['code']) . '">' . htmlspecialchars($bank['name']) . '</option>';
        }
        
    }
    
}
?>
</select>
<div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
</div>

<div class="form-group">
<label>Age</label>
<input type="text" class="form-control"  id="age"  name="age" value="<?=$_SESSION['age']?>"   placeholder="Enter Your Age" >
<i class="far fa-list-ol"></i>
<div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
</div>

<div class="form-group">
<label>Gender</label>
<select name="gender" id="gender" class="form-select">
<?=gender_dropdown($_SESSION['gender']) ?>
</select>
<div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
</div>

<!-- <div class="form-group">
<label>Password</label>
<input type="password" class="form-control"  id="pass1"  name="pass1"  placeholder="Your Password" >
<i class="far fa-lock"></i>
<div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
</div>

<div class="form-group">
<label>Confirm Password</label>
<input type="password" class="form-control" id="pass2"  name="pass2"  placeholder="Your Password" >
<i class="far fa-lock"></i>
<div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
</div> -->

<div class="d-flex align-items-center">
<button type="submit" class="theme-btn"><i class="far fa-paper-plane"></i> Update Profile</button>
</div>
</form>

</div>
</div>
</div>
</div>
</main>

<script src="assets/js/edit_validator.js"></script>