<?php

//login user if there are no errors in the form
function loginUser($email, $pass, $checked) {
    global $conn, $errors;
    //$hash = password_hash($pass, PASSWORD_BCRYPT);
    if (sizeof($errors) == 0) {
        $sql = "SELECT * FROM users WHERE email='".$email."'";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            // output data of selected row
            $row = $result->fetch_assoc();
            //if (password_verify($hash, $row['password'])) {
            if ($pass === $row['password']) {
                if (!empty($checked)) {
                    setcookie("useremail", $email, time()+ (10 * 365 * 24 * 60 * 60));  
                    setcookie("password", $pass, time()+ (10 * 365 * 24 * 60 * 60));
                }
                $_SESSION['userdata'] = array('user_email'=>$row['email'],'user_id'=>$row['user_id']);
                header('Location: home.php');
            } else {
                $errors[] = array('input'=>'form', 'msg'=>'Invalid password');
            }   
        } else {
            $errors[] = array('input'=>'form', 'msg'=>'Wrong Email Address');
            return $errors;
        }

        $conn->close();
    }
    return false;
}

//login admin if there are no errors in the form
function loginAdmin($email, $pass, $checked) {
    global $conn, $errors;
    //$hash = password_hash($pass, PASSWORD_BCRYPT);
    if (sizeof($errors) == 0) {
        $sql = "SELECT * FROM admin WHERE email='".$email."'";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            // output data of selected row
            $row = $result->fetch_assoc();
            //if (password_verify($hash, $row['password'])) {
            if ($pass === $row['password']) {
                if (!empty($checked)) {
                    setcookie("admin_email", $email, time()+ (10 * 365 * 24 * 60 * 60));  
                    setcookie("admin_password", $pass, time()+ (10 * 365 * 24 * 60 * 60));
                }
                $_SESSION['admindata'] = array('admin_email'=>$row['email'],'admin_id'=>$row['admin_id']);
                header('Location: index.php');
            } else {
                $errors[] = array('input'=>'form', 'msg'=>'Invalid password');
            }   
        } else {
            $errors[] = array('input'=>'form', 'msg'=>'Wrong Email Address');
            return $errors;
        }

        $conn->close();
    }
    return false;
}

// check whether user already exist with the same email id
function checkUser($email) {
    global $conn;
    $check_query = "SELECT * FROM users WHERE email='".$email."'";
    $result = $conn->query($check_query);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            if ($row['email'] == $email) {
                $_SESSION['error'][] = $email. " email address already exists";
                break;
            }
        }
        return $_SESSION['error'];
    } 
    return false;
}

// register user
function registerUser($name, $email, $password, $gender, $mobile_no, $address, $image) {
    global $conn;
    //$secure_password = password_hash($password, PASSWORD_BCRYPT);
    if (sizeof($_SESSION['error']) == 0) {
        $sql = "INSERT INTO users (name, email, password, gender, mobile_no, address, image) VALUES('".$name."', '".$email."', '".$password."', '".$gender."', '".$mobile_no."', '".$address."', '".$image."')";
        if ($conn->query($sql) === true) {
            $_SESSION['success'] = "Your account has been created! ";
            return $_SESSION['success'];
        } else {
            $_SESSION['error'][] = $conn->error;
            return $_SESSION['error'];
        }
    }
    return false;
}

// add questions to quiz
function addQuestion($question, $option1, $option2, $option3, $option4, $answer, $exam_no) {
    global $conn;
    if (empty($_SESSION['error'])) {
        $sql = "INSERT INTO questions (question, option1, option2, option3, option4, answer, exam_no) VALUES('".$question."', '".$option1."', '".$option2."', '".$option3."', '".$option4."', '".$answer."', '".$exam_no."')";
        if ($conn->query($sql) === true) {
            $_SESSION['success'] = "Question has been added to test ".$exam_no;
            return $_SESSION['success'];
        } else {
            $_SESSION['error'][] = $conn->error;
            return $_SESSION['error'];
        }
    }
    return false;
} 

//check exam's result and shows it to user in their dashboard
function answer($data) {
    global $conn;
    $ans = implode(" ", $data);
    $exam_no = $_POST['exam_no'];
    $user_id = $_POST['user_id'];
    $right = 0;
    $wrong = 0;
    $no_answer = 0;
    $sql = "SELECT ques_id, answer FROM questions WHERE exam_no='".$exam_no."'";
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
        if($row['answer'] == $_POST[$row['ques_id']]) { // 1st option is correct
            $right++;
        }
        elseif($_POST[$row['ques_id']] == "no_attempt") {
            $no_answer++;
        }
        else {
            $wrong++;
        }
    }
    $array = array();
    $array['exam_no'] = $exam_no;
    $array['right'] = $right;
    $array['wrong'] = $wrong;
    $array['no_answer'] = $no_answer;
    $marks = implode(',', $array);

    $sql1 = "INSERT INTO user_exam_result (user_id, exam_id, marks, date) VALUES('".$user_id."', '".$exam_no."', '".$marks."', now())";
    $conn->query($sql1);
    return $array;
}

