<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                        $month = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
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