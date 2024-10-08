<?php
include("header.php");
include("../model/api.php");

echo"<div class=\"container\">
        <!-- header row -->
        <div class=\"col-sm-12\">
            <div id=\"header\" class=\"st-xlarge st-text-grey\">
            Scripting Blog Block 4
            </div>
        <!-- Main Album -->
        <div class=\"album py-5\">
            <div class=\"container\">
                <div class=\"row\">";

    echo "
        <!-- Item Card 1 --> 
        <div class=\"col-md-4\">
            <div class=\"card mb-4 box-shadow\">
                <img class=\"card-img-top\" src=\"images/rss_feed_icon.png\" alt=\"RSS Feed\">
                <h5 class=\"card-title text-center\">RSS Feed (Dynamic)</h5>
                <div class=\"card-body\">
                    <p class=\"card-text\">This is a dynamic feed which is made from the six most recent items from Block 1</p>
                        <div class=\"d-flex justify-content-between align-items-center\">
                            <div class=\"btn-group d-flex\">
                                <button type=\"button\" class=\"btn btn-sm btn-outline-secondary\" 
                                  onclick=\"location.href='rss.php'\">
                                  Open RSS Feed
                                </button>
                            </div>
                        </div>
                </div>
            </div>
        </div>";

echo "
        <!-- Item Card 2 --> 
        <div class=\"col-md-4\">
            <div class=\"card mb-4 box-shadow\">
                <img class=\"card-img-top\" src=\"images/BBCW.jpg\" alt=\"Weather Feed\">
                <h5 class=\"card-title text-center\">BBC Weather Feed</h5>
                <div class=\"card-body\">
                    <p class=\"card-text\">This is a dynamic feed using XSLT to transform XML to HTML5</p>
                        <div class=\"d-flex justify-content-between align-items-center\">
                            <div class=\"btn-group d-flex\">
                                <button type=\"button\" class=\"btn btn-sm btn-outline-secondary\" 
                                  onclick=\"location.href='weather.php'\">
                                  Open Weather Feed
                                </button>
                            </div>
                        </div>
                </div>
            </div>
        </div>";

echo "
        <!-- Item Card 3 --> 
        <div class=\"col-md-4\">
            <div class=\"card mb-4 box-shadow\">
                <img class=\"card-img-top\" src=\"images/rest.png\" alt=\"REST API\">
                <h5 class=\"card-title text-center\">REST Web Services</h5>
                <div class=\"card-body\">
                    <p class=\"card-text\">This is a dynamic feed made from the six most recent 
                    questions from Block 2 with functionality to select a single question, using REST</p>
                        <div class=\"d-flex justify-content-between align-items-center\">
                            <div class=\"btn-group d-flex\">
                                <button type=\"button\" class=\"btn btn-sm btn-outline-secondary\" 
                                  onclick=\"location.href='GetAllQuestions'\">
                                  Open REST Questions
                                </button>
                            </div>
                        </div>
                </div>
            </div>
        </div>";

echo"            </div> <!-- row -->
           </div> <!-- container -->
        </div>
    </div>
</div>";

//This adds information from the file footer.php
include("footer.php");

