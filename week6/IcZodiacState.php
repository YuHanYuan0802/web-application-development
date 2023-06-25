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
            <input type="text" name="ic" id="ic" class="text-center" placeholder="xxxxxx-xx-xxxx">
            <select name="whatyear" id="whatyear">
                <option value="19">19</option>
                <option value="20">20</option>
            </select>
            <?php
            if (!empty($_POST["ic"])) {
                $ic = $_POST["ic"];
                $icdate = substr($ic, 4, -8); //substr only return specific part of string with string starting point and length, positive number returned with start of the string and the negative number return from end of the string
                $icmonth = substr($ic, 2, -10);
                $icyear = substr($ic, 0, -12);
                $month = array("JANUARY", "FEBRUARY", "MARCH", "APRIL", "MAY", "JUNE", "JULY", "AUGUST", "SEPTEMBER", "OCTOBER", "NOVEMBER", "DECEMBER");
            }
            ?><br><br>
            <input type="submit" name="submit" value="Verify and Submit">
        </form>
    </div>

    <?php
    if (isset($_POST["submit"]) && isset($_POST["whatyear"])) {
        $ic = $_POST["ic"];
        $icpattern = "/^[0-9]{6}-[0-9]{2}-[0-9]{4}$/";
        $validateIC = preg_match($icpattern, $ic);
        $whatyear = $_POST["whatyear"];
        if ($validateIC === 1 && checkdate($icmonth, $icdate, $whatyear)) {
            $date = $icdate;
            $arraymonth = $icmonth;
            switch ($whatyear) {
                case '19':
                    $year = $icyear + 1900;
                    break;

                case '20':
                    $year = $icyear + 2000;
                    break;
            }
            if ($year <= date("Y")) {
                $age = date("Y") - $year;
                $arrayzodiacnum = $year % 12;
                $cnzodiac = array("Monkey", "Chicken", "Dog", "Pig", "Mouse", "Cow", "Tiger", "Rabbit", "Dragon", "Snake", "Horse", "Goat");
                $countrycode = substr($ic, 7, -5);
                echo "<br><div class='fs-3 text-center'>";
                echo $ic;
                echo "<br>";
                echo "Your birthday is: ";
                echo $month[$arraymonth - 1] . " " . $date . ", " . $year . " " . "<br>Age: " . $age;
                echo "<br>";
                if ($countrycode === "01" || $countrycode === "21"  || $countrycode === "22"  || $countrycode === "23" || $countrycode === "24") {
                    echo "Your are from Johor";
                    echo "<br>";
                    echo "<img class = 'shadow-lg' src = 'img/johor.jpg' alt = 'Johor'>";
                    echo "<br>";
                } else if ($countrycode === "02" || $countrycode === "25" || $countrycode === "26" || $countrycode === "27") {
                    echo "Your are from Kedah";
                    echo "<br>";
                    echo "<img class = 'shadow-lg' src = 'img/kedah.jpg' alt = 'Kedah'>";
                    echo "<br>";
                } else if ($countrycode === "03" || $countrycode === "28" || $countrycode === "29") {
                    echo "Your are from Kelantan";
                    echo "<br>";
                    echo "<img class = 'shadow-lg' src = 'img/kelantan.jpg' alt = 'Kelatan'>";
                    echo "<br>";
                } else if ($countrycode === "04" || $countrycode === "30") {
                    echo "Your are from Malacca";
                    echo "<br>";
                    echo "<img class = 'shadow-lg' src = 'img/malacca.jpg' alt = 'Malacca'>";
                    echo "<br>";
                } else if ($countrycode === "05" || $countrycode === "31" || $countrycode === "59") {
                    echo "Your are from Negeri Sembilan";
                    echo "<br>";
                    echo "<img class = 'shadow-lg' src = 'img/sembilan.jpg' alt = 'Sembilan'>";
                    echo "<br>";
                } else if ($countrycode === "06" || $countrycode === "32" || $countrycode === "33") {
                    echo "Your are from Pahang";
                    echo "<br>";
                    echo "<img class = 'shadow-lg' src = 'img/pahang.jpg' alt = 'Pahang'>";
                    echo "<br>";
                } else if ($countrycode === "07" || $countrycode === "34" || $countrycode === "35") {
                    echo "Your are from Penang";
                    echo "<br>";
                    echo "<img class = 'shadow-lg' src = 'img/penang.jpg' alt = 'Penang'>";
                    echo "<br>";
                } else if ($countrycode === "08" || $countrycode === "36" || $countrycode === "37" || $countrycode === "38" || $countrycode === "39") {
                    echo "Your are from Perak";
                    echo "<br>";
                    echo "<img class = 'shadow-lg' src = 'img/perak.jpg' alt = 'Perak'>";
                    echo "<br>";
                } else if ($countrycode === "09" || $countrycode === "40") {
                    echo "Your are from Perlis";
                    echo "<br>";
                    echo "<img class = 'shadow-lg' src = 'img/perlis.jpg' alt = 'Perlis'>";
                    echo "<br>";
                } else if ($countrycode === "10" || $countrycode === "41" || $countrycode === "42" || $countrycode === "43" || $countrycode === "44") {
                    echo "Your are from Selangor";
                    echo "<br>";
                    echo "<img class = 'shadow-lg' src = 'img/selangor.jpg' alt = 'Selangor'>";
                    echo "<br>";
                } else if ($countrycode === "11" || $countrycode === "45" || $countrycode === "46") {
                    echo "Your are from Terengganu";
                    echo "<br>";
                    echo "<img class = 'shadow-lg' src = 'img/terengganu.jpg' alt = 'Terengganu'>";
                    echo "<br>";
                } else if ($countrycode === "12" || $countrycode === "47" || $countrycode === "48" || $countrycode === "49") {
                    echo "Your are from Sabah";
                    echo "<br>";
                    echo "<img class = 'shadow-lg' src = 'img/sabah.jpg' alt = 'Sabah'>";
                    echo "<br>";
                } else if ($countrycode === "13" || $countrycode === "50" || $countrycode === "51" || $countrycode === "52" || $countrycode === "53") {
                    echo "Your are from Sarawak";
                    echo "<br>";
                    echo "<img class = 'shadow-lg' src = 'img/sarawak.jpg' alt = 'Sarawak'>";
                    echo "<br>";
                } else if ($countrycode === "14" || $countrycode === "54" || $countrycode === "55" || $countrycode === "56" || $countrycode === "57") {
                    echo "Your are from Federal Territory of Kuala Lumpur";
                    echo "<br>";
                    echo "<img class = 'shadow-lg' src = 'img/kl.jpg' alt = 'KL'>";
                    echo "<br>";
                } else if ($countrycode === "15" || $countrycode === "58") {
                    echo "Your are from Federal Territory of Labuan";
                    echo "<br>";
                    echo "<img class = 'shadow-lg' src = 'img/labuan.jpg' alt = 'Labuan'>";
                    echo "<br>";
                } else if ($countrycode === "16") {
                    echo "Your are from Federal Territory of Putrajaya";
                    echo "<br>";
                    echo "<img class = 'shadow-lg' src = 'img/putrajaya.jpg' alt = 'Putrajaya'>";
                    echo "<br>";
                } else {
                    echo "<br><div class='alert alert-danger container'>";
                    echo "Not found";
                    echo "</div>";
                }
                echo "<br>";
                echo "Your Chinese Zodiac is: " . $cnzodiac[$arrayzodiacnum];
                echo "<br>";
                if ($arrayzodiacnum == 0) {
                    echo "<img src = 'img/monkey.png' alt = 'monkey'>";
                } else if ($arrayzodiacnum == 1) {
                    echo "<img src = 'img/rooster.png' alt = 'rooster'>";
                } else if ($arrayzodiacnum == 2) {
                    echo "<img src = 'img/dog.png' alt = 'dog'>";
                } else if ($arrayzodiacnum == 3) {
                    echo "<img src = 'img/pig.png' alt = 'pig'>";
                } else if ($arrayzodiacnum == 4) {
                    echo "<img src = 'img/mouse.png' alt = 'mouse'>";
                } else if ($arrayzodiacnum == 5) {
                    echo "<img src = 'img/cow.png' alt = 'cow'>";
                } else if ($arrayzodiacnum == 6) {
                    echo "<img src = 'img/tiger.png' alt = 'tiger'>";
                } else if ($arrayzodiacnum == 7) {
                    echo "<img src = 'img/rabbit.png' alt = 'rabbit'>";
                } else if ($arrayzodiacnum == 8) {
                    echo "<img src = 'img/dragon.png' alt = 'dragon'>";
                } else if ($arrayzodiacnum == 9) {
                    echo "<img src = 'img/snake.png' alt = 'snake'>";
                } else if ($arrayzodiacnum == 10) {
                    echo "<img src = 'img/horse.png' alt = 'horse'>";
                } else {
                    echo "<img src = 'img/goat.png' alt = 'goat'>";
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
                        echo "Your Zodiac is: Libra";
                        echo "<br>";
                        echo "<img src = 'img/libra.png' alt = 'Libra'>";
                        echo "<br>";
                    }
                } else if ($arraymonth == 11) {
                    if ($date <= 22) {
                        echo "Your Zodiac is: Libra";
                        echo "<br>";
                        echo "<img src = 'img/libra.png' alt = 'Libra'>";
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
            } else {
                echo "<br><div class='alert alert-danger container'>";
                echo "Please enter correct born year";
                echo "</div>";
            }
        } else {
            echo "<br><div class='alert alert-danger container'>";
            echo "Please enter correct Ic";
            echo "</div>";
        }
    }
    ?>
</body>

</html>