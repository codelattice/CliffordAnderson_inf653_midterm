<?php
  class Quote{
      //DB stuff
      private $conn;
      private $table = 'quotes';

      //Post Properties
      public $id;
      public $quote;

      public $authorId;
      public $categoryId;

      //public $created_at;

      // Constructor with DB
      public function __construct($db){
          $this->conn = $db;
      }

      //Get Posts
      public function read(){
          //Create query
          $query = 'SELECT
                quotes.id as id,
                quotes.quote as quote,
                quotes.authorId as author,
                quotes.categoryId as category
              FROM
                '.$this->table.'';
          //Prepare statement
          $stmt = $this->conn->prepare($query);

          // Execute query

          $stmt->execute();

          return $stmt;
      }

      // Get single post

      public function read_single(){

        //Create query
        $query = 'SELECT
        q.id as id,
        q.quote as quote,
        q.authorId as authorId
        q.categoryId as categoryId
      FROM
        '.$this->table.' q
      WHERE
        q.id = ?
        LIMIT 0,1';
        
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(1, $this->id);

      // Execute query
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $this->title = $row['id'];
      $this->body = $row['quote'];
      $this->authorId = $row['authorId'];
      $this->categoryId = $row['categoryId'];
        
      return $stmt->rowCount();

      }
      //Create Post
      public function create(){
        //Create query
        $query = 'INSERT INTO '.$this->table.'
          SET
             quote = :quote,
             authorId = :authorId,
             categoryId = :categoryId';
          
          //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Clean data
        //$this->title = htmlspecialchars(strip_tags($this->title)); COMMENTING OUT FOR TESTING PURPOSES
        $this->quote = htmlspecialchars(strip_tags($this->quote));
        $this->authorId = htmlspecialchars(strip_tags($this->authorId));
        $this->category_id = htmlspecialchars(strip_tags($this->categoryId));

        //Bind data
        $stmt->bindParam(':quote', $this->quote);
        $stmt->bindParam(':author', $this->authorId);
        $stmt->bindParam(':category', $this->categoryId); //removed _id from the end of this->category_id//

        //Execute query

        if($stmt->execute()){
          return true;
        }

        //Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
      }
  }
