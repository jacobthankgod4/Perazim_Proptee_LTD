<?php

$pdo = require __DIR__ . '/../../../includes/db/pdo_pg.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteP'])) {

  $ided = isset($_POST['Id']) ? (int)$_POST['Id'] : 0;
  if ($ided > 0) {
    // Delete property using prepared statement
    $stmtProp = $pdo->prepare('DELETE FROM public.property WHERE "Id" = :id');
    $stmtProp->execute([':id' => $ided]);

    // Delete associated investments
    $stmtInv = $pdo->prepare('DELETE FROM public.investment WHERE "property_id" = :id');
    $stmtInv->execute([':id' => $ided]);
  }
?>
    <script>
    Swal.fire({
                                    icon: 'success',
                                    title: 'Hurray',
                                    text: 'you have successfully completed a investment',  
                                    showClass: {
                                      popup: 'animate__animated animate__fadeInDown'
                                    },
                                    hideClass: {
                                      popup: 'animate__animated animate__fadeOutUp'
                                    }
                                  })
</script>
<?php
}

$stmt = $pdo->prepare('SELECT "Id", "Title", "Type", "Status", "Address", "City", "State", "Zip_Code", "Description", "Price", "Area", "Ammenities", "Bedroom", "Bathroom", "Built_Year", "Images", "Video" FROM public.property');
$stmt->execute();
$r51 = $stmt->fetchAll(PDO::FETCH_ASSOC);
$fetch_array_id = [];
$fetch_array_title = [];
$fetch_array_type = [];
$fetch_array_status = [];
$fetch_array_address = [];
$fetch_array_city = [];
$fetch_array_state = [];
$fetch_array_zip = [];
$fetch_array_desc = [];
$fetch_array_price = [];
$fetch_array_area = [];
$fetch_array_ammeniities = [];
$fetch_array_bed = [];
$fetch_array_bath = [];
$fetch_array_year = [];
$fetch_array_img = [];
$fetch_array_video = [];

$count_fetch_proptee=0;


foreach ($r51 as $fetch_array) {

    $fetch_array_id[$count_fetch_proptee]=$fetch_array['Id'];
    $fetch_array_title[$count_fetch_proptee]=$fetch_array['Title'];
    $fetch_array_type[$count_fetch_proptee]=$fetch_array['Type'];
    $fetch_array_status[$count_fetch_proptee]=$fetch_array['Status'];
    $fetch_array_address[$count_fetch_proptee]=$fetch_array['Address'];
    $fetch_array_city[$count_fetch_proptee]=$fetch_array['City'];
    $fetch_array_state[$count_fetch_proptee]=$fetch_array['State'];
    $fetch_array_zip[$count_fetch_proptee]=$fetch_array['Zip_Code'];
    $fetch_array_desc[$count_fetch_proptee]=$fetch_array['Description'];
    $fetch_array_price[$count_fetch_proptee]=$fetch_array['Price'];
    $fetch_array_area[$count_fetch_proptee]=$fetch_array['Area'];
    $fetch_array_ammeniities1[$count_fetch_proptee]=$fetch_array['Ammenities'];
    
    $fetch_array_ammeniities = explode(',', $fetch_array['Ammenities']);

    $fetch_array_bed[$count_fetch_proptee]=$fetch_array['Bedroom'];
    $fetch_array_bath[$count_fetch_proptee]=$fetch_array['Bathroom'];
    $fetch_array_year[$count_fetch_proptee]=$fetch_array['Built_Year'];
    // $fetch_array_img[$count_fetch_proptee]=$fetch_array['Images'];

    $fetch_array_images[$count_fetch_proptee] = explode(',', $fetch_array['Images']);

    $fetch_array_video[$count_fetch_proptee]=json_decode($fetch_array['Video']);
    $count_fetch_proptee++;
    
}


