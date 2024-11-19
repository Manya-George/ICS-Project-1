<?php
require_once("../db/dbconnector.php");
session_start();

$userID = $_SESSION["userID"];

if (isset($_POST['save'])) {
    $budget = $_POST['budgetAmount'];
    $duration = $_POST['budgetType'];
    $breakpoint = $_POST['breakpoint'];

    $sql1 = "INSERT INTO Budget(budget, breakpoint, userID, duration) VALUES ('$budget', '$breakpoint', '$userID', '$duration')";
    $rs1 = mysqli_query($conn, $sql1);
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
    <title>Home Page</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body style="background-color: #E6E6EE;">
<div class="container-fluid mt-2">
    <div class="row">
        <?php include "../reusable/sidebar.php"; ?>
        <div class="col-6 my-2 py-1 mx-4 px-3">
            <?php include "../reusable/budgetDisplay.php"; ?>
            <div style="background: white; border-radius: 50px;" class="mt-3 px-3 py-5">
                <h3>Fill your Budgets</h3>
                <form method="POST" id="budgetForm">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Amount (Ksh.)</th>
                                <th>Type</th>
                                <th>Break Point</th>
                            </tr>
                        </thead>
                        <tbody id="budgetsContainer">
                            <!-- Dynamic budget rows addition -->
                        </tbody>
                    </table>
                    <div>
                        <div style="display: flex; gap: 10px;">
                            <input class="btn text-white px-4 form-control mt-4" type="submit" id="addBudget" name="addBudget" value="Add Budget" style="background-color: #8282AB; border-radius: 20px;"> 
                            <input class="btn text-white px-4 form-control mt-4" type="submit" id="save" name="save" value="Save Budget" style="background-color: #8282AB; border-radius: 20px;"> 
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-4 my-2 py-1 mx-2 px-3" style="background-color: white; border-radius: 25px;">
            <div class="d-flex">
                <p class="py-2 px-2">Within Budget</p>
                <div class="my-3" style="width: 10px; height: 10px; border-radius: 10px; background-color: green;"></div>
            </div>
            <div>
                <?php
                // Assuming you have a session variable for the user ID
                $userID = $_SESSION['userID'];
                $duration = $_GET['duration'] ?? 'monthly'; // Default to monthly if not specified

                function getWeeklyData($conn, $userID) {
                    $sql = "SELECT WEEK(datepaid) as week, SUM(amount) as expenditure
                            FROM Transactions
                            WHERE userID = ?
                            GROUP BY week";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $userID);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $weeklyExpenditures = [];
                    while ($row = $result->fetch_assoc()) {
                        $weeklyExpenditures[$row['week']] = $row['expenditure'];
                    }

                    $sql = "SELECT duration, SUM(budget) as budget
                            FROM Budget
                            WHERE userID = ? AND duration = 'weekly'
                            GROUP BY duration";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $userID);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $weeklyBudgets = [];
                    while ($row = $result->fetch_assoc()) {
                        $weeklyBudgets[$row['duration']] = $row['budget'];
                    }

                    return ['expenditures' => $weeklyExpenditures, 'budgets' => $weeklyBudgets];
                }

                function getMonthlyData($conn, $userID) {
                    $sql = "SELECT MONTH(datepaid) as month, SUM(amount) as expenditure
                            FROM Transactions
                            WHERE userID = ?
                            GROUP BY month";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $userID);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $monthlyExpenditures = [];
                    while ($row = $result->fetch_assoc()) {
                        $monthlyExpenditures[$row['month']] = $row['expenditure'];
                    }

                    $sql = "SELECT duration, SUM(budget) as budget
                            FROM Budget
                            WHERE userID = ? AND duration = 'monthly'
                            GROUP BY duration";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $userID);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $monthlyBudgets = [];
                    while ($row = $result->fetch_assoc()) {
                        $monthlyBudgets[$row['duration']] = $row['budget'];
                    }

                    return ['expenditures' => $monthlyExpenditures, 'budgets' => $monthlyBudgets];
                }

                $data = $duration == 'weekly' ? getWeeklyData($conn, $userID) : getMonthlyData($conn, $userID);

                // Output the data to the JavaScript
                echo "<script>var chartData = " . json_encode($data) . ";</script>";
                ?>
                <canvas id="budgetChart"></canvas>
            </div>
        </div>
    </div>
</div>
<script>
    var budgetsContainer = document.getElementById('budgetsContainer');
    var addBudgetButton = document.getElementById('addBudget');

    addBudgetButton.addEventListener('click', function() {
        var budgetRow = document.createElement('tr');
        budgetRow.innerHTML = `
            <td><input type="number" class="form-control" id="budgetAmount" name="budgetAmount" required></td>
            <td>
                <select class="form-select" id="budgetType" name="budgetType" required>
                    <option value="">Select Type</option>
                    <option value="Weekly">Weekly</option>
                    <option value="Monthly">Monthly</option>
                </select>
            </td>
            <td><input type="number" class="form-control" id="breakpoint" name="breakpoint" required></td>
        `;
        budgetsContainer.appendChild(budgetRow);
    });

    // Function to plot the chart
    function plotChart(data) {
        const ctx = document.getElementById('budgetChart').getContext('2d');
        const labels = Object.keys(data.expenditures).map(key => {
            return data.expenditures[key] ? key : '';
        });
        const expenditures = Object.values(data.expenditures);
        const budgets = Object.values(data.budgets);

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Expenditures',
                        data: expenditures,
                        borderColor: 'red',
                        backgroundColor: 'rgba(255, 0, 0, 0.2)',
                        fill: false
                    },
                    {
                        label: 'Budgets',
                        data: budgets,
                        borderColor: 'green',
                        backgroundColor: 'rgba(0, 255, 0, 0.2)',
                        fill: false
                    }
                ]
            },
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Duration'
                        },
                        beginAtZero: true
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Amount (Ksh.)'
                        },
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        position: 'bottom' // Position the legend below the chart
                    }
                }
            }
        });
    }

    // Check if chartData is defined and plot the chart
    if (typeof chartData !== 'undefined') {
        console.log(chartData);
        plotChart(chartData);
    } else {
        console.error("chartData is not defined");
    }
</script>
</body>
</html>
