<?php

    require_once("../db/dbconnector.php");
    session_start();

    $userID = $_SESSION["userID"];

    if(isset($_POST['create'])){

        $accountname = $_POST['accountname'];
        $usernumber = $_POST['usernumber'];
    
            $sql = "INSERT INTO accounts(accountname, userID, usernumber) VALUES('$accountname', '$userID', '$usernumber')";
            $rs = mysqli_query($conn,$sql);
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
        <title>Create Family Account</title>
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
                                <h3 class="text-center">Your Account Information</h3>
                                <p class="text-center mt-3" style="color: grey;">Create Your Account Below</p>

                                <label for="accountname" class="mt-3">Account Name:</label><br>
                                <input class="form-control" type="text" id="accountname" name="accountname"><br>

                                <label for="usernumber" class="mt-3">Number of Users:</label><br>
                                <input class="form-control" type="text" id="usernumber" name="usernumber"><br>
                                    
                                <input class="btn text-white px-2 form-control" type="submit" id="create" name="create" value="Create Account" style="background-color: #8282AB; border-radius: 20px;">                      
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </body>
</html>