<header>
    <?php
        include('dbconfig/connection.php');
        //session_start();
        $header_query="SELECT * FROM `categories`";
        $header_result=mysqli_query($con,$header_query);
    ?>
    <div style="display:flex;">
        <div style="display:flex; margin-right:100px;">
            <img src="Images/EchoCartIcon.jpg" width="90px" height="90px" style="margin-right:30px;">
            <a href="profile.php"><div class="image_container_header"><img style="object-fit: cover; border-radius:50%; border:2px solid #01112b; margin-right:20px;" src="<?php echo $_SESSION['user_info']['pfp']; ?>"></div></a>
            <?php
                while($header_row = $header_result->fetch_assoc()){
            ?>
            <a href="category.php?action=<?php echo $header_row["category_id"]?>">
            <div style="display:flex;">
                <div class="image_container_header"><img src="<?php echo $header_row["image"] ?>"></div>
                <span class="name_container_header"><?php echo $header_row["category_name"] ?></span>
            </div>
            </a>
            <?php
                }
            ?>
        </div>
        <div>
            <button class="header-sell-button" onclick="window.location.href='sell.php';">Sell</button>
        </div>
    </div>
</header>