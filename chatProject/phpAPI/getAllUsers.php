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

    $sql = "SELECT firstName, lastName, username, isActive, userID FROM users ORDER BY Coalesce(firstName, lastName)";

    $response = $conn->query($sql);

    $rows = array();
    while($r = mysqli_fetch_assoc($response)) {
        $rows[] = $r;
    }

    echo json_encode($rows);
    $conn->close();

?>




