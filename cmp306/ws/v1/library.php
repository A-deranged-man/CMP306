<?php

	// Library of methods to support the Web Service	

	function getAllQuestions()
	{
		global $connection;
		$query="SELECT question.qno, question.question, question.userid, question.ddtm, user.username 
        FROM question, user WHERE question.userid = user.userid ORDER BY question.ddtm DESC LIMIT 6";
		$result=mysqli_query($connection, $query);
		$response=array();
		while($row=mysqli_fetch_array($result))
		{
			$response[]=$row;
		}
		header('Content-Type: application/json');
		return json_encode($response);
	}

	
	//  function to get a specific employee
	function getQuestion($id)
	{
		global $connection;
		$query="SELECT question.qno, question.question, question.userid, question.ddtm, user.username 
        FROM question, user WHERE question.userid = user.userid AND question.qno =".$id ;
		$result=mysqli_query($connection, $query);
		$response=array();
		$response[0] = mysqli_fetch_array($result) ;
		header('Content-Type: application/json');
		return json_encode($response);
	}
