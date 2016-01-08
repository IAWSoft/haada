<?php

session_start();

if(isset($_SESSION['user']))
{
    include("config.php");
    
    $email = $_SESSION['email'];
	$user = $_SESSION['user'];
	$info = $_SESSION['description'];
echo '
    <section class="main container">
	<div class="row centered">
		<section class="posts col-md-12">	
			<article class="post clearfix">
			  <br/>
        <h1><b></b>Personal data sheet</b></h1>
        <p><b>User name:</b> '.$user.'</p>
        <p><b>email:</b> '.$email.'</p>
        <p><b>Description:</b> '.$info.'</p>
        <br/>
        <p><a href="changePassword.php">Change password?</a></p>
      </artcle>
    </section>  
  </div>
</section>'; 
}
else
{
     header("location: ./");
}
?>
