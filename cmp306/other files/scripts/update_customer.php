<?PHP
//This script takes information from the form on dispcust.php, updates the new values into the database and moves the user into the login.php screen.

//variables that hold the database username and password
$user="root";
$pass="";

// Connect to the MySQL database
$db = new PDO('mysql:host=localhost;dbname=my_ecommerce_db', $user, $pass);

//Check for any connection errors
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Takes information from form and places it into variables
$Custmid = $_POST['custid'] ;
$CustName = $_POST['custname'] ;
$email= $_POST['email'];
$Addr1 = $_POST['address1'] ;
$Addr2 = $_POST['address2'] ;
$PostC = $_POST['postcode'] ;
$password_entry = $_POST['password_entry'] ;
$crypted_pass = crypt($password_entry, 'saltie');

//This is an sql statement that will update all values selected with the values from the declared variables.
$sql = "UPDATE customer SET 
		CustomerName = '$CustName',
		email = '$email',
		Address1 = '$Addr1',
		Address2 = '$Addr2',
		PostCode = '$PostC',
		Password = '$crypted_pass' 
		WHERE Customerid = '$Custmid'";

//Preparing the SQL statement
$stmt = $db->prepare($sql);

//Executing the SQL statement
$stmt->execute();

//Moves the user to the login.php screen on completion of data entry
header("Location: ../logineditsuccess.php");
?>