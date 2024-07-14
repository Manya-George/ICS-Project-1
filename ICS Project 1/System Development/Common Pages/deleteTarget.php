<?php

    require_once("../db/dbconnector.php");
    session_start();

    if (isset($_GET['targetID'])) {
        $targetID = $_GET['targetID'];
        $userID = $_SESSION["userID"];
    
        // Prepare the SQL statement
        $sql = "DELETE FROM targets WHERE targetID = '$targetID' AND userID = '$userID'";

        $rs=mysqli_query($conn,$sql);

    if($rs){
    header("location: viewTargets.php");
    }
}

?>