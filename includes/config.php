<?php

$db_host = "localhost";           // Server where is alocate the db
$db_name = "taskmanager";         // Name db 
$db_user = "root";                // User for db taskmanager
$db_password = "";                // Password for db taskmanager


$db_table = "User_session";       // Name table db

$cdb = mysqli_connect($db_host, $db_user, $db_password) or die("No se ha podido realizar la conexión con la base de datos. Error: ".mysqli_connect_error() );
mysqli_select_db($cdb, $db_name);
?>