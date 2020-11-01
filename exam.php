<?php
$title = "Tests List";
include('header.php');
//check session variable is set
if (!isset($_SESSION['userdata']['user_email'])) {
    header('location: index.php');
}
$user_id = $_SESSION['userdata']['user_id'];
$exam_no = $_GET['exam_no'];

function showExamQuestions() {
    global $conn, $exam_no;
    $sql = "SELECT * FROM questions WHERE exam_no='".$exam_no."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {    
        $count = $result->num_rows;
        $i = 1;
        echo '<h4>Total '.$count.' questions</h4>';
        $html = '<form action="score.php" method="post" class="exam">';
        while ($row = $result->fetch_assoc()) { 
            $html .= '<p>'.$i.') '.$row['question'].'</p>';
            if(isset($row['option1'])) {
		    $html .= '<div class="radio"><label><input type="radio" name="'.$row['ques_id'].'" value="0">'.$row['option1'].'</label></div>';                    
			}
			if(isset($row['option2'])) {
			$html .= '<div class="radio"><label><input type="radio" name="'.$row['ques_id'].'" value="1">'.$row['option2'].'</label></div>';
			}
			if(isset($row['option3'])) {
			$html .= '<div class="radio"><label><input type="radio" name="'.$row['ques_id'].'" value="2">'.$row['option3'].'</label></div>';
			}
			if(isset($row['option4'])) {
			$html .= '<div class="radio"><label><input type="radio" name="'.$row['ques_id'].'" value="3">'.$row['option4'].'</label></div>';
			}
			$html .= '<div class="radio" style="display:none" ><label><input type="radio" checked="checked" name="'.$row['ques_id'].'" value="no_attempt"></label></div>';
            $i++; 
        }
        echo $html .= '<input type="hidden" name="exam_no" value="'.$exam_no.'" /><input type="submit" name="quiz" value="Submit"></form>';
    } 
}

?>      

        <div class="container content">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                	<h1>Test <?php echo $exam_no; ?></h1>
                	<?php
                	showExamQuestions();
                	?>
                </div>
            </div>
        </div>
        <?php include('footer.php');

