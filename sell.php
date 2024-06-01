<?php
include('dbconfig/connection.php');
session_start();

$user_id = $_SESSION['user_info']['user_id'];
$username = $_SESSION['user_info']['username'];
$first_name = $_SESSION['user_info']['first_name'];
$last_name = $_SESSION['user_info']['last_name'];
$pfp = $_SESSION['user_info']['pfp'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" type="image/x-icon" href="Images/EchoCart.ico">
</head>

<body>
    <?php require("header.php"); ?>
    <center>
        <div id="customAlertOverlay" class="custom-alert-overlay" onclick="hideCustomAlert()"></div>
        <div id="customAlertBox" class="custom-alert">
            <span id="customAlertMessage"></span>
            <br><br>
            <button onclick="hideCustomAlert()">OK</button>
        </div>
        <h1>POST YOUR AD</h1>
        <div class="sell-form-container">
            <form action="sell_action.php" method="post" enctype="multipart/form-data">
                <input type="text" name="title" placeholder="Title" required>
                <input type="text" name="dollar_price" oninput="convertPrice()" placeholder="Price In Dollar" required>
                <input type="text" name="lb_price" placeholder="Price In L.L" required>
                <input type="text" name="phone_number" placeholder="Phone Number (ex : +961 01 234 567)" pattern="\+961\s\d{2}\s\d{3}\s\d{3}" required>
                <select name="categories">
                    <option value="" disabled selected hidden>Select a category</option>
                    <option value="Vehicles">Vehicles</option>
                    <option value="Mobiles & Accessories">Mobiles & Accessories</option>
                    <option value="Electronics & Appliances">Electronics & Appliances</option>
                    <option value="Furniture & Decor">Furniture & Decor</option>
                    <option value="Pets">Pets</option>
                    <option value="Sports & Equipments">Sports & Equipments</option>
                </select>
                <textarea id="description" name="description" rows="4" cols=94.9% placeholder="Description" style="padding:10px 20px; margin-top:10px; margin-bottom:10px;"></textarea>
                <div class="sell-image-container">
                    <!-- Five image selectors -->
                    <div class="sell-image-selector">
                        <img class="sell-selected-image" src="Images/DefaultSellPhoto.jpg" alt="Selected image">
                        <label class="sell-image-input-label" for="image-input-1">Choose an image</label>
                        <input class="sell-image-input" type="file" name="image-input-1" id="image-input-1">
                        <button class="sell-remove-image-button">Remove image</button>
                    </div>

                    <div class="sell-image-selector">
                        <img class="sell-selected-image" src="Images/DefaultSellPhoto.jpg" alt="Selected image">
                        <label class="sell-image-input-label" for="image-input-2">Choose an image</label>
                        <input class="sell-image-input" type="file" name="image-input-2" id="image-input-2">
                        <button type="button" class="sell-remove-image-button">Remove image</button>
                    </div>

                    <div class="sell-image-selector">
                        <img class="sell-selected-image" src="Images/DefaultSellPhoto.jpg" alt="Selected image">
                        <label class="sell-image-input-label" for="image-input-3">Choose an image</label>
                        <input class="sell-image-input" type="file" name="image-input-3" id="image-input-3">
                        <button type="button" class="sell-remove-image-button">Remove image</button>
                    </div>

                    <div class="sell-image-selector">
                        <img class="sell-selected-image" src="Images/DefaultSellPhoto.jpg" alt="Selected image">
                        <label class="sell-image-input-label" for="image-input-4">Choose an image</label>
                        <input class="sell-image-input" type="file" name="image-input-4" id="image-input-4">
                        <button type="button" class="sell-remove-image-button">Remove image</button>
                    </div>

                    <div class="sell-image-selector">
                        <img class="sell-selected-image" src="Images/DefaultSellPhoto.jpg" alt="Selected image">
                        <label class="sell-image-input-label" for="image-input-5">Choose an image</label>
                        <input class="sell-image-input" type="file" name="image-input-5" id="image-input-5">
                        <button type="button" class="sell-remove-image-button">Remove image</button>
                    </div>
                </div>
                <div style="display:block;">
                    <input type="submit" name="submit" value="Submit" class="sell-button">
                    <input type="reset" name="reset" value="Reset" class="sell-button">
                </div>
            </form>
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
                            labels[i].style.display = 'none';
                        };

                        reader.readAsDataURL(file);
                    });

                    removeImageButtons[i].addEventListener('click', () => {
                        imageInputs[i].value = '';
                        selectedImages[i].src = 'Images/DefaultSellPhoto.jpg';
                        labels[i].style.display = 'block';
                        event.preventDefault();
                    });
                }
            </script>
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

                function convertPrice() {
                    // Get the value from the dollar_price input
                    var dollarPrice = document.querySelector('input[name="dollar_price"]').value;

                    // Check if the input value is a number
                    if (!isNaN(dollarPrice) && dollarPrice.trim() !== '') {
                        // Convert the input value to a number and multiply by 90,000
                        var lbPrice = Number(dollarPrice) * 90000;

                        // Display the result in the lb_price input
                        document.querySelector('input[name="lb_price"]').value = lbPrice;
                    } else if(dollarPrice.trim() == ''){
                        document.querySelector('input[name="lb_price"]').value = '';
                    }else{
                        // Clear the lb_price input and show custom alert if the input is not a number
                        document.querySelector('input[name="lb_price"]').value = '';
                        document.querySelector('input[name="dollar_price"]').value = '';
                        showCustomAlert('Please enter a valid numeric value');
                    }
                }

                function checkForErrors() {
                    const urlParams = new URLSearchParams(window.location.search);
                    if (urlParams.has('error')) {
                        const error = urlParams.get('error');
                        let message = '';
                        switch (error) {
                            case '1':
                                message = 'Please Enter All The Recommended Info. Price in LL is not recommended';
                                break;
                            case '2':
                                message = 'Title Already Exists';
                                break;
                            case '3':
                                message = 'Please make sure that prices are numbers';
                                break;
                            case '4':
                                message = 'Title Must be less than 45 characters';
                                break;
                        }
                        showCustomAlert(message);
                    }
                }

                // Check for errors when the page loads
                window.onload = checkForErrors;
            </script>
        </div>
    </center>
</body>

</html>