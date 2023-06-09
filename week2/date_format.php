<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <title>Date Format</title>
</head>

<body>
    <div class="container-fluid h1">
        <?php
        date_default_timezone_set("Asia/Kuala_Lumpur");
        $month = date("M");
        $date = date("d, Y");
        $day = date("(D)");
        $hour = date("H");
        $minute = date(":i");
        $sec = date(":s");
        echo "<div>";
        echo "<span class='fw-bold text-uppercase' style='color:#af7b51'>$month </span>" . "<span class='fw-bold'>$date</span>" . "<span style='color:rgb(7,55,99)'> $day</span>" . "<br>";
        echo "<span style='color:rgb(91,15,0)'>$hour</span>" . "<span style='color:rgb(76,17,48)'>$minute</span>" . "$sec";
        echo "</div>";
        ?>
    </div>

</body>

</html>