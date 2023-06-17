<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <title>Registration Form</title>
</head>

<body>
    <div class="container">
        <form action="" method="post">
            <div class="mb-3">
                <label for="firstname" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo isset($_POST["firstname"]) ? $_POST["firstname"] : ''; ?>" required>
                <div id="emailHelp" class="form-text">Your first name.</div>
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo isset($_POST["lastname"]) ? $_POST["lastname"] : ''; ?>" required>
                <div id="emailHelp" class="form-text">Your last name.</div>
            </div>
            <div class="mb-3">
                <label for="birthday" class="form-label">Choose your birthday</label><br>
                <div class="row">
                    <div class="col">
                        <label for="date" class="form-label">Date</label>
                        <select name="date">
                            <?php
                            for ($i = 1; $i <= 31; $i++) {
                                echo "<option value='$i'>$i</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col">
                        <label for="month" class="form-label">Month</label>
                        <select name="month" id="month">
                            <?php
                            $month = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
                            for ($i = 0; $i <= 11; $i++) {
                                echo "<option value='$month[$i]'>$month[$i]</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col">
                        <label for="year" class="form-label">Year</label>
                        <select name="year" id="year">
                            <?php
                            for ($i = 1900; $i <= 2023; $i++) {
                                echo "<option value='$i'>$i</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="gender" class="form-label">Gender</label><br>
                <div class="form-check col ms-3">
                    <input class="form-check-input" type="radio" name="gender" id="male" value="male" checked required>
                    <label class="form-check-label" for="male">
                        Male
                    </label>
                </div>
                <div class="form-check col">
                    <!-- check name gender is null or not and if the gender equal to value male, then print checked as the attribute of the radio button -->
                    <input class="form-check-input" type="radio" name="gender" id="female" value="female" <?php
                                                                                                            if (isset($_POST["gender"]) && $_POST["gender"] == "female") {
                                                                                                                echo "checked";
                                                                                                            }
                                                                                                            ?> required>
                    <label class="form-check-label" for="female">
                        Female
                    </label>
                </div>
                <div class="form-check col">
                    <input class="form-check-input" type="radio" name="gender" id="other" value="other" <?php
                                                                                                        if (isset($_POST["gender"]) && $_POST["gender"] == "other") {
                                                                                                            echo "checked";
                                                                                                        }
                                                                                                        ?> required>
                    <label class="form-check-label" for="other">
                        Other
                    </label>
                </div>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" aria-describedby="emailHelp" minlength="6" name="username" value="<?php echo isset($_POST["username"]) ? $_POST["username"] : ''; ?>" required>
                <div id="emailHelp" class="form-text">Your username.</div>
            </div>
            <div class="mb-3">
                <label for="InputPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="InputPassword" minlength="6" name="password" value="<?php echo isset($_POST["password"]) ? $_POST["password"] : ''; ?>" required>
                <div id="emailHelp" class="form-text">Your password.</div>
            </div>
            <div class="mb-3">
                <label for="ConfirmPassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="ConfirmPassword" name="confirmpassword" value="<?php echo isset($_POST["confirmpassword"]) ? $_POST["confirmpassword"] : ''; ?>" required>
                <div id="emailHelp" class="form-text">Confirm your password.</div>
            </div>
            <div class="mb-3">
                <label for="InputEmail" class="form-label">Email address</label>
                <input type="email" class="form-control" id="InputEmail" aria-describedby="emailHelp" name="email" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ''; ?>" required>
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-2">
                <button id="submit" type="submit" class="btn btn-primary" name="submit">Submit</button>
            </div>
        </form>
    </div>
    <?php
    if (isset($_POST["submit"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $confirmpassword = $_POST["confirmpassword"];
        $symbol = preg_match('/[+$()%@#]/', $password); //check the string have included those invalid symbols.
        $uppercase = preg_match('/[A-Z]{6,}/', $password); //check all uppercase without lowercase and number.
        $lowercase = preg_match('/[a-z]{6,}/', $password); //check all lowercase without uppercase and number.
        $number =  preg_match('/[0-9]{6,}/', $password); //check all number without uppercase and lowercase.
        $userpattern = '/^[a-zA-Z][a-zA-Z0-9_-]{5,}$/'; //using delimiter like / is to differentiate between string and expression.
        $namecase = 0;
        $passcase = 0;
        $cfmcase = 0;
        if (!preg_match($userpattern, $username)) {
            $namecase = 1;
        } else {
            $namecase = 2;
        }

        if ($symbol || $uppercase || $lowercase || $number) { //if matches any word, symbol or number case return true.
            $passcase = 1;
        } else {
            $passcase = 2;
        }

        if ($password != $confirmpassword) { //if not matches with previous password return true.
            $cfmcase = 1;
        } else {
            $cfmcase = 2;
        }

        switch ($namecase) {
            case '1':
                echo "<div class='alert alert-danger container' role='alert'>";
                echo "Please enter minimum 6 characters and first character cannot be number, only _ or - is allowed.";
                echo "</div>";
                break;

            case '2':
                echo "<div class='alert alert-info container' role='alert'>";
                echo "Username validated";
                echo "</div>";
                break;
        }

        switch ($passcase) {
            case '1':
                echo "<div class='alert alert-danger container' role='alert'>";
                echo "Please enter minimum 6 characters, at least 1 capital letter, 1 small letter, 1 number, and NO symbols like +$()% (@#) allowed.";
                echo "</div>";
                break;

            case '2':
                echo "<div class='alert alert-info container' role='alert'>";
                echo "Password validated";
                echo "</div>";
                break;
        }

        switch ($cfmcase) {
            case '1':
                echo "<div class='alert alert-danger container' role='alert'>";
                echo "Please enter the same password.";
                echo "</div>";
                break;

            case '2':
                echo "<div class='alert alert-info container' role='alert'>";
                echo "Confirm password validated";
                echo "</div>";
                break;
        }

        if ($namecase == 2 && $passcase == 2 && $cfmcase == 2) {
            echo "<div class='alert alert-success container' role='alert'>";
            echo "Register successful" . "<br>" . "Welcome" . " " . $username;
            echo "</div>";
        }
    }
    ?>
</body>

</html>