<?php
    include("database.php");
    session_start();

    $username = $_SESSION['username'];
    $password = $_SESSION['password'];

    if(empty($username) || empty($password)){
        echo '<script>alert("session has expired");</script>';
        header("Location: index.php");
        exit();
    }

    else{
        $sql = "SELECT * FROM users WHERE email = '$username'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);

            if(!password_verify($password, $row['password'])){
                echo '<script>alert("invalid password");</script>';
                header("Location: index.php");
                exit();
            }
        }
    }
?>