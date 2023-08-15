<?php
    include("sessionValidator.php");
    include("adminHeader.php")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="assests/style/admin.css">
  </head>
<body>

<section class="main">
      <div class="main-top">
        <h1>Details</h1>
      </div>
      <div class="users">
        <div class="card">
          <img src="assests/images/Money.jpg">
          <h4>Money Earned</h4>
          <div class="per">
            <table>
              <tr>
                <td class="amount"><span>
                <?php
                  $sql = "SELECT SUM(price) FROM (SELECT flight.price FROM flight INNER JOIN ticket ON ticket.fid = flight.flight_id) AS subQuery;";
                  $result = mysqli_query($conn, $sql);
                  $row = mysqli_fetch_assoc($result);
                  echo "Rs. " . $row['SUM(price)'];

                ?>
                </span></td>
              </tr>
              <tr>
                <td>Ticket earnings</td>
              </tr>
            </table>
          </div>

        </div>
        <div class="card">
          <img src="assests/images/Passengers.png">
          <h4>Number Of Passengers</h4>
          <div class="per">
            <table>
              <tr>
                <td class="amount"><span>
                <?php
                  $sql = "SELECT COUNT(ticket_id) FROM ticket";
                  $result = mysqli_query($conn, $sql);
                  $row = mysqli_fetch_assoc($result);
                  echo $row['COUNT(ticket_id)'];

                ?>
                </span></td>
              </tr>
              <tr>
                <td>Amount</td>
              </tr>
            </table>
          </div>
          
        </div>
        <div class="card">
          <img src="assests/images/Tickets.png">
          <h4>Number of tickets Issued</h4>
          <div class="per">
            <table>
              <tr>
                <td class="amount"><span>
                <?php
                  $sql = "SELECT COUNT(ticket_id) FROM ticket";
                  $result = mysqli_query($conn, $sql);
                  $row = mysqli_fetch_assoc($result);
                  echo $row['COUNT(ticket_id)'];

                ?>
                </span></td>
              </tr>
              <tr>
                <td>Amount</td>
              </tr>
            </table>
          </div>
          
        </div>
          
        
      </div>
  </section>


  <section class="Flights">
      <div class="flight-cart-container">
      <h1>Flight List</h1>
      <table class="table">
          <thead>
              <tr>
                  <th>Flight ID</th>
                  <th>Departure time</th>
                  <th>Arrival Time</th>
                  <th>Departure</th>
                  <th>Destination</th>
                  <th>Duration</th>
                  <th>Price</th>
              </tr>
          </thead>
          <tbody>
          <?php
          $sql = "SELECT * FROM flight";
          $result = mysqli_query($conn, $sql);
              if(mysqli_num_rows($result) > 0){
                  while($row = mysqli_fetch_assoc($result)){
                      $duration = $row['duration'];
                      $hours = intdiv($duration, 60);
                      $minutes = $duration % 60;
                      $price = $row['price'];

                      echo "<tr>";
                      echo "<td>{$row['flight_id']}</td>";
                      echo "<td>{$row['departure_time']}</td>";
                      echo "<td>{$row['arrival_time']}</td>";
                      echo "<td>{$row['depature']}</td>";
                      echo "<td>{$row['destination']}</td>";
                      echo "<td>{$hours}h {$minutes}m</td>";
                      echo "<td>{$price}</td>";
                      echo "</tr>";
                  }
              } else {
                  echo "<tr><td colspan='7'>No flights available.</td></tr>";
              }
          ?>
          </tbody>
      </table>
  </div>
        

</body>

</html>



