<?php
    include('dbconfig/connection.php'); //connecting to database
    $username=strtolower($_POST['username']); //function post takes the name of the element 
    $email=strtolower($_POST['email']);
    $pass=$_POST['pass'];
    $passconf=$_POST['passconf'];
    $fn=ucfirst(strtolower($_POST['fn']));
    $ln=ucfirst(strtolower($_POST['ln']));
    $security_question=$_POST['choice'];
    $answer=strtolower($_POST['answer']);
    $dob=$_POST['dob'];
    $gender=$_POST['gender'];
    echo($username);

    if(empty($username) || empty($email) || empty($pass) || empty($passconf) || empty($fn) || empty($ln) || empty($answer) || empty($dob) || empty($gender)){
        header("location:signup.php?error=1");
    } 
    else{
        $select_query1="SELECT * FROM `users` WHERE `username`='$username'";
        $select_query2="SELECT * FROM `users` WHERE `email`='$email'";
        $result1=mysqli_query($con,$select_query1);
        $result2=mysqli_query($con,$select_query2);
        $row_num1=mysqli_num_rows($result1);
        $row_num2=mysqli_num_rows($result2);
        if ($row_num1>0) {
            header("location:signup.php?error=2");
        } else if($row_num2>0){
            header("location:signup.php?error=3");
        } else if(strlen($pass)<8){
            header("location:signup.php?error=4");
        } else if($pass!=$passconf){
            header("location:signup.php?error=5");
        } else{
            $hashedpass = password_hash($pass, PASSWORD_DEFAULT);
            $hashedSC=hash('sha256',$security_question);
            $hashedAnswer=hash('sha256',$answer);
            //echo $hashedSC, $hashedpass;
        }
    }
    //echo $username, $email, $pass, $passconf, $fn, $ln, $security_question, $answer, $dob, $gender;


    //This method inserts the row automatically in the table
    $query="INSERT INTO `users`(`username`, `email`, `password`, `first_name`, `last_name`, `security_question`, `answer`, `dob`, `gender`)
        VALUES ('$username','$email','$hashedpass','$fn','$ln','$hashedSC','$hashedAnswer','$dob','$gender')";
        echo($query);
    mysqli_query($con,$query);
    
    header("Location: login.php"); //for redirection to the login page after inserting the row
?>