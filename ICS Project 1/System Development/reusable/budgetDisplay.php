<?php
require_once("../db/dbconnector.php");


$userID = $_SESSION['userID'];
$selectedMonth = $_GET['month'] ?? date('F'); // Default to the current month if not specified

$sql = "SELECT SUM(budget) as total_budget, breakpoint, months FROM Budget WHERE userID = ? AND months = ? GROUP BY months";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $userID, $selectedMonth);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$budget = $row['total_budget'] ?? 0;
$breakpoint = $row['breakpoint'] ?? 0;
$months = $row['months'] ?? "No Month Specified";

$expenditureQuery = "SELECT SUM(amount) as total_expenditure FROM transactions WHERE userID = ?";
$stmt = $conn->prepare($expenditureQuery);
$stmt->bind_param("s", $userID);
$stmt->execute();
$expenditureResult = $stmt->get_result();
$expenditureRow = $expenditureResult->fetch_assoc();
$totalExpenditure = $expenditureRow['total_expenditure'] ?? 0;

$balance = $budget - $totalExpenditure;

$stmt->close();

$balanceColor = ($balance < $breakpoint) ? 'red' : 'green';
$balanceMessage = ($balance < $breakpoint) ? 'Exceeded Budget' : 'Within Budget';
?>
<!DOCTYPE html>
<html>
    <body>
    <div>
        <h3><?php echo $months ?></h3>
        <div>
            <strong>Total Budget:</strong> <span id="totalBudget">Ksh. <?php echo $budget ?></span><br>
            <strong>Total Expenditure:</strong> <span id="totalExpenditure">Ksh. <?php echo $totalExpenditure ?></span><br>
            <strong>Balance:</strong> <span id="balance" style="color: <?php echo $balanceColor; ?>;">Ksh. <?php echo $balance ?></span>
        </div>
    </div>
    </body>
</html>
