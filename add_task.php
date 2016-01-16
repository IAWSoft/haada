<!DOCTYPE html>
<html>
	<head>
		<title>Haada IAW</title>
		<meta charset="utf-8">

		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/estilos.css">
		<link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css">		
	</head>

	<body>
		<?php
			// This includes the header:			
			include("includes/header.php");
		?>

		<?php
			// This checks if there is a user logged in:
			if(isset($_SESSION['user']))
			{
				// Anyone can add new tasks or incidences, so there's no need to check for the permission level.
				// The form to add a new task is created now:
				echo '<p> Prueba </p>';

			}
		?>

		<?php
			This includes the login form, the contact info and the footer:
			include("includes/flogin.html");
			include("includes/contact.html");
			include("includes/footer.html");
		?>
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>