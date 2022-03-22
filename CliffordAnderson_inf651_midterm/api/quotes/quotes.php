<?php

  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  
  include_once '../../config/Database.php';
  include_once '../../models/Quote.php';
  include_once '../../models/Category.php';
  include_once '../../models/Author.php';

  // Instantiate DB & conne/ct
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $quoteObject = new Quote($db);

  // Blog post query
  $quotation = $quoteObject->read();
  
  // Get row count
  $num = $quotation->rowCount();

  //Check if any posts
  if($num > 0){
      // Post array
      $posts_arr = array();
  
      while ($row = $quotation->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $post_item = array(
           'id' => $id,
           'quote' => $quote,
           'authorId' => $authorId,
           'categoryId' => $categoryId
           //'body' => html_entity_decode($body),
           //'author' => $author,
           //'category' => $category
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