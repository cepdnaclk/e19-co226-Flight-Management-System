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
                    <div class="duration-label">Duration</div>
                    <input class="duration-textbox" type="text" name="duration">
                </div>
                <div class="price-container">
                    <div class="price-label">Price</div>
                    <input class="price-textbox" type="text" name="price">
                </div>
                <div class="add-button-container">
                    <input class="add-button" type="submit" value="Add" name="submit">
                </div>
            </form>
        </div>
    </div>
</body>
</html>

<script>
    var element = document.getElementById("create-flight-button");
    element.style.fontWeight = "bold";
</script>

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
            echo '<script>alert("enter duration");</script>';
        }
        elseif(empty($price)){
            echo '<script>alert("enter price");</script>';
        }
        else{
            $sql = "INSERT INTO flight (departure_time, arrival_time, depature, destination, duration, price) 
                    VALUE ('$departure', '$arrival', '$from', '$to', '$duration', '$price')";

            try{
                mysqli_query($conn, $sql);
                echo '<script>alert("Flight added successfull");</script>';
            }
            catch(mysqli_sql_exception $e){
                $error =  $e->getMessage();
                echo '<script>alert("' . $error . '");</script>';
            }
            
        }
    }

?>