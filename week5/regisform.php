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
        <form action="regissuccess.php" method="post" class="needs-validation was-validated">
            <div class="mb-3">
                <label for="firstname" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstname" name="firstname" required>
                <div id="emailHelp" class="form-text">Your first name.</div>
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Please enter your first name.
                </div>
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastname" name="lastname" required>
                <div id="emailHelp" class="form-text">Your last name.</div>
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Please enter your last name.
                </div>
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
                    <input class="form-check-input" type="radio" name="gender" id="male" value="Male" checked>
                    <label class="form-check-label" for="male">
                        Male
                    </label>
                </div>
                <div class="form-check col">
                    <input class="form-check-input" type="radio" name="gender" id="female" value="Female">
                    <label class="form-check-label" for="female">
                        Female
                    </label>
                </div>
                <div class="form-check col">
                    <input class="form-check-input" type="radio" name="gender" id="other" value="Other">
                    <label class="form-check-label" for="other">
                        Other
                    </label>
                </div>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" aria-describedby="emailHelp" minlength="6" name="username" required>
                <div id="emailHelp" class="form-text">Your username.</div>
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Please enter your username.
                </div>
            </div>
            <div class="mb-3">
                <label for="InputPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="InputPassword" minlength="6" name="password" required>
                <div id="emailHelp" class="form-text">Your password.</div>
            </div>
            <div class="mb-3">
                <label for="ConfirmPassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="ConfirmPassword" name="confirmpassword" required>
                <div id="emailHelp" class="form-text">Confirm your password.</div>
            </div>
            <div class="mb-3">
                <label for="InputEmail" class="form-label">Email address</label>
                <input type="email" class="form-control" id="InputEmail" aria-describedby="emailHelp" name="email" required>
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Please enter your email.
                </div>
            </div>
            <div class="mb-2">
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </div>
        </form>
    </div>
</body>

</html>