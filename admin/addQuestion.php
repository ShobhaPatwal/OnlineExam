<?php 
$title = 'Add Question';
include('header.php'); 
?>  
	<?php include('sidebar.php'); ?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index.php">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Tests</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Add Question</h1>
			</div>
		</div><!--/.row-->
		<div class="content-box"><!-- Start Content Box -->
				<div class="content-box-content">
					<?php if(isset($_SESSION['error'])) : ?>
                    <span id="message">
                        <div class="alert alert-danger">
                            <?php echo $_SESSION['error']; unset($_SESSION['error']);  ?>
                        </div> 
					</span>
					<?php endif; ?> 
							
					<?php if(isset($_SESSION['success'])) : ?>
                        <span id="message">
                            <div class="alert alert-success">
                                <?php echo $_SESSION['success']; 
							    unset($_SESSION['success']); ?>
                            </div> 
						</span>
					<?php endif; ?> 
					<form action="add_quiz.php" method="post"> 
						<!-- This is the target div. id must match the href of this div's tab -->
						<div class="form-group">
						 	<label for="question">Question</label>
      						<input type="text" class="form-control" name="question" id="question" placeholder="Enter question" required/>
    					</div>
    					<div class="form-group">
    						<label for="option_1">Option 1</label>
    						<input type="text" class="form-control" name="option_1" id="option_1" placeholder="Enter option 1" required/>
  						</div>
     					<div class="form-group">
    						<label for="option_2">Option 2</label>
    						<input type="text" class="form-control" name="option_2" id="option_2" placeholder="Enter option 2" required/>
  						</div>
     					<div class="form-group">
    						<label for="option_3">Option 3</label>
    						<input type="text" class="form-control" name="option_3" id="option_3" placeholder="Enter option 3" required/>
  						</div>
     					<div class="form-group">
    						<label for="option_4">Option 4</label>
    						<input type="text" class="form-control" name="option_4" id="option_4" placeholder="Enter option 4" required/>
  						</div>
   						<div class="form-group">
    						<label for="answer">Answer</label>
    						<input type="text" class="form-control" name="answer" id="answer" placeholder="Enter answer" required/> 
  						</div>
  						<div class="form-group">
    						<label for="exam_no">Exam Number</label>
    						<input type="number" class="form-control" name="exam_no" id="exam_no" min="1" placeholder="Enter exam no" value="<?php if(isset($_GET['test_id'])) : echo $_GET['test_id'];  endif; ?>"required/>
  						</div>
 						<button type="submit" class="btn btn-default" name="quiz">Submit</button>
					</form>
				</div> <!-- End .content-box-content -->
			</div> <!-- End .content-box -->
	</div>	<!--/.main-->
	
	<?php include('footer.php'); ?>