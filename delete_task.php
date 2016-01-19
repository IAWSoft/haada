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
	
	session_start();
	include ('includes/header.php'); 
	$permissions = $_SESSION['level'];
			
	if($permissions == 1)
	{
		
		 echo'
		 <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
			  <div class="modal-dialog size">
			    <div class="modal-content" style="min-width: 250px;">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title text-center" id="delete"><span><img src="images/logo_haada_trans_landscape.png" style="height: 30px;"></span></h4>
			      </div>
			      <div class="modal-body">
				     <div class="row center">
					<section class="posts col-md-12"> 
						<form action="" method="post" class="form-horizontal"> 
							<fieldset class="size2 text-center">
							    <div >
		         					   <h3> Are you sure? </h3> 
		         					   <br/>
								<a href="main.php" class="btn btn-primary">No</a>
					             <input type="submit" class="btn btn-danger" value="Yes, delete" name="Submit">
			        			</div>
							</fieldset>
						</form>
					</section>	
						
						<!-- contact form ends -->	
							</div>	
				        </div>
			      </div>
			    </div><!-- /.modal-content -->
			</div><!-- /.modal -->';
						
	}														    
				                   



// If the "add" button has been pressed, execute the following code.
if(isset($_POST['Submit'])) 
{	
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
}	
	 		
?>
<?php include ('includes/footer.html');?>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>

<?php
	 echo '<script type="text/javascript">
			 $(window).load(function() {
  				$("#delete").modal("show");
    		});
			 
			 </script>';

?>

</body>
</html>