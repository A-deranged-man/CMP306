<?php
//This adds information from the header.php file
include("header.php");
?>
    <div class="col-sm-12">
        <div id="header" class="st-xlarge st-text-grey">
            Display All Employees
        </div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Options</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="displayall.php">Display All Employees</a>
                    <a class="nav-item nav-link" href="createemployee.php">Create Another Employee</a>
                </div>
            </div>
        </nav>
        <br>
	<?php
		include("../model/api.php");
		$employeetxt = getAllEmployees() ;
		$employee = json_decode($employeetxt) ;
		for ($i=0, $iMax = count($employee); $i< $iMax; $i++) {
			echo "Employee : " ;
			echo "<a href=displayemployee.php?id=" ;
			echo $employee[$i] -> eno ;
			echo ">" ;
			echo $employee[$i] -> ename ;
			echo "</a><br/>" ;
		}?>
    </div>
<?php
//This adds information from the file footer.php
include("footer.php");
?>