<?php

session_start(); 
include("config.php");
// This prints the register form:
echo '
                <section class="main container">
                        <div class="row centered">
                            <section class="posts col-md-12">   
                                <article class="post clearfix">
                                    <div class="well">
                                       <form class="form-horizontal " action="" method="post">
                                        <div class="form-group">
                                            <label class="control-label col-xs-2">Username: </label>
                                            <div class="col-xs-9">
                                                <input type="text" class="form-control"  placeholder="Username" name="userName">
                                            </div>
                                        </div>
                                    
                                        <div class="form-group">
                                            <label class="control-label col-xs-2">Password:</label>
                                            <div class="col-xs-9">
                                                <input type="password" class="form-control"  placeholder="Password" name="userPassword">
                                            </div>
                                        </div>
                                    
                                        <div class="form-group">
                                            <label class="control-label col-xs-2">Repeat password:</label>
                                            <div class="col-xs-9">
                                                <input type="password" class="form-control"  placeholder="Repeat password" name="Rpassword">
                                            </div>
                                        </div>
                                    
                                        <div class="form-group">
                                            <label class="control-label col-xs-2">Email: </label>
                                            <div class="col-xs-9">
                                                <input type="text" class="form-control"  placeholder="Email" name="email">
                                            </div>
                                        </div>
                                    
                                        <div class="form-group">
                                            <label class="control-label col-xs-2">Description:</label>
                                            <div class="col-xs-9">
                                                <textarea type="text" class="form-control"  rows="5" placeholder="Description" name="description"></textarea>
                                            </div>
                                        </div>
                                    
                                        <div class="form-group">
                                            <div class="col-xs-offset-3 col-xs-9">
                                                 <br /><input type="submit" class="btn btn-primary" value="Register" name="submit">
                                            </div>
                                        </div>

                                        </form>
                                      </div>
                                </article>
                            </section>  
                        </div>
                    </section>';

// If the "Add" button has been pressed execute the following code:
if(isset($_POST['submit'])) 
{
     // Create variables to store the form data:
    $userName =  mysqli_real_escape_string($cdb, $_POST['userName']);  
    $query_user = mysqli_query($cdb, "SELECT * FROM ".$db_table." WHERE userName='".$userName."' ");       
    
    // This checks if the userName exists in the database:
    if(mysqli_num_rows($query_user) == 0) 
    {
        $string = mysqli_real_escape_string($cdb, $_POST['email']);
        
        $email = $string;
        if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $email)) 
        {
            
            $query_mail = mysqli_query($cdb, "SELECT * FROM ".$db_table." WHERE email='".$email."' ");  
           // Check if the email exists in the database:
            if(mysqli_num_rows($query_mail) == 0) 
            {       
                
                $Rpassword = mysqli_real_escape_string($cdb, $_POST['Rpassword']); 
                $password = mysqli_real_escape_string($cdb, $_POST['userPassword']); 

                $description = mysqli_real_escape_string($cdb, $_POST['description']);
            
                // Check if the password has been introduced correctly twice:
                if($password == $Rpassword)
                {
                    // Encrypt the  password:
                    $hash = sha1($password);
                    // Check the received values to confirm that they're not NULL:
                    if(!empty($userName) && !empty($password) && !empty($email)) 
                    {
                        // Register the new user in the database:
                        $query_newuser = mysqli_query($cdb, "INSERT INTO ".$db_table." SET userName='".$userName."', userPassword='".$hash."', email='".$email."', description='".$description."', permissionLevel=2 ");
                    
                        echo '<p>' . mysqli_error($cdb) . '<br /><br />Query: ' . $query_newuser . '</p>';
                     
                        if($query_newuser)
                        {
                            echo '<script type="text/javascript">
                            alert("The user has been successfully registered.");
                            window.location.href = "./";
                            </script>';
                        }
                        
                        else
                        {
                            echo '<script type="text/javascript">
                            alert("The registering process failed.");
                            window.location.href = "javascript:window.history.back();";
                            </script>';
                        }
                    }
                }
                // The passwords do not match:
                else
                {
                        echo '<script type="text/javascript">
                        alert("The passwords do not match.");
                        window.location.href = "javascript:window.history.back();";
                        </script>';
                }    
            }
            // This email is already registered:
            else
            {
                    echo '<script type="text/javascript">
                    alert("This email is already registered.");
                    window.location.href = "javascript:window.history.back();";
                    </script>';
            }
        }
        // This email is not valid:
        else
        {
            echo '<script type="text/javascript">
            alert("This email is not valid.");
            window.location.href = "javascript:window.history.back();";
            </script>';
        }        
    }        
    // This user is already registered:
    else
    {
            echo '<script type="text/javascript">
            alert("This user is already registered.");
            window.location.href = "javascript:window.history.back();";
            </script>';
    }
}      

?>
