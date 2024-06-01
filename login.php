<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Log In Page</title>
    <link rel="icon" type="image/x-icon" href="Images/EchoCart.ico">
</head>

<body class="signup-login-body">
    <center>
        <div style="width: 750px; height: 500px; padding: 16px; padding-bottom: -20px; background-color: white; border: 1px solid #ccc; border-radius: 50px; margin-top:100px; justify-content: space-between; display: block; box-shadow: 10px 10px 20px rgba(0, 0, 0, 0.2);">
            <h1>Log In</h1>
            <form action="login_action.php" method="post">
                <input style="margin:25px 0 25px 0;" type="text" name="username" placeholder="UserName"><br>
                <input style="margin:25px 0 25px 0;" type="password" name="pass" placeholder="Password">
                <?php
                if (isset($_GET['error'])) {
                    $i = $_GET['error'];
                    if ($i == 1) {
                        echo ('<h2 style="color:red;">Username does not exist</h2>');
                    } else {
                        echo ('<h2 style="color:red;">Please check your password</h2>');
                    }
                }
                ?>
                <button style="margin:25px 0 25px 0;" class="login-button">LogIn</button>
            </form>
            <span style="text-align:left;">
                <p><a style="margin:25px 0 25px 0;" href="checkcredentiels.php">Forgot Your Password?</a></p>
                <p style="margin:25px 0 25px 0;">Do not have an acoount?<a href="signup.php"> Sign Up</a></p>
                <p><a href="about_us.php">About Us!!</a></p>
            <span>
        </div>
    </center>
</body>

</html>