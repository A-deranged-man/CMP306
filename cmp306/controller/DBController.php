<?php
class DBController {
    public string $host = "lochnagar.abertay.ac.uk";
    public string $user = "sql1901368";
    public string $password = "BDuWfkHjHZa7";
    public string $database = "sql1901368";
    public $conn;

    public function getConnstring() {
        $con = mysqli_connect($this->host, $this->user, $this->password, $this->database) ;
        // check connection
        if (mysqli_connect_errno()) {
            echo("Connect failed: ". mysqli_connect_error());
            exit();
        } else {
            $this->conn = $con;
        }
        return $this->conn;
    }

    public function __construct() {
        $this->conn = $this->connectDB();
    }

    public function connectDB() {
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        return mysqli_connect($this->host, $this->user, $this->password, $this->database);
    }

    public function runQuery($query) {
        $result = mysqli_query($this->conn,$query);
        if(!empty($result)) {
            return $result;
        }
    }

}