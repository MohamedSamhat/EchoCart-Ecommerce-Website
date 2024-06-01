<?php
include('dbconfig/connection.php');
session_start();

if(isset($_GET['action']) && isset($_GET['product_id']) && $_GET['action'] == 'deletead'){
    $product_id = $_GET['product_id'];
    $query = "DELETE FROM `products` WHERE `product_id` = '$product_id'";
    mysqli_query($con, $query);
    header("Location: profile.php");
}

if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $user_id = $_SESSION['user_info']['user_id'];
    $pfp = $_SESSION['user_info']['pfp'];
    // echo $product_id . ' (' . $user_id . ')';
}

//
$product_query = "SELECT products.*, users.pfp, users.username, users.created_at AS joined_at, categories.category_name FROM products INNER JOIN users ON products.user_id = users.user_id INNER JOIN categories ON products.category_id = categories.category_id WHERE product_id = $product_id;";
// echo($product_query);
$product_result = mysqli_query($con, $product_query);
$product_row_num = mysqli_num_rows($product_result);

if ($product_row_num > 0) {
    $product_data = mysqli_fetch_assoc($product_result);
    $title = $product_data['title'];
    $description = $product_data['description'];
    $price_dollar = $product_data['price_dollar'];
    $price_lb = $product_data['price_lb'];
    $category_name = $product_data['category_name'];
    $created_at = $product_data['created_at'];
    $phone_nb = $product_data['phone_nb'];
    $ad_user_pfp = $product_data['pfp'];
    $ad_user_joined_at = $product_data['joined_at'];
    $ad_username = $product_data['username'];
    $ad_user_id = $product_data['user_id'];
    // echo($ad_user_id);
}
//

//
if($ad_user_id != $user_id){
    $hide_button = true;
}
//

//
$images = array();

$images_query = "SELECT image_url FROM product_images WHERE product_id = $product_id; ";
// echo("<br>".$images_query);
$images_result = mysqli_query($con, $images_query);
$images_row_num = mysqli_num_rows($images_result);

