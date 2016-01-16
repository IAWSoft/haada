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
        <h2 class="text-center"><b>Welcome to HAADA!</b></h2>
        <h4 class="text-center">
          HAADA is a tasks and incidents manager. This tool will help you to organize your tasks and incidents.<br/>
        </h4>
        <p class="text-center">
          You will have a root user who can see the whole tasks and incidents. This root user will create new standard users who will be able to add tasks and incidents.
        </p>
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
</body>
</html>