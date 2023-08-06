<?php
    include("sessionValidator.php");
    include("header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assests/style/ticketBuy.css">
</head>
<body>
<div class="form-container">
    <form class="search-form" action="ticketBuy.php" method="get">
        <div class="inputBoxContainer">
            <input class="inputBox" placeholder="Depature" name="depature" id="depature" type="text">
        </div>
        <div class="inputBoxContainer">
            <input class="inputBox" placeholder="Destination" name="destination" id="destination" type="text">
        </div>
        <input class="btnSearch" type="submit" name="search" value="Search">
    </form>
</div>


<?php
    if(isset($_GET["search"])){
        $departure = filter_input(INPUT_GET, "depature", FILTER_SANITIZE_SPECIAL_CHARS);
        $destination = filter_input(INPUT_GET, "destination", FILTER_SANITIZE_SPECIAL_CHARS);

        if(empty($departure)){
            echo '<script>alert("enter a departure");</script>';
        }
        elseif(empty($destination)){
            echo '<script>alert("enter a destination");</script>';
        }
        else{
            $sql = "SELECT * FROM flight WHERE depature = '$departure' AND destination = '$destination'";

            try{
                $result = mysqli_query($conn, $sql);

                echo '<div class="flight-cart-container">';

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
                            <div class="flight-information-container">

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

                            <div class="buy-button-container">
                                buy now
                            </div>

                        </div>
    
                        EOL;
    
                    }

                }
                else{
                    echo '<script>alert("No flight available!");</script>';
                }

                echo "</div>";
            }
            catch(mysqli_sql_exception $e){
                $error =  $e->getMessage();
                echo '<script>alert("' . $error . '");</script>';
            }
        }
    }
?>

</body>
</html>

<script>
    var element = document.getElementById("ticket-button");
    element.style.fontWeight = "bold";
</script>

