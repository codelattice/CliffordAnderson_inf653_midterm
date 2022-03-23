<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  
  include_once '../../config/Database.php';
  include_once '../../models/Quote.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $post = new Quote($db);

  // Get ID
  /*if isset*/$post->id = isset($_GET['id']) ? $_GET['id'] : die();
  $post->quote = isset($_GET['quote']) ? $_GET['quote'] : die();
  $post->authorId = isset($_GET['authorId']) ? $_GET['authorId'] : die();
  $post->categoryId = isset($_GET['categoryId']) ? $_GET['categoryId'] : die();


  // Get post

  $post->read_single();

  // Create array
  $post_arr = array(
      'id' => $post->id,
      'quote' => $post->quote,
      'authorId' => $post->authorId,
      'categoryId' => $post->categoryId
  );

  //Make JSON
if($post->read_single()){
/*echo json_encode(
      array('id' => $post->id, 'category' => $post->category)
    );*/
  print_r(json_encode($post_arr));
} else {
      echo json_encode(
          array('message' => 'No Quotes Found')
      );
  }
