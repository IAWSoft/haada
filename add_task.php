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
				$user = $_SESSION['user'];
				// Anyone can add new tasks or incidences, so there's no need to check for the permission level.
				// The form to add a new task is created now:
				echo '
				<div>
					<form action="" method="post">
						<p>Task Name: <input type="text" name="taskName"></p>
						<p>Category: <span><select name="category">';

						require("includes/config.php");
						// This is going to print the options for the different categories:
						$q = "SELECT categoryId,categoryName from category";
						$r = mysqli_query($cdb, $q);

						while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC))
						{
							echo '<option value="'. $row['categoryId'] . '">' . $row['categoryName'] . '</option>';
						}

						echo '</select></span></p>
						<p>Description: <textarea name="description"></textarea></p>
						<p>Department: <span><select name="department">';

						// This is going to print the options for the different departments:
						$q2 = "SELECT departmentId,departmentName from department";
						$r2 = mysqli_query($cdb, $q2);

						while ($row = mysqli_fetch_array($r2, MYSQLI_ASSOC))
						{
							echo '<option value="'. $row['departmentId'] . '">' . $row['departmentName'] . '</option>';
						}

						echo '</select></span></p>
							<input type="submit" value="Create">
							</form>
						</div>';

			}
		?>

		<?php
			// This includes the login form, the contact info and the footer:
			include("includes/flogin.html");
			include("includes/contact.html");
			include("includes/footer.html");
		?>
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>