<?php

$ide3= $_SESSION['identity2'];
$ide4= $_SESSION['user_id'];

  // Use prepared statement to check existing investment
  $q = "SELECT Id_invest FROM invest_now WHERE package_id = ? AND Usa_Id = ?";
  $stmt = mysqli_prepare($dbc, $q);
  if ($stmt) {
    $pkg = (int)$_SESSION['identity2'];
    $uid = (int)$_SESSION['user_id'];
    mysqli_stmt_bind_param($stmt, 'ii', $pkg, $uid);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $rows = $res ? mysqli_num_rows($res) : 0;
    mysqli_stmt_close($stmt);
  } else {
    $q_raw = "SELECT Id_invest FROM invest_now WHERE package_id = " . (int)$_SESSION['identity2'] . " AND Usa_Id= " . (int)$_SESSION['user_id'];
    $r = mysqli_query($dbc, $q_raw);
    $rows = mysqli_num_rows($r);
  }

             if ($rows === 0) {                


 

 $output= "success";

             }else {
                 

$output= "fail";
            ?>
<script>
    Swal.fire({
  title: "<strong>Notice!</u></strong>",
  icon: "info",
  html: `
    You have already invested in this package...Click the link below to select a different package or view your investments.
  `,
  showCloseButton: true,
  showCancelButton: true,
  focusConfirm: false,
  confirmButtonText: `
    <a href='listings' class="text-white"> Listings</a>
  `,
  confirmButtonAriaLabel: "Thumbs up, great!",
  cancelButtonText: `
    <a href='my-investments' class="text-white"> My Investments</a>
  `,
  cancelButtonAriaLabel: "Thumbs down"
});
                                  
</script>

<?php




            }
                 
