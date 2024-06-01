<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Sign Up Page</title>
    <link rel="icon" type="image/x-icon" href="Images/EchoCart.ico">
</head>

<body class="signup-login-body">
    <div style="display:flex; margin-top:-10px;">
        <div class="signup-image-container">
            <img src="Images/EchoCartIcon.jpg" width=700px height=700px>;
        </div>
        <div class="signup-container-container">
            <div class="signup-container">
                <h1>Sign Up</h1>
                <form action="signup_action.php" method="post">
                    <div style="display:flex;">
                        <input type="text" name="fn" placeholder="First Name">
                        <input style="margin-left:15px;" type="text" name="ln" placeholder="Last Name">
                    </div>
                    <div style="margin-top:2px;">
                        <input type="text" name="username" placeholder="UserName"><br>
                        <input type="email" name="email" placeholder="Email"><br>
                    </div>
                    <div style="display:flex; padding:0px;">
                        <input type="password" name="pass" placeholder="Password">
                        <input style="margin-left:15px" type="password" name="passconf" placeholder="Re-Enter Password"><br>
                    </div>
                    <div>
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
                    </div>
                    <div style="display:flex; margin-right:20px;">
                        <span><input style="margin-right:120px;" type="date" name="dob" placeholder="Date OF Birth"></span>
                        <div style="display:flex;">
                            <p style="margin-left:15px">Gender :
                            <p>
                                <span style="display:flex;">
                                    <input style="margin-left:5px; margin-right:5px;" type="radio" id="male" name="gender" value="male">
                                    <label style="margin-right:10px;" for="male">Male</label>
                                    <input style="margin-left:5px; margin-right:5px;" type="radio" id="female" name="gender" value="female">
                                    <label for="female">Female</label>
                                </span>
                        </div>
                    </div>
                    <div>
                        <?php
                        if (isset($_GET['error'])) {
                            $i = $_GET['error'];
                            if ($i == 1) {
                                echo ('<h2 style="color:red;">Please Enter All The Recommended Info</h2>');
                            } else if ($i == 2) {
                                echo ('<h2 style="color:red;">Username Already Exists</h2>');
                            } else if ($i == 3) {
                                echo ('<h2 style="color:red;">Email Already Used</h2>');
                            } else if ($i == 4) {
                                echo ('<h2 style="color:red;">Password Is Too Short (8 character at least)</h2>');
                            } else if ($i == 5) {
                                echo ('<h2 style="color:red;">Passwords Do Not Match</h2>');
                            }
                        }
                        ?>
                        <button class="signup-button">Sign Up</button>
                    </div>
                </form>
                <p>Already have an account? <a href="login.php">Log In</a></p>
                <p><a href="about_us.php">About Us !!</a></p>
            </div>
        </div>
    </div>
</body>

</html>