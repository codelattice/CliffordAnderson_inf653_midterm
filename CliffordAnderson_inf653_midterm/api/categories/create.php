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

  // Instantiate blog post object
  $categorical = new Category($db);

  $categorical->category = isset($_POST['category']) ? $_POST['category'] : die(); //changed from $_GET to $_POST

  // Get raw posted data

  $data = json_decode(file_get_contents("php://input"));

  $categorical->category = $data->category;

  //Create post
  if($categorical->create()){
    echo json_encode(
      array('id' => $db->lastInsertId(), 'category' => $categorical->category)
      //array($categorical)
    );
} else {
      echo json_encode(
          array('message' => 'Category Not Created')
      );
  }
