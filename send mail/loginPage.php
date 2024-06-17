<?php
    include_once "../db/dbconnector.php";
    if (isset($_POST['submit'])){
    
        if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["email"])){
    
            function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
            }    
    
            $username = validate($_POST["username"]);
            $email = validate($_POST["email"]);
            $password = validate($_POST["password"]);
        
            if(empty($username)){
                header("Location: loginPage.php?error=Username is required");
                exit();
            }else if(empty($email)){
                header("Location: loginPage.php?error=Email is required");
                exit();
            }else if(empty($password)){
                header("Location: loginPage.php?error=Password is required");
                exit();
            }else{
                $sql = "SELECT * FROM users WHERE username='$username' AND passwords='$password'";
            
                $rs = mysqli_query($conn,$sql);
        
                if(mysqli_num_rows($rs)===1){
                $row = mysqli_fetch_assoc($rs);
                if($row['username']===$username && $row['passwords']=== $password && $row['email']===$email && $row['activity']==='1')
                {
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['password'] = $row['passwords'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['userrole'] = $row['userrole'];
                    $_SESSION['userID'] = $row['userID'];
                
                    header("Location: HomePage.php");
                    
                }else{
                    header("Location: loginPage.php?error=Incorrect username or password");
                    exit();
                }
                }else{
                    header("Location: loginPage.php?error=Incorrect username or password");
                    exit();
                }
            } 
            }else{
                header("Location: loginPage.php");
                exit();
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
        <title>Login</title>
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
                    <p class="mt-4 text-white text-center">Please login with your credentials</p>
                    <p class="text-white text-center" style="text-decoration: underline; cursor: pointer;">Learn more about how we work</p>
                    <div class="text-center">
                        <img class="mb-5 mt-2" src="../Images/Logo.png" height="50px" width="50px" style="cursor: pointer; mix-blend-mode: multiply;" onclick="window.location.href='http://localhost/ICS%20Project%201/System%20Development/Common%20Pages/landingPage.html'">
                    </div>
                </div>
                <div class="col-6 d-flex justify-content-center">
                    <form method="POST" action="" class="px-5 py-5">
                        <h3>Login</h3>
                        <p class="mt-3" style="color: grey;">Access Your Account Using Your Credentials</p>

                        <label for="username" class="mt-3">Username:</label><br>
                        <input class="form-control" type="text" id="username" name="username" required><br>
                      
                        <label for="email">Email:</label><br>
                        <input class="form-control" type="text" id="email" name="email" required><br>
                      
                        <label for="Password">Password:</label><br>
                        <input class="form-control" type="password" id="password" name="password" required><br>

                        <p style="font-size: small;">Don't have an account? <span style="color: blue;"><a href="signUpPage.php" style="text-decoration: none; color: blue;">Create Account</a></span></p>
                      
                        <input class="btn text-white px-2 form-control" type="submit" id="submit" name="submit" value="Login" style="background-color: #23297A; border-radius: 20px;">
                      
                      </form>
                </div>
            </div>
        </div>
    </body>
</html>