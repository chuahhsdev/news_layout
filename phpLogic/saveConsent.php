<?php
include_once("../mysql.php"); //Import MYSQL

$userChoice=$_POST["userChoice"];

$cookie_name = "CHUAHHS_COOKIE";

if (!isset($_COOKIE[$cookie_name])) {
    $guid = bin2hex(random_bytes(16)); //Generate Random GUID
    $dateTime = (new DateTime())->format('Y-m-d H:i:s');
    $versionNo = 1;

    $cookie_value = $guid . "|" . $dateTime . "|" . $versionNo;
	$accepted = "";
	
	if ($userChoice == "accepted"){
		setcookie($cookie_name, $cookie_value, time() + (86400 * 365), "/"); //Set Cookie for 1 year
		$accepted = "Y";
	}else{
		setcookie($cookie_name, $cookie_value, time() + (86400 * 1), "/"); //Set Cookie for 1 day
		$accepted = "N";
	}
    $stmt = mysqli_prepare($connection, "INSERT INTO authentication (GUID, consent_date, version, accepted) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssis", $guid, $dateTime, $versionNo, $accepted);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
?>