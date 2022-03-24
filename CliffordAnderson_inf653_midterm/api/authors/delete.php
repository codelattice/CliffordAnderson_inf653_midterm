<?php
  //Headers
  /*header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,
  Access-Control-Allow-Methods, Authorization, X-Requested-With');*/
  
  include_once '../../models/Author.php';

  // Instantiate blog post object
  $post = new Author($db);

  // Get raw posted data

  $data = json_decode(file_get_contents("php://input"));
  
  /*if (isset($data->id)){
    $post->id = $data->id;
  }*/

  //Delete entry and return array
  if($post->delete()){
    echo json_encode(
      array('id' => $post->id)
    );
} else {
      echo json_encode(
          array('message' => 'Nothing to delete')
      );
  }
