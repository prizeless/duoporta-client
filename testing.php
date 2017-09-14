<?php
require_once 'vendor/autoload.php';

$request = new \Duoporta\Controllers\Request();
$result  = $request->getMMCodes();

print_r($result);