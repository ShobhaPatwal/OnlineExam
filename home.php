<?php
$title = "Tests List";
include('header.php')
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
                    <p>Each test contains 10 questions, you get 1 point for each correct answer, at the end of each test you get your total score. When you finish the quiz, you can go through each question with the correct answer.</p>

                    <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Test Number</th>
                                        <th>Total Questions</th>
                                        <th>Actions</th>
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
                                       
                                        <a href="exam.php?exam_no=<?php echo $row["exam_no"]; ?>" title="Delete">Start Test</a> 
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

