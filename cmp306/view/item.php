<?php
include("header.php");
include("../model/api.php");

$id = $_GET['item_page_id'];

$additional_image_txt = getAdditionalItemImages($id);
$additional_image = json_decode($additional_image_txt);

$itemtxt = getItemById($id) ;
$item = json_decode($itemtxt) ;

    echo " <div class=\"container\">
            <div class=\"row\">
                <div class=\"col-lg-8\">
                <!-- Item {$item-> item_page_id} -->
                    <div class=\"st-xlarge st-text-grey\">
                        {$item-> title}
                    </div>
                    <br>
                    <div class=\"st-row\">
                        <h4 align=\"left\">{$item-> header}</h4>
                        <p>Written by {$item-> auth_name} on {$item-> date_published}</p>
                        <p align=\"left\">{$item-> description}</p>
                    </div>
                    <div class=\"card my-5\">
                        <h5 class=\"card-header\">Additional Links</h5>
                        <div class=\"card-body\">
                            <div class=\"row\">
                                <div class=\"col-lg-9\">
                                    <ul class=\"list-unstyled\">
                                        <li><a href=\"article.php?article_id={$item-> article_id}\">
                                                View the full article on DB Software</a></li>
                                        <li><a href=\"{$item-> source_link}\">
                                                See the original article from {$item-> source_name}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=\"col-md-4\">
                    <img class=\"img-responsive\" src=\"images/{$item-> image_name}\"
                         style=\"padding-left: 20px; padding-bottom: 20px;\" align=\"right\" alt=\"{$item-> image_alt}\"/>
                    <img class=\"img-responsive\" src=\"images/{$additional_image-> image_name}\"
                         style=\"padding-left: 20px;\" align=\"right\" alt=\"{$additional_image-> image_alt}\"/>
                </div>
            </div>
        </div>";

include("footer.php");
