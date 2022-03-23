<?php
  //Headers
  /*header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,
  Access-Control-Allow-Methods, Authorization, X-Requested-With');*/
  
  include_once '../../config/Database.php';
  include_once '../../models/Author.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $post = new Author($db);

  // Get raw posted data

  $data = json_decode(file_get_contents("php://input"));

  //Create post
  if($post->delete()){
    echo json_encode(
      array('id' => $db->lastInsertId(), 'author' => $post->author)
    );
} else {
      echo json_encode(
          array('message' => 'Post Not Created')
      );
  }