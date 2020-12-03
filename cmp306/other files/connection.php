<?php
Class dbObj{

	// Abertay database connections 
	var $servername = "lochnagar.abertay.ac.uk";
	var $username = "sql1901368";
	var $password = "BDuWfkHjHZa7";
	var $dbname = "sql1901368";
	var $conn;

	function getConnstring() {
		$con = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname) ;
		// check connection 
		if (mysqli_connect_errno()) {
			echo("Connect failed: ". mysqli_connect_error());
			exit();
		} else {
			$this->conn = $con;
		}
		return $this->conn;
	}
}
?>