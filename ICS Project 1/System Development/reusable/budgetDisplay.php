<?php
    require_once("../db/dbconnector.php");
    
    $sql = "SELECT * FROM budget WHERE userID ='$userID'";
    $rs = $conn->query($sql);  
    $row = $rs->fetch_assoc();

    $budget = $row['budget'];

    if($budget === null || $budget === ''){
        $budget = 0;
    }

        $expenditureQuery = "SELECT SUM(amount) as total_expenditure FROM transactions WHERE userID = ?";
        $stmt = $conn->prepare($expenditureQuery);
        $stmt->bind_param("s", $userID);
        $stmt->execute();
        $expenditureResult = $stmt->get_result();
        $expenditureRow = $expenditureResult->fetch_assoc();
        $totalExpenditure = $expenditureRow['total_expenditure'] ?? 0;

        // Calculate balance
        $balance = $budget - $totalExpenditure;

        $stmt->close();

?>
<!DOCTYPE html>
<html>
    <body>
    <div>
        <h3>May</h3>
        <div>
            <strong>Total Budget:</strong> <span id="totalBudget">Ksh. <?php echo $budget ?></span><br>
            <strong>Total Expenditure:</strong> <span id="totalExpenditure">Ksh. <?php echo $totalExpenditure ?></span><br>
            <strong>Balance:</strong> <span id="balance">Ksh. <?php echo $balance ?></span>
        </div>
    </div>
    </body>
</html>