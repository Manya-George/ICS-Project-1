<?php
    session_start();
    require_once("../db/dbconnector.php");
    if(isset($_POST['submit'])){

        if(isset($_POST["verification"])){

            function validate($data){
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }    
        
            $verification_code = validate($_POST["verification"]);

            if(empty($verification_code)){
                header("Location: verification.php?error=Verification Code is required");
                exit();
            }else{
                $sql = "SELECT * FROM users WHERE verify_token = '$verification_code'";
            
                $rs = mysqli_query($conn,$sql);
        
                if(mysqli_num_rows($rs)===1){
                    $row = mysqli_fetch_assoc($rs);

                    if($row['verify_token']===$verification_code){

                        $sql1 = "UPDATE users SET activity = '1' WHERE verify_token = '$verification_code'"; 
                        $rs1 = mysqli_query($conn,$sql1);

                        header("Location: loginPage.php");

                    }else{
                    header("Location: verification.php?error=Incorrect verification code");
                    exit();
                }
                }else{
                    header("Location: verification.php?error=Incorrect verification code");
                    exit();
                }
            } 
        }else{
            header("Location: verification.php");
            exit();
        }
    };
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/webp" href="../Images/Logo.png">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
        <title>Verify Account</title>
    </head>
    <body>
    <div class="container d-flex justify-content-center">
        <form method="POST" class="px-5 py-5" id="verifyAcc">
            <h3>Verify Your Account</h3>
            <p class="mt-3" style="color: grey;">Enter The Verification Code Sent To Your Email Below:</p>

            <label for="verification" class="mt-3">Verification Code:</label><br>
            <input class="form-control" type="text" id="verification" name="verification" required><br>
                      
            <input class="btn text-white px-2 form-control" type="submit" id="submit" name="submit" value="Verify Account" style="background-color: #23297A; border-radius: 20px;">
                      
        </form>
    </div>
    </body>
</html>