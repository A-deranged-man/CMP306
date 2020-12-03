<?PHP
/*
Program Name:	login.php
Description:	script designed to allow a customer to login
Original Author:			Robert Burns
Author:                     Dylan Baker
Date:			05/04/2019
*/

// Before proceeding the 'user' cookie must be set, so do a check.
$cookie_name = "user";

if(isset($_COOKIE[$cookie_name])) {
    // Cookie user already set, no need to login.
	include("scripts/header.php");
    echo /** @lang text */ "<div class=\"st-xlarge st-text-grey\">Error: You are already logged in!</div>
  <p>To log-in to a different account, you will need to log out of \"$_COOKIE[$cookie_name]\" first.</p>
  <p>Under \"User Account\" in the sidebar, select \"Log Out\" or click <a href=\"logout.php\">here</a>.</p.\" ;";
	include("scripts/footer.php");

} else {
    // Allow the user to login
	include("scripts/header.php");

?>

<div class="st-xlarge st-text-grey">
    Customer Login
</div>

<!-- This is a form that takes a users name and password and passes them on to the dispcust.php script -->
			<form action="\scripts\process.login.php" method="POST">
				<p>Email Address: <br>
					<input type="text" name="email" size="50"></p>

				<p>Password:<br> 
					<input type="password" name="password_entry" size="50"></p>
			
				<button type="reset">Reset</button>
	
				<button type="submit">Submit</button>
			</form>

<?PHP
    include("scripts/footer.php");
}
?>