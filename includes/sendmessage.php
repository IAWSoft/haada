<?php

$name = $_POST["name"];

$email = $_POST["email"];

$subject = $_POST["subject"];

$message = $_POST["message"];

$subject = $_POST["subject"];

$for = "info@haada.com";
 
 
 $mensaje = "

 Name: ".$nombre."
 email: ".$correo."
 Message: ".$message."
 ";

if ($_POST['submit']) 
{
	if (mail($for,$subject,utf8_decode($message))) 
	{
		echo '<script type="text/javascript" >
				alert("Message send.");
				window.location.href = "../";
			</script>';
	} 
	else 
	{
		echo 'Failed';
	}
}

?>
