<?php
    include('dbconfig/connection.php'); //connecting to database
    $username=strtolower($_POST['username']); //function post takes the name of the element 
    $pass=$_POST['pass'];
    session_start();

    $query="SELECT * FROM `users` WHERE `username` LIKE '$username'";
    
    $result=mysqli_query($con,$query);

    $row_num=mysqli_num_rows($result);

    if($row_num>0){
        $data = mysqli_fetch_assoc($result);
        $storedpass = $data["password"];
        //echo "<br>".$storedpass;
        if (password_verify($pass, $storedpass)){
            $_SESSION["user_info"]=$data;
            header("location:profile.php");
        }else{
            header("location:login.php?error=2");
        }
    }else{
        header("location:login.php?error=1");
    }
?>