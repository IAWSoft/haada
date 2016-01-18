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

    include("includes/header.php");

  ?> 
<section class="main container">
	<div class="row centered">
		<section class="posts col-md-12">	
			<article class="post clearfix">
			  <br/>
			  <!-- Use this? 
        <h2 class="text-center"><b>Welcome to <span><img src="../images/logo_haada_trans_landscape.png" style="height: 23px;"></span>!</b></h2> -->
        <!-- Or this? -->
        <h2 class="text-center"> <span><img class="img-thumbnail imgAju" src="../images/logo_haada_trans_landscape.png"></span></h2>
        <h4 class="text-center">
          </br>HAADA is a new generation tool created to help you keep track of the problems that come up in your organization. </br>You can use it to create and manage incidences using a ticket system.<br/></br>
        </h4>
        <p class="text-center">Register and contact us to make you your organization administrator, and then you can manage your organization users yourself.</br>
          As an administrator, you will have access to the whole set of features. Your subordinates can create new tickets and keep track of them.</p>
      </article>
    </section>  
  </div>
</section>  
    
  <?php  
    
    include("includes/flogin.html");
    include("includes/contact.html");
    include("includes/footer.html");
    

  ?> 
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
<?php  

  //Comprobamos si existe la cookie login, si esta existe se carga autimaticamente el modal de login 
	if(isset($_COOKIE['login'])) 
	{
    echo '<script type="text/javascript">
			 $(window).load(function() {
    
  				$("#myModalLogin").modal("show");
    		});
			 </script>';
  }
  
  include("includes/tickets.php");
  
 	if(isset($_COOKIE['tickets'])) 
	{ 
			 echo '<script type="text/javascript">
			 $(window).load(function() {
  				$("#dialog").modal("show");
    		});
			 
			 </script>';

	} 				
?>  
  
</body>
</html>