<?PHP

//Takes information from form and places it into variables
$email = $_POST['email'];
$password_entry = $_POST['password_entry'];
$crypted_pass = crypt($password_entry, 'saltie');

//This statement selects all data from the customer table in a row where the name and password match that of the values declared in the variables.
$sql = "SELECT * FROM customer WHERE email='$email' AND Password='$crypted_pass'";

//This brings data from the database into the page and pushes it into rows with numbers whilst also catching errors.
try {
	$stmt=$db->query($sql);

		if($row = $stmt->fetch()) {
				$row[0] .
                $row[1] .
				$row[2] .
				$row[3] .
				$row[4] .
				$row[5] .
				$row[6];
		}
}

catch (PDOException $e) {
    header("Location: ../login.php");
	echo $e->getMessage();
}

if($email == $row[2] and $crypted_pass == $row[6])   {
    $cookie_name = "user";
    $cookie_guest = "guest";
    setcookie($cookie_name, $row[1].",".$row[0],0, "/" );
    unset($_COOKIE[$cookie_guest]);
    header("Location: ../disprod.php");
}

/*

retrieve cookies

if(isset($_COOKIE["user"])){
    $info = explode(",", $_COOKIE["user"]);
    $username = $info[0];
    $Custid = $info[1];
}

*/

else {
    header("Location: ../loginfail.php");
}


