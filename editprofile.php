<?php
include('dbconfig/connection.php');
session_start();

$pfp = $_SESSION['user_info']['pfp'];
?>

<?php
if (isset($_GET['action']) && $_GET['action'] == 'edit') {
    $user_id = $_SESSION['user_info']['user_id'];
    $username = $_SESSION['user_info']['username'];
    $new_username = strtolower($_POST['username']);
    $new_fn = ucfirst(strtolower($_POST['fn']));
    $new_ln = ucfirst(strtolower($_POST['ln']));



    $affirmation_query = "SELECT `username` from `users` WHERE `username` = '$new_username'";
    $affirmation_result = mysqli_query($con, $affirmation_query);
    $affirmation_row_num = mysqli_num_rows($affirmation_result);
    if ($affirmation_row_num > 0) {
        header("location:editprofile.php?error=1");
    } else {
        // Check if an image file has been uploaded
        if (isset($_FILES['image-input-1'])) {
            $targetDirectory = 'PostImages/';
            $file = $_FILES['image-input-1']['name'];
            $filePath = $targetDirectory . $file;
            $fileTemporaryName = $_FILES['image-input-1']['tmp_name'];
            if ($filePath == $targetDirectory) {
                $filePath = 'Images/DefaultPFP.jpg';
                header('Location:signup.php');
            }
            if (empty($new_fn)) {
                $new_fn = $_SESSION['user_info']['first_name'];
            }
            if (empty($new_ln)) {
                $new_ln = $_SESSION['user_info']['last_name'];
            }
            if ($filePath == 'Images/DefaultPFP.jpg') {
            } else{
                move_uploaded_file($fileTemporaryName, $filePath);
                echo "Image uploaded successfully: " . $filePath . "<br>";
            }
            if (empty($new_username)) {
                $new_username = $username;
                $insert_query = "UPDATE `users` SET `first_name` = '$new_fn', `last_name` = '$new_ln', `pfp` = '$filePath' WHERE `user_id` = '$user_id'";
            } else {
                $insert_query = "UPDATE `users` SET `first_name` = '$new_fn', `last_name` = '$new_ln', `pfp` = '$filePath',`username` = '$new_username' WHERE `user_id` = '$user_id'";
            }
            mysqli_query($con, $insert_query);

            $select_query = "SELECT * FROM `users` WHERE `username`='$new_username'";
            //echo ($select_query);
            $result = mysqli_query($con, $select_query);

            $row_num = mysqli_num_rows($result);
            // echo $row_num;

            if ($row_num > 0) {
                $data = mysqli_fetch_assoc($result);
                session_unset();
                $_SESSION["user_info"] = $data;
                // echo '<pre>';
                // print_r($_SESSION ['user_info']);
                // echo '</pre>';
                header("location:profile.php");
            }
            // Redirect to profile page after successful upload
        } else {
            echo "Error uploading image: " . $filePath . "<br>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="Images/EchoCart.ico">
    <link rel="stylesheet" href="styles.css">
    <title>Edit Profile</title>
    <script>
        function showCustomAlert(message) {
            // Show the custom alert box and overlay
            document.getElementById('customAlertMessage').innerText = message;
            document.getElementById('customAlertBox').style.display = 'block';
            document.getElementById('customAlertOverlay').style.display = 'block';
        }

        function hideCustomAlert() {
            // Hide the custom alert box and overlay
            document.getElementById('customAlertBox').style.display = 'none';
            document.getElementById('customAlertOverlay').style.display = 'none';
        }

        function checkForErrors() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('error')) {
                const error = urlParams.get('error');
                let message = '';
                switch (error) {
                    case '1':
                        message = 'Username Already Exists';
                        break;
                }
                showCustomAlert(message);
            }
        }

        // Check for errors when the page loads
        window.onload = checkForErrors;
    </script>
</head>

<body>
    <?php require('header.php') ?>
    <div id="customAlertOverlay" class="custom-alert-overlay" onclick="hideCustomAlert()"></div>
    <div id="customAlertBox" class="custom-alert">
        <span id="customAlertMessage"></span>
        <br><br>
        <button onclick="hideCustomAlert()">OK</button>
    </div>
    <center>
        <h1>EDIT YOUR PROFILE INFORMATION</h1>
        <div class="edit-container">
            <form action="editprofile.php?action=edit" method="post" enctype="multipart/form-data" style="display:flex; flex-direction:column; align-items:center;">
                <input type="text" name="fn" placeholder="First Name">
                <input type="text" name="ln" placeholder="Last Name">
                <input type="text" name="username" placeholder="Username">
                <div class="sell-image-selector" style="height:265px;">
                    <img class="sell-selected-image" style="width:100%;height:200px; object-fit: cover;" src="<?php echo $pfp ?>" alt="Selected image">
                    <label class="sell-image-input-label" for="image-input-1">Change your PFP</label>
                    <input class="sell-image-input" type="file" name="image-input-1" id="image-input-1"><br>
                    <button class="sell-remove-image-button">Remove image</button>
                </div>
                <button class="sell-button">Submit</button>
            </form>
        </div>
    </center>
    <script>
        const imageContainers = document.getElementsByClassName('sell-image-selector');
        const imageInputs = document.getElementsByClassName('sell-image-input');
        const removeImageButtons = document.getElementsByClassName('sell-remove-image-button');
        const selectedImages = document.getElementsByClassName('sell-selected-image');
        const labels = document.getElementsByClassName('sell-image-input-label');

        for (let i = 0; i < imageInputs.length; i++) {
            imageInputs[i].addEventListener('change', () => {
                const file = imageInputs[i].files[0];
                const reader = new FileReader();

                reader.onload = (event) => {
                    selectedImages[i].src = event.target.result;
                    labels[i].style.display = 'block';
                };

                reader.readAsDataURL(file);
            });

            removeImageButtons[i].addEventListener('click', () => {
                imageInputs[i].value = '';
                selectedImages[i].src = 'Images/DefaultPFP.jpg';
                labels[i].style.display = 'block';
                event.preventDefault();
            });
        }
    </script>
</body>

</html>