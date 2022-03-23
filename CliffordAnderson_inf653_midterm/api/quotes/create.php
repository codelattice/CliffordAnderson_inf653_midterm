<?php
  //Headers
  /*header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,
  Access-Control-Allow-Methods, Authorization, X-Requested-With');*/
  
  include_once '../../config/Database.php';
  include_once '../../models/Quotes.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Quotes object
  $quotable = new Quotes($db);

  // Get raw posted data

  $data = json_decode(file_get_contents("php://input"));

  $quotable->author = $data->author;

  //Create post
  if($quotable->create()){
    echo json_encode(
      array('id' => $db->lastInsertId(), 'category' => $quotable->author)
    );
} else {
      echo json_encode(
          array('message' => 'Post Not Created')
      );
  }
