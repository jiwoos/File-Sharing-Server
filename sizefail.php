<!DOCTYPE HTML>
<html lang=en>

<head>
	<title> fail </title>
	<style>
		body {
			background-color: rgb(146, 168, 209);
			display: flex;
			flex-direction: column;
		}

		h1 {
			align-items: center;
			text-align: center;
			color: rgb(245, 195, 194);
		}

		p {
			display: block;
			font-size: 2em;
			text-align: right;
			font-weight: bolder;
			color: rgb(245, 195, 194);
		}

		form {
			text-align: center;
			align-items: center;
		}
	</style>
</head>
<?php
session_start();
//if someone tries to access without logging-in, it redirects to the login page
if ($_SESSION['session'] != true) {
	header("Location: login.php");
}



//'upload files' button redirects to the uploader.php
if (isset($_POST["upload"])) {
	header("Location: uploader.php");
}
//'view files' button redirects to the viewfile.php
if (isset($_POST["view"])) {
	header("Location: viewfile.php");
}
//'log out' button directs to the view file.php
if (isset($_POST["logout"])) {
	header("Location: logout.php");
}


?>




<body>
	<p>
		<?php
		//setting up the date that is being displayed on the top-right corner
		date_default_timezone_set("America/Chicago");
		echo date("F  j  Y");
		echo "<br>";
		echo date('l');

		?> </p>
	<h1> sorry, <br> the size of the file is too large</h1>
	<form action="sizefail.php" method="post">
		<input name="upload" type="submit" value="upload files">
		<input name="view" type="submit" value="view files">
		<input name="logout" type="submit" value="Log out"> </form>

</body>

</html>