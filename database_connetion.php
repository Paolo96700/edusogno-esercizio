<?php

$sname        = "localhost";
$db_username = "root";
$db_password = "root";

$db_name     = "db_users_edusogno";

$conn = mysqli_connect($sname, $db_username, $db_password, $db_name); 

if (!$conn) {
   echo "Connection failed!";
}

// Restituisci l'oggetto MySQLi
return $conn;