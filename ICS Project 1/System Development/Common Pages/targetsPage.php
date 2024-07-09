<?php
    require_once("../db/dbconnector.php");
    session_start();
    $userID = $_SESSION["userID"];

    if (isset($_POST['add'])){
        header("Location: addTarget.php");
    }
    elseif(isset($_POST['view'])){
        header("Location: viewTargets.php");
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
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <title>Targets Page</title>
    </head>
    <body  style="background-color: #E6E6EE;">
        <div class="container-fluid mt-2">
            <div class="row">
                <?php
                    include "../reusable/sidebar.php";
                ?>
                <div class="col-6 my-2 py-1 mx-4 px-3">
                    <?php
                        include "../reusable/budgetDisplay.php";
                    ?>
                    <div>
                        <section style="background: white; border-radius: 50px;" class="mt-3">
                            <div class="d-flex justify-content-center">
                                <form class="px-3 py-5" id="expenditure" method="POST">
                                    <h3>Targets</h3>
                                    <p class="mt-3" style="color: grey;">Add Your Saving Targets and Goals Below</p>

                                    <img src="../Images/goalsImg.png" width="450px" height="200px"><br>
                                        
                                    <input class="btn text-white px-2 form-control mt-4" type="submit" id="add" name="add" value="Add Saving Target" style="background-color: #8282AB; border-radius: 20px;" onclick="window.location.href='addTarget.php'">                       
                                </form>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="col-4 my-2 py-2 mx-2 px-3" style="background-color: white; border-radius: 25px;">
                    <div class="d-flex">
                        <p class="py-2 px-2">Within Saving Goal</p>
                        <div class="my-3" style="width: 10px; height: 10px; border-radius: 10px; background-color: green;"></div>
                    </div>
                    <div>
                        <?php
                            require_once("../db/dbconnector.php");

                            $sql = "SELECT category, SUM(amount) as total_amount FROM Transactions WHERE userID = ? GROUP BY category";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("s", $userID);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            $categories = [];
                            $amounts = [];

                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    $categories[] = $row['category'];
                                    $amounts[] = $row['total_amount'];
                                }
                            } else {
                                //echo '<img src="../Images/notransaction.png" alt="No transactions" width="400px" height="150px">';
                                echo '<h2>No Transcations Made</h2>';
                            }

                            $stmt->close();
                            include "../reusable/piechart.php";
                        ?>
                        <input class="btn text-white px-2 mb-2 mt-4 form-control" type="submit" id="view" name="view" value="View Set Goals" style="background-color: #8282AB; border-radius: 20px;" onclick="window.location.href='viewTargets.php'"> 
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>