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
	//If user have root permission
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
                        on t.userId = u.userId)");//Execute the query
          
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
          
          while($row = mysqli_fetch_assoc($query_task))
          {
              echo' <tr>
                        <td>'.$row["taskName"].'</td>
                        <td>'.$row["creationDate"].'</td>
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
                        WHERE userName ='".$user."'");//Execute the query
          
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

  $url = "http://haada-habibi.c9users.io";
  include("includes/config.php");
          $query_task = mysqli_query($cdb, "SELECT t.taskId, t.taskName, t.creationDate, t.status, t.categoryId, t.department, t.startDate, t.finishDate, s.statusName, c.categoryName,t.description, t.information, u.userName, d.departmentName
                        from ((((tasks as t inner join category as c 
                        on t.categoryId = c.categoryId)
                        inner join department as d
                        on t.department = d.departmentId)
                        inner join status as s 
                        on t.status = s.statusId)
                        inner join users as u
                        on t.userId = u.userId)");
    
    $totalincidencias = mysqli_num_rows($query_task);
 
if($total_registros > 0)
{   

    //Limit the search
    $incidencia_pagina = 1;
    $pagina = false;
    
    //Inspect the page to show and the register beginning to show
    if (isset($_GET["pagina"]))
   
      $pagina = $_GET("pagina");
      if(!$pagina)
      {
        $inicio = 0;
        $pagina = 1;
      }
      else
      {
        $inicio = ($pagina - 1) * $incidencia_pagina;
      }
    
    
    //Total pages calculation
    $total_paginas = ceil($totalincidencias / $incidencia_pagina);
    
    //Query that will be different at every page
    $consulta = "SELECT t.taskId, t.taskName, t.creationDate, t.status, t.categoryId, t.department, t.startDate, t.finishDate, s.statusName, c.categoryName,t.description, t.information, u.userName, d.departmentName
                        from ((((tasks as t inner join category as c 
                        on t.categoryId = c.categoryId)
                        inner join department as d
                        on t.department = d.departmentId)
                        inner join status as s 
                        on t.status = s.statusId)
                        inner join users as u
                        on t.userId = u.userId) WHERE userName ='".$user."' ORDER BY t.startDate DESC LIMIT ".$inicio.",".$incidencia_pagina;
                        
    
    $rs = mysqli_query($cdb, $consulta);
              
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
    
    while ($row3 = mysqli_fetch_assoc($rs)){
        echo' <tr>
                        <td>'.$row3["taskName"].'</td>
                        <td>'.$row3["creationDate"].'</td>
                        <td>'.$row3["finishDate"].'</td>
                        <td>'.$row3["statusName"].'</td>
                        <td>'.$row3["categoryName"].'</td>
                        <td>'.$row3["description"].'</td>
                        <td>'.$row3["information"].'</td>
                        <td>'.$row3["userName"].'</td>
                        <td>'.$row3["departmentName"].'</td>
                      </tr>
                    '; 
      
    }
     echo '</table>';
    
  if ($total_paginas > 1)
  {
    echo '<nav>
            <div class="center-block">
            <ul class="pagination">
            ';
    
    if ($pagina !=1)
    {
      echo '<li><a class="pagination" href="'.$url.'?pagina='.($pagina-1).'"></a></li>';
      for ($i=1;$i<=$total_paginas;$i++) 
      {
         if ($pagina == $i) 
         {
         //If current page index is shown, dont put the link
          echo $pagina;
         }
         else
         {
           //If index dont belong to the current page, put the link to go to the correct page
           echo '<li><a class="pagination" href="'.$url.'?pagina='.$i.'">'.$i.'</a></li>';
         }
         if ($pagina != $total_paginas)
         {
           echo '<li><a class="pagination" href="'.$url.'?pagina='.($pagina+1).'"></a></li>';
         }
                     echo '</ul>
                </div>           
            </nav>
        ';  
      }
    }
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