if ($images_row_num > 0) {
    while ($images_row = $images_result->fetch_assoc()) {
        $images[] = $images_row['image_url'];
    }
}
// echo ("<br>");
// print_r($images);
//
function timeAgo($given_time_str) {
    $given_time = \DateTime::createFromFormat("Y-m-d H:i:s", $given_time_str);
    $current_time = new \DateTime();
    $time_diff = $current_time->diff($given_time);

    $seconds = $time_diff->s;
    $minutes = $time_diff->i;
    $hours = $time_diff->h;
    $days = $time_diff->d;
    $weeks = floor($time_diff->days / 7);
    $months = floor($time_diff->days / 30);
    $years = floor($time_diff->days / 365);

    if ($years > 0) {
        return "$years years ago";
    } elseif ($months > 0) {
        return "$months months ago";
    } elseif ($weeks > 0) {
        return "$weeks weeks ago";
    } elseif ($days > 0) {
        return "$days days ago";
    } elseif ($hours > 0) {
        return "$hours hours ago";
    } elseif ($minutes > 0) {
        $minutes = abs(60-$minutes);
        return "$minutes minutes ago";
    } else {
        return "$seconds seconds ago";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ad Page</title>
    <link rel="icon" type="image/x-icon" href="Images/EchoCart.ico">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php require('header.php'); ?>
    <div style="display:flex;">
        <div class="ad-info-container">
            <div class="ad-image-container">
                <?php
                if (!empty($images)) { ?>
                    <img id='displayImage' src="" alt="Image" style="height:450px;">
                    <button id='nextButton'>NextImage</button>
                <?php
                } else {
                    echo '<img src="Images/DefaultPostPhoto.jpg" alt="Image">';
                } ?>
            </div>
            <div style="display:flex; padding-left:20px; margin-bottom:20px; border:0.5px #01112b solid;">
                <div style="display:flex;  flex-direction:column;line-height:15px;">
                    <h1 style="color:red; font-size:50px; font-family:ProximaNova, Helvetica, sans-serif;text-align:left;">USD <?php echo $price_dollar ?></h1>
                    <h2 style="font-size:25px; font-family:ProximaNova, Helvetica, sans-serif; text-align:left;">L.L <?php echo $price_lb ?></h2>
                    <h3 style="font-size:25px; font-family:ProximaNova, Helvetica, sans-serif; text-align:left;"><?php echo $title ?></h3>
                </div>
                <div style="display:flex; margin-left:270px;">
                    <p style="font-family:ProximaNova, Helvetica, sans-serif; font-weight:bold;"><?php echo $category_name?></p>
                </div>
            </div>
            <div style=" display:flex; border:0.5px #01112b solid; flex-direction:column; padding-left:20px; margin-bottom:20px; line-height:15px;">
                <h1 style="font-size:25px; font-family:ProximaNova, Helvetica, sans-serif; text-align:left;">Description</h1>
                <p style="font-family:ProximaNova, Helvetica, sans-serif;"><?php echo $description?></p>
            </div>
            <div>
                <p><br><br></p>
            </div>
        </div>
        <div style="display:flex; flex-direction:column;">
            <div style="display:flex; padding-left:20px; padding-bottom:15px; width:450px; height:auto; font-family:ProximaNova, Helvetica, sans-serif; border:#01112b solid 0.5px;margin-left:30px; margin-top:20px;"">
                <div>
                    <a href="profile.php?ad_user_id=<?php echo $ad_user_id ?>"><p style="font-weight:bold; font-size:25px;"><?php echo $ad_username ?></p></a>
                    <span style="display:flex;">
                        <p style="font-weight:bold; text-decoration: underline;">Phone Number:</p> 
                        <p style="margin-left:3px;"><?php echo $phone_nb ?></p>
                    </span>
                    <p style="padding-left:7px; color:gray; font-size:12px;">Joined <?php echo (timeAgo($ad_user_joined_at)) ?></p>
                </div>
                <div style = "margin-left:75px; margin-top:30px;">
                    <img src="<?php echo $ad_user_pfp ?>" style="width:100px; height:100px; object-fit:cover; border:2px solid #01112b; border-radius:50%;">
                </div>
            </div>
            <div style="text-align:left; padding-left:10px; padding-right:10px; width:450px; margin-top:30px; margin-left:30px; font-family:ProximaNova, Helvetica, sans-serif; display:flex; flex-direction:column; border:0.5px #01112b solid;">
                <h1>Your safety matters to us!</h1>
                <ul>
                    <li>Only meet in public / crowded places.</li>
                    <li>Never go alone to meet a buyer / seller, always take someone with you.</li>
                    <li>Check and inspect the product properly before purchasing it.</li>
                    <li>Never pay anything in advance or transfer money before inspecting the product.</li>
                </ul>
            </div>
            <?php if(!$hide_button = true){?>
            <button style="margin-left:30px; margin-top:20px;" class="profile-button" onclick="confirmDeletion()">Delete Post</button>
            <?php } ?>
        </div>
    </div>

    <script>
        // Pass the PHP array to JavaScript by encoding it as JSON
        const elements = <?php echo json_encode($images); ?>;

        // Variable to keep track of the current index
        let currentIndex = 0;

        // Function to update the index
        function updateIndex() {
            // Increment the index
            currentIndex++;

            // Reset the index if it goes beyond the array length
            if (currentIndex >= elements.length) {
                currentIndex = 0;
            }
        }

        // Function to update the display based on the current index
        function updateDisplay() {
            // Get the display image element
            const displayImage = document.getElementById('displayImage');

            // Update the src attribute with the current image URL
            displayImage.src = elements[currentIndex];
        }

        // Function to handle the button click
        function handleButtonClick() {
            // Update the index
            updateIndex();

            // Update the display
            updateDisplay();
        }

        // Add event listener to the button
        document.getElementById('nextButton').addEventListener('click', handleButtonClick);

        // Initial display update
        window.onload = updateDisplay;
    </script>
    <script>
        function confirmDeletion() {
            // Show confirmation dialog
            const userConfirmed = confirm("Are you sure you want to delete your account?");
            
            // If the user clicked "OK", proceed with the deletion
            if (userConfirmed) {
                window.location.href = "ad.php?action=deletead&product_id=<?php echo $product_id ?>";
            }
        }
    </script>
</body>

</html>