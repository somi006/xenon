<?php
include_once 'config.php';

if(isset($_SESSION['id'])) {
    if($_SESSION['id'] != '') {
        header('Location: welcome.php');
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $flagError = true;
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $re_pass = $_POST['re_pass'];
    $terms = isset($_POST['terms']) ? $_POST['terms'] : '';

    if($name == '') {
        $flagError = false;
        $errName = 'Name is required.';
    }
    if($email == '') {
        $flagError = false;
        $errEmail = 'Email is required.';
    } elseif($email != '') {
        $sqlEmail = "SELECT email FROM users WHERE email = '".$email."'";
        $checkEmail = mysqli_query($conn, $sqlEmail);
        if($checkEmail->num_rows > 0) {
            $flagError = false;
            $errEmail = 'Email already exist.';
        }
    }
    if($pass == '') {
        $flagError = false;
        $errPass = 'Password is required.';
    }
    if($re_pass == '') {
        $flagError = false;
        $errRePass = 'Confirm Password is required.';
    }
    if($pass != $re_pass || $re_pass != $pass) {
        $flagError = false;
        $errPass = 'Password and cofirm password did not matched.';
    }
    if($terms == '') {
        $flagError = false;
        $errTerms = 'Terms of service is required.';
    }

    if($flagError) {
        try {
            $sql = "insert into users (full_name,email,password,status) 
                    values('".$name."', '".$email."', '".md5($pass)."', 1)";
            $affected = mysqlI_query($conn, $sql);

            if($affected) {
                $sqlPass = "SELECT id,full_name,email,password,status FROM users WHERE email = '".$email."' and password = '".md5($pass)."'";
                $checkPass = mysqli_query($conn, $sqlPass);
                $userData = mysqli_fetch_array($checkPass, MYSQLI_ASSOC);

                $_SESSION['id'] = $userData['id'];
                $_SESSION['name'] = $userData['full_name'];
                $_SESSION['email'] = $userData['email'];
                $_SESSION['status'] = $userData['status'];

                $sucMsg = 'Registration Successful.';
                header('Location: welcome.php');
            } else {
                $errMsg = "An unexpected error has been occurred, please try again.";
            }
        } catch (Throwable $th) {
            $errMsg = 'Failed to register, please try again.';
        }
    }
}



include_once 'html/register.html';