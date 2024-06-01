<?php
    include('dbconfig/connection.php');
    $pass=$_POST['password'];
    $passconf=$_POST['confpass'];
    session_start();
    $username=$_SESSION["username"]["username"];
    //echo($username);

    if(strlen($pass)<8){
        header("location:changepassword.php?error=1");
    } else if($pass!=$passconf){
        header("location:changepassword.php?error=2");
    } else{
        $hashedpass = password_hash($pass, PASSWORD_DEFAULT);
        //echo($hashedpass);
        //This method inserts the row automatically in the table
        $query="UPDATE `users` SET `password` = '$hashedpass' WHERE `username` = '$username'";
        //echo($query);
        mysqli_query($con,$query);
        session_destroy();
        header("Location: login.php"); //for redirection to the login page after inserting the row
    }
?>