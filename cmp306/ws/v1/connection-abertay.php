<?php
	// Abertay database connections 
	$servername = "lochnagar.abertay.ac.uk";
	$username = "sql1901368";
	$password = "BDuWfkHjHZa7";
	$dbname = "sql1901368";

	function getConnectionString() {
	
		global $servername, $username, $password, $dbname ;
	
		$conn = mysqli_connect($servername, $username, $password, $dbname) ;
		// check connection 
		if (mysqli_connect_errno()) {
			echo("Abertay - connection failed: ". mysqli_connect_error());
			return 0 ;
		} else {
			return $conn;
		}
	}
?>