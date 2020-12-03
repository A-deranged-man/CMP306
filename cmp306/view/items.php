<?php
//connect to the database
//This adds information from the header.php file
include("header.php");
include("../model/api.php");

echo"<div class=\"container\">
        <!-- header row -->
        <div class=\"col-sm-12\">
            <div id=\"header\" class=\"st-xlarge st-text-grey\">
            Items & Linked Articles
            </div>
        <!-- Main Album -->
        <div class=\"album py-5\">
            <div class=\"container\">
                <div class=\"row\">";

$gridtxt = displaygridview() ;
$grid = json_decode($gridtxt) ;
for ($i=0, $iMax = count($grid); $i< $iMax; $i++) {
    echo "
        <!-- Item Card {$grid[$i] -> item_id} --> 
        <div class=\"col-md-4\">
            <div class=\"card mb-4 box-shadow\">
                <img class=\"card-img-top\" src=\"images/{$grid[$i] -> image_name}\" alt=\"{$grid[$i] -> image_alt}\">
                <h5 class=\"card-title text-center\">{$grid[$i] -> title}</h5>
                <div class=\"card-body\">
                    <p class=\"card-text\">{$grid[$i] -> short_description}</p>
                        <div class=\"d-flex justify-content-between align-items-center\">
                            <div class=\"btn-group d-flex\">
                                <button type=\"button\" class=\"btn btn-sm btn-outline-secondary\" 
                                  onclick=\"location.href='item.php?item_page_id={$grid[$i] -> item_page_id}'\">
                                  More Information
                                </button>
                            </div>
                        </div>
                </div>
            </div>
        </div>" ;
}
echo"            </div> <!-- row -->
           </div> <!-- container -->
        </div>
    </div>
</div>";

//This adds information from the file footer.php
include("footer.php");

