<?php
//This adds information from the header.php file
include("header.php");
?>
    <div class="col-sm-12">
        <div id="header" class="st-xlarge st-text-grey">
            Create An Employee
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
		<form action="../controller/createemployeerec.php" method="post">
            <p>Employee Number:
                <br>
                <input type="text" name="eno" value="" placeholder="N111111" size="7" maxlength="7" required>
            </p>
			<p>Employee Name:
                <br>
                <input type="text" name="ename" value="" placeholder="John Doe" size="30" maxlength="30" required>
            </p>
			<p>Employee Job:
                <br>
                <input type="text" name="ejob" value="" placeholder="Lecturer" size="30" maxlength="30" required>
            </p>
			<p>Employee Department:
                <br>
                <input type="text" name="edepartment" value="" placeholder="Computing" size="30" maxlength="30" required>
            </p>
            <p>Room Number:
                <br>
                <input type="text" name="eroom" value="" placeholder="3309" size="30" maxlength="30" required>
            </p>
            <p>Phone Number:
                <br>
                <input type="text" name="ephone" value="" placeholder="0087" size="30" maxlength="30" required>
            </p>
			<p>E-Mail:
                <br>
                <input type="text" name="eemail" value="" placeholder="j.doe@abertay.ac.uk" size="30" maxlength="30" required>
            </p>
			<input type="submit"><br>
		</form>
    </div>
<?php
//This adds information from the file footer.php
include("footer.php");
?>