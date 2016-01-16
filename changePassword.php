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
//We check that exists a logged user, in this way we can control the access to this page.
if(isset($_SESSION['user']))
{   
    //Create the form to change the password.
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
    
    //if "add" button has been pressed execute the following code
    if(isset($_POST['submit'])) 
    {
        include("includes/config.php");
        
        //Create variables with the datum from sessions created on login page
        $email = $_SESSION['email']; 
        $oldpass =  $_SESSION['pass'];
        
        //Create variables to store the form datum
        $pass = $_POST['password'];
        $newpassword = $_POST['newpassword'];
        $newpassword2 = $_POST['newpassword2'];
       
        //Encrypt $pass variable
        $hash2 =sha1($pass);
        //Check that old password coincide with password on database
        if($oldpass == $hash2)
        {
            //Check that new password has been well introduced
            if($newpassword == $newpassword2)
            {
              //Encrypt the new password
              $hash = sha1($newpassword2); 
              //Check that receive values aren't null
              if(!empty($pass) && !empty($newpassword) && !empty($newpassword2)) 
              {
                  //Update the password
                  $query_update = mysqli_query($cdb, "UPDATE ".$db_table." SET  userPassword='".$hash."' WHERE users.email = '".$email."' ");
          
                  if($query_update)
                  {
                    //Destroy the S_SESSION that contains old password
                    unset($_SESSION['pass']);
                    //Create new session that will contain the new password
                    $_SESSION['pass'] = $hash;
                    //A message that confirm it's correct and return to the personal data sheet
                    echo '<script type="text/javascript" >
                    alert("password updated");
                    window.location.href = "user.php";
                    </script>';       
                  }
              }
            } 
            else
            {
                //If the password don't coincide with the form fields, send a warning and return to the form.
                echo '<script type="text/javascript" >
                alert("The passwords do not match.");
                window.location.href = "changePassword.php";
                </script>';
            }
        }
        else
        {
            //If the password we want to change isn't correct, pop this warning
            echo '<script type="text/javascript" >
            alert("Password error.");
            window.location.href = "changePassword.php";
            </script>';
        }    
    
    }
}
//If isn' logged, return the user to the index
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