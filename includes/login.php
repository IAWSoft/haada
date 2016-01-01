<?php

session_start();

$user = $_POST['userName'];
$password = $_POST['userPassword'];
$hash = sha1($password); 

include("config.php");

$query_login = mysqli_query($cdb, "SELECT * FROM ".$db_table." WHERE userName='".$user."' AND userPassword='".$hash."'");		

if(mysqli_num_rows($query_login) == 1) 
{
	$row = mysqli_fetch_assoc($query_login);

	$email = $row['email'];
	$user = $row['userName'];
	$password = $row['userPassword'];
	$info = $row['description'];
	$permissions = $row['permissionLevel'];

	$_SESSION['email'] = $email;
	$_SESSION['user'] = $user;
	$_SESSION['description'] = $info;
	$_SESSION['level'] = $permissions;

	header('Location: ../');
    	exit;

} 
else 
{   

      echo '<script type="text/javascript">
        alert("Incorrect username or password..");
        window.location.href = "javascript:window.history.back();";
        </script>';
}


?>

