<?php
// Secure session cookie parameters
ini_set('session.use_strict_mode', 1);
$secure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443);
// Set cookie params (PHP 7.3+ supports array form)
if (PHP_VERSION_ID >= 70300) {
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'domain' => isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '',
        'secure' => $secure,
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
} else {
    session_set_cookie_params(0, '/', isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '', $secure, true);
    ini_set('session.cookie_httponly', 1);
}
session_start();

if (!defined('LIVE')) {
    DEFINE('LIVE', false);
}
// Control display of errors based on LIVE flag: hide errors in production.
if (defined('LIVE') && LIVE) {
    ini_set('display_errors', 0);
    error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
} else {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
}
DEFINE('CONTACT_EMAIL','laresh1090@gmail.com');
//DEFINE('LIVE','true');
//require('./Administration/config.inc.php');
DEFINE('BASE_URI','perazimpropteeltd.com/');
DEFINE('BASE_URL','perazimpropteeltd.com/');
DEFINE('MYSQL', BASE_URI . '/Administration/mysql.inc.php');

function my_error_handler($e_number, $e_message, $e_file, $e_line ){

    $message = "<div class='jumbotron' style='color:#333;padding-left:200px;margin-left:100px;'><pre> An error occured in script '$e_file' on line $e_line:\n $e_message \n ";

    $message .=  print_r(debug_backtrace(), 1). "\n </div>";

   //$message .= "<pre>" .print_r($e_vars, 1)."</pre>\n";

   if (!LIVE) {
       echo "<div class='alert alert-danger'>" .nl2br($message). "</pre></div>";
   }else {
       error_log($message, 1, CONTACT_EMAIL, 'FROM:aadmin@andrizle.com');

       if ($e_number != E_NOTICE) {
        echo "<div class='alert alert-danger'> A system error occured we apologoze or the inconvinience</div>";
       }
   }
return true;
}

set_error_handler('my_error_handler');

function redirect_invalid_admin($check = 'admin_id', $destination = 'home', $protocol = 'http://'){
        if (!isset($_SESSION[$check])) {
            $url = $protocol . BASE_URL . $destination;
            header("location: $url");
            exit(); 
        }
}
function redirect_invalid_user($check = 'user_id', $destination = 'home', $protocol = 'http://'){
    if (!isset($_SESSION[$check])) {
        $url = $protocol . BASE_URL . $destination;
        header("location: $url");
        exit(); 
    }
}

function type_dropdown($title){

    $type = [
        'Select'=>' ',
        'Apartment'=>'apartment',
        'Duplex'=>'duplex',
    
    ];
    
if(isset($title)){
        $valuex = $title;
    }

    if ($valuex) {
            foreach ($type as $key008 => $value008) {
            
                echo '<option value="'.$value008.'"';
                if ($valuex == $value008) {
                    echo "selected";
                }
                echo '>'.$key008.'</option>';
            }
        }else{
            foreach ($type as $key009 => $value009) {
                echo '<option value="'.$value009.'">'.$key009.'</option>';
            }
        }

}

function status_dropdown($title){

    $type = [
        'Select Status'=>' ',
        'For Investment'=>'investment',
        'For Sale'=>'sale',
        'For Shortlet'=>'shortlet',        
        'For Rent'=>'rent',        
    
    ];
    
if(isset($title)){
        $valuex = $title;
    }

    if ($valuex) {
            foreach ($type as $key008 => $value008) {
            
                echo '<option value="'.$value008.'"';
                if ($valuex == $value008) {
                    echo "selected";
                }
                echo '>'.$key008.'</option>';
            }
        }else{
            foreach ($type as $key009 => $value009) {
                echo '<option value="'.$value009.'">'.$key009.'</option>';
            }
        }

}

function bed_dropdown($title){

    $type = [
        'Select'=>' ',
        "1"=>'1',
        "2"=>'2',
        "3"=>'3',
        "4"=>'4',
        "5"=>'5',
    
    ];
    
if(isset($title)){
        $valuex = $title;
    }

    if ($valuex) {
            foreach ($type as $key008 => $value008) {
            
                echo '<option value="'.$value008.'"';
                if ($valuex == $value008) {
                    echo "selected";
                }
                echo '>'.$key008.'</option>';
            }
        }else{
            foreach ($type as $key009 => $value009) {
                echo '<option value="'.$value009.'">'.$key009.'</option>';
            }
        }

}

function bath_dropdown($title){

    $type = [
        'Select'=>' ',
        "1"=>'1',
        "2"=>'2',
        "3"=>'3',
        "4"=>'4',
        "5"=>'5',
    
    ];
    
if(isset($title)){
        $valuex = $title;
    }

    if ($valuex) {
            foreach ($type as $key008 => $value008) {
            
                echo '<option value="'.$value008.'"';
                if ($valuex == $value008) {
                    echo "selected";
                }
                echo '>'.$key008.'</option>';
            }
        }else{
            foreach ($type as $key009 => $value009) {
                echo '<option value="'.$value009.'">'.$key009.'</option>';
            }
        }

}

