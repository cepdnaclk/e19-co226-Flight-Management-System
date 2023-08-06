<?php
    include("sessionValidator.php");
    include("adminHeader.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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