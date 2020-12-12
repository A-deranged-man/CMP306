<?php
include("header.php");
	//  PHP to get all the employees 
	//  URL of the web service
	$url = "https://mayar.abertay.ac.uk/~1901368/cmp306/ws/v1/RESTQuestions" ;
	//  set up the CURL
	$curl = curl_init($url) ;
  	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");                                                                                                                                     
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);                                                                                                                                                                                                                            
  	$resp = curl_exec($curl) ;
  	
  	//  Output the results
  	if (!$resp) {die('Error : "'.curl_error($curl).'" - Code: '.curl_errno($curl)); }
  	curl_close($curl) ;	
  	
  	echo "<br><br>" ;
  	$question = json_decode($resp) ;
  	
  	$n = count($question) ;
  	for ($i=0; $i<$n; $i++) {
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
                    <a class=\"text-light\" href=\"GetQuestion/{$question[$i]-> qno}\">View Answers</a>
                </button>
            </div>
        </div>
        <br>";
    }
include("footer.php");
?>
