<?php
session_start();
include_once("../mysql.php"); //Import MYSQL

$email=$_POST["email"];
$password=$_POST["password"];

$md5password = md5($password);

$sql="SELECT * from user where username=? and `password`=?";

//$result=mysqli_query($connection, $sql);
$stmt = $connection->prepare($sql);
$stmt->bind_param("ss", $email, $md5password); 

$stmt->execute();

$result = $stmt->get_result();

$num_row=mysqli_num_rows($result);
$row=mysqli_fetch_assoc($result);

if ($num_row>0) { //Valid let's gooo
	$_SESSION["isLogin"] = 1;
    $_SESSION["user"] = $email;
	echo json_encode(['success' => true]);
}else{ // Invalid credentials
    echo json_encode(['success' => false, 'message' => 'Invalid!']);
}

?>