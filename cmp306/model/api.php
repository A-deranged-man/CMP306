<?php
	// Connect to database
	include("../controller/DBController.php");
	$db = new DBController();
	$conn =  $db->getConnstring();

	/*

	Functions for Block 1 work //Begin

	*/

	//  function to create an employee
	function createEmployee($txt) {
		global $conn;
		$data = json_decode($txt) ;
		//$sql = "insert into employee (eno, ename) values (?, ?)" ;
		$stmt = $conn->prepare("insert into employee (eno, ename, ejob, edepartment, eroom, ephone, eemail) values (?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("sssssss", $eno, $ename, $ejob, $edepartment, $eroom, $ephone, $eemail);
		$eno = $data -> eno ;
		$ename = $data -> ename ;
		$ejob = $data -> ejob ;
		$edepartment = $data -> edepartment ;
		$eroom = $data -> eroom ;
		$ephone = $data -> ephone ;
		$eemail = $data -> eemail ;
		$res = $stmt->execute();
		$res = $stmt->insert_id ;
		return $res ;
	}

	//  function to get all the employees
	function getAllEmployees()
	{
		global $conn;
		$sql = "SELECT * FROM employee";
		$result = mysqli_query($conn, $sql);
		//  convert to JSON
		$rows = array();
		while($r = mysqli_fetch_assoc($result)) {
    		$rows[] = $r;
		}
		return json_encode($rows);
	}
	
	//  function to get a single employee
	function getEmployeeById($id)
	{
		global $conn;
		$stmt = mysqli_stmt_init($conn);
		$sql = "SELECT * FROM employee WHERE eno= ? LIMIT 1" ;
		mysqli_stmt_prepare($stmt, $sql);
		mysqli_stmt_bind_param($stmt, 's', $id);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$row=mysqli_fetch_array($result) ;  //there is only 1 row
		return json_encode($row);
	}

    function displaygridview(){
        global $conn;
        $stmt = mysqli_stmt_init($conn);
        $sql = "SELECT item.item_id, item.item_page_id, item.title, item.short_description, 
       item.image_id, image.image_name, image.image_alt FROM item, image WHERE item.image_id = image.image_id" ;
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $rows = array();
        while($r = mysqli_fetch_assoc($result)) {
            $rows[] = $r;
        }
        return json_encode($rows);
    }

    function getItemById($id){
        global $conn;
        $stmt = mysqli_stmt_init($conn);
        $sql = "SELECT item_page.item_page_id, item_page.article_id, item_page.title, item_page.header, 
       item_page.description, item_page.auth_name, item_page.date_published, item_page.image_id, item_page.source_name, 
       item_page.source_link, image.image_name, image.image_alt FROM item_page, image 
        WHERE item_page_id= ? AND item_page.image_id=image.image_id" ;
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row=mysqli_fetch_array($result) ;
        return json_encode($row);
	}

	function getAdditionalItemImages($id)
    {
        global $conn;
        $stmt = mysqli_stmt_init($conn);
        $sql = "SELECT item_page.item_page_id, item_page.additional_image_id, image.image_id, image.image_name, 
       image.image_alt FROM item_page, image WHERE item_page_id= ? AND item_page.additional_image_id=image.image_id" ;
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row=mysqli_fetch_array($result) ;
        return json_encode($row);
    }

    function getArticleById($id){
        global $conn;
        $stmt = mysqli_stmt_init($conn);
        $sql = "SELECT article.article_id, article.title, article.description, article.auth_name, 
       article.date_published, article.image_id, article.source_name, article.source_link, image.image_name, 
       image.image_alt FROM article, image WHERE article_id= ? AND article.image_id=image.image_id" ;
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row=mysqli_fetch_array($result) ;
        return json_encode($row);
    }

    /*

    Functions for Block 1 work //End

    Functions for Block 2 work //Begin

    */

    function getUserById($id){
        global $conn;
        $stmt = mysqli_stmt_init($conn);
        $sql = "SELECT question.qno, question.question, question.userid, question.ddtm, user.username 
        FROM question, user WHERE user.userid = ? AND question.userid = ? ORDER BY `question`.`qno` DESC " ;
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, 'ii', $id, $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $rows = array();
        while($r = mysqli_fetch_assoc($result)) {
            $rows[] = $r;
        }
        return json_encode($rows);
    }

    function make_safe($uname) {
	    global $conn;
	    return
            mysqli_real_escape_string($conn, $uname);
        }

    function make_safe_SS($uname) {
        global $conn;
            mysqli_real_escape_string($conn, $uname);
            stripslashes($uname);
            return $uname;
    }

    function register_user($username, $email, $password, $date){
        global $conn;
        $stmt = mysqli_stmt_init($conn);
        $sql = "INSERT into `user` (username, email, password, create_datetime)
        VALUES (?, ?, ?, ?)" ;
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, 'ssss', $username,$email, $password, $date);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_get_result($stmt);
    }

    function login_user($email){
        global $conn;
        $stmt = mysqli_stmt_init($conn);
        $sql = "SELECT * FROM `user` WHERE email=?" ;
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_get_result($stmt);
    }

    function  delete_question($qno){
        session_start();
        if($_SESSION["logged-in"] === "yes"){
            global $conn;
            $stmt = mysqli_stmt_init($conn);
            $sql = "DELETE FROM answer WHERE answer.qno = ?" ;
            mysqli_stmt_prepare($stmt, $sql);
            mysqli_stmt_bind_param($stmt, 'i', $qno);
            mysqli_stmt_execute($stmt);

            $stmt = mysqli_stmt_init($conn);
            $sql = "DELETE FROM question WHERE question.qno = ?" ;
            mysqli_stmt_prepare($stmt, $sql);
            mysqli_stmt_bind_param($stmt, 'i', $qno);
            mysqli_stmt_execute($stmt);
        }

    }

    function edit_question($question, $qno){
        global $conn;
        $stmt = mysqli_stmt_init($conn);
        $sql = "UPDATE question SET question.question = ? WHERE question.qno = ?" ;
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, 'si', $question, $qno);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_get_result($stmt);
    }

    function getQuestionById($qno, $userid){
        global $conn;
        $stmt = mysqli_stmt_init($conn);
        $sql = "SELECT question.qno, question.question, question.userid, question.ddtm, user.username 
        FROM question, user WHERE question.qno = ? AND user.userid = ?" ;
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, 'ii', $qno, $userid);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $rows = array();
        while($r = mysqli_fetch_assoc($result)) {
            $rows[] = $r;
        }
        return json_encode($rows);
    }

    function getQuestions(){
        global $conn;
        $stmt = mysqli_stmt_init($conn);
        $sql = "SELECT question.qno, question.question, question.userid, question.ddtm, user.username 
        FROM question, user WHERE question.userid = user.userid ORDER BY question.ddtm DESC LIMIT 6 " ;
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $rows = array();
        while($r = mysqli_fetch_assoc($result)) {
            $rows[] = $r;
        }
        return json_encode($rows);
    }

    function getAnswers($qno){
        global $conn;
        $stmt = mysqli_stmt_init($conn);
        $sql = "SELECT answer.qno, answer.answer, answer.userid, answer.ddtm, user.username 
        FROM user, answer WHERE answer.qno = ? AND answer.userid = user.userid ORDER BY answer.ddtm" ;
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $qno);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $rows = array();
        while($r = mysqli_fetch_assoc($result)) {
            $rows[] = $r;
        }
        return json_encode($rows);
    }

    function getQuestionForAnswer($qno){
        global $conn;
        $stmt = mysqli_stmt_init($conn);
        $sql = "SELECT question.qno, question.question, question.userid, question.ddtm, user.username 
        FROM question, user WHERE question.qno = ? AND user.userid = question.userid" ;
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $qno);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $rows = array();
        while($r = mysqli_fetch_assoc($result)) {
            $rows[] = $r;
        }
        return json_encode($rows);
    }

    function submitQuestion($question, $userid, $ddtm){
        global $conn;
        $stmt = mysqli_stmt_init($conn);
        $sql = "INSERT into question (question, userid, ddtm) VALUES (?,?,?)" ;
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, 'sis', $question, $userid, $ddtm);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_get_result($stmt);
    }

    function submitAnswer($qno, $answer, $userid, $ddtm){
        global $conn;
        $stmt = mysqli_stmt_init($conn);
        $sql = "INSERT into `answer` (qno,answer,userid, ddtm)
                     VALUES (?,?,?,?)" ;
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, 'isis', $qno, $answer, $userid,$ddtm);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_get_result($stmt);
    }

    /*

    Functions for Block 2 work //End

    Functions for Block 3 work //Begin

    */

    //  function to enter a new message for the device
    //  $message is the message to be entered into the database table.
    function createMessage($message) {
        global $conn;
        $data = json_decode($message, true);
        $redlightstate = $data["0"]["pin5"];
        $greenlightstate = $data["1"]["pin7"];
        $internaltemp = $data["2"]["pin8"];
        $externaltemp = $data["3"]["pin9"];

        $lightsql = $conn->prepare("UPDATE lightsstate SET redstate = ?, greenstate = ? WHERE id = 8") ;
        $lightsql->bind_param("ii",$redlightstate,$greenlightstate);
        mysqli_stmt_execute($lightsql);

        $arr = array('Internal_Temprature' => $internaltemp, 'External_Temprature' => $externaltemp);
        $tempsjson = json_encode($arr);

        $stmt = $conn->prepare("insert into temprature (message, dttm) values (?, ?)");
        $stmt->bind_param("ss", $tempsjson, $dttm);
        $dttm = date("Y-m-d H:i:s");
        mysqli_stmt_execute($stmt);

        $idstmt = mysqli_stmt_init($conn);
        $sql = "SELECT id FROM temprature ORDER BY temprature.id DESC LIMIT 1";
        mysqli_stmt_prepare($idstmt, $sql);
        mysqli_stmt_execute($idstmt);
        $result = mysqli_stmt_get_result($idstmt);
        $rows = array();
        while($r = mysqli_fetch_assoc($result)) {
            $rows[] = $r;
        }
        return $rows["0"]["id"];
    }

    function getLightStates(){
        global $conn;
        $stmt = mysqli_stmt_init($conn);
        $sql = "SELECT redstate, greenstate FROM lightsstate" ;
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_get_result($stmt);
    }

    function getMostRecentTemp(){
        global $conn;
        $stmt = mysqli_stmt_init($conn);
        $sql = "SELECT * from temprature WHERE dttm > (NOW() - INTERVAL 24 HOUR) ORDER BY `temprature`.`id` DESC LIMIT 1" ;
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $rows = array();
        while($r = mysqli_fetch_assoc($result)) {
            $rows[] = $r;
        }
        return json_encode($rows);
    }

	function getdbtemps(){
        global $conn;
        $stmt = mysqli_stmt_init($conn);
        $sql = "SELECT temprature.message from temprature WHERE dttm > (NOW() - INTERVAL 24 HOUR) ORDER BY `temprature`.`id` ASC" ;
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $rows = array();
        while($r = mysqli_fetch_assoc($result)) {
            $rows[] = $r;
        }
        return $rows;
    }

    function getdbtemptime(){
        global $conn;
        $stmt = mysqli_stmt_init($conn);
        $sql = "SELECT TIME(temprature.dttm) AS time_part from temprature WHERE dttm > (NOW() - INTERVAL 24 HOUR) ORDER BY `temprature`.`id` ASC" ;
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $rows = array();
        while($r = mysqli_fetch_assoc($result)) {
            $rows[] = $r;
        }
        return $rows;

    }