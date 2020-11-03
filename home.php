<?php
$title = "Tests List";
include('header.php');
//check session variable is set
if (!isset($_SESSION['userdata']['user_email'])) {
    header('location: index.php');
}
$user_id = $_SESSION['userdata']['user_id'];
?>      

        <div class="container content">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h1 class="center">Welcome to Online Test Platform</h1>
                     <div class=" col-lg-12 text-center">
               <h3> Welcome, <span class="text-uppercase text-warning"><?php
                $sql = "SELECT * FROM users WHERE user_id='".$_SESSION['userdata']['user_id']."'";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo ucfirst($row['name']);
                } ?>
                </span></h3>
            </div>
            <br>
                    <p>Each test contains 10 questions, you get 1 point for each correct answer, at the end of each test you get your total score. When you finish the test, you can go through each question with the correct answer.</p>
                    <br/>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Test Number</th>
                                <th>Test Name</th>
                                <th>Date & Time</th>
                                <th>Total Questions</th>
                                <th>Status</th>
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
                                <td>
                                    <?php 
                                    $sql1 = "SELECT * FROM exam WHERE exam_id='".$row['exam_no']."'";
                                    $result1 = $conn->query($sql1);
                                    $row1 = $result1->fetch_assoc();
                                    echo $row1['exam_title'];
                                    ?>
                                </td>
                                <td><?php echo $row1['date'];?></td>
                                <td>
                                    <?php 
                                    $sql2 = "SELECT * FROM questions WHERE exam_no='".$row['exam_no']."'";
                                    $result2 = $conn->query($sql2);
                                    $count = $result2->num_rows;
                                    echo $count;
                                    ?>     
                                </td>
                                <td>
                                    <?php 
                                    $sql3 = "SELECT * FROM user_exam_result WHERE exam_id='".$row['exam_no']."' && user_id='".$user_id."'";
                                    $result3 = $conn->query($sql3);
                                    $count1 = $result3->num_rows;
                                    if($count1 == 1) {
                                        echo "Completed";
                                    } else {
                                        echo "Not Completed";
                                    }
                                    ?>     
                                </td>
                                <td>
                                    <a href="exam.php?exam_no=<?php echo $row["exam_no"]; ?>" title="Start Test">Start Test</a> 
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
        </div>
        <?php include('footer.php');

