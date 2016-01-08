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
    //Creamos el formulario para el cambio de contraseña
    echo '
      <div class="posi well">
      <label>Change password for Haada</label>
        <form class="form-horizontal " action="changePassword.php" method="post">
            <div>
               <input type="password" class="form-control"   placeholder="Old password" name="password" requiered>
             </div>
             <br/>
    
             <div >
               <input type="password" class="form-control"   placeholder="New password" name="newpassword" requiered>
             </div>
             <br/>
            <div>
               <input type="password" class="form-control"   placeholder="Repeat new password" name="newpassword2" requiered>
             </div>
             <br/>
             <div >
                <input type="submit" class="btn btn-primary btn-md btn-block" value="submit" name="submit">
             </div>
        </form>
      </div>';
    
    // Si el boton de "añadir" fué presionado ejecuta el resto del código   
    if(isset($_POST['submit'])) 
    {
        include("includes/config.php");
        
        //Creamos variables con los datos de las sessiones creadas en el login
        $email = $_SESSION['email']; 
        $oldpass =  $_SESSION['pass'];
        
        //Creamos variables para almacenar los datos del formulario
        $pass = $_POST['password'];
        $newpassword = $_POST['newpassword'];
        $newpassword2 = $_POST['newpassword2'];
       
        //Encriptamos la variable $pass
        $hash2 =sha1($pass);
        //Comprobamos si la contraseña vieja coincide con la de la bd
        if($oldpass == $hash2)
        {
            //Comprobamos que la nueva contraseña se ha introducido bien 
            if($newpassword == $newpassword2)
            {
              //Encriptamos la nueva contraseña
              $hash = sha1($newpassword2); 
              
              // Comprobamos que los valores recibidos no son NULL
              if(!empty($pass) && !empty($newpassword) && !empty($newpassword2)) 
              {
                  //Actualiamos la contraseña
                  $query_update = mysqli_query($cdb, "UPDATE ".$db_table." SET  userPassword='".$hash."' WHERE users.email = '".$email."' ");
          
                  if($query_update)
                  {
                    //Destruimos la S_SESSION que contenía la vieja contraseña                          
                    unset($_SESSION['pass']);
                    //creamos una nueva session que contendrá la nueva contraseña
                    $_SESSION['pass'] = $hash;
                    //Mensaje de correcto y volvemos a la ficha del usuario
                    echo '<script type="text/javascript" >
                    alert("password updated");
                    window.location.href = "user.php";
                    </script>';       
                  }
              }
            } 
            else
            {
                //si las nueva contraseña no coincide en los dos campos del form, enviamos un mensaje de aviso  y volvemos al form.
                echo '<script type="text/javascript" >
                alert("The passwords do not match.");
                window.location.href = "changePassword.php";
                </script>';
            }
        }
        else
        {
            //Si la contraseña que queremos cambiar no es correcta, salta este aviso
            echo '<script type="text/javascript" >
            alert("Password error.");
            window.location.href = "changePassword.php";
            </script>';
        }    
    
    }
}
//Si no se está logeado, devolvemos al usuario al index
else
{
     header("location: ./");
}


    include("includes/flogin.html");
    include("includes/footer.html");
  ?> 
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
</html>