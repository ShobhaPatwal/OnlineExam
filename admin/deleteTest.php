<?php

session_start();
include('../config.php');

//remove exam from database
if(isset($_GET['action']) && $_GET['action'] == "remove") {
    $exam_no = $_REQUEST['test_id'];
    $delete = "DELETE FROM questions WHERE exam_no='".$exam_no."'";
    if ($conn->query($delete) === TRUE) {
        $_SESSION['success'] = "Test ".$exam_no." is deleted";
    } else {
        $_SESSION['error'] = $conn->error;
    }
}

//remove question from a exam
if(isset($_GET['action']) && $_GET['action'] == "delete") {
    $ques_id = $_REQUEST['ques_id'];
    $number = $_REQUEST['number'];
    $exam_no = $_REQUEST['exam_no'];
    $delete = "DELETE FROM questions WHERE ques_id='".$ques_id."'";
    if ($conn->query($delete) === TRUE) {
        $_SESSION['success'] = "Question ".$number." is deleted from Exam ".$exam_no;
    } else {
        $_SESSION['error'] = $conn->error;
    }
}

header('location: tests.php');

?>
