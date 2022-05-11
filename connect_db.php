<?php
$serverName="localhost";
$userName="root";
$pass="";
$db="web_mevabe";
$con= mysqli_connect($serverName, $userName, $pass, $db);
if (!$con){
    echo "<h1>ket noi that bai</h1>";
    die("Connection failed: ".mysqli_connect_error());
}else {
  echo "Database status: Connected";
}