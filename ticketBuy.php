<?php
    include("sessionValidator.php");
    include("header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tickets</title>
    <link rel="stylesheet" href="assests/style/ticketBuy.css">
</head>
<body>
<div class="form-container">
    <form class="search-form" action="ticketBuy.php" method="get">
        <div class="inputBoxContainer">
            <input id="departure" class="inputBox" placeholder="Depature" name="depature" id="depature" type="text">
        </div>
        <div class="inputBoxContainer">
            <input id="destination" class="inputBox" placeholder="Destination" name="destination" id="destination" type="text">
        </div>
        <input class="btnSearch" type="submit" name="search" value="Search">
    </form>
</div>

<div class="overlay" id="overlay"></div>

<div class="popup-container" id="popup">
    <div class="image-container">
        <img class="tick-img" src="assests/images/tick.png">
    </div>
    <div class="popup-header">Thank You!</div>
    <div class="popup-message">Your details has been successfully submitted.</div>
    <div class="button-container">
        <button class="close-button" type="button" onclick="closePopup()">Close</button>
    </div>
</div>

<script>
    let popup = document.getElementById('popup');
    let overlay = document.getElementById('overlay');

    function closePopup(){
        popup.style.visibility = 'hidden';
        overlay.style.visibility = 'hidden';
    }

</script>

<?php
    $result_count = 0;

    if(isset($_GET["search"])){
        $departure = filter_input(INPUT_GET, "depature", FILTER_SANITIZE_SPECIAL_CHARS);
        $destination = filter_input(INPUT_GET, "destination", FILTER_SANITIZE_SPECIAL_CHARS);

        if(empty($departure) && empty($destination)){
            echo <<<EOL
                    <script>
                        var inputElement = document.getElementById("departure");
                        inputElement.placeholder = "Enter a departure";
                        inputElement.classList.add("empty-warning");

                        var inputElement = document.getElementById("destination");
                        inputElement.placeholder = "Enter a destination";
                        inputElement.classList.add("empty-warning");
                    </script>;
                    EOL;
        }
        elseif(!empty($departure) && empty($destination)){
            $sql = "SELECT * FROM flight WHERE depature = '$departure'";

            try{
                $result = mysqli_query($conn, $sql);

                echo '<div class="flight-cart-container">';
                $result_count = mysqli_num_rows($result);

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

                            EOL;

                        echo <<<EOL
                            
                            <div class="buy-button-container">
                                <form action="ticketBuy.php" method="post">
                                    <input type="hidden" value="{$id}" name="flight-id">
                                    <input type="submit" class="buy-now-button" name="submit" value="BOOK NOW">
                                </form>
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

        elseif(empty($departure) && !empty($destination)){
            $sql = "SELECT * FROM flight WHERE destination = '$destination'";

            try{
                $result = mysqli_query($conn, $sql);

                echo '<div class="flight-cart-container">';
                $result_count = mysqli_num_rows($result);

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

                            EOL;

                        echo <<<EOL
                            
                            <div class="buy-button-container">
                                <form action="ticketBuy.php" method="post">
                                    <input type="hidden" value="{$id}" name="flight-id">
                                    <input type="submit" class="buy-now-button" name="submit" value="BOOK NOW">
                                </form>
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

        else{
            $sql = "SELECT * FROM flight WHERE depature = '$departure' AND destination = '$destination'";

            try{
                $result = mysqli_query($conn, $sql);

                echo '<div class="flight-cart-container">';
                $result_count = mysqli_num_rows($result);

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

                            EOL;

                        echo <<<EOL
                            
                            <div class="buy-button-container">
                                <form action="ticketBuy.php" method="post">
                                    <input type="hidden" value="{$id}" name="flight-id">
                                    <input type="submit" class="buy-now-button" name="submit" value="BOOK NOW">
                                </form>
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

    else{
        $sql = "SELECT * FROM flight";

            try{
                $result = mysqli_query($conn, $sql);

                echo '<div class="flight-cart-container">';
                $result_count = mysqli_num_rows($result);

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

                            EOL;

                        echo <<<EOL
                            
                            <div class="buy-button-container">
                                <form action="ticketBuy.php" method="post">
                                    <input type="hidden" value="{$id}" name="flight-id">
                                    <input type="submit" class="buy-now-button" name="submit" value="BOOK NOW">
                                </form>
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

    if(isset($_POST["submit"])){

        try{
            $fid = $_POST["flight-id"];
            $username = $_SESSION['username'];

            $sql = "SELECT user_id FROM users WHERE email='$username'; ";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);

            $uid = $row["user_id"];

            $sql = "INSERT INTO ticket (uid,fid) VALUES ($uid,$fid);";
            mysqli_query($conn, $sql);

            echo <<<EOT
                <script>document.getElementById('popup').style.visibility='visible';
                document.getElementById('overlay').style.visibility='visible';
                </script>
                EOT;

        }
        catch(mysqli_sql_exception $e){
            $error =  $e->getMessage();
            echo '<script>alert("' . $error . '");</script>';
        }

    }

    
?>


</body>

<script>

    var element = document.getElementById("ticket-button");
    element.style.fontWeight = "bold";

</script>

</html>