function box($t1,$t2){

    if (in_array($t1, $t2)) {
            echo "checked";
        }else{
            
        }

}

function bank_dropdown($title){

    $type = [
         'Select Bank'=>' ',
        "Access Bank"=>"Access Bank",
        "Citibank"=>"Citibank",
        "Ecobank Nigeria"=>"Ecobank Nigeria",
        "Fidelity Bank"=>"Fidelity Bank",
        "First Bank of Nigeria"=>"First Bank of Nigeria",
        "First City Monument Bank (FCMB)"=>"First City Monument Bank (FCMB)",
        "Globus Bank"=>"Globus Bank",
        "Guaranty Trust Bank (GTBank)"=>"Guaranty Trust Bank (GTBank)",
        "Heritage Bank"=>"Heritage Bank",
        "Keystone Bank"=>"Keystone Bank",
        "Parallex Bank"=>"Parallex Bank",
        "Polaris Bank"=>"Polaris Bank",
        "Providus Bank"=>"Providus Bank",
        "Stanbic IBTC Bank"=>"Stanbic IBTC Bank",
        "Standard Chartered Bank"=>"Standard Chartered Bank",
        "Sterling Bank"=>"Sterling Bank",
        "SunTrust Bank"=>"SunTrust Bank",
        "Union Bank of Nigeria"=>"Union Bank of Nigeria",
        "United Bank for Africa (UBA)"=>"United Bank for Africa (UBA)",
        "Unity Bank"=>"Unity Bank",
        "Wema Bank"=>"Wema Bank",
        "Zenith Bank"=>"Zenith Bank",

    
    ];
    
if(isset($title)){
        $valuex = $title;
    }

    if ($valuex) {
            foreach ($type as $key008 => $value008) {
            
                echo '<option value="'.$value008.'"';
                if ($valuex == $value008) {
                    echo "selected";
                }
                echo '>'.$key008.'</option>';
            }
        }else{
            foreach ($type as $key009 => $value009) {
                echo '<option value="'.$value009.'">'.$key009.'</option>';
            }
        }

}

function gender_dropdown($title){

    $type = [
         'Select Gender'=>' ',
         "Male"=>"male",
         "Female"=>"female",

    
    ];
    
if(isset($title)){
        $valuex = $title;
    }

    if ($valuex) {
            foreach ($type as $key008 => $value008) {
            
                echo '<option value="'.$value008.'"';
                if ($valuex == $value008) {
                    echo "selected";
                }
                echo '>'.$key008.'</option>';
            }
        }else{
            foreach ($type as $key009 => $value009) {
                echo '<option value="'.$value009.'">'.$key009.'</option>';
            }
        }

}

function vat_calc($title1){

    $calculate_=(2.5/100)*$title1;

    return $calculate_;
    

}


function form_error_report($pst_name,  $errors =
array()){

    if (array_key_exists($pst_name, $errors)) {
        echo '
       
            <div class="alert alert-danger">' .$errors[$pst_name].'</div>';
    }
    else{
        echo '';
    }
}
function addMonthsToDate($dateString, $monthsToAdd) {
    $date = new DateTime($dateString); // Convert string to DateTime
    $date->modify("+$monthsToAdd months"); // Add variable months
    return $date->format("d-m-y"); // Return formatted date
}

function remaining_days_percentage($start_date, $end_date, $current_date) {
    /**
     * Calculate the percentage of remaining days to the end date.
     *
     * @param string $start_date Start date in 'DD-MM-YY' format
     * @param string $end_date End date in 'DD-MM-YY' format
     * @param string $current_date Current date in 'DD-MM-YY' format
     * @return float Percentage of remaining days
     */
    
    // Convert from 'd-m-y' to 'Y-m-d' format for strtotime()
    $start_date = DateTime::createFromFormat('d-m-y', $start_date)->format('Y-m-d');
    $end_date = DateTime::createFromFormat('d-m-y', $end_date)->format('Y-m-d');
    $current_date = DateTime::createFromFormat('d-m-y', $current_date)->format('Y-m-d');

    // Convert to timestamps
    $start = strtotime($start_date);
    $end = strtotime($end_date);
    $current = strtotime($current_date);
    
    if ($current < $start) {
        return 100.0; // If current date is before start, 100% remains
    }
    if ($current >= $end) {
        return 0.0; // If current date is on or after end, 0% remains
    }
    
    $total_days = ($end - $start) / 86400;
    $remaining_days = ($end - $current) / 86400;
    
    return ($remaining_days / $total_days) * 100;
}