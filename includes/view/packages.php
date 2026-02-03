<main class="main">

<div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/01.jpg)">
<div class="container">
<h2 class="breadcrumb-title">Investment Packages</h2>
<ul class="breadcrumb-menu">
<li><a href="index.html">Home</a></li>
<li class="active">Investment Packages</li>
</ul>
</div>
</div>

<div class="property-listing  py-120">
<div class="container">
<div class="row">        
<div class="col-lg-12">
<div class="col-md-12">
<div class="property-sort">
<h5>Showing 1-10 of 50 Results</h5>
<div class="col-md-3 property-sort-box">
<select class="select">
<option value="1">₦5,000 to ₦100,000</option>
<option value="1">₦100,000 to ₦1,000,000</option>
<option value="1">₦1,000,000 to ₦10,000,000</option>        
</select>
</div>
</div>
</div>
<div class="row listing-list">
<?php while($countDown < $count_fetch_proptee) : ?>
<div class="col-md-6 col-lg-12">
<div class="listing-item">
<div class="listing-img">
<img src="includes/admin/<?=$fetch_array_images[$countDown][0] ?>" alt>
<span class="listing-badge" id="output<?=$countDown?>"><?=$fetch_array_interest[$countDown]; ?>%</span>
</div>
<div class="listing-content">
<h4 class="listing-title"><a href="#"><?=$fetch_array_title[$countDown]; ?></a></h4>
<p class="listing-sub-title"><i class="far fa-location-dot"></i><?=$fetch_array_address[$countDown]; ?></p>
<div class="listing-price">
<div class="listing-price-info">
    <h6 class="listing-price-amount" >₦<?=$fetch_array_share_cost[$countDown]; ?></h6>
    <span class="listing-price-title">Cost of Share</span>
</div>
<div class=" ">
  <form action="invest-now" method="post">
    <div class="form-group ">
    <label for="" class="listing-price-amount">invest for :</label>
    <br>
    <input type="hidden" id="cost<?=$countDown?>" value="<?=$fetch_array_share_cost[$countDown]; ?>">
    <select name="period" class="form-control options" id="drop<?=$countDown?>">    
      <option value="6">6 months</option>
      <option value="12">1 Year</option>
      <option value="24">2 Years</option>
      <option value="60">5 Years</option>
    </select>
    </div>
<br>
    <input type="hidden" name="identity" value="<?=$fetch_array_id[$countDown]; ?>">
    <input type="hidden" name="title_" value="<?=$fetch_array_title[$countDown]; ?>">
    <input type="hidden" name="img_" value="<?=$fetch_array_images[$countDown][0] ?>">
    <input type="hidden" name="address_" value="<?=$fetch_array_address[$countDown]; ?>">
    <input type="hidden" name="cost_" value="<?=$fetch_array_share_cost[$countDown]; ?>">
    <input type="hidden" name="interest_" value="<?=$fetch_array_interest[$countDown]; ?>">    
    <input type="hidden" name="identity2" value="<?=$fetch_array_id_in[$countDown]; ?>">
    <button type="submit" class="listing-btn"> Invest Now</button>
  </form>    
</div>
</div>
<div class="listing-feature">
<ul class="listing-feature-list">

</ul>
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
        <div class="listing-author">             
        <h5><?=$fetch_array_no_of[$countDown]; ?> Investors</h5>
        </div>
        <h4><?=$fetch_array_current_inv[$countDown]; ?> Raised</h4>
        </div>
        
</div>
</div>
</div>
</div>
<?php     
        $countDown++;
        endwhile; 
  ?>

<div class="pagination-area">
<div aria-label="Page navigation example">
<ul class="pagination">
<li class="page-item">
<a class="page-link" href="#" aria-label="Previous">
<span aria-hidden="true"><i class="far fa-angle-double-left"></i></span>
</a>
</li>
<li class="page-item active"><a class="page-link" href="#">1</a></li>
<li class="page-item"><a class="page-link" href="#">2</a></li>
<li class="page-item"><a class="page-link" href="#">3</a></li>
<li class="page-item">
<a class="page-link" href="#" aria-label="Next">
<span aria-hidden="true"><i class="far fa-angle-double-right"></i></span>
</a>
</li>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

</main>

<script>
// Select all <select> elements
const options = document.querySelectorAll('.options'); // Use a class for multiple elements

