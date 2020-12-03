<?PHP
//This script is designed to take information from the newcust.php form and insert it into the database.

//variables that hold the database username and password
$user = "root" ;
$pass = "" ;
	
// Connect to the MySQL database
$db = new PDO('mysql:host=localhost;dbname=my_ecommerce_db', $user, $pass);
	
//Check for any connection errors
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Takes information from form and places it into variables
$Customerid = $_POST['custid'] ;
$CustomerName = $_POST['custname'] ;
$Email1 = $_POST['email'] ;
$Address1 = $_POST['address1'] ;
$Address2 = $_POST['address2'] ;
$PostCode = $_POST['postcode'] ;
$password_entry = $_POST['password_entry'] ;
$crypted_pass = crypt($password_entry, 'saltie');

//The sql statement
$sql="INSERT INTO customer (Customerid, CustomerName,email, Address1, Address2, PostCode, Password) 
VALUES (:customerid, :customername, :mail, :addr1, :addr2, :pcode, :crypted_pass) ";

//Preparing the SQL statement
$stmt = $db->prepare($sql);


//Executing the SQL statement
$stmt->execute(array(
	"customerid" => $Customerid,
	"customername" => $CustomerName,
	"mail" => $Email1,
	"addr1" => $Address1,
	"addr2" => $Address2,
	"pcode" => $PostCode,
	"crypted_pass" => $crypted_pass
		) 
	);

if($Email1 == $_POST['email'] and $password_entry == $_POST['password_entry'])   {
    $cookie_name = "user";
    setcookie($cookie_name, $CustomerName,0, "/" );
    header("Location: ../loginsuccess.php");
}

else {
    header("Location: ../loginfail.php");
}
?>