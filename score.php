<?php 
$title = "Score";
include('header.php');
include_once('config.php');
include_once('functions.php');
//calls function for checking answers
$answer = answer($_POST);
?>
        <div class="container content">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                	<?php
                	$total_question = $answer['right']+$answer['wrong']+$answer['no_answer'];
                	?>
                	<h1>Test <?php echo $_SESSION['exam_no']; ?> Result</h1><br/>
                	<table class="table table-bordered">
					    <thead>
					      <tr>
					        <th>Total Number Of Questions</th>
					        <th><?php echo $total_question; ?></th>
					      </tr>
					    </thead>
					    <tbody>
					      <tr>
					        <td>1</td>
					        <td>Anna</td>
					      </tr>
					      <tr>
					        <td>2</td>
					        <td>Debbie</td>
					      </tr>
					      <tr>
					        <td>3</td>
					        <td>John</td>
					      </tr>
					    </tbody>
  					</table>
                	
                </div>
            </div>
        </div>
        <?php include('footer.php');
