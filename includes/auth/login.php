<main class="main">

<div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/01.jpg)">
<div class="container">
<h2 class="breadcrumb-title">Login</h2>
<ul class="breadcrumb-menu">
<li><a href="index.html">Home</a></li>
<li class="active">Login</li>
</ul>
</div>
</div>

<div class="login-area py-120">
<div class="container">
<div class="col-md-5 mx-auto">
<div class="login-form">
<div class="login-header">
<img src="assets/img/logo/logo_a.png" alt>
<p>Login with your peravest account</p>
<div class="alert alert-danger errDisplay" style="display:none"></div>
</div>
<form action="#" id="form"  >
<div class="form-group">
<label>Email Address</label>
<input type="email" class="form-control" name="mail" placeholder="Your Email">
<i class="far fa-envelope"></i>
</div>
<div class="form-group">
<label>Password</label>
<input type="password" id="password"  class="form-control" name="pass" placeholder="Your Password">
<i class="far fa-lock"></i>
<span class="far fa-eye-slash " id='flt' style="
      position: absolute; 
      top: 70%; 
      right: 10px; 
      transform: translateY(-50%);
      cursor: pointer;" onclick="togglePasswordVisibility()"></span>
</div>
<div class="d-flex justify-content-between mb-3">
<div class="form-check">
<input class="form-check-input" type="checkbox" value id="remember">
<label class="form-check-label" for="remember">
Remember Me
</label>
</div>
<a href="forgot-password" class="forgot-pass">Forgot Password?</a>
</div>
<div class="d-flex align-items-center">
<button type="submit" class="theme-btn loginBtn"><i class="far fa-sign-in"></i> Login</button>
</div>
</form>
<div class="login-footer">
<!-- <div class="login-divider"><span>Or</span></div>
<div class="social-login">
<a href="#" class="btn-fb"><i class="fab fa-facebook"></i> Login With Facebook</a>
<a href="#" class="btn-gl"><i class="fab fa-google"></i> Login With Google</a>
</div> -->
<p>Don't have an account? <a href="register">Register.</a></p>
</div>
</div>
</div>
</div>
</div>

</main>

<script src="assets/js/login_validator.js"></script>


<script>
  function togglePasswordVisibility() {
    const passwordField = document.getElementById('password');
    const flt = document.getElementById('flt');
    if (passwordField.type === 'password') {
      passwordField.type = 'text';
        flt.classList.remove('fa-eye-slash');
        flt.classList.add('fa-eye');
    } else {
      passwordField.type = 'password';
      flt.classList.remove('fa-eye');
      flt.classList.add('fa-eye-slash');
    }
  }
</script>
