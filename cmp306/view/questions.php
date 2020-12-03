<?php
include("header.php");
include("../model/api.php");
session_start();
if($_SESSION["logged-in"] === "yes"){
    if (isset($_POST['question'])) {
    $question = make_safe($_REQUEST['question']);
    // escapes special characters in a string
    $ddtm = date("Y-m-d H:i:s");
    $userid = $_SESSION['userid'];
    $result = submitQuestion($question,$userid,$ddtm);
    }
    if($result){
        echo "<script type='text/javascript'>window.top.location='https://mayar.abertay.ac.uk/~1901368/cmp306/view/questions.php';</script>"; exit;
    }
    else{
        echo ' 
         <div class="st-xlarge st-text-grey">
            Questions
           </div>
        <br>
            
            <div class="container">

            <div class="list-group-item list-group-item-action bg-light text-dark ">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Ask a Question:</h5>
                </div>
                <form class="form" action="" method="post">
                <p>
                    <br>
                    <input type="text" name="question" length="500" placeholder="Type your question here" required >
                </p>
                    <input class="btn btn-primary st-black st-text-white st-border-black" type="submit" name="submit" value="Ask Question!">
                </form>
            </div>
        </div>
        <br>';
    }
}
else{
    echo ' 
       <div class="st-xlarge st-text-grey">
            Questions
        </div>
        <br>
            
            <div class="container">

            <div class="list-group-item list-group-item-action bg-light text-dark ">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Log-In to ask a Question</h5>
                </div>
            
            <button class="btn btn-primary st-black st-text-white st-border-black">
                <a class="text-light" href="login.php">Log-In to an Existing Account</a>
            </button>
            
            <button class="btn btn-primary st-black st-text-white st-border-black">
                <a class="text-light" href="user_registration.php">Register a New User</a>
            </button>
            </div>
        </div>
        <br>';
}
$questiontxt = getQuestions();
$question = json_decode($questiontxt);
for ($i = 0, $iMax = count($question); $i < $iMax; $i++) {
    echo "
        <div class=\"container\">
            <div class=\"list-group-item list-group-item-action bg-light text-dark \">
                <div class=\"d-flex w-100 justify-content-between\">
                    <h5 class=\"mb-1\">Question: {$question[$i]-> question} </h5>
                </div>
                <p class=\"st-small\">Date Posted: {$question[$i]-> ddtm}
                <br>
                Posted By: {$question[$i]-> username}
                </p>
                <button class=\"btn btn-primary st-black st-text-white st-border-black\">
                    <a class=\"text-light\" href=\"answers.php?qno={$question[$i]-> qno}\">View Answers</a>
                </button>
            </div>
        </div>
        <br>";
    }
include("footer.php");
