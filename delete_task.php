<!DOCTYPE html>
<html>
<head>
        
    <meta  charset="utf-8">
    <title>Haada IAW</title>
  
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet"/>

</head>
<body>
<?php


$page_title = 'delete_task';
include ('includes/header.php'); ?>

<?php	

	require ('includes/config.php');

//comprobamos que existe un usuario logeado, de esta forma evitamos que se pueda acceder a esta página
if(isset($_SESSION['user']))
{
    $permissions = $_SESSION['level'];
	//If user have permission 1	
	if($permissions == 1)
	{	
        $taskId = $_GET['task']; //captacion de datos
    	$sSQL = "delete from tasks where taskId='$taskId'";	// sentencia SQL
    	$r = mysqli_query ($cdb, $sSQL);   
     		mysqli_close($cdb);
     		
                echo '<script type="text/javascript">
                alert("Task Eliminated");
            window.location.href ="main.php";
                </script>';//refresco de pagina
	}
    else
    {
         header("location: ./");
    }
}
else
{
     header("location: ./");
}
 		
?>
<?php include ('includes/footer.html');?>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>