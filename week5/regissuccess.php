<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <title>Successful Registration</title>
</head>

<body>
    <div class="container">
        <?php
        if (isset($_POST['submit'])) {
            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $date = $_POST["date"];
            $month = $_POST["month"];
            $year = $_POST["year"];
            $gender = $_POST["gender"];
            $username = $_POST["username"];
            $password = $_POST["password"];
            $cfmpassword = $_POST["confirmpassword"];
            $email = $_POST["email"];
            echo "<div class='text-center fs-3'>";
            echo "Welcome ";
            echo ucwords(strtolower($firstname));
            echo ucwords(strtolower($lastname)) . "<br>";
            echo "Your birthday is ";
            echo $date . " " . $month . " " . $year . "<br>";
            echo "Gender: " . $gender . "<br>";
            $userpattern = '/^[a-zA-Z][a-zA-Z0-9_-]{6,}$/'; // ^ check from start of the string, ensures that the username starts with a letter, followed by at least 5 characters that can be letters, numbers, underscores, or hyphens. $ check until end of the string. The quantifier {6,} means that the preceding character class must match at least 6 times, but it can match more times as well.
            if (preg_match($userpattern, $username)) { //preg_match is a function in PHP used to perform a regular expression match. It searches a given subject string for a match to the regular expression pattern provided. The function returns 1 if the pattern matches the subject, 0 if it does not, or false on failure.
                echo "Valid username: " . $username . "<br>";
            } else {
                echo "Invalid username, please try again <br>";
            }
            if ($password == $cfmpassword) {
                $symbol = preg_match('/[+$()%@#]/', $password); 
                $uppercase = preg_match('/[A-Z]{6,}/', $password);
                $lowercase = preg_match('/[a-z]{6,}/', $password);
                $number =  preg_match('/[0-9]{6,}/', $password);
                if ($symbol || $uppercase || $lowercase || $number) {
                    echo "<div>";
                    echo "Invalid password " . "$cfmpassword";
                    echo "</div>";
                } else {
                    echo "<div>";
                    echo "Valid password " . "$cfmpassword";
                    echo "</div>";
                }
            } else{
                echo "Please enter the same password";
            }
            echo "Your email address is: " . $email;
            echo "</div>";
        }
        ?>
    </div>
</body>

</html>