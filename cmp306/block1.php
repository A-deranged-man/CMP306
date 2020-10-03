<?php
//connect to the database
//This adds information from the header.php file
require_once("scripts/DBController.php");
$db_handle = new DBController();
include("scripts/header.php");
?>
<div class="container">
    <!-- header row -->
    <div class="col-sm-12">
    <div id="header" class="st-xlarge st-text-grey">
        <h1>Block 1 Articles</h1>
    </div>
        <!-- Main Album -->
        <div class="album py-5">
            <div class="container">
                <div class="row">
<?php
$result = $db_handle->runQuery("SELECT item_id, article_id, title, short_description, image_name FROM item");
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc())
    { ?>
                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                            <img class="card-img-top" img="" src="images/<?php echo $row["image_name"]; ?>" onclick="location.href='#'" alt="Image">
                            <h5 class="card-title text-center"><?php echo $row["title"]; ?></h5>
                            <div class="card-body">
                                <p class="card-text"><?php echo $row["short_description"]; ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group d-flex">
                                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="location.href='#'">Full Article</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<?php
    }
}
?>
                </div> <!-- row -->
            </div> <!-- container -->
<?php
//This adds information from the file footer.php
include("scripts/footer.php");
?>
