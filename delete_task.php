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

// Session control:
if(isset($_SESSION['user']))
{
    $permissions = $_SESSION['level'];
	// If user has level 1 privileges:
	if($permissions == 1)
	
	{	
        $taskId = $_GET['task']; // Get data
    	$sSQL = "delete from tasks where taskId='$taskId'";	// SQL Sentence
    	$r = mysqli_query ($cdb, $sSQL);   
     		mysqli_close($cdb);
     		
                echo '<script type="text/javascript">
                alert("Task Eliminated");
            window.location.href ="main.php";
                </script>'; // Refresh page
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