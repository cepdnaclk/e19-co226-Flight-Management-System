<?php
    include("sessionValidator.php");
    include("header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="assests/style/dashboard.css">
</head>
<body>
<div class="profile-card-container">
        <?php
            $email = $_SESSION['username'];
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            
            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
                $fname  = $row['first_name'];
                $lname = $row['last_name'];
                $dob = $row['birth_day'];
                $nic = $row['id'];
                $email = $row['email'];
                $country = $row['country'];
                $role = $row['role'];
                $uid = "";

                echo <<<EOL
                        <div class="profile-container">
                            <div class="left">
                                <img src="https://img.icons8.com/bubbles/100/000000/user.png" class="img-radius" alt="User-Profile-Image">
                                    <div class="name">{$fname} {$lname}</div>
                                    <div class="uid">User ID : {$uid}</div>
                            </div>
                            
                            <div class="right">
                                <div class="topic">Information</div>
                                <div class="container">
                                    <div class="label">Date of Birth</div>
                                    <div class="dob">: {$dob}</div>
                                </div>
                                <div class="container">
                                    <div class="label">NIC</div>
                                    <div class="nic">: {$nic}</div>
                                </div>
                                <div class="container">
                                    <div class="label">Email</div>
                                    <div class="email">: {$email}</div>
                                </div>
                                <div class="container">
                                    <div class="label">Country</div>
                                    <div class="country">: {$country} </div>
                                </div>
                                <div class="container">
                                    <div class="label">Role</div>
                                    <div class="role">: {$role} </div>
                                </div>
                            </div>
                        </div>

                    EOL;
            }
            ?>
</body>
</html>

<script>
    var element = document.getElementById("dashboard-button");
    element.style.fontWeight = "bold";
</script>