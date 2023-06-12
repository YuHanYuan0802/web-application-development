<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <title>Name and birthday</title>
</head>

<body>
    <div class="container-fluid text-center row">
        <div class="h1">What is your name?</div>
        <form action="" method="post">
            First Name: <input type="text" name="firstname"><br>
            Last Name: <input type="text" name="lastname"><br>
            <div class="h1">What is your day of birth?</div>
            <select name="date">
                <?php
                for ($i = 1; $i <= 31; $i++) {
                    echo "<option value='$i'>$i</option>";
                }
                ?>
            </select>
            <br>
            <br>
            <select name="month" id="month">
                <?php
                $month = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
                for ($i = 0; $i <= 11; $i++) {
                    echo "<option value='$month[$i]'>$month[$i]</option>";
                }
                ?>
            </select>
            <br>
            <br>
            <select name="year" id="year">
                <?php
                for ($i = 1990; $i <= 2023; $i++) {
                    echo "<option value='$i'>$i</option>";
                }
                ?>
            </select>
            <br>
            <br>
            <input type="submit" name="submit"><br>
        </form>
    </div>

    <?php
    if (isset($_POST['submit'])) {
        $first = $_POST["firstname"];
        $last = $_POST["lastname"];
        $date = $_POST["date"];
        $month = $_POST["month"];
        $year = $_POST["year"];
        $age = date("Y")-$year;
        if (!empty($first) && !empty($last)) {
            echo "<div class='fs-3 text-center'>";
            echo ucwords(strtolower($first));
            echo " ";
            echo ucwords(strtolower($last));
            echo " ";
            echo $date . $month . $year . "<br>Age: " . $age;
            echo "</div><br>";
            if ($age >= 18) {
                echo "<div class='fs-3, text-center'>Welcome</div>";
            } else {
                echo "<div class='fs-3, text-center'>Under 18 years old</div>";
            }
        } else if (empty($first) || empty($last)) {
            echo "<h3 class='text-center, text-danger'> Please enter your name. </h3>";
        } else {
            echo "<h3 class='text-center, text-danger'> Please enter your name. </h3>";
        }
    }
    ?>
</body>

</html>