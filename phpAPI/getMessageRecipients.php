<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbName = "chatlog";

    $conn = new mysqli($servername, $username, $password,  $dbName);

    if ($conn->connect_error) {
        die('Connect Error (' . $conn->connect_errno . ') '
            . $conn->connect_error);
    }

    $userID = $_GET["userID"];

    $sql = "SELECT sub2.*, users.firstName, users.lastName, users.username, users.isActive, users.userID FROM (
                SELECT *, CASE WHEN fromUserID = $userID THEN toUserID ELSE fromUserID END AS newID FROM (
                    SELECT DISTINCT messages.messageID, messages.body, messages.time, messages.fromUserID, messagerecipients.toUserID 
                    FROM messagerecipients 
                    INNER JOIN messages ON messagerecipients.messageID = messages.messageID 
                    WHERE messagerecipients.toUserID=$userID OR messages.fromUserID=$userID
                    ORDER BY messages.time DESC 
                ) AS sub
                ORDER BY time DESC
            ) AS sub2
            JOIN users ON newID = users.userID
            GROUP BY newID
            ORDER BY time DESC;"
                
            ;

    $response = $conn->query($sql);

    $rows = array();
    while($r = mysqli_fetch_assoc($response)) {
        $rows[] = $r;
    }

    echo json_encode($rows);
    $conn->close();
?>