<?php
  //Headers
  /*header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,
  Access-Control-Allow-Methods, Authorization, X-Requested-With');*/
  
  include_once '../../models/Quote.php';
  include_once '../../models/Author.php';
  include_once '../../models/Category.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Creates Quote object
  $quotable = new Quote($db);

  // Decodes json and reads data into a string
  $data = json_decode(file_get_contents("php://input"));

  $quote->quote = $data->quote;
  $quote->authorId = $data->authorId;
  $quote->categoryId = $data->categoryId;

  /*function isValid($id, $model) {
    $model->id = $id;
    $modelResult = $model->read_single();
    return $modelResult;
  }*/

  // if authorId exists:
  /* $authorExists = isValid($authorId, $author;
  // if categoryId exists:
  $categoryExists = isValid($categoryId, $category)
  // if quote id exists:
  $idExists = isValid($id, $quote)

  if(!$categoryIdExists){
    echo json_encode(
        array('message' => 'categoryId Not Found')
    );
  }else if(!$authorIdExists){
    echo json_encode(
        array('message' => 'authorId Not Found')
    );
  }
  else if (!quoteIdExists){
    echo json_encode(
      array('message' => 'authorId Not Found')
    );
  }*/
  $data = json_decode(file_get_contents("php://input"));

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
}
