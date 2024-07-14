<?php

    require_once("../db/dbconnector.php");
    session_start();

    $userID = $_SESSION["userID"];
    $recordAdded = false;

    $sql = "SELECT * FROM users WHERE userID ='$userID'";
    $rs = $conn->query($sql);
    $row = $rs->fetch_assoc(); 
    $verificationtoken = $row["verify_token"];

    if(isset($_POST['add'])){

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
    
            $sql1 = "INSERT INTO users(username, email, passwords, verify_token, activity, createdBy) VALUES('$username', '$email', '$password', '$verificationtoken', '1', '$userID')";
            $rs1 = mysqli_query($conn,$sql1);

            if ($rs1) {
                $recordAdded = true;
            } else {
                echo "Error: " . mysqli_error($conn);
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
        <style>
            .alert-box {
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                padding: 20px;
                background-color: #dff0d8;
                color: #3c763d;
                border: 1px solid #d6e9c6;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                display: none;
            }
        </style>
        <title>Add New User</title>
    </head>
    <body  style="background-color: #E6E6EE;">
        <div class="container-fluid mt-2">
            <div class="row">
                <?php
                    include "../reusable/sidebar.php";
                ?>
                <div class="col-10 my-2 mx-5 px-5">
                    <section style="background: white; border-radius: 50px;">
                        <div class="container justify-content-center">
                            <form method="POST" class="px-5 py-5" id="createAccount">
                                <h3 class="text-center">New User Information</h3>
                                <p class="text-center mt-3" style="color: grey;">Add New User Account Information Below</p>

                                <label for="username" class="mt-3">User Name:</label><br>
                                <input class="form-control" type="text" id="username" name="username"><br>

                                <label for="email" class="mt-3">Email:</label><br>
                                <input class="form-control" type="text" id="email" name="email"><br>

                                <label for="password" class="mt-3">Password:</label><br>
                                <input class="form-control" type="password" id="password" name="password"><br>
                                    
                                <input class="btn text-white px-2 form-control" type="submit" id="add" name="add" value="Add User" style="background-color: #8282AB; border-radius: 20px;">                      
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <div id="alertBox" class="alert-box">
            <strong class="text-center">Confirmed!</strong><br> User Added Successfully!
        </div>

    <script>
        function showAlert() {
            var alertBox = document.getElementById('alertBox');
            alertBox.style.display = 'block';
            setTimeout(function() {
                alertBox.style.display = 'none';
                window.location.href = 'viewAccounts.php';
            }, 2000);
        }

        <?php if ($recordAdded): ?>
        showAlert();
        <?php endif; ?>
    </script>
    </body>
</html>