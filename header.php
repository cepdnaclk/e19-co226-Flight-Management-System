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
            <div id="dashboard-button" class="dashboard-button" onclick="window.location = 'dashboard.php';">Dashboard</div>
            <div id="ticket-button" class="ticket-button" onclick="window.location = 'ticketBuy.php';">Tickets</div>
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