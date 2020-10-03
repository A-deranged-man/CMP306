<!DOCTYPE html>
<!--
Site designed by Dylan Baker

Styles used from W3.CSS, Google, Font Awesome, Bootstrap CSS.

-->
<html lang="en">
<title>DB Software</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="favicon.png" rel="icon">
    <link href="styles1.css" rel="stylesheet">
    <link href="Google-Roboto.css" rel="stylesheet">
    <link href="Google-Montserrat.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link crossorigin="anonymous" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" rel="stylesheet">
    <script crossorigin="anonymous"
            integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<style>
    .st-sidebar a {font-family: "Roboto", sans-serif}
    body,h1,h2,h3,h4,h5,h6,.st-wide {font-family: "Montserrat", sans-serif;}
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

<script type="text/javascript">
    $(window).on('load',function(){$('#myModal').modal('show');});
</script>

<body class="st-content" style="max-width:1200px">

<?php
$cookie_accept = "accepted";
if(!isset($_COOKIE[$cookie_accept])) {
    echo /** @lang text */ "
<!-- Modal -->
<div id=\"myModal\" class=\"modal fade\" role=\"dialog\">

    <div class=\modal-dialog\">
        <!-- Modal content-->
        <div class=\"st-modal-content\">
            <div class=\"modal-header\">
                <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
                <h4 class=\"modal-title\">This Website Uses Cookies</h4>
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
            $cookie_name = "user";
            if(isset($_COOKIE[$cookie_name])) {
                $info = explode(",", $_COOKIE[$cookie_name]);
                echo "Welcome $info[0]!";
            }

            else{
                echo "Welcome!";
            }
            ?>
            </a>
        <a href="../cmp306/index.php" class="st-bar-item st-button st-block st-white st-left-align">Home Page</a>

        <a onclick="courseblocks()" href="javascript:void(0)" class="st-button st-block st-white st-left-align" id="myBtn">
            Course Blocks
            <i class="fa fa-caret-down"></i>
        </a>
        <div id="courseblocks" class="st-bar-block st-hide st-padding-large st-medium">
            <a href="../cmp306/block1.php" class="st-bar-item st-button">Block 1</a>
            <a href="../cmp306/block2.php" class="st-bar-item st-button">Block 2</a>
            <a href="../cmp306/block3.php" class="st-bar-item st-button">Block 3</a>
            <a href="../cmp306/block4.php" class="st-bar-item st-button">Block 4</a>
        </div>
        <br>
    </div>
    <br>
    <a href="../cmp306/privacy_policy.php" class="st-bar-item st-button st-medium st-text-black">Privacy Policy</a>
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
    <header class="st-container st-xlarge"?>
        <p class="st-left">
        </p>

        <p class="st-right">
            <br>
        </p>
    </header>
<!-- end of header -->