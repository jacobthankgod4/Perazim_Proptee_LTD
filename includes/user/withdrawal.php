<?php
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
    $paystack_key = getenv('PAYSTACK_SECRET');
    if (empty($paystack_key)) {
        throw new Exception('PAYSTACK_SECRET environment variable not set');
    }
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer {$paystack_key}"
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}

$bank=$_SESSION['bank'];

$account=$_SESSION['account'];

$wProptee_id=$_POST['wProptee_id'];

$wPackage_id=$_POST['wPackage_id'];

if(!isset($_POST['with'])){
    
    $t_c=0;
    
    $amount=round($_POST['wAmount']);
    //echo $amount;
    
    // Decode the JSON response into an associative array
$dataArray1 = createTransferRecipient("$account","$bank");

// Check if the "recipient_code" exists in the "data" key
if (isset($dataArray1['data']['recipient_code'])) {
    $recipientCode = $dataArray1['data']['recipient_code'];
    $valid="yes";
} else {
    $valid="no";
}

$reason='jas';

  $url = "https://api.paystack.co/transfer";

  $fields = [
    "source" => "balance", 
    "reason" => "Calm down", 
    "amount" => $amount*100, 
    "recipient" => $recipientCode
    ];

  $fields_string = http_build_query($fields);

  //open connection
  $ch = curl_init();
  
  //set the url, number of POST vars, POST data
  curl_setopt($ch,CURLOPT_URL, $url);
  curl_setopt($ch,CURLOPT_POST, true);
  curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: Bearer {$paystack_key}",
        "Cache-Control: no-cache",
    ));
  
  //So that curl_exec returns the contents of the cURL; rather than echoing it
  curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
  
  //execute post
  $result = curl_exec($ch);
   //echo $result;
 $sda=json_decode($result, true);
  
    if (isset($sda['data']['transfer_code'])) {
    $sharp=$sda['data']['transfer_code'];
    }else{
        $sharp=0;
    }
    
//   echo $sharp;
}else{
    $amount=round($_POST['amount']);
    
    $sharp=$_POST['sharp'];
    
    $otp=$_POST['otp'];
    
    $url = "https://api.paystack.co/transfer/finalize_transfer";

  $fields = [
    "transfer_code" => $sharp, 
    "otp" => $otp
  ];

  $fields_string = http_build_query($fields);

  //open connection
  $ch = curl_init();
  
  //set the url, number of POST vars, POST data
  curl_setopt($ch,CURLOPT_URL, $url);
  curl_setopt($ch,CURLOPT_POST, true);
  curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: Bearer {$paystack_key}",
        "Cache-Control: no-cache",
    ));
  
  //So that curl_exec returns the contents of the cURL; rather than echoing it
  curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
  
  //execute post
  $result = curl_exec($ch);
  
  //echo $result;
 

// Decode JSON to PHP array
$data = json_decode($result, true); // Pass `true` to get an associative array

// Check if JSON decoding was successful
if ($data === null) {
    echo "JSON decoding failed: " . json_last_error_msg();
} else {
    // Check if the 'status' key exists
    if (isset($data['status'])) {
        // Get and display the value of 'status'
        $status = $data['status'];
        echo "Status: " . ($status ? 'true' : 'false');
        
        if($status==false){
            $suc='no';
        }else{
            
            // Delete using prepared statement to avoid SQL injection
            $q1  = "DELETE FROM `invest_now` WHERE proptee_id = ? AND package_id = ?";
            $stmt = mysqli_prepare($dbc, $q1);
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, 'ii', $wProptee_id, $wPackage_id);
                mysqli_stmt_execute($stmt);
                $suc = (mysqli_stmt_affected_rows($stmt) > 0) ? 'yes' : 'no';
                mysqli_stmt_close($stmt);
            } else {
                $suc = 'no';
            }
        }
    } else {
        echo "'status' key not found in the JSON response.";
    }
}
}




?>


<main class="main">

<div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/01.jpg)">
<div class="container">
<h2 class="breadcrumb-title">Withdrawal</h2>
<ul class="breadcrumb-menu">
<li><a href="index.html">Home</a></li>
<li class="active">WIthdrawal</li>
</ul>
</div>
</div>

<div class="login-area py-120">
<div class="container">
<div class="col-md-5 mx-auto">
<div class="login-form">
<div class="login-header">
<img src="assets/img/logo/logo_a.png" alt>
<p></p>
<?php if(!isset($_POST['with']) && $valid=='yes'){ ?>
<div class="alert alert-success mt-3 mb-3"><b>Account Number Verified,</b> input the OTP CODE you receved on your device to complete withdrwal</div>
<?php }elseif(!isset($_POST['with']) && $valid=='no'){ ?>
<div class="alert alert-danger mt-3 mb-3"><b>Invalid Account Number,</b> please go to the <a href='profile'><u>profile page</u></a> to edit account details</div>
<?php } ?>
<?php if($sharp==0){ ?>
<div class="alert alert-danger mt-3 mb-3"><b>Oops!!! Please Try Again Later</div>
<?php } ?>

<?php if(isset($_POST['with']) && $suc=='yes'){ ?>
<div class="alert alert-success mt-3 mb-3"><b>Withdrawal Successful</div>
<?php }elseif(isset($_POST['with']) && $suc=='no'){ ?>
<div class="alert alert-danger mt-3 mb-3"><b>Withdrawal Unsuccessful</b> try again later...</div>
<?php } ?>
<div class="alert alert-danger errDisplay" style="display:none"></div>
</div>
<form action="" method='post' >
    <input type="hidden" class="form-control" name="sharp" value='<?=$sharp?>'>
    
    <input type="hidden" class="form-control" name="amount" value='<?=$amount?>'>
    
    <input type='hidden' name='wProptee_id' value='<?=$wProptee_id ?>' >
    <input type='hidden' name='wPackage_id' value='<?=$wPackage_id ?>' >
<div class="form-group">
<label>Enter OTP  Code</label>
<input type="text" class="form-control" name="otp" placeholder="Your OTP">
<i class="far fa-list"></i>
</div>

<div class="d-flex align-items-center">
<button type="submit" name='with' class="theme-btn loginBtn" disabled><i class="far fa-sign-in"></i> WIthdraw</button>
</div>
</form>

</div>
</div>
</div>
</div>

</main>