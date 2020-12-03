<?php
include("header.php");
include("../model/api.php");
session_start();
$userid = $_SESSION['userid'];
if($_SESSION["logged-in"] === "yes") {

    $usertxt = getUserById($userid);
    $user = json_decode($usertxt);
    for ($i = 0, $iMax = count($user); $i < $iMax; $i++) {
        echo "<div class=\"container\">
            <div class=\"list-group-item list-group-item-action bg-light text-dark \">
                <div class=\"d-flex w-100 justify-content-between\">
                    <h5 class=\"mb-1\">Question: {$user[$i]-> question} </h5>
                </div>
                <p class=\"st-small\">Date Posted: {$user[$i]-> ddtm}
                    <br>
                    Posted By: {$user[$i]-> username}
                </p>
                <button class=\"btn btn-primary st-red st-text-white st-border-black\">
                    <a class=\"text-light\" href=\"delete_question.php?qno={$user[$i]-> qno}\">Delete Question</a>
                </button>
                <button class=\"btn btn-primary st-black st-text-white st-border-black\">
                    <a class=\"text-light\" href=\"edit_question.php?qno={$user[$i]-> qno}\">Edit Question</a>
                </button>
            </div>
        </div>
        <br>";
    }
}

else{
    echo "<script type='text/javascript'>window.top.location='https://mayar.abertay.ac.uk/~1901368/cmp306/view/login.php';</script>"; exit;
}

include("footer.php");