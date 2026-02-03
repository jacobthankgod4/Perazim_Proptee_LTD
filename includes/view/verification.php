<?php

require 'vendor/autoload.php';

// Use PAYSTACK_SECRET from environment; do not keep live keys in code.
$paystack_key = getenv('PAYSTACK_SECRET');
if (empty($paystack_key)) {
    die('PAYSTACK_SECRET not configured.');
}
$paystack = new Yabacon\Paystack($paystack_key);

$reference = $_GET['reference'];

echo 'sharp';
if (empty($reference)) {
    die('Transaction reference is missing.');
}

// $transaction = $paystack->transaction->verify(['reference' => $reference]);

try {
    $transaction = $paystack->transaction->verify(['reference' => $reference]);
} catch (Exception $e) {
    die('Error: ' . $e->getMessage()); // Log or display the error
}


if ($transaction->data->status === 'success') {
    echo 'sharp1';
   $ide4= $_SESSION['user_id'];
 $ide1= $_SESSION['identity'];

 $ide2= $_SESSION['period'];
 
 $cost= $_SESSION['cost_'];

 $ide3= $_SESSION['identity2'];

    // Check if investment exists using prepared statement
    require_once __DIR__ . '/../db/pdo_pg.php';
    $pdo = getPdoPostgres();
    
    $pkg_id = (int)$ide3;
    $stmt = $pdo->prepare('SELECT "Id_invest" FROM public.invest_now WHERE "package_id" = :pkg_id');
    $stmt->execute([':pkg_id' => $pkg_id]);
    $rows = $stmt->rowCount();

    if ($rows === 0) {
        $stmt2 = $pdo->prepare('INSERT INTO public.invest_now ("Usa_Id", "period", "proptee_id", "package_id") VALUES (:usa_id, :period, :proptee_id, :package_id)');
        $usa_id = (int)$ide4;
        $period = $ide2;
        $proptee_id = (int)$ide1;
        $package_id = $pkg_id;
        $insert_ok = $stmt2->execute([
            ':usa_id' => $usa_id,
            ':period' => $period,
            ':proptee_id' => $proptee_id,
            ':package_id' => $package_id
        ]);

        if ($insert_ok && $stmt2->rowCount() > 0) {
            $output = "your investment was successful";
        } else {
            $output = "your investment was unsuccessful";
        }
    }

} else {
echo 'sharp2';
$output= "your investment was unsuccessful";
}
$cost = $_SESSION['cost_'];
// Update investment safely
$stmt3 = $pdo->prepare('UPDATE public.investment SET "current_inv" = "current_inv" + :cost WHERE "property_id" = :prop_id AND "Id_in" = :idin');
$prop_id = 7;
$idin = 1;
$stmt3->execute([
    ':cost' => $cost,
    ':prop_id' => $prop_id,
    ':idin' => $idin
]);
?>

<main class="main">

<div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/01.jpg)">
<div class="container">
<h2 class="breadcrumb-title"><?=$output ?></h2>

</div>
</div>


</main>

<script>
    						  setTimeout(function() {
							window.location.href = "my-investments"; // Redirect URL
						}, 5000);
</script>


