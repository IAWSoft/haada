 <script src="../js/jquery.js"></script>
 <script type="text/javascript" src="../js/bootstrap.min.js"></script>
 
<?php

session_start();
include("config.php");
//Creamos la cookie login por si el usuario se equivoca con el user o pass, para que al regresar al index salte de nuevo el modal de login.
setcookie("login", "login", time()+60*60*24*365,"/");

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
	$userId = $row['userId'];

	//Creamos las sesiones para poder pasarlas entre páginas
	$_SESSION['email'] = $email;
	$_SESSION['user'] = $user;
	$_SESSION['description'] = $info;
	$_SESSION['level'] = $permissions;
	$_SESSION['pass'] = $password;
	$_SESSION['userId'] = $userId;
	
	
	if($permissions == 1)
	{
		//Si el usuario es admin, hacemos una consulta de cuantos tickets abiertos hay
		$query_tickets = mysqli_query($cdb, "SELECT * FROM ".$db_table4." WHERE status='1' ");
		//Contamos los tickets abiertos y los almacenamos en una variable
		$tickets = mysqli_num_rows($query_tickets);
		//Creamos una cookie "tickets" con una duración de 5 segundos para que al logearse salte una ventana modal con el aviso de cuantos hay abiertos
		setcookie("tickets", $tickets, time()+05*01*01*001,"/");
		
	}
	
	//Volvemos al index y destruimos la cookie login
	setcookie("login", '', time()-60*60*24*365,"/");
	header('Location: ../');
    exit;

} 
else 
{   
	//Si los datos introducidos no son correctos, lanzamos alert con aviso y volvemos al index donde se vuelve a cargar la ventana modal de login.

            echo '<script type="text/javascript">
			window.alert("User o password error.");   
    		$("document").ready(function(){
    		history.back();
    		});
			</script>';

		
}


?>

