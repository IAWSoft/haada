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
				$userId = $_SESSION['userId'];
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
							<input type="hidden" name="user" value="'. $userId. '">
							<input type="submit" value="Create">
							</form>
						</div>';

			}

			// If the user pushes the "Create" button, this tries to insert it into the database:
			if ($_SERVER['REQUEST_METHOD'] == 'POST')
			{
				// Database connection and error array:
				require('includes/config.php');
				$errors = array();

				// Check if there is a task name:
				if (empty($_POST['taskName']))
				{
					$errors[] = 'You have to introduce a task name.';
				}
				else
				{
					$n = mysqli_real_escape_string($cdb, trim($_POST['taskName']));
				}

				// Check if there is a category ID:
				if(empty($_POST['category']))
				{
					$errors[] = 'You have to select a category.';
				}
				else
				{
					$c = mysqli_real_escape_string($cdb, trim($_POST['category']));
				}

				// This saves the description into a variable, without check, as it is not mandatory.
				$d = mysqli_real_escape_string($cdb, trim($_POST['description']));

				// This saves the userId into a variable:
				$u = mysqli_real_escape_string($cdb, trim($_POST['userId']));

				// And this checks if there is a department ID:
				if(empty($_POST['department']))
				{
					$errors[] = 'You have to select a department.';
				}
				else
				{
					$dep = mysqli_real_escape_string($cdb, trim($_POST['department']));
				}

				// If there are no errors, this sends the query to register the new task:
				if(empty($errors))
				{
					// This is the query:
					$q = "insert into tasks (taskName, creationDate, status, categoryId, description, userId, department)
							values ($n, getDate(), 1, $c, $d, $u, $dep)";
					$r = mysqli_query($cdb, $q);

					// Checks if everything went ok registering the data:
					if ($r)
					{
						echo '<h3>Okay!</h3><p>You have registered the task!</p>';
					}
					else
					{
						echo '<h1>System Error</h1>
                        <p class="error">The query could not be registered due to a system error. Sorry for the inconvenience</p>';
		                
		                echo '<p>' . mysqli_error($cdb) . '<br /><br />Query: ' . $q . '</p>';
					}

					mysqli_close($cdb);
				}


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