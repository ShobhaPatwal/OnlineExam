<?php 
$title = 'Tests';
include('header.php'); 
?>  
	<?php include('sidebar.php'); ?>

    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
				<h1 class="page-header">Tests Detail</h1>
			</div>
		</div><!--/.row-->
		<div class="content-box"><!-- Start Content Box -->
				<div class="content-box-content">
					<div class="table-responsive">
        				<div class="table-wrapper">
            				<div class="table-title">
                				<div class="row">
                    				<div class="col-sm-12">
                    					Enable/Disable previous and next button
                        				<form action="status.php" method="post" id="enable_disable">
                                        	<label class="switch">
      											<input type="checkbox" class="toggle" <?php 
                                                $sql2 = "SELECT status FROM setting WHERE setting_id=1";
                                                $result = $conn->query($sql2);
                                                $row = $result->fetch_assoc();
                                                if ($row['status'] == 'enable') {
                                                    $checked = "checked"; echo $checked;
                                                } else {
                                                    $checked = ""; echo $checked;
                                                }
                                                ?> name="status" id="status" value="<?php echo $row['status']; ?>">
      											<span class="slider round"></span>
    										</label>
                                            <input type="hidden" name="hidden_status" id="hidden_status" value="enable" />
                                        </form>
                        				<a href="addTest.php" class="btn btn-info add-new"><i class="fa fa-plus"></i> Add New Test</a>
                    				</div>
                				</div>
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
                                		<?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                            		</div> 
								</span>
								<?php endif; ?> 
            				</div>
            				<table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Test Number</th>
                                        <th>Test Name</th>
                                        <th>Total Questions</th>
                                        <th>Date Of Creation</th>
                                        <th style="min-width:140px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sql = "SELECT * FROM exam";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                	<td><?php echo $row['exam_id'];?></td>
                                    <td><?php echo $row['exam_title'];?></td>
                                    <td><?php 
                                    $sql1 = "SELECT * FROM questions WHERE exam_no='".$row['exam_id']."'";
                                    $result1 = $conn->query($sql1);
                                    $exam_no = $row['exam_id'];
                                    $count = $result1->num_rows;
                                    echo $count;
                                    ?></td>
                                    <td><?php echo $row['date'];?></td>
									<td style="min-width:140px;">
				                        <a class="edit" href="viewTest.php?test_id=<?php echo $exam_no;  ?>" data-toggle="tooltip" title="View Test"><i class="fa fa-eye"></i></a>
				                        <a class="addd" href="addQuestion.php?test_id=<?php echo $exam_no; ?>" data-toggle="tooltip" title="Add Question"><i class="fa fa-plus"></i></a>
				                        <a class="delete" href="deleteTest.php?action=remove&test_id=<?php echo $exam_no; ?>" data-toggle="tooltip" title="Delete Test"><i class="fa fa-trash"></i></a>
				                    </td>
                                </tr>
                                <?php
                                    }
                                } 
                                ?>
                                 
                                </tbody>
                            </table>
				        </div>
    				</div>
				</div> <!-- End .content-box-content -->
			</div> <!-- End .content-box -->
	</div>	<!--/.main-->

    <script>
    $(document).ready(function(){
        /* ('#status').bootstrapToggle({
            on: 'enable',
            off: 'disable'
        }); */

        $('#status').change(function(){
            if($(this).prop('checked')) {
                $('#hidden_status').val('enable');
                document.getElementById('enable_disable').submit();
            }
            else if($(this).prop('')) {
                $('hidden_status').val('disable');
                document.getElementById('enable_disable').submit();
            }
        });
        
        /*$('#enable_disable').on('submit', function(event){
            //event.preventDefault();
            var status = $('#status').val();
            $.ajax({
                url: "status.php",
                method: "POST",
                type: "POST",
                data: $(this).serialize(),
                success:function(data){
                    if(data == 'done') {
                        //$('#status').bootstrapToggle('on');
                        alert("Data Inserted");
                    } else {
                        alert(data);
                    }

                }
            });
            $.fail(function( msg ) {
                        alert("Data Inserted");
                    });
        });  */
    });
    </script>

	
	<?php include('footer.php'); ?>