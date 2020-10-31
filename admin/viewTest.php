<?php 
$title = 'View Test Questions';
include('header.php'); 
$exam_no = $_GET['test_id'];
$count = '';
function showQuestions() {
    global $conn, $exam_no, $count;
    $sql = "SELECT * FROM questions WHERE exam_no='".$exam_no."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {    
        $i = 1;
        $html = "";
        while ($row = $result->fetch_assoc()) {
            echo $html = '<div class="question">
                <div>
                    <span>'.$i.')</span>'.$row['question'].'</div> 
                <div>
                    <span>Option 1:</span>'.$row['option1'].'</div>
                <div>
                    <span>Option 2:</span>'.$row['option2'].'</div>
                <div>
                    <span>Option 3:</span>'.$row['option3'].'</div>
                <div>
                    <span>Option 4:</span>'.$row['option4'].'</div>
                <div>
                    <span>Answer:</span>'.$row['answer'].'</div> 
                </div> ';
            $i++; 
        }
    }  
    $count = $result->num_rows; 
}
$row1 = $count;
?>  
	<?php include('sidebar.php'); ?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index.php">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">View Test</li>
			</ol>
		</div><!--/.row-->
		<br/><br/>
		<div class="content-box"><!-- Start Content Box -->
			<div class="content-box-content">
                <div class="table-title">
                    <h2>Test <?php echo $exam_no; ?> (<?php echo $row1; ?> questions)</h2>
                </div>
                <?php
                showQuestions();
                ?>
            				
			</div> <!-- End .content-box-content -->
		</div> <!-- End .content-box -->

	</div>	<!--/.main-->
	
	<?php include('footer.php'); ?>