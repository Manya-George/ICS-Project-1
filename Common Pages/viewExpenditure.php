<?php

    require_once("../db/dbconnector.php");
    session_start();
    $userID = $_SESSION["userID"];

    $sql = "SELECT * FROM transactions WHERE userID='$userID'";
    $rs = $conn->query($sql);

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
        <title>Your Expenditure</title>
    </head>
    <body>
        <h2 class="text-center mt-4 mb-4 mx-5 px-5">Your Expenditure<span class="mx-5 px-5"><i id="close" class="bi bi-x fs-1" style="color: black; cursor: pointer;" title="Close Page" onclick="window.location.href='expenditurePage.php'"></i></span></h2>
        <table class="table table-striped container">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Payment Method</th>
                </tr>
            </thead>
            <?php
                while($row = $rs->fetch_assoc()){
            ?>
            <tbody>
                <tr>
                    <td><?php echo $row['expensename'];?></td>
                    <td><?php echo $row['amount'];?></td>
                    <td><?php echo $row['category'];?></td>
                    <td><?php echo $row['datepaid'];?></td>
                    <td><?php echo $row['paymentmethod'];?></td>
            
                </tr>
            </tbody>
            <?php
                }
            ?>
        </table>
    </body>
</html>