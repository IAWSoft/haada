<?php

$db_host = "localhost";           // Server location
$db_name = "taskmanager";         // Database name
$db_user = "root";                // Database user
$db_password = "";                // Database user password

// Database table names:
$db_table = "users";       
$db_table1 = "category";
$db_table2 = "department";
$db_table3 = "status"; 
$db_table4 = "tasks"; 

$cdb = mysqli_connect($db_host, $db_user, $db_password) or die("No se ha podido realizar la conexión con la base de datos. Error: ".mysqli_connect_error() );
mysqli_select_db($cdb, $db_name);
?>