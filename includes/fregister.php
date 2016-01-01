<?php

session_start(); 
include("config.php");

echo '

<div class="row" style="padding: 30px">
<section class="posts col-md-9">    
<form class="form-horizontal" action="" method="post" >
    
    <div class="form-group">
        <label class="control-label col-xs-2">User name: </label>
        <div class="col-xs-9">
            <input type="text" class="form-control"  placeholder="User name" name="userName">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-2">Password</label>
        <div class="col-xs-9">
            <input type="password" class="form-control"  placeholder="Password" name="userPassword">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-2">Repeat password</label>
        <div class="col-xs-9">
            <input type="password" class="form-control"  placeholder="Repeat password" name="Rpassword">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-2">email: </label>
        <div class="col-xs-9">
            <input type="text" class="form-control"  placeholder="email" name="email">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-2">Description: </label>
        <div class="col-xs-9">
            <textarea type="text" class="form-control"  rows="5" placeholder="Description" name="description"></textarea>
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-offset-3 col-xs-9">
             <br /><input type="submit" class="btn btn-primary" value="Submit" name="submit">
        </div>
    </div>

</form>';

if(isset($_POST['submit'])) // Si el boton de "añadir" fué presionado ejecuta el resto del código
{
    $userName =  $_POST['userName'];   
    $password = $_POST['userPassword']; 
    $Rpassword = $_POST['Rpassword']; 
    $email = $_POST['email'];
    $description = $_POST['description'];

    if($password == $Rpassword)
    {
        $hash = sha1($password);

        if(!empty($userName) && !empty($password) && !empty($email)) // Comprobamos que los valores recibidos no son NULL
        {
            $query_newuser = mysqli_query($cdb, "INSERT INTO ".$db_table." SET userName='".$userName."', userPassword='".$hash."', email='".$email."', description='".$description."', permissionLevel=2 ");
        
            echo '<p>' . mysqli_error($cdb) . '<br /><br />Query: ' . $query_newuser . '</p>';

            if($query_newuser)
            {
                echo '<div class="form-group">
                    <label class="control-label col-xs-2">Congrats:</label>
                        <div class="col-xs-9">
                            <p class="form-control">The user has been successfully inserted</p>
                        </div>
                    </div>'; // Si el registro (user) se insertó en la base de datos, mostramos este mensaje
            }
            else
            {
                echo '<div class="form-group">
                    <label class="control-label col-xs-2">Error:</label>
                        <div class="col-xs-9">
                            <p class="form-control">The register is failed.</p>
                        </div>
                </div>';
            } 
        }
    } 
    else
    {
            echo '<script type="text/javascript">
            alert("The passwords do not match.");
            window.location.href = "javascript:window.history.back();";
            </script>';
    }
}      



?>
