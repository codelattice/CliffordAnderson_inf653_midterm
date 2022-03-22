<?php

  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  
  include_once '../../config/Database.php';
  include_once '../../models/Category.php';

  // Instantiate DB & conne/ct
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $categorical = new Category($db);

  // Blog post query
  $return = $categorical->read();
  
  // Get row count
  $num = $return->rowCount();

  //Check if any posts
  if($num > 0){
      // Post array
      $posts_arr = array();
      $posts_arr['data'] = array();

      while ($row = $return->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $post_item = array(
           'id' => $id,
           //'quote' => $quote,
           //'body' => html_entity_decode($body),
           'category' => $category,
           //'category' => $category
        );

        // Push to "data"

        array_push($posts_arr['data'], $post_item);
    }
    
    echo json_encode($posts_arr);

}else{

    // No Posts

    echo json_encode(
        array('message' => 'No Posts Found')
    );

  }