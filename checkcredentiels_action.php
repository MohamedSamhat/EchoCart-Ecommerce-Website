<?php
    include('dbconfig/connection.php'); //connecting to database
    $username=strtolower($_POST['username']); //function post takes the name of the element 
    $sq=$_POST['choice'];
    $hashedsq=hash('sha256', $sq);
    $answer=strtolower($_POST['answer']);
    $hashedanswer=hash('sha256', $answer);
    //echo "<br>",$hashedsq,"         ",$hashedanswer;
    session_start();

    $query="SELECT * FROM `users` WHERE `username` LIKE '$username'";
    
    $result=mysqli_query($con,$query);

    $row_num=mysqli_num_rows($result);

    if($row_num>0){
        $data = mysqli_fetch_assoc($result);
        $storedsq = $data["security_question"];
        $storedanswer = $data["answer"];
        echo "<br>",$storedsq,"         ",$storedanswer;
        if ($storedsq==$hashedsq && $storedanswer==$hashedanswer){
            $_SESSION["username"]=$data;
            header("location:changepassword.php");
        }else{
            header("location:checkcredentiels.php?error=2");
        }
    }else{
        header("location:checkcredentiels.php?error=1");
    }
?>