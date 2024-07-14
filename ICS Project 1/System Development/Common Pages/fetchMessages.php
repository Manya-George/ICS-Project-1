<?php
    require_once("../db/dbconnector.php");
    session_start();

    if (isset($_GET['userID'])) {
        $userID = $_GET['userID'];

        $sql = "SELECT 
                    m.messageID, 
                    m.message, 
                    m.timestamp, 
                    s.username AS sender, 
                    r.username AS receiver 
                FROM 
                    Messages m 
                JOIN 
                    Users s ON m.sender_id = s.userID 
                JOIN 
                    Users r ON m.receiver_id = r.userID 
                WHERE 
                    m.sender_id = ? OR m.receiver_id = ? 
                ORDER BY 
                    m.timestamp ASC";
                    
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $userID, $userID);
        $stmt->execute();
        $result = $stmt->get_result();

        $messages = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $messages[] = $row;
            }
        }

        echo json_encode($messages);
    }
?>
