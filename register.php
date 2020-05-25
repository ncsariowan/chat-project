<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel='stylesheet' type='text/css' href='registration.css' />
</head>

<body>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbName = "chatlog";

    $conn = new mysqli($servername, $username, $password,  $dbName);

    $errmsg = "";

    if ($conn->connect_error) {
        die('Connect Error (' . $conn->connect_errno . ') '
            . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    }



    ?>

    <div class="container">
        <div class="center">
            <h1>Register</h1>
            <p><?php echo $errmsg ?></p>
            <form action="chats.php" method="post">
                <table>
                    <tr>
                        <td>
                            First Name:
                        </td>
                        <td>
                            <input type="text" name="firstName" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Last Name:
                        </td>
                        <td>
                            <input type="text" name="lastName" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Username:
                        </td>
                        <td>
                            <input type="text" name="username" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Email:
                        </td>
                        <td>
                            <input type="text" name="email" required>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Password:
                        </td>
                        <td>
                            <input type="password" name="password" required>
                        </td>
                    </tr>
                </table>
                <input class="submit" type="submit">
            </form>

        </div>
    </div>

</body>

</html>