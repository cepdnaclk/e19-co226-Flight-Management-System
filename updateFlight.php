<?php
    $sql = "DELETE FROM flight WHERE departure_time < NOW();";
    $result = mysqli_query($conn, $sql);
?>