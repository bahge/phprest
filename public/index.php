<?php
require __DIR__ . '/vendor/autoload.php';
use App\Controllers\httpRequest;

$request_method = $_SERVER["REQUEST_METHOD"];

$a = new httpRequest($request_method, CHECKMETHODS);
$a->verify_authentication(CREDENTIALS);