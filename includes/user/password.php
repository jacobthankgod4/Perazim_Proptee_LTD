<main class="main">

<div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/01.jpg)">
<div class="container">
<h2 class="breadcrumb-title">Edit Password</h2>
<ul class="breadcrumb-menu">
<li><a href="index.html">Home</a></li>
<li class="active">Edit Password</li>
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
<label>Old Password</label>
<input type="password" class="form-control"  id="pass"  name="pass"  placeholder="Your Password" >
<i class="far fa-lock"></i>
<span class="far fa-eye-slash " id='flt0' style="
      position: absolute; 
      top: 70%; 
      right: 10px; 
      transform: translateY(-50%);
      cursor: pointer;" onclick="togglePasswordVisibility0()"></span>

<div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
</div>

<div class="form-group">
<label>New Password</label>
<input type="password" class="form-control"  id="pass1"  name="pass1"  placeholder="Your Password" >
<i class="far fa-lock"></i>
<span class="far fa-eye-slash " id='flt' style="
      position: absolute; 
      top: 70%; 
      right: 10px; 
      transform: translateY(-50%);
      cursor: pointer;" onclick="togglePasswordVisibility()"></span>
<div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
</div>

<div class="form-group">
<label>Confirm New Password</label>
<input type="password" class="form-control" id="pass2"  name="pass2"  placeholder="Your Password" >
<i class="far fa-lock"></i>
<span class="far fa-eye-slash " id='flt1' style="
      position: absolute; 
      top: 70%; 
      right: 10px; 
      transform: translateY(-50%);
      cursor: pointer;" onclick="togglePasswordVisibility1()"></span>
<div class="alert alert-danger mt-3 mb-3 errorMessage"></div>
</div>

<div class="d-flex align-items-center">
<button type="submit" class="theme-btn"><i class="far fa-paper-plane"></i> Update Password</button>
</div>
</form>

</div>
</div>
</div>
</div>
</main>

<script src="assets/js/pass_validator.js"></script>

<script>
function togglePasswordVisibility0() {
    const passwordField0 = document.getElementById('pass');
    
    const flt0 = document.getElementById('flt0');

    if (passwordField0.type === 'password') {
      passwordField0.type = 'text';
        flt0.classList.remove('fa-eye-slash');
        flt0.classList.add('fa-eye');
    } else {
      passwordField0.type = 'password';
      flt0.classList.remove('fa-eye');
      flt0.classList.add('fa-eye-slash');
    }
  }

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