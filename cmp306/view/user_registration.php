<?php
    include("header.php");
    include("../model/api.php");
    if($_SESSION["logged-in"] === "yes"){
        echo "<script type='text/javascript'>window.top.location='https://mayar.abertay.ac.uk/~1901368/cmp306/view/questions.php';</script>"; exit;
    }

    else{
// When form submitted, insert values into the database.
if (isset($_REQUEST['username'])) {
    $username = make_safe_SS($_REQUEST['username']);
    $email    = make_safe_SS($_REQUEST['email']);
    $crypted_password = password_hash($_REQUEST['password'], PASSWORD_BCRYPT);
    $create_datetime = date("Y-m-d H:i:s");

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        echo "<div class='form'>
                  <h3>Email Address Invalid.</h3><br/>
                  <p class='link'><a href='user_registration.php'>Click here to register again.</a></p>
                  </div>";
    }
    if (preg_match('/[A-Za-z0-9]+/', $_POST['username']) == 0) {
        echo "<div class='form'>
                  <h3>Username Invalid.</h3><br/>
                  <p class='link'><a href='user_registration.php'>Click here to register again.</a></p>
                  </div>";
    }
    if (strlen($_POST['password']) > 60 || strlen($_POST['password']) < 5) {
        echo "<div class='form'>
                  <h3>Password Over character limit (60 characters max)</h3><br/>
                  <p class='link'><a href='user_registration.php'>Click here to register again.</a></p>
                  </div>";
    }
    $result = register_user($username,$email,$crypted_password,$create_datetime);
    if ($result) {
        echo "<div class='form'>
                  <h3>You are registered successfully.</h3><br/>
                  <p class='link'><a href='login.php'>Click here to login</a></p>
                  </div>";
    } else {
        echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'><a href='user_registration.php'>Click here to register again.</a></p>
                  </div>";
    }
}
else {
    ?>

    <form class="form" action="" method="post">
        <h1>Registration</h1>
        <p>Username:
            <br>
            <input type="text" name="username" placeholder="Username" required >
        </p>
        <div class="fieldWrapper">
            <label for="email">Email Address:</label>
            <br>
            <input type="text" name="email" id="email" placeholder="Email Address" required onkeyup="validateEmail(); return false;">
            <span id="confirmEmail" class="confirmEmail"></span>
        </div>

        <div class="fieldWrapper">
            <label for="password_entry">Password:</label>
            <br>
            <input type="password" name="password" id="password_entry" value="" placeholder="Password" required>
        </div>
        <div class="fieldWrapper">
            <label for="pass2">Confirm Password:</label>
            <br>
            <input type="password" name="confirm_pass" id="pass2" onkeyup="checkPass(); return false;" value="">
            <span id="confirmMessage" class="confirmMessage"></span>
        </div>
        <input type="submit" name="submit" value="Register">
        <p class="link"><a href="login.php">Click to Login</a></p>
    </form>

    <script>
        function checkPass()
        {
            //Store the password field objects into variables
            var pass1 = document.getElementById('password_entry');
            var pass2 = document.getElementById('pass2');
            //Store the Confirmation Message Object
            var message = document.getElementById('confirmMessage');
            //Compare the values in the password field
            //and the confirmation field
            if(pass1.value === pass2.value){
                //The passwords match.
                //Set the color to the good color and inform
                //the user that they have entered the correct password
                pass2.style.backgroundColor = "#66cc66";
                message.style.color = "#66cc66";
                message.innerHTML = "Passwords Match!"
            }else{
                //The passwords do not match.
                //Set the color to the bad color and
                //notify the user.
                pass2.style.backgroundColor = "#ff6666";
                message.style.color = "#ff6666";
                message.innerHTML = "Passwords Do Not Match!"
            }
        }

        function validateEmail()
        {
            var mailformat = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
            var email = document.getElementById('email');
            var message = document.getElementById('confirmEmail');
            if(email.value.match(mailformat))
            {
                email.style.backgroundColor = "#66cc66";
                message.style.color = "#66cc66";
                message.innerHTML = "Valid Email Address."
                return true;
            }
            else
            {
                email.style.backgroundColor = "#ff6666";
                message.style.color = "#ff6666";
                message.innerHTML = "Invalid Email Address!"
                return false;
            }
        }
    </script>

<?php
}
    }include("footer.php");
?>
