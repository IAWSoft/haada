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
  ?> 

  <?php
 if(isset($_SESSION['user']))
{
    $permissions = $_SESSION['level'];
	// If user has root privileges:
	if($permissions == 1)
	{
	  
    include("includes/config.php");
          $query_task = mysqli_query($cdb, "SELECT t.taskId, t.taskName, t.creationDate, t.status, t.categoryId, t.department, t.startDate, t.finishDate, s.statusName, c.categoryName,t.description, t.information, u.userName, d.departmentName
                        from ((((tasks as t inner join category as c 
                        on t.categoryId = c.categoryId)
                        inner join department as d
                        on t.department = d.departmentId)
                        inner join status as s 
                        on t.status = s.statusId)
                        inner join users as u
                        on t.userId = u.userId) order by t.taskId desc"); // Execute the query
          
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
                      </tr>
                    '; 
          }
          echo '</table>';
          
        }else {
          
          $user = $_SESSION['user'];
          include("includes/config.php");
          
          $query_task2 = mysqli_query($cdb, "SELECT t.taskId, t.taskName, t.creationDate, t.status, t.categoryId, t.department, t.startDate, t.finishDate, s.statusName, c.categoryName,t.description, t.information, u.userName, d.departmentName
                        from ((((tasks as t inner join category as c 
                        on t.categoryId = c.categoryId)
                        inner join department as d
                        on t.department = d.departmentId)
                        inner join status as s 
                        on t.status = s.statusId)
                        inner join users as u
                        on t.userId = u.userId)
                        WHERE userName ='".$user."'"); // Execute the query
          
          echo '<table border="1">
                  <thead>
                    <tr>
                    <th>Name</th>
                    <th>Creation Date</th>
                    <th>Finish Date</th>
                    <th>Status</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Information</th>
                    <th>User</th>
                    <th>Department</th>
                    </tr>
                    </thead>';
          if(mysqli_num_rows($query_task2) != 0)
          {
          while($row2 = mysqli_fetch_assoc($query_task2))
          {
              echo' <tr>
                        <td>'.$row2["taskName"].'</td>
                        <td>'.$row2["creationDate"].'</td>
                        <td>'.$row2["finishDate"].'</td>
                        <td>'.$row2["statusName"].'</td>
                        <td>'.$row2["categoryName"].'</td>
                        <td>'.$row2["description"].'</td>
                        <td>'.$row2["information"].'</td>
                        <td>'.$row2["userName"].'</td>
                        <td>'.$row2["departmentName"].'</td>
                      </tr>
                    '; 
          }
          }
          echo '</table>';
        }
}
  ?>
    
  <?php    
    include("includes/flogin.html");
    include("includes/contact.html");
    include("includes/footer.html");
  ?>
  <script src="js/prefixfree.min.js"></script>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>