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
        <form action="" method="post">
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
                for ($i = 0; $i <= count($month); $i++) {
                    echo "<option value=\"" . ($i+1) . "\">$month[$i]</option>";
                }
                ?>
            </select>
            <br>
            <br>
            <select name="year" id="year">
                <?php
                for ($i = 1900; $i <= 2023; $i++) {
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
        $date = $_POST["date"];
        $month = $_POST["month"];
        $year = $_POST["year"];
        $age = date("Y") - $year;
        $cnzodiac = array("Mouse", "Cow", "Tiger", "Rabbit", "Dragon", "Snake", "Horse", "Goat", "Monkey", "Chicken", "Dog", "Pig");
        $numzodiac = $year + 9;
        $arrayzodiacnum = $numzodiac % 12;
        echo "<div class='fs-3 text-center'>";
        echo $date . " " . $month . " " . $year . " " . "<br>Age: " . $age;
        echo "<br>";
        echo "Your Chinese Zodiac is: " . $cnzodiac[$arrayzodiacnum - 1];
        echo "<br>";
        if ($month == 1) {
            if ($date <= 18) {
                echo "Sagittarius";
            } else {
                echo "Capricornus";
            }
        }elseif ($month == 2) {
            if ($date <= 15) {
                echo "Capricornus";
            }else {
                echo "Aquarius";
            }
        }
        echo "</div><br>";
    }
    ?>
</body>

</html>