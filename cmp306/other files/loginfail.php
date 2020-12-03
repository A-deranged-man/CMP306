<!-- Whilst this is essentially a html page, I made it a .php so that I could add information from the header.php
and footer.php files -->
<?PHP
//This adds information from the header.php file
include("scripts/header.php");

?>

<div class="st-xlarge st-text-grey">
    Login Failed
</div>

<div class=" st-text-grey st-padding-64">
    Incorrect credentials entered. Please try again.
</div>

<?PHP
//This adds information from the file footer.php
include("scripts/footer.php");
?>