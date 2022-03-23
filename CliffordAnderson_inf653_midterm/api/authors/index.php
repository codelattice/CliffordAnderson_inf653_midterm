<?php

include('../../config/Database.php');

$database = new Database();
$db = $database->connect();
require_once('../../models/Author.php');

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
}
else if ($method === 'GET'){
    if (isset($id) === TRUE){
        require('read_once.php');
    }
    else{
        require('read.php');
    }
}
else if ($method === 'POST'){
    require('create.php');
}
