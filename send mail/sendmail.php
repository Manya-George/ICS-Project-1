<?php
    session_start();
    require_once("../db/dbconnector.php");
    require_once 'vendor/autoload.php';

    if(isset($_POST['submit'])){

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cfpassword = $_POST['cfpassword'];

        function gen_using_md5($length = 16){
            $code = md5(mt_rand(0, mt_getrandmax()));
            $code = substr($code, 0, $length - 1);
            return $code;
        }
    
        $verification_code = gen_using_md5();

        if($password===$cfpassword){      
            $sql = "INSERT INTO users(username, email, passwords, verify_token) VALUES('$username', '$email', '$password', '$verification_code')";
            $rs = mysqli_query($conn,$sql);

            if($rs){
                // Create the Transport
                $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls'))
                ->setUsername('george.manya@strathmore.edu')
                ->setPassword('clkpzrazfytumwhd')
                ;
        
                // Create the Mailer using your created Transport
                $mailer = new Swift_Mailer($transport);

                $bodyContent = '<h3>Copy the authentication code below</h3>
                                <a href="http://localhost/ICS%20Project%201/System%20Development/Common%20Pages/loginPage.php" id="verificationcode">' . $verification_code . '</a>
                                ';
                
                // Create a message
                $message = (new Swift_Message())

                ->setSubject('Verify Your Email')
                ->setFrom(['george.manya@strathmore.edu' => 'Track It'])
                ->setTo([$email])
                ->setBody($bodyContent, 'text/html')
                ;
                
                // Send the message
                $result = $mailer->send($message);
                if($result){
                    $_SESSION['status'] = "Thank you for signing up."; 
                    header("Location: verification.php");
                    exit(0);
                }
                else{
                    $_SESSION['status'] = "Something went wrong while sending email."; 
                    header("Location: {$_SERVER["HTTP_REFERER"]}");
                    exit(0);
                }
            }
        }   
        else{
            /*header ("location:  adminSignUp.php?error=Wrong password");
            exit();*/
        }  
    }
    else{
        header("Location: ../Common Pages/signUpPage.php");
        exit(0);
    }
?>