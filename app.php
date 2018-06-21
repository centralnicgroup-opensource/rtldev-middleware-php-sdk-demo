<?php

require __DIR__ . '/vendor/autoload.php';
//as autoloading for functions is not available 
//require_once __DIR__ . '/vendor/hexonet/php-sdk/src/Connection.php';

// --- SESSIONLESS API COMMUNICATION ---
$api = \HEXONET\Connection::connect(array(
    "url" => "https://coreapi.1api.net/api/call.cgi",
    "login" => "test.user",
    "password" => "test.passw0rd",
    "entity" => "1234"
));

$r = $api->call(array(
    "COMMAND" => "StatusAccount"
));
echo "<pre>" . htmlspecialchars(print_r($r->asHash(), true)) . "</pre>";

// --- SESSION BASED API COMMUNICATION ---

// TODO - this needs a review of the PHP SDK itself