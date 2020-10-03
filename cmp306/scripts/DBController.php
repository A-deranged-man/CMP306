<?php
class DBController {
    private string $host = "lochnagar.abertay.ac.uk";
    private string $user = "sql1901368";
    private string $password = "";
    private string $database = "sql1901368";
    private $conn;

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

    public function runStmt($stmt, $param, $values) {
        $to_bind = $this->conn->prepare($stmt);
        $to_run = $to_bind->bind_param($param,$values);
        if(!empty($to_run)) {
            $to_run->execute();
        }
    }

}