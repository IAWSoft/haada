<?php

$name = $_POST["name"];

$email = $_POST["email"];

$subject = $_POST["subject"];

$message = $_POST["message"];

$subject = $_POST["subject"];

$for = "drossan@hotmail.es";
 
 
 $mensaje = "

 Name: ".$nombre."
 Email: ".$correo."
 Message: ".$message."
 ";

if ($_POST['submit']) 
{
	if (mail($for,$subject,utf8_decode($message))) 
	{
		echo '<script type="text/javascript" >
				alert("Message sent.");
				window.location.href = "../";
			</script>';
	} 
	else 
	{
		echo 'Failed to send message.';
	}
}

?>
