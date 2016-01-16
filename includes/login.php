<?php

session_start();
include("config.php");

//Almacenamos los post enviados desde el form en variables
$user = mysqli_real_escape_string($cdb, $_POST['userName']);
$password = mysqli_real_escape_string($cdb, $_POST['userPassword']);
//encriptamos la contraseña
$hash = sha1($password); 


//Ejecutamos la siguiente consulta para comprobar que el user y password coinciden en la misma fila de la bd
$query_login = mysqli_query($cdb, "SELECT * FROM ".$db_table." WHERE userName='".$user."' AND userPassword='".$hash."'");		


if(mysqli_num_rows($query_login) == 1) 
{
	
	$row = mysqli_fetch_assoc($query_login);
	//creamos las variables con los datos de la tabla
	$email = $row['email'];
	$user = $row['userName'];
	$password = $row['userPassword'];
	$info = $row['description'];
	$permissions = $row['permissionLevel'];

	//Creamos las sesiones para poder pasarlas entre páginas
	$_SESSION['email'] = $email;
	$_SESSION['user'] = $user;
	$_SESSION['description'] = $info;
	$_SESSION['level'] = $permissions;
	$_SESSION['pass'] = $password;
	//Volvemos al index
	header('Location: ../');
    exit;

} 
else 
{   
	//Si los datos introducidos no son correctos, lanzamos alert con aviso.
    echo '<script type="text/javascript">
    alert("Incorrect username or password..");
        window.location.href = "javascript:window.history.back();";
        </script>';
}


?>

