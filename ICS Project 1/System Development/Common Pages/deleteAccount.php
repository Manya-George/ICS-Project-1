<?php

require_once("../db/dbconnector.php");

if(isset($_GET['userID'])){

   $userID=$_GET['userID'];
}

$sql="UPDATE users Set activity='0' Where userID='$userID'";

$rs=mysqli_query($conn,$sql);

if($rs){
   header("location: viewAccounts.php");
}

?>