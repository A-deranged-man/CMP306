<?php
include("../model/api.php");
include("auth_session.php");
session_start();
$qno = $_GET['qno'];
delete_question($qno);
header('Location: useraccount.php');