// Individual cost and output elements

 const dropdown0 =  document.querySelector('#drop0');
 const dropdown1 =  document.querySelector('#drop1');
 const dropdown2 =  document.querySelector('#drop2');
 const dropdown3 =  document.querySelector('#drop3');
 const dropdown4 =  document.querySelector('#drop4');
 const dropdown5 =  document.querySelector('#drop5');
 const dropdown6 =  document.querySelector('#drop6');
 const dropdown7 =  document.querySelector('#drop7');


 const cost0 =  document.querySelector('#cost0');
 const cost1 =  document.querySelector('#cost1');
 const cost2 =  document.querySelector('#cost2');
 const cost3 =  document.querySelector('#cost3');
 const cost4 =  document.querySelector('#cost4');
 const cost5 =  document.querySelector('#cost5');
 const cost6 =  document.querySelector('#cost6');
 const cost7 =  document.querySelector('#cost7');
 

 const output0 =  document.querySelector('#output0');
 const output1 =  document.querySelector('#output1');
 const output2 =  document.querySelector('#output2');
 const output3 =  document.querySelector('#output3');
 const output4 =  document.querySelector('#output4');
 const output5 =  document.querySelector('#output5');
 const output6 =  document.querySelector('#output6');
 const output7=  document.querySelector('#output7');

 // Add an event listener to handle changes in the dropdown
 dropdown0.addEventListener('change', function() {
            // Update the text content of the display-text element
            console.log(dropdown0.value);

            let drop = dropdown0.value;

            if (drop==6) {
              output0.textContent='9.25%'
            }else if(drop==12){
 output0.textContent='18.5% p.a' 
            }else if(drop==24){
               output0.textContent='37%'
            }else if(drop==60){
               output0.textContent='92.5% '
            }
            
        });

        dropdown1.addEventListener('change', function() {
            // Update the text content of the display-text element
            console.log(dropdown1.value);

            let drop = dropdown1.value;

            if (drop==6) {
              output1.textContent='9.25%'
            }else if(drop==12){
 output1.textContent='18.5% p.a' 
            }else if(drop==24){
               output1.textContent='37%'
            }else if(drop==60){
               output1.textContent='92.5% '
            }
            
        });

        dropdown2.addEventListener('change', function() {
            // Update the text content of the display-text element
            console.log(dropdown2.value);

            let drop = dropdown2.value;

            if (drop==6) {
              output2.textContent='9.25%'
            }else if(drop==12){
 output2.textContent='18.5% p.a' 
            }else if(drop==24){
               output2.textContent='37%'
            }else if(drop==60){
               output2.textContent='92.5% '
            }
            
        });

        dropdown3.addEventListener('change', function() {
            // Update the text content of the display-text element
            console.log(dropdown3.value);

            let drop = dropdown3.value;

            if (drop==6) {
              output3.textContent='9.25%'
            }else if(drop==12){
 output3.textContent='18.5% p.a' 
            }else if(drop==24){
               output3.textContent='37%'
            }else if(drop==60){
               output3.textContent='92.5% '
            }
            
        });

        dropdown4.addEventListener('change', function() {
            // Update the text content of the display-text element
            console.log(dropdown4.value);

            let drop = dropdown4.value;

            if (drop==6) {
              output4.textContent='9.25%'
            }else if(drop==12){
 output4.textContent='18.5% p.a' 
            }else if(drop==24){
               output4.textContent='37%'
            }else if(drop==60){
               output4.textContent='92.5% '
            }
            
        });

        dropdown5.addEventListener('change', function() {
            // Update the text content of the display-text element
            console.log(dropdown5.value);

            let drop = dropdown5.value;

            if (drop==6) {
              output5.textContent='8.8%'
            }else if(drop==12){
 output5.textContent='16% p.a' 
            }else if(drop==24){
               output5.textContent='33%'
            }else if(drop==60){
               output5.textContent='65% '
            }
            
        });

        dropdown6.addEventListener('change', function() {
            // Update the text content of the display-text element
            console.log(dropdown6.value);

            let drop = dropdown6.value;

            if (drop==6) {
              output6.textContent='8.8%'
            }else if(drop==12){
 output6.textContent='16% p.a' 
            }else if(drop==24){
               output6.textContent='33%'
            }else if(drop==60){
               output6.textContent='65% '
            }
            
        });

        dropdown7.addEventListener('change', function() {
            // Update the text content of the display-text element
            console.log(dropdown7.value);

            let drop = dropdown7.value;

            if (drop==6) {
              output7.textContent='8.8%'
            }else if(drop==12){
 output7.textContent='16% p.a' 
            }else if(drop==24){
               output7.textContent='33%'
            }else if(drop==60){
               output7.textContent='65% '
            }
            
        });


</script>
