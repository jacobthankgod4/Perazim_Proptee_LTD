<?php

// Use environment variable for Paystack key; avoid hardcoded keys in repo.
error_reporting(E_ALL);
ini_set('display_errors', getenv('APP_DEBUG') ? 1 : 0);
ini_set('display_startup_errors', getenv('APP_DEBUG') ? 1 : 0);


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout'])) {
  
require 'vendor/autoload.php';

$email=$_POST['email'];

// Require PAYSTACK_SECRET to be set in environment for production.
$paystack_key = getenv('PAYSTACK_SECRET');
if (empty($paystack_key)) {
  die('PAYSTACK_SECRET not configured. Set environment variable.');
}
$paystack = new Yabacon\Paystack($paystack_key);

$transaction = $paystack->transaction->initialize([
  'amount' => 100 *100,
  'email' => $email,
   'split_code' => "SPL_8mPKZodPGH",
  'callback_url' => 'https://perazimpropteeltd.com/payment_verification.php'
]);

header('Location: ' .$transaction->data->authorization_url);


}

