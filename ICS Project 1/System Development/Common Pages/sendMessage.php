<?php
    require_once("../db/dbconnector.php");
    session_start();

    if (isset($_POST['message']) && isset($_POST['sender_id']) && isset($_POST['receiver_id'])) {
        $message = $_POST['message'];
        $sender_id = $_POST['sender_id'];
        $receiver_id = $_POST['receiver_id'];

        // Insert message
        $stmt = $conn->prepare("INSERT INTO Messages (sender_id, receiver_id, message) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $sender_id, $receiver_id, $message);
        if ($stmt->execute()) {
            echo "Message sent";
        } else {
            echo "Error: " . $stmt->error;
        }
    }
?>
