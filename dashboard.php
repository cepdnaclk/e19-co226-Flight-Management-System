<?php
    include("sessionValidator.php");
    include("header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assests/style/dashboard.css">
    <link rel="stylesheet" href="assests/style/airTicket.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="assests/images/fevicon.ico">
</head>
<body>
    <div class="profile-card-container">
        <?php
            $email = $_SESSION['username'];
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            
            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
                $fname  = $row['first_name'];
                $lname = $row['last_name'];
                $dob = $row['birth_day'];
                $nic = $row['id'];
                $email = $row['email'];
                $country = $row['country'];
                $role = $row['role'];
                $uid = $row['user_id'];

                echo <<<EOL
                        <div class="profile-container">
                            <div class="left">
                                <img src="https://img.icons8.com/bubbles/100/000000/user.png" class="img-radius" alt="User-Profile-Image">
                                    <div class="name">{$fname} {$lname}</div>
                                    <div class="uid">User ID : {$uid}</div>
                            </div>
                            
                            <div class="right">
                                <div class="topic">Information</div>
                                <div class="container">
                                    <div class="label">Date of Birth</div>
                                    <div class="dob">: {$dob}</div>
                                </div>
                                <div class="container">
                                    <div class="label">NIC</div>
                                    <div class="nic">: {$nic}</div>
                                </div>
                                <div class="container">
                                    <div class="label">Email</div>
                                    <div class="email">: {$email}</div>
                                </div>
                                <div class="container">
                                    <div class="label">Country</div>
                                    <div class="country">: {$country} </div>
                                </div>
                                <div class="container">
                                    <div class="label">Role</div>
                                    <div class="role">: {$role} </div>
                                </div>
                            </div>
                        </div>

                    EOL;
            }
        ?>
    </div>

    <div class="flight-cart-container">
        <?php
            $email = $_SESSION['username'];
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $fname = strtoupper($row['first_name']);
            $lname = strtoupper($row['last_name']);
            $uid = $row['user_id'];

            $sql = "SELECT * FROM ticket WHERE uid = '{$uid}'";
            $result = mysqli_query($conn, $sql);

            $fid_array = array();

            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $fid = $row['fid'];
                    array_push($fid_array, $fid);
                }
            }

            $length = count($fid_array);
            for ($i = 0; $i < $length; $i++) {
                $fid = $fid_array[$i];

                $sql = "SELECT * FROM flight WHERE flight_id = '{$fid}'";
                $result = mysqli_query($conn, $sql);
                
                $row = mysqli_fetch_assoc($result);

                        $id = $row['flight_id'];
                        $departure = $row['departure_time'];
                        $arrival = $row['arrival_time'];
                        $from = strtoupper($row['depature']);
                        $to = strtoupper($row['destination']);
                        $duration = $row['duration'];
                        $hours = intdiv($duration, 60);
                        $minutes = $duration % 60;
                        $price = $row['price'];
                        $boarding = explode(" ", $departure);
                        $date = $boarding[0];
                        $boarding_time = $boarding[1];
                        $departure_time = explode(" ", $arrival)[1];

                        echo <<<EOL


                        <div class="flight-ticket-card">
                            <div class="flight-ticket-header">
                                <div class="air-ticket-label">
                                    AIR TICKET
                                </div>
                                <div class="boarding-pass-label">
                                    BOARDING PASS
                                </div>
                            </div>
                            <div class="flight-ticket-information-container">

                                <div class="information-upper">
                                    <div class="name-container">
                                        <div class="passenger-name-label">
                                            NAME OF PASSANGER
                                        </div>
                                        <div class="passenger-name">
                                            {$fname} {$lname}
                                        </div>
                                    </div>
                                    <div class="date-container">
                                        <div class="date-label">
                                            DATE
                                        </div>
                                        <div class="date">
                                            {$date}
                                        </div>
                                    </div>
                                    <div class="boarding-time-container">
                                        <div class="boarding-time-label">
                                            BOARDING TIME
                                        </div>
                                        <div class="boarding-time">
                                            {$departure_time}
                                        </div>
                                    </div>
                                    <div class="departure-time-container">
                                        <div class="departure-time-label">
                                            DEPARTURE TIME
                                        </div>
                                        <div class="passenger-name">
                                            {$boarding_time}
                                        </div>
                                    </div>
                                </div>

                                <div class="information-middle">
                                    <div class="from-to-container">
                                        <div class="from-container">
                                            <div class="from-label">
                                                FROM
                                            </div>
                                            <div class="from">
                                                {$from}
                                            </div>
                                        </div>
                                        <div class="to-container">
                                            <div class="to-label">
                                                TO
                                            </div>
                                            <div class="to">
                                                {$to}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="empty-container">

                                    </div>
                                    <div class="duration-container">
                                        <div class="duration-label">
                                            DURATION
                                        </div>
                                        <div class="duration">
                                            {$hours} HOURS {$minutes} MINUTES
                                        </div>
                                    </div>
                                    <div class="qr-code-container">
                                        <img class="qr-code" id="resultImage" src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=bahukapn" alt="Result Image">
                                    </div>
                                </div>

                                <div class="information-bottom">
                                    <div class="flight-id-container">
                                        <div class="flight-id-label">
                                            FLIGHT ID :
                                        </div>
                                        <div class="flight-id">
                                            F{$fid}
                                        </div>
                                    </div>
                                    <div class="ticket-id-container">
                                        <div class="flight-id-label">
                                            TICKET ID :
                                        </div>
                                        <div class="ticket-id">
                                            TXX
                                        </div>
                                    </div>
                                    <div class="gate-close-notification">
                                        GATE CLOSED 30 MINUTES BEFORE DEPARTURE
                                    </div>
                                </div>
                            </div>

                            <div class="flight-ticket-footer">
                                <div class="footer-color-ribben"></div>
                                <div class="company-name-container">
                                    <div class="company-name">
                                        FLIGHT NAV PRO
                                    </div>
                                </div>
                            </div>
                        </div>

                        

                        EOL;

            } 

            
            ?>
    </div>
</body>
</html>

<script>
    var element = document.getElementById("dashboard-button");
    element.style.fontWeight = "bold";
</script>