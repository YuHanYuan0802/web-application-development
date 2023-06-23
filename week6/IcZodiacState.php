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
            <div class="h1">What is your IC number?</div>
            <input type="text" name="ic" id="ic" class="text-center" placeholder="xxxx-xx-xxxx">
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
            <input type="submit" name="submit" value="Verify and Submit"><br>
        </form>
    </div>

    <?php
    if (isset($_POST["submit"])) {
        $ic = $_POST["ic"];
        $icpattern = "/^[0-9]{4}-[0-9]{2}-[0-9]{4}$/";
        $validateIC = preg_match($icpattern, $ic);
        if ($validateIC === 1 && checkdate($_POST["month"], $_POST["date"], $_POST["year"])) {
            $date = $_POST["date"];
            $arraymonth = $_POST["month"];
            $year = $_POST["year"];
            $age = date("Y") - $year;
            $cnzodiac = array("Mouse", "Cow", "Tiger", "Rabbit", "Dragon", "Snake", "Horse", "Goat", "Monkey", "Chicken", "Dog", "Pig");
            $numzodiac = $year + 9;
            $arrayzodiacnum = $numzodiac % 12;
            echo "<br><div class='fs-3 text-center'>";
            echo $ic;
            echo "<br>";
            echo $month[$arraymonth - 1] . " " . $date . ", " . $year . " " . "<br>Age: " . $age;
            echo "<br>";
            echo "Your Chinese Zodiac is: " . $cnzodiac[$arrayzodiacnum - 1];
            echo "<br>";
            if ($arrayzodiacnum - 1 == 0) {
                echo "<img src = 'img/mouse.png' alt = 'mouse'>";
            } else if ($arrayzodiacnum - 1 == 1) {
                echo "<img src = 'img/cow.png' alt = 'cow'>";
            } else if ($arrayzodiacnum - 1 == 2) {
                echo "<img src = 'img/tiger.png' alt = 'tiger'>";
            } else if ($arrayzodiacnum - 1 == 3) {
                echo "<img src = 'img/rabbit.png' alt = 'rabbit'>";
            } else if ($arrayzodiacnum - 1 == 4) {
                echo "<img src = 'img/dragon.png' alt = 'dragon'>";
            } else if ($arrayzodiacnum - 1 == 5) {
                echo "<img src = 'img/snake.png' alt = 'snake'>";
            } else if ($arrayzodiacnum - 1 == 6) {
                echo "<img src = 'img/horse.png' alt = 'horse'>";
            } else if ($arrayzodiacnum - 1 == 7) {
                echo "<img src = 'img/goat.png' alt = 'goat'>";
            } else if ($arrayzodiacnum - 1 == 8) {
                echo "<img src = 'img/monkey.png' alt = 'monkey'>";
            } else if ($arrayzodiacnum - 1 == 9) {
                echo "<img src = 'img/rooster.png' alt = 'rooster'>";
            } else if ($arrayzodiacnum - 1 == 10) {
                echo "<img src = 'img/dog.png' alt = 'dog'>";
            } else if ($arrayzodiacnum - 1 == 11) {
                echo "<img src = 'img/pig.png' alt = 'pig'>";
            }
            echo "<br>";
            if ($arraymonth == 1) {
                if ($date <= 18) {
                    echo "Your Zodiac is: Sagittarius";
                    echo "<br>";
                    echo "<img src = 'img/sagittarius.png' alt = 'Sagittarius'>";
                    echo "<br>";
                } else {
                    echo "Your Zodiac is: Capricornus";
                    echo "<br>";
                    echo "<img src = 'img/capricornus.png' alt = 'Capricornus'>";
                    echo "<br>";
                }
            } else if ($arraymonth == 2) {
                if ($date <= 15) {
                    echo "Your Zodiac is: Capricornus";
                    echo "<br>";
                    echo "<img src = 'img/capricornus.png' alt = 'Capricornus'>";
                    echo "<br>";
                } else {
                    echo "Your Zodiac is: Aquarius";
                    echo "<br>";
                    echo "<img src = 'img/aquarius.png' alt = 'Aquarius'>";
                    echo "<br>";
                }
            } else if ($arraymonth == 3) {
                if ($date <= 11) {
                    echo "Your Zodiac is: Aquarius";
                    echo "<br>";
                    echo "<img src = 'img/aquarius.png' alt = 'Aquarius'>";
                    echo "<br>";
                } else {
                    echo "Your Zodiac is: Pisces";
                    echo "<br>";
                    echo "<img src = 'img/pisces.png' alt = 'Pisces'>";
                    echo "<br>";
                }
            } else if ($arraymonth == 4) {
                if ($date <= 18) {
                    echo "Your Zodiac is: Pisces";
                    echo "<br>";
                    echo "<img src = 'img/pisces.png' alt = 'Pisces'>";
                    echo "<br>";
                } else {
                    echo "Your Zodiac is: Aries";
                    echo "<br>";
                    echo "<img src = 'img/aries.png' alt = 'Aries'>";
                    echo "<br>";
                }
            } else if ($arraymonth == 5) {
                if ($date <= 13) {
                    echo "Your Zodiac is: Aries";
                    echo "<br>";
                    echo "<img src = 'img/aries.png' alt = 'Aries'>";
                    echo "<br>";
                } else {
                    echo "Your Zodiac is: Taurus";
                    echo "<br>";
                    echo "<img src = 'img/taurus.png' alt = 'Taurus'>";
                    echo "<br>";
                }
            } elseif ($arraymonth == 6) {
                if ($date <= 19) {
                    echo "Your Zodiac is: Taurus";
                    echo "<br>";
                    echo "<img src = 'img/taurus.png' alt = 'Taurus'>";
                    echo "<br>";
                } else {
                    echo "Your Zodiac is: Gemini";
                    echo "<br>";
                    echo "<img src = 'img/gemini.png' alt = 'Gemini'>";
                    echo "<br>";
                }
            } else if ($arraymonth == 7) {
                if ($date <= 20) {
                    echo "Your Zodiac is: Gemini";
                    echo "<br>";
                    echo "<img src = 'img/gemini.png' alt = 'Gemini'>";
                    echo "<br>";
                } else {
                    echo "Your Zodiac is: Cancer";
                    echo "<br>";
                    echo "<img src = 'img/cancer.png' alt = 'Cancer'>";
                    echo "<br>";
                }
            } else if ($arraymonth == 8) {
                if ($date <= 9) {
                    echo "Your Zodiac is: Cancer";
                    echo "<br>";
                    echo "<img src = 'img/cancer.png' alt = 'Cancer'>";
                    echo "<br>";
                } else {
                    echo "Your Zodiac is: Leo";
                    echo "<br>";
                    echo "<img src = 'img/leo.png' alt = 'Leo'>";
                    echo "<br>";
                }
            } else if ($arraymonth == 9) {
                if ($date <= 15) {
                    echo "Your Zodiac is: Leo";
                    echo "<br>";
                    echo "<img src = 'img/leo.png' alt = 'Leo'>";
                    echo "<br>";
                } else {
                    echo "Your Zodiac is: Virgo";
                    echo "<br>";
                    echo "<img src = 'img/virgo.png' alt = 'Virgo'>";
                    echo "<br>";
                }
            } else if ($arraymonth == 10) {
                if ($date <= 30) {
                    echo "Your Zodiac is: Virgo";
                    echo "<br>";
                    echo "<img src = 'img/virgo.png' alt = 'Virgo'>";
                    echo "<br>";
                } else {
                    echo "Your Zodiac is: Lirba";
                    echo "<br>";
                    echo "<img src = 'img/lirba.png' alt = 'Lirba'>";
                    echo "<br>";
                }
            } else if ($arraymonth == 11) {
                if ($date <= 22) {
                    echo "Your Zodiac is: Lirba";
                    echo "<br>";
                    echo "<img src = 'img/lirba.png' alt = 'Lirba'>";
                    echo "<br>";
                } else if ($date <= 29) {
                    echo "Your Zodiac is: Scorpius";
                    echo "<br>";
                    echo "<img src = 'img/scorpius.png' alt = 'Scorpius'>";
                    echo "<br>";
                } else {
                    echo "Your Zodiac is: Ophiuchus";
                    echo "<br>";
                    echo "<img src = 'img/ophiuchus.png' alt = 'Ophiuchus'>";
                    echo "<br>";
                }
            } else if ($arraymonth == 12) {
                if ($date <= 17) {
                    echo "Your Zodiac is: Ophiuchus";
                    echo "<br>";
                    echo "<img src = 'img/ophiuchus.png' alt = 'Ophiuchus'>";
                    echo "<br>";
                } else {
                    echo "Your Zodiac is: Sagittarius";
                    echo "<br>";
                    echo "<img src = 'img/sagittarius.png' alt = 'Sagittarius'>";
                    echo "<br>";
                }
            }
            echo "</div><br>";
        } elseif ($validateIC !== 1) {
            echo "<br><div class='alert alert-danger container'>";
            echo "Please enter correct Ic";
            echo "</div>";
        } else {
            echo "<br>";
            echo "<div class='alert alert-danger container'>";
            echo "Please enter correct date, month and year";
            echo "</div>";
        }
    } else {
        echo "<br><div class='alert alert-danger container'>";
        echo "Please enter correct Ic";
        echo "</div>";
    }

    ?>
</body>

</html>