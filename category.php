<?php
include('dbconfig/connection.php');
session_start();

$pfp = $_SESSION['user_info']['pfp'];
$category_id = $_GET['action'];

$category_query = "SELECT * FROM `categories` WHERE `category_id` = '$category_id';";
//echo $category_query;
$category_result = mysqli_query($con, $category_query);
$category_row = mysqli_fetch_assoc($category_result);
$category_name = $category_row['category_name'];
//echo $category_name;

$ads_query = "SELECT * FROM `products` WHERE `category_id` = '$category_id'";
//echo($ads_query);
$ads_result = mysqli_query($con, $ads_query);
$ads_row_num = mysqli_num_rows($ads_result);

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
    <link rel="icon" type="image/x-icon" href="Images/EchoCart.ico">
    <link rel="stylesheet" href="styles.css">
    <title><?php echo $category_name ?></title>
</head>

<body style="font-family:ProximaNova, Helvetica, sans-serif;">
    <?php require('header.php') ?>
    <h1><?php echo $category_name ?></h1>
    <div style="margin-right:120px; margin-left:120px;">
        <?php if ($ads_row_num > 0) { ?>
            <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                <?php
                $counter = 0;
                while ($ads_row = $ads_result->fetch_assoc()) {
                    $product_id = $ads_row["product_id"];
                    $title = $ads_row["title"];
                    $price_dollar = $ads_row["price_dollar"];
                    $created_at = $ads_row["created_at"];

                    $ads_image_query = "SELECT image_url FROM `product_images` WHERE `product_id` = '$product_id' LIMIT 1";
                    $ads_image_result = mysqli_query($con, $ads_image_query);
                    $ads_image_row_num = mysqli_num_rows($ads_image_result);
                    if ($ads_image_row_num > 0) {
                        $ads_image_row = $ads_image_result->fetch_assoc();
                        $product_image = $ads_image_row["image_url"];
                    } else {
                        $product_image = "Images/DefaultPostPhoto.jpg";
                    }

                    if ($counter % 4 == 0 && $counter != 0) {
                        echo '</div><div style="display: flex; flex-wrap: wrap; gap: 15px;">';
                    }
                    $counter++;
                ?>
                    <a href="ad.php?product_id=<?php echo ($product_id) ?>">
                        <div style="width:300px; height:330px; margin-bottom: 10px; border: 2px solid #01112b; ">
                            <img src="<?php echo $product_image; ?>" width="100%" height="175px" alt="img">
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
        <?php } ?>
    </div>
</body>

</html>