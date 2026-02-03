<?php

// Fetch the list of banks from Paystack
function getBanks() {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.paystack.co/bank");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer sk_test_3e81d65ae295b55b354b6e799c63901470b4f897"
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}

$dataArray = getBanks();

include "includes/view/header.php";

include "includes/auth/register.php";

include "includes/view/footer.php";