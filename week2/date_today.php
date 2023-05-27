<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <title>Today's Date</title>
</head>
<body>
<div class="container-fluid text-center row">
        <div class="h1">What is your day of birth?</div>
        <div class="col">
            <div class="btn-group">
                <button class="btn btn-lg btn-info" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <select name="Date" id="Date" class="bg-info border border-0">
                        <?php
                        date_default_timezone_set("Asia/Singapore");
                        $day = date("d");
                        echo "<option value='Dates'>Date $day</option>";
                        for ($i = 1; $i <= 31; $i++) {
                            echo "<option value='Dates'>Date $i</option>";
                        }
                        ?>
                    </select>
                </button>
            </div>
        </div>

        <div class="col">
            <div class="btn-group">
                <button class="btn btn-lg btn-warning" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <select name="Month" id="Month" class="bg-warning border border-0">
                        <?php
                        $nummonth = date("m");
                        $i = $nummonth - 1;
                        $month = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
                        echo "<option value='Dates'>$month[$i]</option>";
                        for ($i=0; $i<=11; $i++){
                            echo "<option value='Dates'>$month[$i]</option>";
                        }
                        ?>
                    </select>
                </button>
            </div>
        </div>

        <div class="col">
            <div class="btn-group">
                <button class="btn btn-lg btn-danger" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <select name="Year" id="Year" class="bg-danger border border-0">
                        <?php
                        $year = date("Y");
                        echo "<option value='Years'>Year $year</option>";
                        for ($i = 1900; $i <= 2023; $i++) {
                            echo "<option value='Years'>Year $i</option>";
                        }
                        ?>
                    </select>
            </div>
        </div>

    </div>
</body>
</html>