<?php 
$title = 'Dashboard';
include('header.php'); 
?>  
	<?php include('sidebar.php'); ?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index.php">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Dashboard</li>
			</ol>
		</div><!--/.row-->
		<br/><br/>
		<div class="content-box"><!-- Start Content Box -->
				<div class="content-box-content">
					<div class="table-responsive">
        				<div class="table-wrapper">
            				<div class="table-title">
                				<h2>Online Tests</h2>
            				</div>
            				<table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Test Number</th>
                                        <th>Total Questions</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sql = "SELECT DISTINCT exam_no FROM questions";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                	<td><?php echo $row['exam_no'];?></td>
                                    <td><?php 
                                    $sql1 = "SELECT * FROM questions WHERE exam_no='".$row['exam_no']."'";
                                    $result1 = $conn->query($sql1);
                                    $count = $result1->num_rows;
                                    echo $count;
                                    ?></td>
                                    <td>
				                        <a href="viewTest.php?test_id=<?php echo $row["exam_no"]; ?>" >View Test</a>
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
		<div class="content-box"><!-- Start Content Box -->
				<div class="content-box-content">
					<div class="table-responsive">
        				<div class="table-wrapper">
            				<div class="table-title">
                				<h2>Users</h2>
            				</div>
            				<table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>User ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>Mobile No.</th>
                                        <th>Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $sql = "SELECT * FROM users";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                	<td><?php echo $row['user_id'];?></td>
                                    <td><a href="../images/<?php echo $row['image'];?>"><img width="60px" height="60px" src="../images/<?php echo $row['image'];?>" alt="image" /></a> <?php echo $row['name'];?></td>
                                    <td><?php echo $row['email'];?></td>
                                    <td><?php echo $row['gender'];?></td>
                                    <td><?php echo $row['mobile_no'];?></td>
                                    <td><?php echo $row['address'];?></td>
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
	
	<?php include('footer.php'); ?>