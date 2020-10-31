<?php

session_start();
include_once('../config.php');
include_once('../functions.php');
if (isset($_POST['quiz'])) {
    $question = htmlentities($_POST['question']);
    $option1 = htmlentities($_POST['option_1']);
    $option2 = htmlentities($_POST['option_2']);
    $option3 = htmlentities($_POST['option_3']);
    $option4 = htmlentities($_POST['option_4']);
    $answer = htmlentities($_POST['answer']);
    $exam_no = $_POST['exam_no'];
    $option_array = [$option1, $option2, $option3, $option4];
    if (!in_array($answer, $option_array)) {
    	$_SESSION['error'] = 'Answer does not match with any option';
    } 
    $ans = array_search($answer,$option_array);
    // add questions to quiz
    $addQuestion = addQuestion($question, $option1, $option2, $option3, $option4, $ans, $exam_no);
    header('location: index.php');

} 

?>


