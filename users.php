<?php
    include("sessionValidator.php");
    include("adminHeader.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="stylesheet" href="assests/style/users.css">
</head>
<body>
    <div class="user-container">
      <h1>User List</h1>
      <table class="table">
          <thead>
              <tr>
                  <th>User ID</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Birth Day</th>
                  <th>ID</th>
                  <th>Email</th>
                  <th>Country</th>
              </tr>
          </thead>
          <tbody>
          <?php
          $sql = "SELECT * FROM users";
          $result = mysqli_query($conn, $sql);
              if(mysqli_num_rows($result) > 0){
                  while($row = mysqli_fetch_assoc($result)){
                      echo "<tr>";
                      echo "<td>{$row['user_id']}</td>";
                      echo "<td>{$row['first_name']}</td>";
                      echo "<td>{$row['last_name']}</td>";
                      echo "<td>{$row['birth_day']}</td>";
                      echo "<td>{$row['id']}</td>";
                      echo "<td>{$row['email']}</td>";
                      echo "<td>{$row['country']}</td>";
                      echo "</tr>";
                  }
              } else {
                  echo "<tr><td colspan='7'>No users available.</td></tr>";
              }
          ?>
          </tbody>
      </table>
    </div>
</body>
</html>