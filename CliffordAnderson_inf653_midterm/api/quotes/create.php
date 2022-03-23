<?php
  //Headers
  /*header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,
  Access-Control-Allow-Methods, Authorization, X-Requested-With');*/
  
  include_once '../../config/Database.php';
  include_once '../../models/Quote.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $post = new Quote($db);

  // Get raw posted data

  $data = json_decode(file_get_contents("php://input"));

  //$post->id = $data->id; commenting out for testing purposes
  $post->quote = $data->quote;
  $post->authorId = $data->authorId;
  $post->categoryId = $data->categoryId;

  //Create post
  if($post->create()){
    echo json_encode(
      array('id' => $db->lastInsertId(), 'quote' => $post->quote, 'authorId' => $post->authorId, 'categoryId' => $post->categoryId)
    );
} else {
      echo json_encode(
          array('message' => 'Post Not Created')
      );
  }
