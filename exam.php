<?php
$title = "Tests List";
include('header.php');
include_once('functions.php');
//check session variable is set
if (!isset($_SESSION['userdata']['user_email'])) {
    header('location: index.php');
}
$user_id = $_SESSION['userdata']['user_id'];
$exam_no = $_GET['exam_no'];

?>      

        <div class="container content">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                	<h1>
                		<?php
                        $sql = "SELECT * FROM exam WHERE exam_id='".$exam_no."'";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc(); 
                        echo $row['exam_title'];?> (Test <?php echo $exam_no; ?>)
                    </h1>
                	<?php
                	$sql1 = "SELECT status FROM setting WHERE setting_id=1";
                    $result1 = $conn->query($sql1);
                    $row1 = $result1->fetch_assoc();
                    //check whether admin enable/disable  previous/next button or not to show questions
                    if ($row1['status'] == 'enable') {
                        enableSingleQuestion();
                    } else {
                    	showExamQuestions();
                    }
              		?>

					<script>
					var currentTab = 0; // Current tab is set to be the first tab (0)
					showTab(currentTab); // Display the current tab

					function showTab(n) {
					    // This function will display the specified tab of the form...
					    var x = document.getElementsByClassName("tab");
					    x[n].style.display = "block";
					    //... and fix the Previous/Next buttons:
					    if (n == 0) {
					        document.getElementById("prevBtn").style.display = "none";
					    } else {
					        document.getElementById("prevBtn").style.display = "inline";
					    }
					    if (n == (x.length - 1)) {
					        document.getElementById("nextBtn").innerHTML = "Submit";
					    } else {
					        document.getElementById("nextBtn").innerHTML = "Next";
					    }

					}

					function nextPrev(n) {
					    // This function will figure out which tab to display
					    var x = document.getElementsByClassName("tab");
					    // Hide the current tab:
					    x[currentTab].style.display = "none";
					    // Increase or decrease the current tab by 1:
					    currentTab = currentTab + n;
					    // if you have reached the end of the form...
					    if (currentTab >= x.length) {
					        // ... the form gets submitted:
					        document.getElementById("examForm").submit();
					        return false;
					    }
					    // Otherwise, display the correct tab:
					    showTab(currentTab);
					}
					</script>

                </div>
            </div>
        </div>
        <?php include('footer.php');

