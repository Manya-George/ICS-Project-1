<?php

    require_once("../db/dbconnector.php");
    session_start();
    $userID = $_SESSION["userID"];

    $sql = "SELECT * FROM users WHERE createdBy='$userID'";
    $rs = $conn->query($sql);

    /*if (isset($_POST['deactivate'])){
        header("Location: deleteAccount.php");
    }*/

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
        <title>Your Family Accounts</title>
    </head>
    <body>
        <h2 class="text-center mt-4 mb-4 mx-5 px-5">Your Family Accounts<span class="mx-5 px-5"><i id="close" class="bi bi-x fs-1" style="color: black; cursor: pointer;" title="Close Page" onclick="window.location.href='homePage.php'"></i></span></h2>
        <table class="table table-striped container">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Activity</th>
                </tr>
            </thead>
            <?php
                while($row = $rs->fetch_assoc()){
            ?>
            <tbody>
                <tr>
                    <td><?php echo $row['username'];?></td>
                    <td><?php echo $row['email'];?></td>
                    <td><?php echo $row['passwords'];?></td>
                    <td><?php echo $row['activity'];?></td> 
                    <td><input class="btn text-white px-2 py-2" type="submit" id="budget" name="budget" value="Assign Budget" style="background-color: #299617; border-radius: 5px;" onclick = "window.location.href='assignBudget.php?userID=<?php echo $row['userID']?>'"></td>
                    <td><input class="btn text-white px-2 py-2" type="submit" id="budget" name="budget" value="View Expenditure" style="background-color: #299617; border-radius: 5px;" onclick = "window.location.href='accountExpenditure.php?userID=<?php echo $row['userID']?>'"></td> 
                    <td><input class="btn text-white px-2 py-2" type="submit" id="deactivate" name="deactivate" value="Deactivate Account" style="background-color: #FF2C2C; border-radius: 5px;" onclick = "window.location.href='deleteAccount.php?userID=<?php echo $row['userID']?>'"></td>  
                    <td><input class="btn text-white px-2 py-2" type="submit" id="reactivate" name="reactivate" value="Reactivate Account" style="background-color: #007BFF; border-radius: 5px;" onclick = "window.location.href='reactivateAccount.php?userID=<?php echo $row['userID']?>'"></td>   
                    <td><i class="bi bi-chat-dots" style="cursor: pointer; width: 25px; height: 25px;" title="Chat" onclick = "window.location.href='../demos/message.html'"></i></td>     
                </tr>
            </tbody>
            <?php
                }
            ?>
        </table>
    </body>
</html>