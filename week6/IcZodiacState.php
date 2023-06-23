<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <title>Ic Zodiac and State</title>
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
                    echo "<option value=\"" . ($i + 1) . "\">$month[$i]</option>";
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
    if (isset($_POST['submit']) && checkdate($_POST["month"], $_POST["date"], $_POST["year"])) {
        $date = $_POST["date"];
        $arraymonth = $_POST["month"];
        $year = $_POST["year"];
        $age = date("Y") - $year;
        $cnzodiac = array("Mouse", "Cow", "Tiger", "Rabbit", "Dragon", "Snake", "Horse", "Goat", "Monkey", "Chicken", "Dog", "Pig");
        $numzodiac = $year + 9;
        $arrayzodiacnum = $numzodiac % 12;
        echo "<div class='fs-3 text-center'>";
        echo $date . " " . $month[$arraymonth - 1] . " " . $year . " " . "<br>Age: " . $age;
        echo "<br>";
        echo "Your Chinese Zodiac is: " . $cnzodiac[$arrayzodiacnum - 1];
        echo "<br>";
        if ($arraymonth == 1) {
            if ($date <= 18) {
                echo "Sagittarius";
            } else {
                echo "Capricornus";
            }
        } else if ($arraymonth == 2) {
            if ($date <= 15) {
                echo "Capricornus";
            } else {
                echo "Aquarius";
            }
        } else if ($arraymonth == 3) {
            if ($date <= 11) {
                echo "Aquarius";
            } else {
                echo "Pisces";
            }
        } else if ($arraymonth == 4) {
            if ($date <= 18) {
                echo "Pisces";
            } else {
                echo "Aries";
            }
        } else if ($arraymonth == 5) {
            if ($date <= 13) {
                echo "Aries";
            } else {
                echo "Taurus";
            }
        } elseif ($arraymonth == 6) {
            if ($date <= 19) {
                echo "Taurus";
            } else {
                echo "Gemini";
            }
        } else if ($arraymonth == 7) {
            if ($date <= 20) {
                echo "Gemini";
            } else {
                echo "Cancer";
            }
        } else if ($arraymonth == 8) {
            if ($date <= 9) {
                echo "Cancer";
            } else {
                echo "Leo";
            }
        } else if ($arraymonth == 9) {
            if ($date <= 15) {
                echo "Leo";
            } else {
                echo "Virgo";
            }
        } else if ($arraymonth == 10) {
            if ($date <= 30) {
                echo "Virgo";
            } else {
                echo "Lirba";
            }
        } else if ($arraymonth == 11) {
            if ($date <= 22) {
                echo "Lirba";
            } else if ($date <= 29) {
                echo "Scorpius";
            } else {
                echo "Ophiuchus";
            }
        } else if ($arraymonth == 12) {
            if ($date <= 17) {
                echo "Ophiuchus";
            } else {
                echo "Sagittarius";
            }
        }
        echo "</div><br>";
    } else {
        echo "<br>";
        echo "<div class='alert alert-danger container'>";
        echo "Please enter correct date, month and year";
        echo "</div>";
    }
    ?>
</body>
</html>