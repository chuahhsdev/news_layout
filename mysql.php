<?php
if(isset($_GET['debug'])){
   ini_set('display_errors', 1);
   ini_set('display_startup_errors', 1);
   error_reporting(E_ALL);
}
$host="localhost";
$user="root";
$password='';
$db="newsLayout";

$connection=mysqli_connect($host, $user, $password, $db);
if (mysqli_connect_errno()) {
   echo "Failed to connect to MySQL: ".mysqli_connect_error();
}

date_default_timezone_set("Asia/Kuala_Lumpur");
?>
