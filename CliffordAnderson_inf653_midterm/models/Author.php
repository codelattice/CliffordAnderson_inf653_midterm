<?php
  class Author{
      //DB stuff
      private $conn;
      private $table = 'authors';

      //Post Properties
      public $id;
      public $quote;
      public $author;
      public $category;
      //public $created_at;

      // Constructor with DB
      /*(public function __construct($db){
          $this->conn = $db;
      }*/

      //Get Posts
      public function read(){
          //Create query
          $query = 'SELECT
                authors.id as id,
                authors.author as author
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
        c.name as category_name,
        p.id,
        p.category_id,
        p.title,
        p.body,
        p.author,
        p.created_at
      FROM
        '.$this->table.' p
      LEFT JOIN
        categories c ON p.category_id = c.id
      WHERE
        p.id = ?
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
      $this->author = $row['author'];
      $this->category_id = $row['category'];
      }
      //Create Post
      public function create(){
        //Create query
        $query = 'INSERT INTO '.$this->table.'
          SET
             id = :id,
             quote = :quote,
             author = :author,
             category = :category';
          
          //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Clean data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->body = htmlspecialchars(strip_tags($this->body));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        //Bind data
        $stmt->bindParam(':id', $this->title);
        $stmt->bindParam(':quote', $this->quote);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':category', $this->category_id);

        //Execute query

        if($stmt->execute()){
          return true;
        }

        //Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
      }
  }
