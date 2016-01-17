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
// This checks if a user is logged in, to control the access to this page:
if(isset($_SESSION['user']))
{   
    // Print the form to change the password:
    echo '
      <div class="posi well">
      <label>Change account password:</label>
        <form class="form-horizontal " action="changePassword.php" method="post">
            <div></br>
               <input type="password" class="form-control"   placeholder="Type your old password" name="password" requiered>
             </div>
             <br/>
    
             <div >
               <input type="password" class="form-control"   placeholder="Type a new password" name="newpassword" requiered>
             </div>
             <br/>
            <div>
               <input type="password" class="form-control"   placeholder="Repeat the new password" name="newpassword2" requiered>
             </div>
             <br/>
             <div >
                <input type="submit" class="btn btn-primary btn-md btn-block" value="Change password" name="submit">
             </div>
        </form>
      </div>';
    
    // If the "add" button has been pressed execute the following code:
    if(isset($_POST['submit'])) 
    {
        include("includes/config.php");
        
        // Create variables with the data from the sessions created on login page:
        $email = $_SESSION['email']; 
        $oldpass =  $_SESSION['pass'];
        
        // Create variables to store the form data:
        $pass = $_POST['password'];
        $newpassword = $_POST['newpassword'];
        $newpassword2 = $_POST['newpassword2'];
       
        // Encrypt $pass variable:
        $hash2 =sha1($pass);
        // Check if the old password is the one on the database:
        if($oldpass == $hash2)
        {
            // Check if the new password has been written right twice:
            if($newpassword == $newpassword2)
            {
              // Encrypt the new password:
              $hash = sha1($newpassword2); 
              // Check if received values aren't NULL:
              if(!empty($pass) && !empty($newpassword) && !empty($newpassword2)) 
              {
                  //Update the password:
                  $query_update = mysqli_query($cdb, "UPDATE ".$db_table." SET  userPassword='".$hash."' WHERE users.email = '".$email."' ");
          
                  if($query_update)
                  {
                    // Destroy the S_SESSION that contains old password:
                    unset($_SESSION['pass']);
                    // Create a new session that will contain the new password:
                    $_SESSION['pass'] = $hash;
                    // Alert prompt to show that the password has been updated and return to the account settings:
                    echo '<script type="text/javascript" >
                    alert("Password updated.");
                    window.location.href = "user.php";
                    </script>';       
                  }
              }
            } 
            else
            {
                // If the two new passwords are not the same in the form fields, show a warning and return to the form:
                echo '<script type="text/javascript" >
                alert("The passwords do not match.");
                window.location.href = "changePassword.php";
                </script>';
            }
        }
        else
        {
            // If the password we want to change isn't correct, pop this warning:
            echo '<script type="text/javascript" >
            alert("Password error.");
            window.location.href = "changePassword.php";
            </script>';
        }    
    
    }
}
// If a user isn't logged, return the user to the index page:
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