<?php
include("header.php");
include("../model/api.php");

$article_id = $_GET['article_id'];
$articletxt = getArticleById($article_id);
$article = json_decode($articletxt) ;

echo " <div class=\"container\">
            <div class=\"row\">
                <div class=\"col-lg-8\">
                <!-- Item {$article-> item_page_id} -->
                    <div class=\"st-xlarge st-text-grey\">
                        {$article-> title}
                    </div>
                    <br>
                    <div class=\"st-row\">
                        <h4 align=\"left\">{$article-> header}</h4>
                        <p>Written by {$article-> auth_name} on {$article-> date_published}</p>
                        <p align=\"left\">{$article-> description}</p>
                    </div>
                    <div class=\"card my-5\">
                        <h5 class=\"card-header\">Additional Links</h5>
                        <div class=\"card-body\">
                            <div class=\"row\">
                                <div class=\"col-lg-9\">
                                <div class=\"btn-group d-flex\">
                                <button type=\"button\" class=\"btn btn-sm btn-outline-secondary\" 
                                onclick=\"location.href='items.php'\">
                                  Return to Item Grid View</button></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=\"col-md-4\">
                    <img class=\"img-responsive\" src=\"images/{$article-> image_name}\"
                         style=\"padding-left: 20px; padding-bottom: 20px;\" align=\"right\" alt=\"{$article-> image_alt}\"/>
                </div>
            </div>
        </div>";

include("footer.php");
?>