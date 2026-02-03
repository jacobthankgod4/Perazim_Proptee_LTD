<?php

$page_title = 'Login Page ';

include 'Administration/config.inc.php';

include "Administration/mysql.inc.php";

redirect_invalid_user();

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

function createTransferRecipient($accountNumber, $bankCode) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.paystack.co/transferrecipient");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        'type' => 'nuban',        
        'account_number' => $accountNumber,
        'bank_code' => $bankCode,
        'currency' => 'NGN'
    ]));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer sk_test_3e81d65ae295b55b354b6e799c63901470b4f897"
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}

$bank=$_SESSION['bank'];

$account=$_SESSION['account'];

// Decode the JSON response into an associative array
$dataArray1 = createTransferRecipient("$account","$bank");

// Check if the "recipient_code" exists in the "data" key
if (isset($dataArray1['data']['recipient_code'])) {
    $valid="yes";
} else {
    $valid="no";
}



include "includes/view/header.php";

include "includes/user/profile.php";

include "includes/view/footer.php";