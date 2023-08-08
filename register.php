<?php
    include("database.php");
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="assests/style/register.css">
</head>
<body>
    <form action="register.php" method="post">
        <div class="register-card">
        <img src="assests/images/logo.png" class="img-radius" alt="LOGO">
            <div class="name-container">
                <input class="first-textbox" type="text" name="fname" placeholder="First Name">
                <input class="last-textbox" type="text" name="lname" placeholder="Last Name">
            </div>
            
            <div class="bday-container">
                <p class="bday-label">Date of Birth</p>
                <input class="dob-textbox" type="date" name="dob">
            </div>
            <input class="username-textbox" type="text" name="id" placeholder="ID">
            <input class="username-textbox" type="text" name="country" placeholder="Country">
            <input class="username-textbox" type="text" name="email" placeholder="Email">
            <input class="password-textbox" type="password" name="password" placeholder="Password">
            <div class="register-link">Already a member ? <a class="register-label" href="index.php">Login</a> </div>
            <input class="register-button" type="submit" name="submit" value="Register">
        </div>
    </form>
</body>
</html>

<?php

    if(isset($_POST["submit"])){
        $firstName = filter_input(INPUT_POST, "fname", FILTER_SANITIZE_SPECIAL_CHARS);
        $lastName = filter_input(INPUT_POST, "lname", FILTER_SANITIZE_SPECIAL_CHARS);
        $bday = filter_input(INPUT_POST, "dob", FILTER_SANITIZE_SPECIAL_CHARS);
        $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
        $country = filter_input(INPUT_POST, "country", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
        
    
        if(empty($firstName)){
            echo '<script>alert("enter a first name");</script>';
        }
        elseif(empty($lastName)){
            echo '<script>alert("enter a last name");</script>';
        }
        elseif(empty($bday)){
            echo '<script>alert("enter a birthday");</script>';
        }
        elseif(empty($email)){
            echo '<script>alert("enter a email");</script>';
        }
        elseif(empty($country)){
            echo '<script>alert("enter a last name");</script>';
        }
        elseif(empty($id)){
            echo '<script>alert("enter a id");</script>';
        }
        elseif(empty($password)){
            echo '<script>alert("enter a password");</script>';
        }
        else{
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users (first_name, last_name, birth_day, id, email, country, password, role) 
                    VALUE ('$firstName', '$lastName', '$bday', '$id', '$email', '$country', '$hash', 'passenger')";

            try{
                mysqli_query($conn, $sql);
                $_SESSION['username'] = $email;
                $_SESSION['password'] = $password;
                header("Location: dashboard.php");
                exit();
            }
            catch(mysqli_sql_exception $e){
                $error =  $e->getMessage();
                echo '<script>alert("username already taken");</script>' . $error;
            }
            
        }
    
    
    }

    /*
    CREATE TABLE users (
        user_id INT AUTO_INCREMENT PRIMARY KEY,
        first_name varchar(50) NOT NULL,
        last_name varchar(50) NOT NULL,
        birth_day date NOT NULL,
        id varchar(50) NOT NULL,
        email varchar(50) NOT NULL,
        country varchar(50) NOT NULL,
        password varchar(255) NOT NULL,
        role varchar(50) NOT NULL,
        UNIQUE (id),
        UNIQUE(email)
    );

    CREATE TABLE flight (
        flight_id INT AUTO_INCREMENT PRIMARY KEY,
        departure_time datetime NOT NULL,
        arrival_time datetime NOT NULL,
        depature varchar(50) NOT NULL,
        destination varchar(50) NOT NULL,
        duration int(20) NOT NULL,
        price int(10) NOT NULL
    );
    
    CREATE TABLE ticket (
        ticket_id INT AUTO_INCREMENT PRIMARY KEY,
        uid int,
        fid int,
        FOREIGN KEY (uid) REFERENCES users(user_id) ON DELETE CASCADE ON UPDATE CASCADE,
        FOREIGN KEY (fid) REFERENCES flight(flight_id) ON DELETE CASCADE ON UPDATE CASCADE
    );

    INSERT INTO ticket (uid,fid)
    VALUES ($uid,$fid);

    SELECT * FROM flight WHERE depature = '$departure' AND destination = '$destination';

    SELECT user_id FROM users WHERE email='$username'; 


    */

    mysqli_close($conn);
?>

