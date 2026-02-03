<main class="main">

<div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/01.jpg)">
<div class="container">
<h2 class="breadcrumb-title">Checkout Page</h2>
<ul class="breadcrumb-menu">
<li><a href="index.html">Home</a></li>
<li class="active">Checkout Page</li>
</ul>
</div>
</div>

<div class="property-checkout py-120">
<div class="container">
<div class="row" style="display:flex;align-items:center;justify-content:center;">

<div class="col-lg-4">
<div class="booking-summary">
<h4 class="mb-30">Investment Summary</h4>
<div class="booking-property-img">
<img src="includes/admin/<?=$_SESSION['img_'] ?>" alt>
</div>
<div class="booking-property-content">
<div class="booking-property-title">
<div>
<h5><?=$_SESSION['title_'] ?></h5>
<p><i class="far fa-map-marker-alt"></i> <?=$_SESSION['address_'] ?></p>
</div>
<!-- <a href="#" class="book-edit-btn"><i class="far fa-pen"></i></a> -->
</div>
<!-- <div class="booking-property-rate">
<span class="badge bg-warning"><i class="far fa-star"></i> 4.5/5</span>
<span class="rate-type">Average</span>
<span class="rate-text">(35 Reviews)</span>
</div> -->
</div>
<div class="booking-order-info">
<div class="booking-pay-info">
<h5 class="mb-3">Payment</h5>
<hr>
<ul>
<li>Investment Cost: <span>₦<?=number_format($_SESSION['cost_']) ?></span></li>
<li>VAT: <span>₦<?=number_format(vat_calc($_SESSION['cost_'])); ?></span></li>
<!-- <li><strong>Taxes:</strong> <span>$560.00</span></li> -->
<li class="order-total"><strong>You Pay:</strong> <span>₦<?php $pay=number_format($_SESSION['cost_']+vat_calc($_SESSION['cost_'])); $pay_=$_SESSION['cost_']+vat_calc($_SESSION['cost_']); echo $pay; ?></span></li>
</ul>
</div>
<form action="checkout.php" method="POST">
    <input type="hidden" id="amount" name="amount" value="<?=$pay_; ?>">
    <input type="hidden" id="Id" name="Id_checkout" value="<?=$_SESSION['user_id']; ?>">
    <input type="hidden" id="email" name="email" value="<?=$_SESSION['Email']; ?>">
<div class="text-end mt-40">
<button type="submit" href="#" name="checkout" class="theme-btn d-block">Checkout Now <i class="far fa-arrow-right"></i></button>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>

</main>
<script src="https://js.paystack.co/v2/inline.js"></script>
<script>

</script>

