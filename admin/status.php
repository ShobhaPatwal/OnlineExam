<?php
session_start();
include_once('../config.php');

if(isset($_POST["status"])) {
	$status = $_POST['hidden_status'];
	echo $status;
	echo $sql = "UPDATE setting SET status='".$status."' WHERE setting_id=1";

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
