<?php

session_start();

$user = mysqli_real_escape_string($cdb, $_POST['user_name']);
$password = mysqli_real_escape_string($cdb, $_POST['user_Password']);
$hash = sha1($password); 

include("config.php");

$query_login = mysqli_query($cdb, "SELECT * FROM ".$db_table." WHERE user_name='".$usuario."' AND user_Password='".$hash."'");		


if(mysqli_num_rows($query_login) == 1) 
{
	$row = mysqli_fetch_assoc($query_login);

	$email = $row['email'];
	$user = $row['user_name'];
	$password = $row['user_Password'];
	$info = $row['informacion'];
	$permissions = $row['level'];

	$_SESSION['email'] = $email;
	$_SESSION['user'] = $user;
	$_SESSION['informacion'] = $info;
	$_SESSION['level'] = $permissions;

	header('Location: ../');
    	exit;

} 
else 
{   
        echo '<script type="text/javascript">
        alert("Los datos introducidos son inconrrectos, vuelva a intentarlo.");
        window.location.href = "javascript:window.history.back();";
        </script>';
}


?>

