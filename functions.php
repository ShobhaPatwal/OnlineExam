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
        echo $sql = "INSERT INTO users (name, email, password, gender, mobile_no, address, image) VALUES('".$name."', '".$email."', '".$password."', '".$gender."', '".$mobile_no."', '".$address."', '".$image."')";
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
        echo $sql = "INSERT INTO questions (question, option1, option2, option3, option4, answer, exam_no) VALUES('".$question."', '".$option1."', '".$option2."', '".$option3."', '".$option4."', '".$answer."', '".$exam_no."')";
        if ($conn->query($sql) === true) {
            $_SESSION['success'] = "Question has been added to quiz.";
            return $_SESSION['success'];
        } else {
            $_SESSION['error'][] = $conn->error;
            return $_SESSION['error'];
        }
    }
    return false;
} 

//function for checking answers
function answer($data) {
    global $conn;
    $ans = implode(" ", $data);
    $exam_no = $_POST['exam_no'];
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
    return $array;
}

?>