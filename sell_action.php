<?php
include('dbconfig/connection.php');
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_info']['user_id'];

    $title = $_POST['title'];
    $dollar_price = $_POST['dollar_price'];
    $lb_price = $_POST['lb_price'];
    $phone_number = $_POST['phone_number'];
    if(empty($lb_price)){
        $lb_price=0;
    }
    $category = $_POST['categories'];
    switch($category){
        case 'Vehicles': $category_id = 1; break;
        case 'Mobiles & Accessories': $category_id = 2; break;
        case 'Electronics & Appliances': $category_id = 3; break;
        case 'Furniture & Decor' : $category_id = 4; break;
        case 'Pets': $category_id = 5; break;
        case 'Sports & Equipments' : $category_id = 6; break;
        default: $category_id = 0;break ;
    }
    $description = isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '';

    if(empty($title) || empty($description|| empty($dollar_price)) || empty($category) || empty($phone_number)){
        header("location:sell.php?error=1");
    } else{
        $select_query1 = "SELECT * FROM `products` WHERE `title` = '$title'";
        $result1 = mysqli_query($con, $select_query1);
        $row_num1 = mysqli_num_rows($result1);
        if($row_num1 != 0){
            header("location:sell.php?error=2");
        }
    }
    if((!is_numeric($dollar_price) && !is_numeric($lb_price))){
        header("location:sell.php?error=3");
    }
    if(strlen($title) >= 45){
        header("location:sell.php?error=4");
    }

    $insert_query="INSERT INTO `products`(`user_id`, `title`, `description`,`price_dollar`,`price_lb`,`category_id`,`phone_nb`) VALUES ('$user_id','$title','$description','$dollar_price','$lb_price','$category_id','$phone_number')";
    mysqli_query($con,$insert_query);
    
    $select_post_id_query = "SELECT `product_id` FROM `products` WHERE `title` = '$title'";
    $result=mysqli_query($con,$select_post_id_query);
    $row_num=mysqli_num_rows($result);
    if($row_num> 0){
        $data = mysqli_fetch_assoc($result);
        $product_id = $data['product_id'];
        // echo $product_id;
    }
    if (isset($_FILES['image-input-1']) || isset($_FILES['image-input-2']) || isset($_FILES['image-input-3']) || isset($_FILES['image-input-4']) || isset($_FILES['image-input-5'])) {
        $targetDirectory = 'PostImages/';
        $imageNames = [];

        for ($i = 1; $i <= 5; $i++) {
            if (isset($_FILES['image-input-' . $i])) {
                $file = $_FILES['image-input-' . $i]['name'];
                $filePath = $targetDirectory . $file;

                if (move_uploaded_file($_FILES['image-input-' . $i]['tmp_name'], $filePath)) {
                    echo "Image uploaded successfully: " . $filePath . "<br>";
                    $imageNames[] = $filePath;

                    $stmt = mysqli_prepare($con, "INSERT INTO `product_images` (`product_id`, `image_url`) VALUES (?, ?)");
                    mysqli_stmt_bind_param($stmt, "is", $product_id, $filePath);

                    mysqli_stmt_execute($stmt);
                } else {
                    echo "Error uploading image: " . $filePath . "<br>";
                }
                header("Location:profile.php");
            }
        }
    } else {
        echo ("<br>error uploading image");
    }
}
