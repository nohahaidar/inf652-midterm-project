<?php
    class Database {
        private $host;
        private $dbname;
        private $username;
        private $password;
        private $conn;
        private $port;

        public function __construct() {
            $this->username = getenv('USERNAME');
            $this->password = getenv('PASSWORD');
            $this->dbname = getenv('DBNAME');
            $this->host = getenv('HOST');
            $this->port = getenv('PORT');
        }

        /*public function connect() {
            if($this->conn) {
                return $this->conn;
            } else {

            $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->dbname}";

            try {
                $this->conn = new PDO ($dsn, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
            } catch(PDOException $e) {
                echo 'Connection Error: ' . $e->getMessage();
            }
            return $this->conn;
        }
        }*/
        public function connect() {
            $this->conn = null;
            $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->db_name};";
            try { 
              $this->conn = new PDO($dsn, $this->username, $this->password);
              $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
              echo 'Connection Error: ' . $e->getMessage();
            }
      
            return $this->conn;
          }
    }