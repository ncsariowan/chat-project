<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="jquery-3.5.1.min.js"></script>
    <title>Chatter</title>
    <?php

        /*
        if (isset($_GET["username"])) {
            $GLOBALS["username"] = $_GET["username"];
        } else {
            // Redirect to login
            header("Location: login.php");
            exit();
        }
        */

        $username = "potato";

        $password = "phone";

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbName = "chatlog";

        $conn = new mysqli($servername, $username, $password,  $dbName);

        if ($conn->connect_error) {
            die('Connect Error (' . $conn->connect_errno . ') '
                . $conn->connect_error);
        }

        if (empty($_POST["username"])
            || empty($_POST["password"])
            || empty($_POST["email"])
            || empty($_POST["firstName"])
            || empty($_POST["lastName"])) {
                $errmsg = "all fields are required!";
        } else {
            $sql = "INSERT INTO users (`username`, `password`, `email`, `firstName`, `lastName`) VALUES ("
            . "'" . $_POST["username"] . "'," 
            . "'" . $_POST["password"] . "'," 
            . "'" . $_POST["email"] . "'," 
            . "'" . $_POST["firstName"] . "'," 
            . "'" . $_POST["lastName"] . "');";

            $conn->query($sql);
        }


        $sql = "UPDATE users SET isActive = 1 WHERE userID = " . $conn->insert_id;;

        $conn->query($sql);

        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT firstName, lastName, username, isActive, userID FROM users WHERE username = \"$username\" AND password = \"$password\"";

        $response = $conn->query($sql);

        if (mysqli_num_rows($response)==0) {
            header("Location: ./login.php?auth=0");
            exit;
        }

        $rows = array();
        while ($r = mysqli_fetch_assoc($response)) {
            $rows[] = $r;
        }

        $_GLOBALS["userData"] = json_encode($rows);


    ?>

    <script>
        GLOBAL_VARS = JSON.parse('<?php echo $_GLOBALS["userData"]?>')[0];
        console.log(GLOBAL_VARS);
    </script>


    <script src="chats.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel='stylesheet' type='text/css' href='chats.css' />
</head>

<body>
    <!-- Modal -->
    <div class="modal" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button id="close-modal" type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">New Conversation</h4>
                </div>
                <template id="contact-template">
                    <div class="contact">
                        <p class="contact-name"></p>
                        <p class="contact-username"></p>
                    </div>
                </template>
                <div class="modal-body" id="contact-body">
                </div>
                <div class="modal-footer">
                    <button  type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>

        </div>
    </div>
    <div id="container">
        <div id="sidebar">
            <template id="conversation-template">
                <div class="conversation">
                    <h3 class="conversation-name"></h3>
                    <p class="last-message"></p>
                    <p class="last-time"></p>
                </div>
            </template>
            <div id="new-conversation" data-toggle="modal" data-target="#myModal">
                +
            </div>
            <div id="conversations">
                <div>
                    Click the + button to start a new conversation.
                </div>
            </div>
        </div>
        <div id="message-box">
            <div id="name-box">
                <h2 id="name"></h2>
            </div>
            <template id="time-break-template">
                <div class="time-break">
                    <span class="time"></span>
                </div>
            </template>
            <template id="message-template">
                <div class="message">
                    <h4 class="message-name"></h4>
                    <p class="body"></p>
                </div>
            </template>

            <div id="messages">
            </div>

            <div id="input-box" class="hidden">
                <textarea id="input"></textarea>
            </div>
        </div>
    </div>
</body>

</html>