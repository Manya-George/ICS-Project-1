<?php
    require_once("../db/dbconnector.php");
    session_start();

    $userID = $_SESSION["userID"];
    $recordAdded = false;

    if(isset($_POST['submit'])){

        $target = $_POST['savingAmount'];
        $month = $_POST['month'];
          
            $sql = "INSERT INTO targets(target, duration, userID) VALUES('$target', '$month', '$userID')";
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
        <title>Add Target Page</title>
    </head>
    <body>
        <div class="container">
            <div class="row align-items-center">
                <h2 class="text-center mt-4 mb-4 mx-5 px-5">Set Your Saving Targets<span class="mx-5 px-5"><i id="close" class="bi bi-x fs-1" style="color: black; cursor: pointer;" title="Close Page" onclick="window.location.href='targetsPage.php'"></i></span></h2>
            </div>
                <form method="POST" id="targetsForm">
                    <div class="mb-3">
                        <label for="savingAmount" class="form-label">Amount To Save (Ksh.)</label>
                        <input type="text" class="form-control" id="savingAmount" name="savingAmount" required>
                    </div>
                    <div class="mb-3">
                        <label for="month" class="form-label">Month</label>
                        <select class="form-select" id="month" name="month" required>
                            <option value="">Select Month</option>
                            <option value="January">January</option>
                            <option value="February">February</option>
                            <option value="March">March</option>
                            <option value="April">April</option>
                            <option value="May">May</option>
                            <option value="June">June</option>
                            <option value="July">July</option>
                            <option value="August">August</option>
                            <option value="September">September</option>
                            <option value="October">October</option>
                            <option value="November">November</option>
                            <option value="December">December</option>
                        </select>
                    </div>

                    <input class="btn text-white px-2 form-control mt-4" type="submit" id="submit" name="submit" value="Add Target" style="background-color: #8282AB; border-radius: 20px;">
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
                    window.location.href = 'viewTargets.php';
                }, 2000);
            }

            <?php if ($recordAdded): ?>
            showAlert();
            <?php endif; ?>
        </script>
    </body>
</html>