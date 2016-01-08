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

  <?php
  include("includes/config.php");
          $query_task = mysqli_query($cdb, "SELECT * FROM ".$db_table4."  where status=1");// Ejecutamos la consulta
          
          while($row = mysqli_fetch_assoc($query_task))
          {
             echo '
             <section class="main container">
              <div class="row centered">
                <section class="posts col-md-12"> 
                  <article class="post clearfix">
                    <p>'.$row["taskName"].'</p>
                    <br/>
                    <a href="edit_task.php?task='.$row["taskId"].'">Edit task</a>
                    <br/>
                    <a href="delete_task.php?task='.$row["taskId"].'">Delete task</a>
      
                  </artcle>
                </section>  
              </div>
            </section> '; 
          }
  ?>      

    
  <?php    
    include("includes/flogin.html");
    include("includes/contact.html");
    include("includes/footer.html");

  ?> 
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>