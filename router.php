<?php
$requestUri = $_SERVER['REQUEST_URI'];

if ($requestUri == '/data.json') {
    header('Content-Type: application/json');
    include($requestUri);
    return true;
}

if ($requestUri == '/')
    $requestUri = 'webformFQW.php';

include($requestUri);
