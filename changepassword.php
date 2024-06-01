<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Change Password</title>
    <link rel="icon" type="image/x-icon" href="Images/EchoCart.ico">
</head>
<body class="check-change-body">
    <div class="changepassword-container">
        <h1>Change Password</h1>
            <form action="changepassword_action.php" method="post">
                <input type="password" name="password" placeholder="Password"><br>
                <input type="password" name="confpass" placeholder="Re-Enter Password"><br>
                <?php
                    if(isset($_GET['error'])){
                        $i=$_GET['error'];
                        if($i==1){
                            echo('<h2 style="color:red;">Password too short</h2>');
                        }
                        else{
                            echo('<h2 style="color:red;">Passwords do not match</h2>');
                        }
                    }
                ?>
            <button class="changepassword-button">Change Password</button>
    </div>
</body>
</html>