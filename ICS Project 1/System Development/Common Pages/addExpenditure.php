<?php
    require_once("../db/dbconnector.php");
    session_start();

    $userID = $_SESSION["userID"];
    $recordAdded = false;

    if(isset($_POST['submit'])){

        $expensename = $_POST['expenseName'];
        $expenseamount = $_POST['expenseAmount'];
        $category = $_POST['expenseType'];
        $dateofpayment = $_POST['dateofPayment'];
        $paymentmethod = $_POST['paymentMethod'];
          
            $sql = "INSERT INTO transactions(expensename, category, amount, paymentmethod, datepaid, userID) VALUES('$expensename', '$category', '$expenseamount', '$paymentmethod', '$dateofpayment', '$userID')";
            $rs = mysqli_query($conn,$sql);

            if ($rs) {
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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        <title>Add Expenditure Page</title>
    </head>
    <body>
        <div class="container">
            <div class="row align-items-center">
                <h2 class="text-center mt-4 mb-4 mx-5 px-5">Track Expenditures<span class="mx-5 px-5"><i id="close" class="bi bi-x fs-1" style="color: black; cursor: pointer;" title="Close Page" onclick="window.location.href='expenditurePage.php'"></i></span></h2>
            </div>
                <form method="POST" id="expenseForm">
                    <div class="mb-3">
                        <label for="expenseName" class="form-label">Expense Name</label>
                        <input type="text" class="form-control" id="expenseName" name="expenseName" required>
                    </div>
                    <div class="mb-3">
                        <label for="expenseAmount" class="form-label">Amount (Ksh.)</label>
                        <input type="number" class="form-control" id="expenseAmount" name="expenseAmount" required>
                    </div>
                    <div class="mb-3">
                        <label for="expenseType" class="form-label">Type</label>
                        <select class="form-select" id="expenseType" name="expenseType" required>
                            <option value="">Select Type</option>
                            <option value="Food">Food</option>
                            <option value="Transport">Transport</option>
                            <option value="Entertainment">Entertainment</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="dateofPayment" class="form-label">Date of Payment</label>
                        <input type="date" class="form-control" id="dateofPayment" name="dateofPayment" required>
                    </div>
                    <div class="mb-3">
                        <label for="paymentMethod" class="form-label">Payment Method</label>
                        <input type="text" class="form-control" id="paymentMethod" name="paymentMethod" required>
                    </div>

                    <input class="btn text-white px-2 form-control mt-4" type="submit" id="submit" name="submit" value="Add Expense" style="background-color: #8282AB; border-radius: 20px;">
                </form>
        </div>
        <div id="alertBox" class="alert-box">
            <strong class="text-center">Confirmed!</strong><br> Record Added Successfully!
        </div>

    <script>
        function showAlert() {
            var alertBox = document.getElementById('alertBox');
            alertBox.style.display = 'block';
            setTimeout(function() {
                alertBox.style.display = 'none';
                window.location.href = 'viewExpenditure.php';
            }, 2000);
        }

        <?php if ($recordAdded): ?>
        showAlert();
        <?php endif; ?>
    </script>
    </body>
</html>