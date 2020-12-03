<?PHP
//This script is designed to take information from the login.php form and pull back the rest of the users info from the  database. after doing this the user can then edit thier information with exception of thier Customer ID.

//This adds information from the header.php file
include("scripts/header.php");

//variables that hold the database username and password
$user="root";
$pass="";

// Connect to the MySQL database
$db = new PDO('mysql:host=localhost;dbname=my_ecommerce_db', $user, $pass);

//Check for any connection errors
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
				$row[0] . " <br>" .
                $row[1] . " <br>" .
				$row[2] . " <br>" .
				$row[3] . " <br>" .
				$row[4] . " <br>" .
				$row[5] . " <br>" .
				$row[6];
		}
}

catch (PDOException $e) {
	echo $e->getMessage();
}

if($email == $row[2] and $crypted_pass == $row[6])   {

}

else {
    header("Location: ../loginfail.php");
}

?>

    <div class="st-xlarge st-text-grey">
        Customer Edit Details Page
    </div>
    <!--This is the form that shall display the users information. It takes data from the $row[x]s (x = where number) and inserts them into thier form rows. this data can then be edited with exception of the Customer ID, and sent to the update_customer.php script -->
<form action="scripts/update_customer.php" method="POST">
	<p>Customer ID: <br> <input type="text" readonly="readonly" name="custid" size="10" maxlength="40"
    value="<?php echo $row[0]; ?>">
    </p>
	
	<p>Customer Name:<br> <input type="text" name="custname" size="50" maxlength="40"
    value="<?php echo $row[1]; ?>">
    </p>

    <p>Email:<br> <input type="text" name="email" size="50" maxlength="150" value="<?php echo $row[2]?>">
    </p>
	
	<p>Address Line 1:<br> <input type="text" name="address1" size="50" maxlength="40" 
    value="<?php echo $row[3]?>">
    </p>
	
	<p>Address Line 2: <br> <input type="text" name="address2" size="50" maxlength="40"
    value="<?php echo $row[4]?>">
    </p>
	
	<p>PostCode: <br> <input type="text" name="postcode" size="50" maxlength="8"
    value="<?php echo $row[5]?>">
    </p>
	
	<p>Password: <br> <input type="password" name="password_entry" size="50" maxlength="40"
    value="<?php echo $row[6]?>">
    </p>
	
	<button type="reset">Reset</button>
	<button type="submit">Update</button>
	
</form>
<p>

</p>
<?PHP
//This adds information from the file footer.php
include("scripts/footer.php");
?>