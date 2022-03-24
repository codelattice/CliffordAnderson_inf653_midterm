<?php
  class Category{
      //DB stuff
      private $conn;
      private $table = 'categories';

      //Post Properties
      public $id;
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
                categories.id as id,
                categories.category as category
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
        c.id as id,
        c.category as category
      FROM
        '.$this->table.' c
      WHERE
        c.id = ?
      LIMIT 0,1';
        
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(1, $this->id);

      // Execute query
      $stmt->execute();
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      $this->id = $row['id'];
      $this->category = $row['category'];
        
       return $stmt->rowCount();
      }
    
      //Create Post
      public function create(){
        //Create query
        $query = 'INSERT INTO '.$this->table.'
          SET
             category = :category';
          
          //Prepare statement
        $stmt = $this->conn->prepare($query);
        
        $this->category = htmlspecialchars(strip_tags($this->category));
        
        //Bind data
        $stmt->bindParam(':category', $this->category);

        //Execute query

        if($stmt->execute()){
          return true;
        }

        //Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
      }
    
          public function delete(){
        //Create query
        $query = 'DELETE FROM '.$this->table.'
          WHERE
             id = :id';
      
          //Prepare statement
        $stmt = $this->conn->prepare($query);

        //Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));

        //Bind data
        $stmt->bindParam(':id', $this->id);

        //Execute query

       if($stmt->execute()){
          return true;
        }

        //Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
      }
  }
