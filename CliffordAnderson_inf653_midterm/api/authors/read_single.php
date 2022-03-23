<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  
  include_once '../../config/Database.php';
  include_once '../../models/Author.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $post = new Author($db);

  // Get ID
  $post->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get post

  $post->read_single();

  // Create array
  $post_arr = array(
      'id' => $post->id,
      'author' => $post->author,
  );

  //print_r(json_encode($post_arr));

if($post->read_single()){
    echo json_encode(
      ($post_arr)
    );
} else {
      echo json_encode(
          array('message' => 'authorId Not Found')
      );
  }
