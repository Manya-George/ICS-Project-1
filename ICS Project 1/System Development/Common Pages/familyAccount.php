<?php
    session_start();
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
        <title>Family Account</title>
    </head>
    <body  style="background-color: #E6E6EE;">
        <div class="container-fluid mt-2">
            <div class="row">
                <?php
                    include "../reusable/sidebar.php";
                ?>
                <div class="col-10 my-2 mx-5 px-5">
                    <section style="background: white; border-radius: 50px;">
                        <div class="container justify-content-center px-3 py-3 pt-3 pb-3">
                            <h3 class="text-center mb-5 mt-4">Start a Family Financial Planning Account</h3>
                            <div class="row">
                                <div class="col mx-5">
                                    <img src="../Images/createfamilyaccount.png" alt="" width="200px" height="350px" style="border-radius: 5px; cursor: pointer;">
                                    <input class="btn text-white px-2 form-control mt-4 mb-4" type="submit" id="create" name="create" value="Create Family Account" style="background-color: #8282AB; border-radius: 20px;" onclick="window.location.href='createFamilyAccount.php'"> 
                                </div>
                                <div class="col mx-5">
                                    <img src="../Images/newuser.png" alt="" width="200px" height="350px" style="border-radius: 5px; cursor: pointer;">
                                    <input class="btn text-white px-2 form-control mt-4 mb-4" type="submit" id="add" name="add" value="Add New User" style="background-color: #8282AB; border-radius: 20px;" onclick="window.location.href='newUser.php'"> 
                                </div> 
                            </div>   
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </body>
</html>