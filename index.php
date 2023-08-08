<?php
    include("database.php");
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assests/style/login.css">
</head>
<body>
    <div class="preload">
        <img class="airplane" src="assests/images/airplane.png" alt="airplane">
        <h3>Landing on the Website...</h3>
        <img class="cloud1" src="assests/images/cloud.png" alt="cloud1">
        <img class="cloud2" src="assests/images/cloud.png" alt="cloud2">
        <img class="cloud3" src="assests/images/cloud.png" alt="cloud3">
    </div>
    <form action="index.php" method="post">
        <div class="register-card">
            <img src="assests/images/logo.png" class="img-radius" alt="LOGO">
            <div class="username-container">
                <p class="username-label">username</p>
                <p id="username-taken-label"></p>
                <input class="username-textbox" type="text" name="username">
            </div>
            
            <div class="password-container">
                <p class="password-label">password</p>
                <p id="password-taken-label"></p>
                <input class="password-textbox" type="password" name="password"><br>
            </div>
            <div class="register-link">Not a member ? <a class="register-label" href="register.php">Register</a> </div>
            <input class="register-button" type="submit" name="submit" value="login">
        </div>
    </form>
    <script src="./app.js"></script>
</body>
</html>

<?php

    if(isset($_POST["submit"])){
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
    
        if(empty($username)){
            echo '<script>document.getElementById("username-taken-label").innerHTML = "enter a username";</script>';
        }

        elseif (empty($password)){
            echo '<script>document.getElementById("password-taken-label").innerHTML = "enter a password";</script>';
        }

        else{
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "SELECT * FROM users WHERE email = '$username'";

            adminRoute($username, $password);

            try{
                $result = mysqli_query($conn, $sql);

                if(mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_assoc($result);

                    if(password_verify($password, $row['password'])){
                        $_SESSION['username'] = $username;
                        $_SESSION['password'] = $password;
                        header("Location: dashboard.php");
                        exit();
                    }

                    else{
                        echo '<script>alert("invalid password");</script>';
                    }
                }
                else{
                    echo '<script>alert("username is invalid");</script>';
                }
                
                
            }
            catch(mysqli_sql_exception){
                echo '<script>document.getElementById("username-taken-label").innerHTML = "username already taken";</script>';
            }
            
        }
    
    
    }

    function adminRoute($username, $password){
        if($username == "admin" && $password == "admin123"){
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            header("Location: admin.php");
            exit();
        }
    }

    mysqli_close($conn);
?>