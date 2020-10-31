<?php

session_start();
include('../config.php');

if(isset($_GET['action']) && $_GET['action'] == "remove") {
    $exam_no = $_REQUEST['test_id'];
    $delete = "DELETE FROM questions WHERE exam_no='".$exam_no."'";
    if ($conn->query($delete) === TRUE) {
        $_SESSION['success'] = "Test ".$exam_no." is deleted";
    } else {
        $_SESSION['error'] = $conn->error;
    }
}

header('location: tests.php');

?>
