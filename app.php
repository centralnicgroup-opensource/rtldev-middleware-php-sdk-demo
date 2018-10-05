<?php

require __DIR__ . '/vendor/autoload.php';
//as autoloading for functions is not available 
//require_once __DIR__ . '/vendor/hexonet/php-sdk/src/Connection.php';

// --- SESSIONLESS API COMMUNICATION ---
echo "--- SESSION-LESS API COMMUNICATION ----<br/>";
$cl = new \HEXONET\APIClient();
$cl->useOTESystem()//LIVE System would be used otherwise by default
   // ->setRemoteIPAddress("1.2.3.4:80"); // provide ip address used for active ip filter
   ->setCredentials("test.user", "test.passw0rd");
$r = $cl->request(array(
    "COMMAND" => "StatusAccount"
));
echo "<pre>" . htmlspecialchars(print_r($r->getHash(), true)) . "</pre>";

// --- SESSION BASED API COMMUNICATION ---
echo "--- SESSION-BASED API COMMUNICATION ----<br/>";
$cl = new \HEXONET\APIClient();
$cl->useOTESystem()//LIVE System would be used otherwise by default
   ->setCredentials("test.user", "test.passw0rd");
$r = $cl->login();
// or this line for using 2FA
// $r = $cl->login('.. here your otp code ...');
if ($r->isSuccess()){
    echo "LOGIN SUCCEEDED.<br/>";
    
    // Now reuse the created API session for further requests
    // You don't have to care about anything!
    $r = $cl->request(array(
        "COMMAND" => "StatusAccount"
    ));
    echo "<pre>" . htmlspecialchars(print_r($r->getHash(), true)) . "</pre>"; 
    
    // Perform session close and logout    
    $r = $cl->logout();
    if ($r->isSuccess()){
        echo "LOGOUT SUCCEEDED.<br/>";
    } else {
        echo "LOGOUT FAILED.<br/>";
    }
} else {
    echo "LOGIN FAILED.<br/>";
}
