<?php
  //Headers
  /*header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,
  Access-Control-Allow-Methods, Authorization, X-Requested-With');*/
  
  include_once '../../config/Database.php';
  include_once '../../models/Category.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate Category object
  $categorical = new Category($db);

  // Get raw posted data

  $data = json_decode(file_get_contents("php://input"));

  $categorical->author = $data->author;

  //Create post
  if($categorical->create()){
    echo json_encode(
      array('id' => $db->lastInsertId(), 'author' => $categorical->author)
    );
} else {
      echo json_encode(
          array('message' => 'Post Not Created')
      );
  }
