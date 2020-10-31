<?php

session_start();
include('../config.php');

if(isset($_GET['action']) && $_GET['action'] == "remove") {
    $user_id = $_REQUEST['user_id'];
    $delete = "DELETE FROM users WHERE user_id='".$user_id."'";
    if ($conn->query($delete) === TRUE) {
        $_SESSION['success'] = "User is deleted";
    } else {
        $_SESSION['error'] = $conn->error;
    }
}

header('location: users.php');

?>