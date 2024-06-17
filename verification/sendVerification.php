<?php
    require_once("../db/dbconnector.php");
    session_start();
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php';

    function sendemail_verify($username, $email, $verify_token){
        $mail = new PHPMailer(true);

        $mail->isSMTP();                                            //Send using SMTP
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication

        $mail->Host       = 'smtp.strathmore.edu';                  //Set the SMTP server to send through
        $mail->Username   = 'user@gmail.com';                       //SMTP username
        $mail->Password   = 'raphaelm';                             //SMTP password

        $mail->SMTPSecure = "tls";                                  //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if 
    };

    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cfpassword = $_POST['cfpassword'];
        $verify_token = md5(rand());

        //Check if Email Already Exists
        $check_existing_email = "SELECT email from users WHERE email='$email' LIMIT 1";
        $cee_run = mysqli_query($conn, $check_existing_email);

        if(mysqli_num_rows($cee_run) > 0){
            $_SESSION['status'] = "Email Already Exists";
            header("Location: signUpPage.php");
        }
        else-if($password===$cfpassword){
            $sql = "INSERT INTO users(username, email, passwords, verify_token) VALUES('$username', '$email', '$password', '$verify_token')";
            $rs = mysqli_query($conn,$sql);

            if($rs){
                sendemail_verify("$username", "$email", "$verify_token");
                $_SESSION['status'] = "Registration Succesful: Please Verify your Email Address";
                header("Location: signUpPage.php");
            }
            else{
                $_SESSION['status'] = "Registration Failed: Try Again";
                header("Location: signUpPage.php");
            }
        }
    }
?>
