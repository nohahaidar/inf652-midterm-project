<?php 
    class Author {
        //DB Stuff
        private $conn;
        private $table = 'authors';

        //Author Properties
        public $id;
        public $author;

        // Constuctor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        // Get Authors
        public function read() {
            // Create query
            $query = 'SELECT 
                c.name as category_name,
                a.id,
                a.category_id,
                a.title,
                a.author,
                a.created_at
            FROM
                ' . $this->table . ' a
            LEFT JOIN
                categories c ON a.category_id = c.id
            ORDER BY
                a.created_at DESC';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
        }

        //Get Single Author
        public function read_single() {
            //Create query
            $query = 'SELECT
                 c.name as category_name,
                 a.id,
                 a.category_id,
                 a.title,
                 a.body,
                 a.author,
                 a.created_at
             FROM
                 ' . $this->table . ' a
             LEFT JOIN
                 categories c ON a.category_id = c.id
             WHERE
                 a.id = ?
             LIMIT 0,1';
 
             // Prepare statement
             $stmt = $this->conn->prepare($query);
 
             //Bind ID
             $stmt->bindParam(1, $this->id);
 
             //Execute query
             $stmt->execute();
 
             $row = $stmt->fetch(PDO::FETCH_ASSOC);
 
             //Set Properties
             $this->title = $row['title'];
             $this->body = $row['body'];
             $this->author = $row['author'];
             $this->category_id = $row['category_id'];
             $this->category_name = $row['category_name'];
         }
 
         // Create Author
         public function create() {
             //Create query
             $query = 'INSERT INTO ' . 
                 $this->table . '
                 (author)
                 VALUES (:author)';
 
             // Prepare Statement
             $stmt = $this->conn->prepare($query);
 
             // Clean data
             $this->author = htmlspecialchars(strip_tags($this->author));
 
             //Bind data
             $stmt->bindParam(':author', $this->author);
 
             //Execute body
             if($stmt->execute()) {
                $this->id=$this->conn->lastInsertId();
                 return true;
             }
 
             return false;
 
         }
 
         // Update Author
         public function update() {
             //Create query
             $query = 'UPDATE ' . 
                 $this->table . '
               SET
                 title = :title,
                 body = :body,
                 author = :author,
                 category_id = :category_id
               WHERE
                 id = :id';
 
             // Prepare Statement
             $stmt = $this->conn->prepare($query);
 
             // Clean data
             $this->title = htmlspecialchars(strip_tags($this->title));
             $this->body = htmlspecialchars(strip_tags($this->body));
             $this->author = htmlspecialchars(strip_tags($this->author));
             $this->category_id = htmlspecialchars(strip_tags($this->category_id));
             $this->id = htmlspecialchars(strip_tags($this->id));
 
             //Bind data
             $stmt->bindParam(':title', $this->title);
             $stmt->bindParam(':body', $this->body);
             $stmt->bindParam(':author', $this->author);
             $stmt->bindParam(':category_id', $this->category_id);
             $stmt->bindParam(':id', $this->id);
 
             //Execute query
             if($stmt->execute()) {
                 return true;
             }
 
             // Print error if something goes wrong
             printf("Error: %s.\n", $stmt->error);
 
             return false;
 
         }
 
         // Delete Author
         public function delete() {
             //Create query
             $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
 
             // Prepare Statement
             $stmt = $this->conn->prepare($query);
             
             // Clean data
             $this->id = htmlspecialchars(strip_tags($this->id));
 
             // Bind data
             $stmt->bindParam(':id', $this->id);
 
             //Execute query
             if($stmt->execute()) {
                 return true;
             }
 
             // Print error if something goes wrong
             printf("Error: %s.\n", $stmt->error);
 
             return false;
         }
    }