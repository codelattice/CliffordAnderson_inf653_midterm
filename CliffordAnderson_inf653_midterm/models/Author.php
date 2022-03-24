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
      public function __construct($db){
          $this->conn = $db;
      }

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
        a.id as id,
        a.author as author
      FROM
        '.$this->table.' a
      WHERE
        a.id = ?
        LIMIT 0,1';
        
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(1, $this->id);

      // Execute query
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $this->id = $row['id'];
      $this->author = $row['author'];
        
      return $stmt->rowCount();
      }
      //Create Post
      public function create(){
        //Create query
        $query = 'INSERT INTO '.$this->table.'
          SET
             author = :author';
          
          //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Clean data
        $this->author = htmlspecialchars(strip_tags($this->author));

        //Bind data
        $stmt->bindParam(':author', $this->author);

        //Execute query

        if($stmt->execute()){
          return true;
        }
        //Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
      }
    
      /*public function modify(){
        $query = 'UPDATE '.$this->table.'
          SET a*/

      public function delete(){
        //Create query
        $query = 'DELETE FROM '.$this->table.'
          WHERE
             author = :author';
          
          //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Clean data
        $this->author = htmlspecialchars(strip_tags($this->author));

        //Bind data
        $stmt->bindParam(':author', $this->author);

        //Execute query

        if($stmt->execute()){
          return array($this->table);
        }
        else{
          return array('message' => 'Nothing To Delete');
        }
      }
