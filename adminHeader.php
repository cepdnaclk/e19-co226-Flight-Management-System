<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="initial-scale=1.0">
  <link rel="stylesheet" href="assests/style/adminHeader.css"/>
  <link rel="icon" type="image/x-icon" href="assests/images/fevicon.ico">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
 
</head>
<body>
  <div class="container">
    <nav>
      <ul>
      <li><a href="#" class="logo">
          <img src="assests/images/logo2.svg" alt="">
          <span class="nav-item">FlightNavPro</span>
        </a></li>
        <li><a href="admin.php">
          <i class="fas fa-home"></i>
          <span class="nav-item" onclick="window.location = 'admin.php';">Home</span>
        </a></li>
        <li><a href="createFlight.php">
          <i class="fas fa-plane"></i>
          <span class="nav-item" onclick="window.location = 'createFlight.php';">Flight Details</span>
        </a></li>
        </li>
        <li><a href="users.php">
          <i class="fas fa-user-friends"></i>
          <span class="nav-item" onclick="window.location = 'users.php';">User Details</span>
        </a></li>
        </li>
        <li>
        <li><a href="logout.php">
          <i class="fas fa-sign-out-alt"></i>
          <span class="nav-item" onclick="window.location = 'logout.php';">Log out</span>
        </a></li>
      </ul>
    </nav>
  </div>
</body>
</html>
