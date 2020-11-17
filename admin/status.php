<?php
session_start();
include_once('../config.php');
echo "hello";
if(isset($_GET["hidden_status"])) {
	$status = $_GET['hidden_status'];
	$sql = "UPDATE setting SET status='".$status."' WHERE setting_id=1";

	if ($conn->query($sql) === TRUE) {
		$sql2 = "SELECT status FROM setting WHERE setting_id=1";
		$result = $conn->query($sql2);
		$row = $result->fetch_assoc();
		if ($row['status'] == 'enable') {
			$checked = "checked";
		} else {
			$checked = "";
		}
	} else {
    	echo "Error: " .$conn->error;
	}
	header('location:tests.php');
}
?>
