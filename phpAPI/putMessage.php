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

    $sql = "INSERT INTO messages (`body`, `fromUserID`) VALUES ("
    . "'" . $_POST["body"] . "'," 
    . "'" . $_POST["userID"] . "');";


    $conn->query($sql);

    $id = $conn->insert_id;

    $sql = "INSERT INTO messagerecipients (`messageID`, `toUserID`) VALUES ("
    . "'" . $id . "'," 
    . "'" . $_POST["toUserID"] . "');";


    $conn->query($sql);

    $conn->close();

?>