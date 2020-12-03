<?php

include("../model/api.php");
//  get the new data
$message = file_get_contents('php://input');
$res = createMessage($message);
echo "Added Record - " . $res;
