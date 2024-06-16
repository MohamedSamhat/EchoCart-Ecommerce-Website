<header>
    <?php
    include('dbconfig/connection.php');
    //session_start();
    $header_query = "SELECT * FROM `categories`";
    $header_result = mysqli_query($con, $header_query);
    ?>
    <div style="display:flex;">
        <div style="display:flex; margin-right:100px;">
            <img src="Images/EchoCartIcon.jpg" width="90px" height="90px" style="margin-right:30px;">
            <a href="profile.php">
                <div class="image_container_header"><img style="object-fit: cover; border-radius:50%; border:2px solid #01112b; margin-right:20px;" src="<?php echo $_SESSION['user_info']['pfp']; ?>"></div>
            </a>
            <div id="nav-buttons" style="display:flex;">
            <?php
            while ($header_row = $header_result->fetch_assoc()) {
            ?>
                <a href="category.php?action=<?php echo $header_row["category_id"] ?>">
                    <div style="display:flex;">
                        <div class="image_container_header"><img src="<?php echo $header_row["image"] ?>"></div>
                        <span class="name_container_header"><?php echo $header_row["category_name"] ?></span>
                    </div>
                </a>
            <?php
            }
            ?>
            </div>
            <form id="search-bar" style="display:none;" action="search.php" method="GET">
                <input type="text" name="query" style=" margin-left:262px; margin-right:260px; width:500px;" placeholder="Search...">
            </form>
        </div>
        <div>
            <button style="margin-right:20px; margin-left:-70px; background-color:white; border:none; cursor:pointer;" onclick="toggleSearch()"><img src="Images/SearchIcon.png"></button>
            <button class="header-sell-button" onclick="window.location.href='sell.php';">Sell</button>
        </div>
    </div>
</header>
<script>
    function toggleSearch() {
        var searchBar = document.getElementById('search-bar');
        var navButtons = document.getElementById('nav-buttons');
        var searchInput = document.getElementById('search-input');

        if (searchBar.style.display === 'none') {
            searchBar.style.display = 'flex';
            navButtons.style.display = 'none';
            searchInput.focus();
        } else {
            searchBar.style.display = 'none';
            navButtons.style.display = 'flex';
            searchInput.value = ''; // Clear the search input
        }
    }
</script>