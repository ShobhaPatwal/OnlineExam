<?php 
$title = 'Add Test';
include('header.php'); 

if (isset($_POST['addtest'])) {
    $test = $_POST['test'];
    $sql = "INSERT INTO exam (exam_title, date) VALUES('".$test."', now())";
    if ($conn->query($sql) === true) {
        $_SESSION['success'] = "Online test is added successfully";
        header('location: tests.php');
    } else {
        $_SESSION['error'][] = $conn->error;
    }
} 

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
				<h1 class="page-header">Add Test</h1>
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
					<form action="" method="post"> 
						<!-- This is the target div. id must match the href of this div's tab -->
						<div class="form-group">
						 	<label for="question">Test Name</label>
      						<input type="text" class="form-control" name="test" id="test" placeholder="Enter Test name" required/>
    					</div>
 						<button type="submit" class="btn btn-default" name="addtest">Submit</button>
					</form>
				</div> <!-- End .content-box-content -->
			</div> <!-- End .content-box -->
	</div>	<!--/.main-->
	
	<?php include('footer.php'); ?>