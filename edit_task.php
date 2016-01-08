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
        include("includes/header.php");
    ?> 

<?php
//comprobamos que existe un usuario logeado, de esta forma evitamos que se pueda acceder a esta página
if(isset($_SESSION['user']))
{
    $permissions = $_SESSION['level'];
	//If user have permission 1	
	if($permissions == 1)
	{
        //Creamos el formulario el edit_task
    
        $taskId = $_GET['task'];
        include("includes/config.php"); 
            $innerJoin = "SELECT t.taskId, t.taskName, t.creationDate, t.status, t.categoryId, t.department, t.startDate, t.finishDate, s.statusName, c.categoryName,t.description, t.information, u.userName, d.departmentName
                        from ((((tasks as t inner join category as c 
                        on t.categoryId = c.categoryId)
                        inner join department as d
                        on t.department = d.departmentId)
                        inner join status as s 
                        on t.status = s.statusId)
                        inner join users as u
                        on t.userId = u.userId)
                        WHERE taskId =".$taskId." LIMIT 1";
    
        $query_task = mysqli_query($cdb, $innerJoin);
    
        while($row = mysqli_fetch_assoc($query_task))
        {
                    echo '
                    <section class="main container">
                            <div class="row centered">
                                <section class="posts col-md-12">   
                                    <article class="post clearfix">
                                        <div class="well">
                                            <form class="form-horizontal " action="" method="post">
                                                <div class="form-group">
                                                    <label class="control-label col-xs-2">Task Name:</label>
                                                        <div class="col-xs-9">
                                                            <p type="text" class="form-control" name="taskName">'.$row['taskName'].'</p>
                                                        </div>
                                                </div>        
                                                <div class="form-group">
                                                    <label class="control-label col-xs-2">Start Date:</label>
                                                      <div class="col-xs-9">
                                                               <input type="date" class="form-control" placeholder="AAAA-MM-DD"  name="startDate">
                                                        </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-xs-2">Finish Date:</label>
                                                      <div class="col-xs-9">
                                                               <input type="date" class="form-control" placeholder="AAAA-MM-DD"  name="finishDate">
                                                        </div>
                                                </div>
                                               <div class="form-group">           
                                                    <label class="control-label col-xs-2">status:</label>
                                                        <div class="col-xs-9">
                                                            <select class="form-control" name="status">
                                                                 <option value="'.$row['status'].'">'.$row['statusName'].'</option>';
                                                                    $query_status = mysqli_query($cdb, "SELECT * FROM ".$db_table3." ORDER BY statusId asc");
                                                                    while($row2 = mysqli_fetch_assoc($query_status))
                                                                    {
                                                                        echo ' <option value="'.$row2['statusId'].'">'.$row2['statusName'].'</option>';
                                                                    } 
                                                        echo'
                                                            </select>
                                                        </div>
                                                </div>  
                                                <div class="form-group">           
                                                    <label class="control-label col-xs-2">Category:</label>
                                                        <div class="col-xs-9">
                                                            <select class="form-control" name="category">
                                                                 <option value="'.$row['categoryId'].'">'.$row['categoryName'].'</option>';
                                                                    $query_category = mysqli_query($cdb, "SELECT * FROM ".$db_table1." ORDER BY categoryId asc");
                                                                    while($row1 = mysqli_fetch_assoc($query_category))
                                                                    {
                                                                        echo ' <option value="'.$row1['categoryId'].'">'.$row1['categoryName'].'</option>';
                                                                    } 
                                                        echo'
                                                            </select>
                                                        </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-xs-2">Description:</label>
                                                        <div class="col-xs-9">
                                                            <p type="text" class="form-control" name="description">'.$row['description'].'</p>
                                                        </div>
                                                </div>
                                                 <div class="form-group">
                                                    <label class="control-label col-xs-2">information:</label>
                                                        <div class="col-xs-9">
                                                            <textarea type="text" class="form-control" name="information">'.$row['information'].'</textarea>
                                                        </div>
                                                </div>
                                                 <div class="form-group">
                                                    <label class="control-label col-xs-2">User creator:</label>
                                                        <div class="col-xs-9">
                                                            <p type="text" class="form-control" name="user">'.$row['userName'].'</p>
                                                        </div>
                                                </div>
                                                <div class="form-group">           
                                                    <label class="control-label col-xs-2">department:</label>
                                                        <div class="col-xs-9">
                                                            <select class="form-control" name="department">
                                                                 <option value="'.$row['department'].'">'.$row['departmentName'].'</option>';
                                                                    $query_depart = mysqli_query($cdb, "SELECT * FROM ".$db_table2." ");
                                                                    while($row0 = mysqli_fetch_assoc($query_depart))
                                                                    {
                                                                        echo ' <option value="'.$row0['departmentId'].'">'.$row0['departmentName'].'</option>';
                                                                    } 
                                                        echo'
                                                            </select>
                                                        </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-xs-2">Date create incident:</label>
                                                        <div class="col-xs-9">
                                                            <p type="text" class="form-control" name="creationDate">'.$row['creationDate'].'</p>
                                                        </div>
                                                </div>
                                                <div class="col-sm-offset-4 col-sm-8">
                                                    <button type="submit"  name="submit" value="Submit" class="form-group btn btn-success">Submit</button>
                                                </div>
    
                                            </form>
                                          </div>
                                    </article>
                                </section>  
                            </div>
                        </section>';
        }
        // Si el boton de "añadir" fué presionado ejecuta el resto del código   
        if(isset($_POST['submit'])) 
        {
            include("includes/config.php");
            $taskId = $_GET['task'];
            $startDate = $_POST['startDate'];
            $finishDate = $_POST['finishDate'];
            $status = $_POST['status'];
            $category = $_POST['category'];
            $information = $_POST['information'];
            $department = $_POST['department'];
            
            $query_update = mysqli_query($cdb, "UPDATE ".$db_table4." SET  startDate='".$startDate."', finishDate='".$finishDate."', status='".$status."', categoryId='".$category."', information='".$information."', department='".$department."' WHERE tasks.taskId = '".$taskId."' ");
    
            if($query_update)
            {
                //Si los datos introducidos son correctos, lanzamos alert con aviso.
                echo '<script type="text/javascript">
                alert("Task update");
                window.location.href ="main.php";
                </script>';
            }
            else
            {
                //Si los datos introducidos no son correctos, lanzamos alert con aviso.
                echo '<script type="text/javascript">
                alert("Task update: ERROR");
                window.location.href ="javascript:window.history.back();";
                </script>';
            }    
        }
	}
	//if user no have level 1, retunr to index.
	else 
	
	                
            {
                //Si los datos introducidos no son correctos, lanzamos alert con aviso.
                echo '<script type="text/javascript">
                alert("Task update: ERROR");
                window.location.href ="javascript:window.history.back();";
                </script>';
            } 
	}

//Si no se está logeado, devolvemos al usuario al index
else
{
     header("location: ./");
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