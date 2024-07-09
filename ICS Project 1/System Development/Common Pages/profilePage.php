<?php

    session_start();
    require_once("../db/dbconnector.php");

    $username = $_SESSION["username"];
    $qry1 = "SELECT * FROM users WHERE username ='$username'";
    $result1 = $conn->query($qry1);  
    $row1 = $result1->fetch_assoc();
    
    
    //$username = $row1['username'];
    $email = $row1["email"];
    $password = $row1["passwords"];

    if(isset($_POST['edit'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cfpassword = $_POST['cfpassword'];
      
        if($password===$cfpassword){      
            $sql = "UPDATE users SET username='$username', email='$email', passwords='$password' WHERE username='$username'";
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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <title>Your Profile</title>
    </head>
    <body  style="background-color: #E6E6EE;">
        <div class="container-fluid mt-2">
            <div class="row">
                <?php
                    include "../reusable/sidebar.php";
                ?>
                <div class="col-10 my-2 mx-5 px-5">
                    <section style="background: white; border-radius: 50px;">
                        <div class="d-flex justify-content-center">
                            <form method="POST" class="px-5 py-5" id="signUp">
                                <h3>Your Account Information</h3>
                                <p class="mt-3" style="color: grey;">View or Edit Your Profile Below</p>

                                <label for="username" class="mt-3">Username:</label><br>
                                <input class="form-control" type="text" id="username" name="username" value=<?php echo $username; ?>><br>
                                    
                                <label for="email">Email:</label><br>
                                <input class="form-control" type="text" id="email" name="email" value=<?php echo $email; ?>><br>
                                    
                                <label for="Password">Password:</label><br>
                                <input class="form-control" type="password" id="password" name="password" value=<?php echo $password; ?>><br>

                                <label for="PasswordConfirm">Confirm Password:</label><br>
                                <input class="form-control" type="password" id="cfpassword" name="cfpassword" required><br>
                                    
                                <input class="btn text-white px-2 form-control" type="submit" id="edit" name="edit" value="Edit" style="background-color: #8282AB; border-radius: 20px;">                      
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </body>
</html>