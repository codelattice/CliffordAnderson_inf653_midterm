<?php
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  
  include_once '../../config/Database.php';
  include_once '../../models/Category.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $categorical = new Category($db);

  // Get ID
  $categorical->id = isset($_GET['id']) ? $_GET['id'] : die();

  // Get post

  $categorical->read_single();

  // Create array
  $post_arr = array(
      'id' => $categorical->id,
      'category' => $categorical->category,
  );

  //Make JSON
  //print_r(json_encode($post_arr));

if($categorical->read_single()){
    echo json_encode(
      ($post_array)
    );
} else {
      echo json_encode(
          array('message' => 'categoryId Not Found')
      );
  }
