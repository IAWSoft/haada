<!DOCTYPE html>
<html>
<head>
		
	<meta  charset="utf-8">
  <title>Haada IAW</title>
  
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/estilos.css">
  <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <?php
  session_start();
    include("includes/header.php");
    include("includes/config.php");
  ?> 

  <?php
  if(isset($_SESSION['user']))
  {
    
     $permissions = $_SESSION['level'];
	    // If user has root permission:
    if($permissions == 1)
    {

          $query_task = mysqli_query($cdb, "SELECT t.taskId, t.taskName, t.creationDate, t.status, t.categoryId, t.department, t.startDate, t.finishDate, s.statusName, c.categoryName,t.description, t.information, u.userName, d.departmentName
                        from ((((tasks as t inner join category as c 
                        on t.categoryId = c.categoryId)
                        inner join department as d
                        on t.department = d.departmentId)
                        inner join status as s 
                        on t.status = s.statusId)
                        inner join users as u
                        on t.userId = u.userId)
                        where status='1' 
                        order by t.taskId desc"); // Execute the query
          
          echo '<table border="1">
                  <thead>
                    <tr>
                    <th>Name</th>
                    <th class="date">Creation Date</th>
                    <th>Finish Date</th>
                    <th>Status</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Information</th>
                    <th>User</th>
                    <th>Department</th>
                    <th id="optionCell">Options</th>
                    </tr>
                    </thead>';
          
          while($row = mysqli_fetch_assoc($query_task))
          {
              echo' <tr>
                        <td>'.$row["taskName"].'</td>
                        <td class="date">'.$row["creationDate"].'</td>
                        <td>'.$row["finishDate"].'</td>
                        <td>'.$row["statusName"].'</td>
                        <td>'.$row["categoryName"].'</td>
                        <td>'.$row["description"].'</td>
                        <td>'.$row["information"].'</td>
                        <td>'.$row["userName"].'</td>
                        <td>'.$row["departmentName"].'</td>
                        <td id="option"><a class="iconcolor" href="edit_task.php?task='.$row["taskId"].'"><i class="fa fa-pencil fa-2x"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                        <a class="iconcolor" href="delete_task.php?task='.$row["taskId"].'"><b><i class="fa fa-trash fa-2x"></i></b></a></td>
                      </tr>
                    '; 
          }
          echo '</table>';
    }
    else
    {
    	header("location: ./");
    }      
  }
  else
  {
    echo '<script type="text/javascript">
              alert("You do not have permission to view this page.");
          </script>';
  }
  ?>       

    
  <?php    
    include("includes/flogin.html");
    include("includes/contact.html");
    include("includes/footer.html");

  ?> 
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src="js/prefixfree.min.js"></script>
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>