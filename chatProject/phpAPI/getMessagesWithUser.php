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
    $toUserID = $_GET["toUserID"];

    $sql = "SELECT messages.*, messagerecipients.*, users.firstName, users.lastName, users.username, users.isActive, users.userID FROM messages 
        JOIN users ON users.userID = messages.fromUserID 
        JOIN messagerecipients ON messages.messageID = messagerecipients.messageID 
        WHERE (messages.fromUserID = $userID AND messagerecipients.toUserID = $toUserID) 
            OR (messages.fromUserID = $toUserID AND messagerecipients.toUserID = $userID) 
            ORDER BY time DESC";

    $response = $conn->query($sql);

    $rows = array();
    while($r = mysqli_fetch_assoc($response)) {
        $rows[] = $r;
    }

    echo json_encode($rows);
    $conn->close();

?>




