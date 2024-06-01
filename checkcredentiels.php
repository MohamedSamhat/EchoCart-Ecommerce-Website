<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Check Credentiels</title>
    <link rel="icon" type="image/x-icon" href="Images/EchoCart.ico">
</head>
<body class="check-change-body">
    <div class="checkcredentiels-container">
        <h1>Check Credentiels</h1>
            <form action="checkcredentiels_action.php" method="post">
                <input type="text" name="username" placeholder="UserName"><br>
                <label for="choice">Choose a Security Question:</label><br>
                <select id="choice" name="choice">
                    <option value="What is your first pet name?">What is your first pet name?</option>
                    <option value="What is the name of your first school?">What is the name of your first school?</option>
                    <option value="What is the name of your childhood BestFriend?">What is the name of your childhood BestFriend?</option>
                    <option value="In what city you were born?">In what city you were born?</option>
                    <option value="What is your favorite food as a child?">What is your favorite food as a child?</option>
                    <option value="What year was your father born?">What year was your father born?</option>
                </select>
                <input type="text" name="answer" placeholder="Answer">
                <?php
                    if(isset($_GET['error'])){
                        $i=$_GET['error'];
                        if($i==1){
                            echo('<h2 style="color:red;">Username does not exist</h2>');
                        }
                        else{
                            echo('<h2 style="color:red;">Credentiels does not match</h2>');
                        }
                    }
                ?>
            <button class="checkcredentiels-button">Check</button>
    </div>
</body>
</html>