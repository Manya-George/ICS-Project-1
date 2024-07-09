<?php
$servername = "localhost";
$username = "root";
$password = "raphaelm";
$dbname ="ICSDemo";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection to DataBase failed: " . $conn->connect_error);
}
/*
else{
  echo "Succesful Connection";
}*/

//mysqli_close($conn);

?>