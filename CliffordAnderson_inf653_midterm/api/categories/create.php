<?php
  //Headers
  /*header('Access-Control-Allow-Origin: *'); REMOVING FOR TEST PURPOSES
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
  $post = new Category($db);

  $post->category = isset($_GET['category']) ? $_GET['category'] : die();

  // Get raw posted data

  $data = json_decode(file_get_contents("php://input"));

  $post->category = $data->category;

  //Create post
  if($post->create()){
    return json_encode(
      //array('message' => 'Post Created')
      array('id' => $db->lastInsertId(), 'category' => $post->category)
    );
} else {
      echo json_encode(
          array('message' => 'Post Not Created')
      );
  }
