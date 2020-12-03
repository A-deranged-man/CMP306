<?php
include("header.php");

$browser=get_browser();

echo "
<div class=\"st-xlarge st-text-grey\">
Browser Information Help Page
</div>

<p>This page will provide you with diagnostic information about your web browser.</p>
<p>If you have problems accessing features on our site, use information on this page when talking to our technicians 
to help them resolve your issues.</p>";

foreach($browser as $key => $value){
    echo "[$key]=>$value</br>";
}

if(($browser->browser) == "Chrome"){
    echo "</br>This is the $browser->browser_maker Chrome browser running on the $browser->platform"." Operating System</br>";
}
else{
    echo "</br>This is the $browser->browser_maker $browser->browser browser running on the $browser->platform"." Operating System</br>";
}

include("footer.php");