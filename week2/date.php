<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <title>Date</title>
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
                        for ($i = 1; $i <= 12; $i++) {
                            echo "<option value='Months'>Month $i</option>";
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