<!DOCTYPE html>
<!--
Site designed by Dylan Baker
Libraries used from Bootstrap 4, W3.CSS, jQuery, Popper.js, Bootstrap JS, Google & Font Awesome.
-->
<html lang="en">
    <head>
        <title>DB Software</title>

        <!-- Required meta tags -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Personal Stylesheet & Icon -->
        <link href="/~1901368/cmp306/view/favicon.png" rel="icon">
        <link href="/~1901368/cmp306/view/styles1.css" rel="stylesheet">

        <!-- Google Roboto, Google Montserrat & Font Awesome -->
        <link href="/~1901368/cmp306/view/Google-Roboto.css" rel="stylesheet">
        <link href="/~1901368/cmp306/view/Google-Montserrat.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

        <!-- Bootstrap CSS -->
        <link crossorigin="anonymous" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
            integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" rel="stylesheet">

        <!-- jQuery, Popper.js, Bootstrap JS -->
        <script crossorigin="anonymous"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
                src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script crossorigin="anonymous"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
                src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script crossorigin="anonymous"
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
                src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>


        <style>
            .st-sidebar a {font-family: "Roboto", sans-serif}
            body,h1,h2,h3,h4,h5,h6,.st-wide {font-family: "Montserrat", sans-serif;}
        </style>

    </head>
<body class="st-content" style="max-width:1200px">
<?php
session_start();
$cookie_accept = "accepted";
if(!isset($_COOKIE[$cookie_accept])) {
    echo /** @lang html */"
            <!-- Modal -->
            <script type=\"text/javascript\">
                $(window).on('load',function(){\$('#myModal').modal('show');});
            </script>
            <div id=\"myModal\" class=\"modal\" role=\"dialog\">
                <div class=\modal-dialog\">
                <!-- Modal content-->
                    <div class=\"st-modal-content\">
                        <div class=\"modal-header\">
                            <h4 class=\"modal-title\">This Website Uses Cookies</h4>
                            <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                        </div>
                        <div class=\"modal-body\">
                            <p>If you wish to continue browsing DB Software, you must accept the use of cookies on this site. 
                               By continuing to use the site or clicking \"Accept Cookies\" You accept this sites usage of cookies.</p>
                        </div>
                        <div class=\"modal-footer\">
                            <button type=\"button\" class=\"btn st-black btn-default\"  data-dismiss=\"modal\">Accept Cookies</button>
                            <button type=\"button\" class=\"btn st-red btn-default\" 
                            onclick=\"window.location.href='http://www.google.co.uk'\" data-dismiss=\"modal\">No Thanks</button>
                        </div>
                    </div>
                </div>
            </div>";
    setcookie($cookie_accept,"accepted",0, "/");
    setcookie($cookie_guest, "guest".","."0",0,"/" );
}
else{
    echo "<!-- Cookies Set -->";
}
?>
<!-- Sidebar/menu -->
<nav class="st-sidebar st-bar-block st-white st-collapse st-top" style="z-index:3;width:250px" id="mySidebar">

    <div class="st-container st-display-container st-padding-16">
        <i onclick="js_close()" class="fa fa-remove st-hide-large st-button st-display-topright"></i>
        <h3 class="st-wide"><b>DB Software</b></h3>
    </div>
    <div class="st-padding-64 st-large st-text-grey" style="font-weight:bold">

        <a class="st-bar-item st-white st-left-align" id="myBtn" >
            <?php
            if(isset($_SESSION['username'])) {
                echo "Welcome ".$_SESSION['username']."!";
            }

            else{
                echo "Welcome!";
            }
            ?>
            </a>
        <a href="/~1901368/cmp306/index.php" class="st-bar-item st-button st-block st-white st-left-align">Home Page</a>
        <br>

        <a onclick="block1()" href="javascript:void(0)" class="st-button st-block st-white st-left-align" id="myBtn">
            Block 1
            <i class="fa fa-caret-down"></i>
        </a>
        <div id="block1" class="st-bar-block st-hide st-padding-large st-medium">
            <a href="/~1901368/cmp306/view/items.php" class="st-bar-item st-button">Items & Articles</a>
            <a href="/~1901368/cmp306/view/displayall.php" class="st-bar-item st-button">Database Entry & JSON</a>
        </div>
        <a onclick="block2()" href="javascript:void(0)" class="st-button st-block st-white st-left-align" id="myBtn">
            Block 2
            <i class="fa fa-caret-down"></i>
        </a>
        <div id="block2" class="st-bar-block st-hide st-padding-large st-medium">
            <a href="/~1901368/cmp306/view/questions.php" class="st-bar-item st-button">Q&A</a>
            <?php
            if($_SESSION["logged-in"] === "yes") {
                echo"<a href=\"/~1901368/cmp306/view/useraccount.php\" class=\"st-bar-item st-button\">User Account</a>";
                echo "<a href=\"/~1901368/cmp306/view/logout.php\" class=\"st-bar-item st-button\">Log Out</a>";
            }

            else{
                echo"<a href=\"/~1901368/cmp306/view/user_registration.php\" class=\"st-bar-item st-button\">Register a New User</a>";
                echo"<a href=\"/~1901368/cmp306/view/login.php\" class=\"st-bar-item st-button\">Log In</a>";
            }
            ?>
        </div>
        <a onclick="block3()" href="javascript:void(0)" class="st-button st-block st-white st-left-align" id="myBtn">
            Block 3
            <i class="fa fa-caret-down"></i>
        </a>
        <div id="block3" class="st-bar-block st-hide st-padding-large st-medium">
            <a href="/~1901368/cmp306/view/IoT.php" class="st-bar-item st-button">IoT</a>
        </div>
        <a onclick="block4()" href="javascript:void(0)" class="st-button st-block st-white st-left-align" id="myBtn">
            Block 4
            <i class="fa fa-caret-down"></i>
        </a>
        <div id="block4" class="st-bar-block st-hide st-padding-large st-medium">
            <a href="../#" class="st-bar-item st-button">TBA</a>
            <a href="../#" class="st-bar-item st-button">TBA</a>
        </div>
        <br>
        <a href="../#" class="st-button st-block st-white st-left-align">Commentary</a>
    <br>
</nav>

<!-- Top menu on small screens -->
<header class="st-bar st-top st-hide-large st-black st-xlarge">
    <div class="st-bar-item st-padding-24 st-wide">DB Software</div>
    <a href="javascript:void(0)" class="st-bar-item st-button st-padding-24 st-right" onclick="js_open()"><i class="fa fa-bars"></i></a>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="st-overlay st-hide-large" onclick="js_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="st-main" style="margin-left:250px">

    <!-- Push down content on small screens -->
    <div class="st-hide-large" style="margin-top:83px"></div>

    <!-- Top header -->
    <header class="st-container st-xlarge">
        <p class="st-left">
        </p>

        <p class="st-right">
            <br>
        </p>
    </header>
<!-- end of header -->