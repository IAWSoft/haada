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
// i will implement, at the moment of delete answer yes or not. in process
	require ('includes/config.php');

//control of ssesion
if(isset($_SESSION['user']))
{
    $permissions = $_SESSION['level'];
	//If user have permission 1	
	if($permissions == 1)
	{	
        $taskId = $_GET['task']; //get data
    	$sSQL = "delete from tasks where taskId='$taskId'";	// SQL Sentence
    	$r = mysqli_query ($cdb, $sSQL);   
     		mysqli_close($cdb);
     		
                echo '<script type="text/javascript">
                alert("Task Eliminated");
            window.location.href ="main.php";
                </script>';//refresh page
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