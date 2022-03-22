<?php

require_once 'read.php';
require_once 'create.php';
require_once 'read_single.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
}

$database = new Database();
$db = $database->connect();

if ($method == 'GET'){
    require_once read.php;
}
