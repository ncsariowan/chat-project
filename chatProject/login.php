<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel='stylesheet' type='text/css' href='registration.css' />
</head>

<body>
    <div class="container">
        <div class="center">

            <h1>Login</h1>
            <form action="chats.php" method="post">
                <div class="info" >
                    <a href="./register.php">Not a user yet? Register Here.</a>
                </div>
                <table>
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
                            Password:
                        </td>
                        <td>
                            <input type="password" name="password" required>
                        </td>
                    </tr>
                </table>
                <p class="error">

                    <?php
                    if (array_key_exists("auth", $_GET) && $_GET["auth"] == 0) {
                        echo "Invalid username or password.";
                    }
                    ?>
                </p>
                <input type="submit" class="submit">
            </form>
        </div>
    </div>

</body>

</html>