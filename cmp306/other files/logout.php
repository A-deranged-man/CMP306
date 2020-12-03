<?php
/*
Program Name:	logout.php
Description:	Common site logout page
				Removes the cookie (if set)
Author:			Robert Burns
Date:			21/01/2019
*/

$cookie_name = "user";
$cookie_guest = "guest";

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

    // Unset the user cookie (effects the user logout)
    if (isset($_COOKIE[$cookie_name])) {
            unset($_COOKIE[$cookie_name]);
            setcookie($cookie_name, '', time() - 3600, '/'); // empty value and old timestamp
            setcookie($cookie_guest, "guest".","."0",0,"/" );
    }

    include("scripts/header.php");
    echo /** @lang text */"
    <div class=\"st-xlarge st-text-grey\">Customer Logout</div>
    <p>You have successfully been logged out.</p>" ;

	include("scripts/footer.php");
}
?>