<!-- Whilst this is essentially a html page, I made it a .php so that I could add information from the header.php and footer.php files -->
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
    Register New Customer
</div>

<div class="formWrapper">
    <!-- This is the form, and link to a script for the database -->
    <form action="scripts/insert_customer.php" method="POST">
        <p>ID:
            <br>
            <input type="text" name="custid" value="" placeholder="Enter an ID" size="40" maxlength="40" required>
        </p>

        <p>Name:
            <br>
            <input type="text" name="custname" value="" placeholder="Enter Your Name" size="40" maxlength="40" required>
        </p>

        <p>Email:
            <br>
            <input type="text" name="email" value="" placeholder="Enter Email" size="50" maxlength="40" required>
        </p>

        <p>Address Line 1:
            <br>
            <input type="text" name="address1" value="" placeholder="Enter Address Line 1" size="40" maxlength="40" required>
        </p>

        <p>Address Line 2 (Optional):
            <br>
            <input type="text" name="address2" value="" placeholder="Enter Address Line 2" size="40" maxlength="40">
        </p>

         <p>Postcode:
            <br>
            <input type="text" name="postcode" value="" placeholder="Enter PostCode" size="40" maxlength="8" required>
        </p>

        <div class="fieldWrapper">
            <label for="password_entry">Password:</label>
            <br>
            <input type="password" name="password_entry" id="password_entry" value="" placeholder="Enter password" size="40" maxlength="50" required>
        </div>

        <div class="fieldWrapper">
            <label for="pass2">Confirm Password:</label>
            <br>
            <input type="password" name="confirm_pass" id="pass2" onkeyup="checkPass(); return false;" value="">
            <span id="confirmMessage" class="confirmMessage"></span>
        </div>

        <p>
            <button type:"reset">Reset Form</button>
            <button type:"submit">Submit Form</button>
        </p>
    </form>
</div>

    <!--
    This script was originally written by Kieth Hatfield in april 2019. Used with permission.
    -->
    <script>
        function checkPass()
        {
            //Store the password field objects into variables ...
            var pass1 = document.getElementById('password_entry');
            var pass2 = document.getElementById('pass2');
            //Store the Confimation Message Object ...
            var message = document.getElementById('confirmMessage');
            //Set the colors we will be using ...
            var goodColor = "#66cc66";
            var badColor = "#ff6666";
            //Compare the values in the password field
            //and the confirmation field
            if(pass1.value == pass2.value){
                //The passwords match.
                //Set the color to the good color and inform
                //the user that they have entered the correct password
                pass2.style.backgroundColor = goodColor;
                message.style.color = goodColor;
                message.innerHTML = "Passwords Match!"
            }else{
                //The passwords do not match.
                //Set the color to the bad color and
                //notify the user.
                pass2.style.backgroundColor = badColor;
                message.style.color = badColor;
                message.innerHTML = "Passwords Do Not Match!"
            }
        }
    </script>
<?PHP
    include("scripts/footer.php");
}
?>