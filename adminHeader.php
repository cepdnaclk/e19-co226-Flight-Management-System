<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assests/style/header.css">
</head>
<body>
    <div class="header-container">
        <div class="nav-bar-container">
            <div class="logo-container">LOGO</div>
            <div id="dashboard-button" class="dashboard-button" onclick="window.location = 'admin.php';">Dashboard</div>
            <div id="create-flight-button" class="create-flight-button" onclick="window.location = 'createFlight.php';">Create Flight</div>
        </div>
        <div class="user-detail-container">
            <div class="username">
                <?php
                    echo $_SESSION["username"];
                ?>
            </div>
            <div class="logout-button" onclick="window.location = 'logout.php';">logout</div>
        </div>
    </div>
</body>
</html>