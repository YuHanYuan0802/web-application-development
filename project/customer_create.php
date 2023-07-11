<!DOCTYPE HTML>
<html>

<head>
    <title>Create Customers</title>
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <!-- container -->
    <div class="container">
        <?php
        include 'menu/menu.php';
        ?>
        <?php
        if ($_POST) {
            include 'config/database.php';
            try {
                // insert query
                $query = "INSERT INTO customers SET username=:username, password=:password, first_name=:firstname, last_name=:lastname, email=:email, gender=:gender, date_of_birth=:date_of_birth, registration_date_time=:registration_date_time, status=:status";
                // prepare query for execution
                $stmt = $con->prepare($query);
                $username = $_POST['username'];
                $password = $_POST['password'];
                $cfmpassword = $_POST['cfmpassword'];
                $firstname = $_POST['first_name'];
                $lastname = $_POST['last_name'];
                $email = $_POST['email'];
                $gender = $_POST['gender'];
                $date_of_birth = $_POST['date_of_birth'];
                $registration_date_time = $_POST['registration_date_time'];
                $status = $_POST['status'];
                $pw_pattern = "/^[0-9A-Za-z]{6,}$/";
                $finalpassword = preg_match($pw_pattern, $password);
                $hashpassword = password_hash($finalpassword, PASSWORD_DEFAULT);
                // bind the parameters
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $hashpassword);
                $stmt->bindParam(':firstname', $firstname);
                $stmt->bindParam(':lastname', $lastname);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':gender', $gender);
                $stmt->bindParam(':date_of_birth', $date_of_birth);
                $stmt->bindParam(':registration_date_time', $registration_date_time);
                $stmt->bindParam(':status', $status);

                $usernamepattern = "/^[0-9A-Za-z]{3,}$/";
                $finalusername = preg_match($usernamepattern, $username);
                
                $currentdate = date("Y-m-d");

                $errormessage = array();
                if (empty($username)) {
                    $errormessage[] = "Please fill in your username" . "<br>";
                }
                if (!$finalusername) {
                    $errormessage[] = "Please enter at least 3 character" . "<br>";
                }
                if (empty($email)) {
                    $errorMessage[] = "Email field is empty.";
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errorMessage[] = "Invalid email format.";
                }
                if (empty($password)) {
                    $errormessage[] = "Please fill in your password " . "<br>";
                }
                if (!$finalpassword) {
                    $errormessage[] = "Please enter at least 6 character for password" . "<br>";
                }
                if (empty($cfmpassword)) {
                    $errormessage[] = "Please enter confirm password" . "<br>";
                }
                if ($password !== $cfmpassword) {
                    $errormessage[] = "Please enter the same password" . "<br>";
                }
                if (empty($firstname)) {
                    $errormessage[] = "Please fill in your first name" . "<br>";
                }
                if (empty($lastname)) {
                    $errormessage[] = "Please fill in your last name" . "<br>";
                }
                if (empty($gender)) {
                    $errormessage[] = "Please fill in your gender" . "<br>";
                }
                if (empty($date_of_birth)) {
                    $errormessage[] = "Please fill in your date of birth" . "<br>";
                }
                if ($date_of_birth > $currentdate) {
                    $errormessage[] = "Birthday cannot bigger than current date" . "<br>";
                }
                if (empty($registration_date_time)) {
                    $errormessage[] = "Please fill in yourif registration_date_time" . "<br>";
                }
                if (empty($status)) {
                    $errormessage[] = "Please fill in your status" . "<br>";
                }
                if (!empty($errormessage)) {
                    echo "<br><div class = 'alert alert-danger'>";
                    foreach ($errormessage as $displayerrormessage) {
                        echo $displayerrormessage;
                    }
                    echo "</div>";
                } else if ($stmt->execute()) {
                    echo "<div class='alert alert-success'>Record saved.</div>";
                    $_POST = array();
                } else {
                    echo "<div class='alert alert-danger'>Unable to save record.</div>";
                }
            } catch (PDOException $exception) {
                if ($exception->getCode() == 23000) {
                    echo "<div class = 'alert alert-danger'>";
                    echo "Username have taken, please enter other username";
                    echo "</div>";
                } else {
                    echo "<div class = 'alert alert-danger'>";
                    echo $exception->getMessage();
                    echo "</div>";
                }
            }
        }
        ?>


        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" name="username" value="<?php echo isset($_POST["username"]) ? $_POST["username"] : "" ?>" placeholder="Enter username">
            </div>
            <br>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" name="password" value="<?php echo isset($_POST["password"]) ? $_POST["password"] : "" ?>" placeholder="Enter password">
            </div>
            <br>
            <div class="form-group">
                <label for="cfmpwd">Confirm Password:</label>
                <input type="password" class="form-control" name="cfmpassword" value="<?php echo isset($_POST["cfmpassword"]) ? $_POST["cfmpassword"] : "" ?>" placeholder="Please enter password again">
            </div>
            <br>
            <div class="form-group">
                <label for="firstname">First Name:</label>
                <input type="text" class="form-control" name="first_name" value="<?php echo isset($_POST["first_name"]) ? $_POST["first_name"] : "" ?>" placeholder="Enter first name">
            </div>
            <br>
            <div class="form-group">
                <label for="lastname">Last Name:</label>
                <input type="text" class="form-control" name="last_name" value="<?php echo isset($_POST["last_name"]) ? $_POST["last_name"] : "" ?>" placeholder="Enter last name">
            </div>
            <br>
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : "" ?>" placeholder="Your email">
            </div>
            <br>
            <div class="form-group">
                <label for="gender">Gender:</label><br>
                <input type="radio" id="male" name="gender" value="male" checked>
                <label for="male">Male</label><br>
                <input type="radio" id="female" name="gender" value="female">
                <label for="female">Female</label><br>
            </div>
            <br>
            <div class="form-group">
                <label for="dob">Date of Birth:</label>
                <input type="date" class="form-control" name="date_of_birth" value="<?php echo isset($_POST["date_of_birth"]) ? $_POST["date_of_birth"] : "" ?>">
                <br>
                <div class="form-group">
                    <label for="regdate">Registration Date & Time:</label>
                    <input type="datetime-local" class="form-control" name="registration_date_time" value="<?php echo isset($_POST["registration_date_time"]) ? $_POST["registration_date_time"] : "" ?>">
                </div>
                <br>
                <div class="form-group">
                    <label for="status">Account Status:</label>
                    <select class="form-control" id="status" name="status" value="<?php echo isset($_POST["status"]) ? $_POST["status"] : "" ?>">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <br>
                <div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
        </form>
        <br>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>