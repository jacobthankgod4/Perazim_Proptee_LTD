<main class="main">

<div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/01.jpg)">
<div class="container">
<h2 class="breadcrumb-title">Subscribers</h2>
<ul class="breadcrumb-menu">
<li><a href="index.html">Home</a></li>
<li class="active">Subscribers</li>
</ul>
</div>
</div>

<div class="user-profile py-120">
<div class="container">
<div class="row">
<div class="col-lg-12">
<div class="user-profile-wrapper">
<div class="user-profile-card">
<h4 class="user-profile-card-title">View All Subscribers</h4>
<div class="col-lg-12">
<div class="table-responsive">
<table class="table table-hover text-nowrap">
<thead>
<tr>
<th>Email Address</th>

</tr>
</thead>
<tbody>
<?php 
        $countDown=0;
        while($countDown < $count_fetch_proptee) : ?>
<tr>
<td><?=$fetch_array_id[$countDown] ?></td>

</tr>
<?php     
        $countDown=$countDown+1;
        endwhile; 
        ?>
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

</main>