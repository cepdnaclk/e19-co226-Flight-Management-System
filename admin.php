<?php
    include("sessionValidator.php");
    include("adminHeader.php")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assests/style/admin.css">
</head>
<body>
    <div class="flight-cart-container">
        <?php
            $sql = "SELECT * FROM flight";
            $result = mysqli_query($conn, $sql);


            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){

                    $id = $row['flight_id'];
                    $departure = $row['departure_time'];
                    $arrival = $row['arrival_time'];
                    $from = $row['depature'];
                    $to = $row['destination'];
                    $duration = $row['duration'];
                    $hours = intdiv($duration, 60);
                    $minutes = $duration % 60;
                    $price = $row['price'];

                    echo <<<EOL

                    <div class="flight-card">
                        <div class="container">
                            <div class="label">Flight ID</div>
                            <div class="id">: {$id}</div>
                        </div>
                        <div class="container">
                            <div class="label">Arrival Time</div>
                            <div class="arrival-time">: {$arrival}</div>
                        </div>
                        <div class="container">
                            <div class="label">departure Time</div>
                            <div class="departure-time">: {$departure}</div>
                        </div>
                        <div class="container">
                            <div class="label">From</div>
                            <div class="from-time">: {$from}</div>
                        </div>
                        <div class="container">
                            <div class="label">To</div>
                            <div class="to">: {$to}</div>
                        </div>
                        <div class="container">
                            <div class="label">Duration</div>
                            <div class="duration">: {$hours} Hours {$minutes} Minutes</div>
                        </div>
                        <div class="container">
                            <div class="label">Price</div>
                            <div class="price">: {$price}.00 LKR</div>
                        </div>
                    </div>

                    

                    EOL;

                    }
            
                }
            ?>
    </div>
</body>
</html>

<script>
    var element = document.getElementById("dashboard-button");
    element.style.fontWeight = "bold";
</script>

