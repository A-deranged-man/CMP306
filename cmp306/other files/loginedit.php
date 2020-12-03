<?PHP
//This adds information from the header.php file
$cookie_name = "user";

if(!isset($_COOKIE[$cookie_name])) {
    // Cookie user not set, ask user to login.
    include("scripts/header.php");
    echo /** @lang text */ "
    <div class=\"st-xlarge st-text-grey\">Error: You need to be logged in to do that!</div>
    <p>You are currently not logged in.</p>
    <p>Under \"User Account\" in the sidebar, select \"Login Existing Customer\" or click <a href=\"login.php\">here</a>.</p." ;
    include("scripts/footer.php");
}
else {

    include("scripts/header.php");
    echo /** @lang text */
    "<div class=\"st-xlarge st-text-grey\">
                    Customer Edit Details Login
                    </div>
        <p>For verification purposes, please enter you account details again</p>

            <!-- This is a form that takes a users name and password and passes them on to the dispcust.php script -->
			<form action=\"dispcust.php\" method=\"POST\">
				<p>Email Address: <br>
					<input type=\"text\" name=\"email\" size=\"50\"></p>

				<p>Password:<br> 
					<input type=\"password\" name=\"password_entry\" size=\"50\"></p>
			
				<button type=\"reset\">Reset</button>
	
				<button type=\"submit\">Submit</button>
			</form>
            <p>

            </p>";

    include("scripts/footer.php");
}
?>
