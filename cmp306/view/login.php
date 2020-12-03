<?php
include("header.php");
include("../model/api.php");
session_start();
if($_SESSION["logged-in"] === "yes"){
    echo "<script type='text/javascript'>window.top.location='https://mayar.abertay.ac.uk/~1901368/cmp306/view/questions.php';</script>"; exit;
}

else{
    if (isset($_POST['email'])) {
    $email = make_safe_SS($_REQUEST['email']);
    $password = ($_REQUEST['password']);

    $result = login_user($email);
    $row = $result->fetch_assoc();
        if (password_verify($password,$row['password'])){
            $_SESSION["userid"] = $row['userid'];
            $_SESSION["username"] = $row['username'];
            $_SESSION["logged-in"] = "yes";
            echo "<script type='text/javascript'>window.top.location='https://mayar.abertay.ac.uk/~1901368/cmp306/view/questions.php';</script>"; exit;
        }

        else{
            echo "<div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'><a href='login.php'>Click here to login again.</a></p>
                  </div>";
        }
}

else {
    ?>
    <form class="form" method="post" name="login">
        <h1>Login</h1>
        <p>Email Address:
            <br>
            <input type="text" name="email" placeholder="Email Address"/>
        </p>
        <p>Password:
            <br>
            <input type="password" name="password" placeholder="Password"/>
        </p>
        <input type="submit" value="Login" name="submit"/>
        <p class="link"><a href="user_registration.php">Register a new account</a></p>
    </form>
    <?php
    }
}
include("footer.php");
?>