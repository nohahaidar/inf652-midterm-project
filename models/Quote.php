<?php
    class Quote {
        //DB Stuff
        private $conn;
        private $table = 'quotes';

        //Properties
        public $id;
        public $name;
        public $created_at;

        //Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        //Get Categories
        public function read() {
            // Create query
            $query = 'SELECT
                id,
                name,
                created_at
            FROM
                ' . $this->table . '
            ORDER BY
                created_at DESC';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            //Execute query
            $stmt->execute();

            return $stmt;
        }
    }