//shows test's questions in admin panel
function showQuestions() {
    global $conn, $exam_no;
    $sql = "SELECT * FROM questions WHERE exam_no='".$exam_no."'";
    $result = $conn->query($sql);
    $count = $result->num_rows;
    echo '<div class="table-title"><h2>Test '.$exam_no.' ('.$count.' questions)</h2></div>';
    if ($result->num_rows > 0) { 
        $i = 1;
        $html = '';
        while ($row = $result->fetch_assoc()) { 
            echo $html = '<div class="question">
                <div><span>'.$i.')</span>'.$row['question'].'</div> 
                <div><span>Option 1:</span>'.$row['option1'].'</div>
                <div><span>Option 2:</span>'.$row['option2'].'</div>
                <div><span>Option 3:</span>'.$row['option3'].'</div>
                <div><span>Option 4:</span>'.$row['option4'].'</div>
                <div><span>Answer:</span>Option '.($row['answer']+1).'</div> 
                <div><a class="delete" href="deleteTest.php?action=delete&ques_id='.$row["ques_id"].'&number='.$i.'&exam_no='.$exam_no.'" data-toggle="tooltip" title="Delete Question">Delete <i class="fa fa-trash"></i></a></div> 
                </div> ';
            $i++; 
        }
    } 
    return false;
}

//shows test's question in user's dashboard and submit test
function showExamQuestions() {
    global $conn, $exam_no, $user_id;
    $sql = "SELECT * FROM questions WHERE exam_no='".$exam_no."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {    
        $count = $result->num_rows;
        $i = 1;
        echo '<h4>Total '.$count.' questions</h4>';
        $html = '<form action="score.php" method="post" class="exam">';
        while ($row = $result->fetch_assoc()) { 
            $html .= '<p>'.$i.') '.$row['question'].'</p>';
            if(isset($row['option1'])) {
            $html .= '<div class="radio"><label><input type="radio" name="'.$row['ques_id'].'" value="0">'.$row['option1'].'</label></div>';                    
            }
            if(isset($row['option2'])) {
            $html .= '<div class="radio"><label><input type="radio" name="'.$row['ques_id'].'" value="1">'.$row['option2'].'</label></div>';
            }
            if(isset($row['option3'])) {
            $html .= '<div class="radio"><label><input type="radio" name="'.$row['ques_id'].'" value="2">'.$row['option3'].'</label></div>';
            }
            if(isset($row['option4'])) {
            $html .= '<div class="radio"><label><input type="radio" name="'.$row['ques_id'].'" value="3">'.$row['option4'].'</label></div>';
            }
            $html .= '<div class="radio" style="display:none" ><label><input type="radio" checked="checked" name="'.$row['ques_id'].'" value="no_attempt"></label></div>';
            $i++; 
        }
        echo $html .= '<input type="hidden" name="exam_no" value="'.$exam_no.'" /><input type="hidden" name="user_id" value="'.$user_id.'" /><input type="submit" name="quiz" value="Submit"></form>';
    } 
    return false;
}

//user submit test by using previous/next question button
function enableSingleQuestion() {
    global $conn, $exam_no, $user_id;;
    $sql = "SELECT * FROM questions WHERE exam_no='".$exam_no."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {    
        $count = $result->num_rows;
        $i = 1;
        $html = '<form action="score.php" method="post" class="exam" id="examForm" >';
        while ($row = $result->fetch_assoc()) { 
            $html .= '<div class="tab"><h4>Question '.$i.' of '.$count.':</h4><p>'.$row['question'].'</p>';
            if(isset($row['option1'])) {
            $html .= '<div class="radio"><label><input type="radio" name="'.$row['ques_id'].'" value="0">'.$row['option1'].'</label></div>';                    
            }
            if(isset($row['option2'])) {
            $html .= '<div class="radio"><label><input type="radio" name="'.$row['ques_id'].'" value="1">'.$row['option2'].'</label></div>';
            }
            if(isset($row['option3'])) {
            $html .= '<div class="radio"><label><input type="radio" name="'.$row['ques_id'].'" value="2">'.$row['option3'].'</label></div>';
            }
            if(isset($row['option4'])) {
            $html .= '<div class="radio"><label><input type="radio" name="'.$row['ques_id'].'" value="3">'.$row['option4'].'</label></div>';
            }
            $html .= '<div class="radio" style="display:none" ><label><input type="radio" checked="checked" name="'.$row['ques_id'].'" value="no_attempt"></label></div>';
            $html .= '</div>';
            $i++; 
        }

        echo $html .= '<input type="hidden" name="exam_no" value="'.$exam_no.'" /><input type="hidden" name="user_id" value="'.$user_id.'" /><div><button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button><button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button></div></form>';
    } 
    return false;
}

?>