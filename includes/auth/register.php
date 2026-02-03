

<main class="main">

<div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/01.jpg)">
<div class="container">
<h2 class="breadcrumb-title">Register</h2>
<ul class="breadcrumb-menu">
<li><a href="index.html">Home</a></li>
<li class="active">Register</li>
</ul>
</div>
</div>

<div class="login-area py-120">
<div class="container">
<div class="col-md-5 mx-auto">
<div class="login-form">
<div class="login-header">
<img src="assets/img/logo/logo_a.png" alt>
<p>Create your peravest account</p>
<div class="alert alert-danger errMessage" style="display:none;"></div>
</div>
<form action="#" id="form" >
    
<div>
<div class="form-group">
<label>Full Name</label>
<input type="text" class="form-control" id="fname" name="fname" placeholder="Your Name" >
<i class="far fa-user"></i>
</div>
<div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
</div>

<div>
<div class="form-group">
<label>Email Address</label>
<input type="email" class="form-control" id="mail"  name="mail"  placeholder="Your Email" >
<i class="far fa-envelope"></i>
</div>
<div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
</div>

<div>
<div class="form-group">
<label>Bank Account No</label>
<input type="number" class="form-control"  id="account"  name="account"  placeholder="Your Account Number" >
<i class="far fa-list-ol"></i>
</div>
<div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
</div>

<div>
<div class="form-group">
<label>Bank Name </label>
<select name="bank" id="bank" class="form-select">
<option value="">-- Select Bank --</option>
            <?php 

if (isset($dataArray['data']) && is_array($dataArray['data'])) {    
    foreach ($dataArray['data'] as $bank) {
        // Use the "id" as the value and the "name" as the option text
        echo '<option value="' . htmlspecialchars($bank['code']) . '">' . htmlspecialchars($bank['name']) . '</option>';
    }
    
}
?>
</select>
</div>
<div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
</div>
<div>
<div class="form-group">
<label>Age</label>
<input type="text" class="form-control"  id="age"  name="age"  placeholder="Enter Your Age" >
<i class="far fa-list-ol"></i>
</div>
<div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
</div>

<div>
<div class="form-group">
<label>Gender</label>
<select name="gender" id="gender" class="form-select">
            <option value="">-- Select Gender --</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
</select>
</div>
<div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
</div>

<div>
<div class="form-group">
<label>Password</label>
<input type="password" class="form-control"  id="pass1"  name="pass1"  placeholder="Your Password" >
<i class="far fa-lock"></i>
<span class="far fa-eye-slash " id='flt' style="
      position: absolute; 
      top: 70%; 
      right: 10px; 
      transform: translateY(-50%);
      cursor: pointer;" onclick="togglePasswordVisibility()"></span>

</div>
<div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
</div>
<div>
<div class="form-group">
<label>Confirm Password</label>
<input type="password" class="form-control" id="pass2"  name="pass2"  placeholder="Your Password" >
<i class="far fa-lock"></i>
<span class="far fa-eye-slash " id='flt1' style="
      position: absolute; 
      top: 70%; 
      right: 10px; 
      transform: translateY(-50%);
      cursor: pointer;" onclick="togglePasswordVisibility1()"></span>
</div>
<div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
</div>

<div class="form-check form-group">
<input class="form-check-input" type="checkbox" value id="agree">
<label class="form-check-label" for="agree">
I agree with the <a href="#">Terms Of Service.</a>
</label>
</div>
<div class="d-flex align-items-center">
<button type="submit" class="theme-btn"><i class="far fa-paper-plane"></i> Register</button>
</div>
</form>
<div class="login-footer">
<p>Already have an account? <a href="login">Login.</a></p>
</div>
</div>
</div>
</div>
</div>
</main>

<script src="assets/js/validator.js"></script>

<script>
  function togglePasswordVisibility() {
    const passwordField1 = document.getElementById('pass1');
    
    const flt = document.getElementById('flt');

    if (passwordField1.type === 'password') {
      passwordField1.type = 'text';
        flt.classList.remove('fa-eye-slash');
        flt.classList.add('fa-eye');
    } else {
      passwordField1.type = 'password';
      flt.classList.remove('fa-eye');
      flt.classList.add('fa-eye-slash');
    }
  }
  
    function togglePasswordVisibility1() {
    const passwordField2 = document.getElementById('pass2');
    
    const flt1 = document.getElementById('flt1');

    if (passwordField2.type === 'password') {
      passwordField2.type = 'text';
        flt1.classList.remove('fa-eye-slash');
        flt1.classList.add('fa-eye');
    } else {
      passwordField2.type = 'password';
      flt1.classList.remove('fa-eye');
      flt1.classList.add('fa-eye-slash');
    }
  }
</script>



