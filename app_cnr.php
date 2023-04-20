<?php

require __DIR__ . '/vendor/autoload.php';

$user = $argv[1];
$password = $argv[2];

// --- SESSIONLESS API COMMUNICATION ---
echo "--- SESSION-LESS API COMMUNICATION ----\n";
$cl = \CNIC\ClientFactory::getClient([
    "registrar" => "CNR" // fka RRPproxy
]);
$cl->useOTESystem()//LIVE System would be used otherwise by default
   // ->setRemoteIPAddress("1.2.3.4:80"); // provide ip address used for active ip filter
   ->setCredentials($user, $password);
$r = $cl->request([
    "COMMAND" => "StatusAccount"
]);
print_r($r->getHash());

// --- SESSION BASED API COMMUNICATION ---
echo "--- SESSION-BASED API COMMUNICATION ----\n";
$cl = \CNIC\ClientFactory::getClient([
    "registrar" => "CNR" // fka RRPproxy
]);
$cl->useOTESystem()//LIVE System would be used otherwise by default
   ->setCredentials($user, $password);
$r = $cl->login();
// or this line for using 2FA
// $r = $cl->login('.. here your otp code ...');
if ($r->isSuccess()){
    echo "LOGIN SUCCEEDED.\n";
    
    // Now reuse the created API session for further requests
    // You don't have to care about anything!
    $r = $cl->request([
        "COMMAND" => "StatusAccount"
    ]);
    print_r($r->getHash()); 
    
    // Perform session close and logout    
    $r = $cl->logout();
    if ($r->isSuccess()){
        echo "LOGOUT SUCCEEDED.\n";
    } else {
        echo "LOGOUT FAILED.\n";
    }
} else {
    echo "LOGIN FAILED.\n";
    echo "NOTE: Session-based communication not yet correctly supported for RRPproxy.";
}
