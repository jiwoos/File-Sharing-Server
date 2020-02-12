<?php
session_start();
//if someone tries to access by manipulating URL, s/he is redirected to the login page
if ($_SESSION['add'] != true) {
	header("Location: login.php");
}
//user is directed to the adding user process page 
if (isset($_POST["add"])) {
	$_SESSION['add'] = true;
	header("Location: addingUserPro.php");
}
//user is redirected to the login page 
if (isset($_POST["login"])) {
	header("Location: login.php");
}
?>



<!DOCTYPE HTML>
<html lang=en>

<head>
	<title> add User? </title>
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
			align-items: center;
			text-align: center;
		}
	</style>
</head>

<body>
	<p>
		<?php
		//setting up the timezone on the upper right corner
		date_default_timezone_set("America/Chicago");
		echo date("F  j  Y");
		echo "<br>";
		echo date('l');

		?> </p>
	<h1> username was invalid. <br> do you want to add a new user?</h1>
	<form action="addUser.php" method="post">
		<input name="add" type="submit" value="yes">
		<input name="login" type="submit" value="Go back to the login page"> </form>

</body>

</html>