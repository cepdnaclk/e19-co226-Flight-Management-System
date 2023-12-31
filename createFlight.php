<?php
    include("sessionValidator.php");
    include("adminHeader.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Flight</title>
    <link rel="stylesheet" href="assests/style/createFlight.css">
</head>
<body>
    <div class="create-flight-card-container">
        <div class="create-flight-card">
            <form action="createFlight.php" method="post">
                <div class="heading">Add Flight Details</div>
                <div class="departure-container">
                    <div class="departure-label">Departure</div>
                    <input class="departure-textbox" type="datetime-local" name="departure-time">
                </div>
                <div class="arrival-container">
                    <div class="arrival-label">Arrival</div>
                    <input class="arrival-textbox" type="datetime-local" name="arrival-time">
                </div>
                <div class="from-container">
                    <div class="from-label">From</div>
                    <input class="from-textbox" type="text" name="from">
                </div>
                <div class="to-container">
                    <div class="to-label">To</div>
                    <input class="to-textbox" type="text" name="to">
                </div>
                <div class="duration-container">
                    <div class="duration-label">Duration (MIN)</div>
                    <input class="duration-textbox" type="text" name="duration">
                </div>
                <div class="price-container">
                    <div class="price-label">Price (LKR)</div>
                    <input class="price-textbox" type="text" name="price">
                </div>
                <div class="add-button-container">
                    <input class="add-button" type="submit" value="Add" name="submit">
                </div>
            </form>
        </div>
    </div>

    <div class="overlay" id="overlay"></div>

    <div class="popup-container" id="popup">
        <div class="image-container">
            <img class="tick-img" src="assests/images/tick.png">
        </div>
        <div class="popup-header">Successfull!</div>
        <div class="popup-message">Flight successfully created.</div>
        <div class="button-container">
            <button class="close-button" type="button" onclick="closePopup()">Close</button>
        </div>
    </div>

    <script>

        function closePopup(){
            let popup = document.getElementById('popup');
            let overlay = document.getElementById('overlay');

            popup.style.visibility = 'hidden';
            overlay.style.visibility = 'hidden';
        }
    </script>


</body>
</html>



<?php
    if(isset($_POST["submit"])){
        $departure = filter_input(INPUT_POST, "departure-time", FILTER_SANITIZE_SPECIAL_CHARS);
        $arrival = filter_input(INPUT_POST, "arrival-time", FILTER_SANITIZE_SPECIAL_CHARS);
        $from = filter_input(INPUT_POST, "from", FILTER_SANITIZE_SPECIAL_CHARS);
        $to = filter_input(INPUT_POST, "to", FILTER_SANITIZE_SPECIAL_CHARS);
        $duration = filter_input(INPUT_POST, "duration", FILTER_SANITIZE_SPECIAL_CHARS);
        $price = filter_input(INPUT_POST, "price", FILTER_SANITIZE_SPECIAL_CHARS);
        
        if(empty($departure)){
            echo '<script>alert("enter departure time");</script>';
        }
        elseif(empty($arrival)){
            echo '<script>alert("enter arrival time");</script>';
        }
        elseif(empty($from)){
            echo '<script>alert("enter from");</script>';
        }
        elseif(empty($to)){
            echo '<script>alert("enter destination");</script>';
        }
        elseif(empty($duration)){
            echo '<script>alert("enter duration (min)");</script>';
        }
        elseif(empty($price)){
            echo '<script>alert("enter price (LKR)");</script>';
        }
        else{
            $sql = "INSERT INTO flight (departure_time, arrival_time, depature, destination, duration, price) 
                    VALUE ('$departure', '$arrival', '$from', '$to', '$duration', '$price')";

            try{
                mysqli_query($conn, $sql);
                echo <<<EOT
                    <script>
                        document.getElementById('popup').style.visibility='visible';
                        document.getElementById('overlay').style.visibility='visible';
                    </script>
                    EOT;
            }
            catch(mysqli_sql_exception $e){
                $error =  $e->getMessage();
                echo '<script>alert("' . $error . '");</script>';
            }
            
        }
    }

?>