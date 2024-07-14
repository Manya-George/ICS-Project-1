<?php

    require_once("../db/dbconnector.php");
    session_start();

    if (isset($_GET['transactionID'])) {
        $transactionID = $_GET['transactionID'];
        $userID = $_SESSION["userID"];
    
        // Prepare the SQL statement
        $sql = "DELETE FROM transactions WHERE transactionID = '$transactionID' AND userID = '$userID'";

        $rs=mysqli_query($conn,$sql);

    if($rs){
    header("location: viewExpenditure.php");
    }
}

?>