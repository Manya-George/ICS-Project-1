<?php

    require_once("../db/dbconnector.php");
    session_start();

    if(isset($_GET['userID'])){

        $userID = $_GET['userID'];
        $month = isset($_GET['month']) ? $_GET['month'] : '';

        $sql = "SELECT * FROM transactions WHERE userID='$userID'";

        if ($month) {
            $sql .= " AND MONTHNAME(datepaid) = '$month'";
        }

        $rs = $conn->query($sql);

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
        <title>Your Expenditure</title>
    </head>
    <body>
        <h2 class="text-center mt-4 mb-4 mx-5 px-5">Your Expenditure<span class="mx-5 px-5"><i id="close" class="bi bi-x fs-1" style="color: black; cursor: pointer;" title="Close Page" onclick="window.location.href='viewAccounts.php'"></i></span></h2>
      
        <div class="container mb-4">
            <form method="GET" action="">
                <p class="mb-1">Search a particular month's expenditure:</p>
                <div class="input-group">
                    <input type="text" name="month" class="form-control" placeholder="Enter month (e.g., January, February)" value="<?php echo htmlspecialchars($month); ?>">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
        </div>

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
                    <td><i class="bi bi-trash" style="color: #FF2C2C; cursor: pointer;" title="Delete" onclick="window.location.href='deleteExpenditure.php?transactionID=<?php echo $row['transactionID']; ?>'"></i></td>
                </tr>
            </tbody>
            <?php
                }
            ?>
        </table>
    </body>
</html>