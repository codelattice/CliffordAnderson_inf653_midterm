<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  
  include_once '../../config/Database.php';
  include_once '../../models/Quote.php';

  if (isset(id)){
    require 'read_single.php';
  }

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $post = new Quote($db);

  // Blog post query
  $result = $post->read();
  
  // Get row count
  $num = $result->rowCount();

  //Check if any posts
  if($num > 0){
      // Post array
      $posts_arr = array();
    
      while ($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $post_item = array(
           'id' => $id,
           'quote' => $quote,
           'author' => $author,
           'category' => $category
        );

        // Push to "data"

        array_push($posts_arr, $post_item);
    }
    
    echo json_encode($posts_arr);

}else{

    // No Posts

    echo json_encode(
        array('message' => 'No Posts Found')
    );

  }
