<?php
$title = "Tests List";
include('header.php');
$user_id = $_SESSION['userdata']['user_id'];
$exam_no = $_GET['exam_no'];
$_SESSION['exam_no'] = $exam_no;

?>      

        <div class="container content">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                	<h1>Test <?php echo $exam_no; ?></h1>
                	<!--<h3>Question 1 of 10:</h3>-->
                	<h4>Total 10 questions</h4>
                	<form action="score.php" method="post" class="exam"> 
                		<?php
                        $sql = "SELECT * FROM questions WHERE exam_no='".$exam_no."'";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
	                        $i = 1;
	                        // output data of each row
	                        while ($row = $result->fetch_assoc()) {
	                        ?>
		                        <p><?php echo $i; ?>) 
		                        <?php echo $row['question']; ?></p>
		                        <?php if(isset($row['option1'])) { ?>
		                        <div class="radio">
		                            <label><input type="radio" name="<?php echo $row['ques_id']; ?>" value="0"><?php echo $row['option1']; ?></label>
								</div>
								<?php } ?>
								<?php if(isset($row['option2'])) { ?>
								<div class="radio">
									<label><input type="radio" name="<?php echo $row['ques_id']; ?>" value="1"><?php echo $row['option2']; ?></label>
								</div>
								<?php } ?>
								<?php if(isset($row['option3'])) { ?>
								<div class="radio">
									<label><input type="radio" name="<?php echo $row['ques_id']; ?>" value="2"><?php echo $row['option3']; ?></label>
								</div>
								<?php } ?>
								<?php if(isset($row['option4'])) { ?>
								<div class="radio">
									<label><input type="radio" name="<?php echo $row['ques_id']; ?>" value="3"><?php echo $row['option4']; ?></label>
								</div>
								<?php } ?>
								<div class="radio" style="display:none" >
									<label><input type="radio" checked="checked" name="<?php echo $row['ques_id']; ?>" value="no_attempt"></label>
								</div>
		                        <?php $i++; 
	                    	}
                        } 
                        ?>
                        <input type="hidden" name="exam_no" value="<?php echo $exam_no; ?>" />
 						<input type="submit" name="quiz" value="Submit">
					</form>
                </div>
            </div>
        </div>
        <?php include('footer.php');

