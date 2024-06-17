<?php
    require_once("../db/dbconnector.php");
    session_start();
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cfpassword = $_POST['cfpassword'];
      
        if($password===$cfpassword){      
            $sql = "INSERT INTO users(username, email, passwords) VALUES('$username', '$email', '$password')";
            $rs = mysqli_query($conn,$sql);

            if($rs){
                /*$_SESSION['status']="Account created successfully";
                header("location:  adminLogin.php");*/
            }
        }
        else{
            /*header ("location:  adminSignUp.php?error=Wrong password");
            exit();*/
        }  
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/webp" href="../Images/Logo.png">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
        <title>Sign Up</title>
        <style>
            p span:hover{
                text-decoration: underline;
                cursor: pointer;
            }
        </style>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-6 bg-gradient" style="background-color: #23297A;">
                    <h2 class="mt-5 mb-5 text-white text-center">Plan your finances<br>today</h2>
                    <div class="text-center">
                        <img src="../Images/signUpPageImg.png" height="250px" width="400px">
                    </div>
                    <p class="mt-4 text-white text-center">Start Your Journey With Us Today</p>
                    <p class="text-white text-center" style="text-decoration: underline; cursor: pointer;">Learn more about how we work</p>
                    <div class="text-center">
                        <img class="mb-5 mt-2" src="../Images/Logo.png" height="50px" width="50px" style="cursor: pointer; mix-blend-mode: multiply;" onclick="window.location.href='http://localhost/ICS%20Project%201/System%20Development/Common%20Pages/landingPage.html'">
                    </div>
                </div>
                <div class="col-6 d-flex justify-content-center">
                    <form action="sendmail.php" method="POST" class="px-5 py-5" id="signUp">
                        <h3>Create Your Account</h3>
                        <p class="mt-3" style="color: grey;">Sign Up Below to Create Your Account Today</p>

                        <label for="username" class="mt-3">Username:</label><br>
                        <input class="form-control" type="text" id="username" name="username" required><br>
                      
                        <label for="email">Email:</label><br>
                        <input class="form-control" type="text" id="email" name="email" required><br>
                      
                        <label for="Password">Password:</label><br>
                        <input class="form-control" type="password" id="password" name="password" required><br>

                        <label for="PasswordConfirm">Confirm Password:</label><br>
                        <input class="form-control" type="password" id="cfpassword" name="cfpassword" required><br>

                        <p style="font-size: small;">Already have an account? <span style="color: blue;"><a href="../Common Pages/loginPage.php" style="text-decoration: none; color: blue;">Log In</a></span></p>
                      
                        <input class="btn text-white px-2 form-control" type="submit" id="submit" name="submit" value="Sign Up" style="background-color: #23297A; border-radius: 20px;">
                      
                      </form>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> 
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </body>
</html>