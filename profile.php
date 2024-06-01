<?php
include('dbconfig/connection.php');
session_start();

$user_id = $_SESSION['user_info']['user_id'];
$username = $_SESSION['user_info']['username'];
$first_name = $_SESSION['user_info']['first_name'];
$last_name = $_SESSION['user_info']['last_name'];
$pfp = $_SESSION['user_info']['pfp'];
$big_pfp = $pfp;
$hide_button="";
//
if(isset($_GET['ad_user_id'])){
    $user_id = $_GET['ad_user_id'];
    $user_query = "SELECT * FROM `users` WHERE `user_id` = '$user_id'";
    $user_result = mysqli_query($con, $user_query);
    $hide_button = true;
    if($result_row_num = mysqli_num_rows($user_result)>0){
        $user_row = mysqli_fetch_assoc($user_result);
        $username = $user_row['username'];
        $first_name = $user_row['first_name'];
        $last_name = $user_row['last_name'];
        $big_pfp = $user_row['pfp'];
    }
}
//

$ads_query = "SELECT p.*, c.category_name FROM products p INNER JOIN categories c ON p.category_id = c.category_id WHERE user_id = $user_id;";
$ads_result = mysqli_query($con, $ads_query);
$ads_row_num = mysqli_num_rows($ads_result);
//
if (isset($_GET['action']) && $_GET['action'] == 'deleteprofile') {
    $user_id = $_SESSION['user_info']['user_id'];
    //echo($user_id);
    $query = "DELETE FROM `users` WHERE `user_id` = '$user_id'";
    //echo($query);
    mysqli_query($con, $query);
    session_unset();
    session_destroy();
    header("Location: login.php");
}
//
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_unset();
    session_destroy();
    header("Location: login.php");
}
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
    <title>Profile Page</title>
    <link rel="icon" type="image/x-icon" href="Images/EchoCart.ico">
    <link rel="stylesheet" href="styles.css">
    <script>
        function confirmDeletion() {
            // Show confirmation dialog
            const userConfirmed = confirm("Are you sure you want to delete your account?");
            
            // If the user clicked "OK", proceed with the deletion
            if (userConfirmed) {
                window.location.href = "profile.php?action=deleteprofile";
            }
        }
        function confirmLogout() {
            // Show confirmation dialog
            const userConfirmed = confirm("Are you sure you want to logout?");
            
            if (userConfirmed) {
                window.location.href = "profile.php?action=logout";
            }
        }
    </script>
</head>

<body class="profile-body">
    <?php require('header.php'); ?>
    <div class="profile-first-container">
        <div>
            <div>
                <img src="<?php echo ($big_pfp) ?>" alt="pfp" class="pfp_style" style="object-fit: cover;">
                <p></p>
            </div>
            <?php if(!$hide_button == true){ ?>
            <div class="profile-button-container">
                <button class="profile-button" onclick="window.location.href='editprofile.php'">Edit Profile</button>
                <button class="profile-button" onclick="confirmDeletion()">Delete Profile</button>
                <button class="profile-button" onclick="confirmLogout()">Logout</button>
            </div>
            <?php } ?>
        </div>
        <div>
            <div>
                <span class="profile-name-container">
                    <span style="width:100%; display:block;"><?php echo "<h1 style='color:#01112b; text-align:left;'>" . $first_name . " " . $last_name . " (" . $_SESSION['user_info']['username'] . ")</h1>"; ?></span>
                </span>
            </div>
            <div>
                <?php if ($ads_row_num > 0) { ?>
                    <div>
                        <p>Showing <?php echo ($ads_row_num) ?> ads</p>
                    </div>
                    <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                        <?php
                        $counter = 0;
                        while ($ads_row = $ads_result->fetch_assoc()) {
                            $product_id = $ads_row["product_id"];
                            $title = $ads_row["title"];
                            $price_dollar = $ads_row["price_dollar"];
                            $created_at = $ads_row["created_at"];
                            $category_name = $ads_row["category_name"];

                            $ads_image_query = "SELECT image_url FROM `product_images` WHERE `product_id` = '$product_id' LIMIT 1";
                            $ads_image_result = mysqli_query($con, $ads_image_query);
                            $ads_image_row_num = mysqli_num_rows($ads_image_result);
                            if ($ads_image_row_num > 0) {
                                $ads_image_row = $ads_image_result->fetch_assoc();
                                $product_image = $ads_image_row["image_url"];
                            } else {
                                $product_image = "Images/DefaultPostPhoto.jpg";
                            }

                            if ($counter % 3 == 0 && $counter != 0) {
                                echo '</div><div style="display: flex; flex-wrap: wrap; gap: 10px;">';
                            }
                            $counter++;
                        ?>
                            <a href="ad.php?product_id=<?php echo($product_id)?>">
                            <div style="width:280px; height:330px; margin-bottom: 10px; border: 2px solid #01112b; ">
                                <img src="<?php echo $product_image; ?>" width="100%" height="175px" alt="img" >
                                <p style="color:red; font-size:20px; padding-left:7px; font-weight:bold">USD <?php echo ($price_dollar) ?></p>
                                <p style="padding-left:7px; color:#01112b; font-weight:bold;"><?php echo ($title) ?></p>
                                <p style="padding-left:7px; color:#01112b;"><?php echo ($category_name) ?></p>
                                <p style="padding-left:7px; color:gray; font-size:12px;"><?php echo (timeAgo($created_at)) ?></p>
                            </div>
                            </a>
                        <?php } ?>
                    </div>
                <?php } else { ?>
                    <div style="display:flex; align-items: center; justify-content: center;">
                        <img src="Images/NoAdsIcon.png" width="400px" height="400px">
                    </div>
                    <center>
                        <p style="font-weight:bold;">There are no ads</p>
                        <p>When users post ads, they will appear here</p>
                    </center>
            </div>
        </div>
    <?php } ?>
    </div>
    </div>
    </div>
</body>

</html>