<?php
include 'config/validate_login.php';
$_SESSION['image'] = "user";
?>

<!DOCTYPE HTML>
<html>

<head>
    <title>Update Customer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- custom css →
    <style>
       .m-r-1em{ margin-right:1em; }
       .m-b-1em{ margin-bottom:1em; }
       .m-l-1em{ margin-left:1em; }
       .mt0{ margin-top:0; }
    </style>-->
</head>

<body>
    <!-- container -->
    <div class="container">
        <div class="page-header">
            <?php
            include 'menu/menu.php';
            ?>
            <p>Update Customer</p>
        </div>
        <!-- PHP read record by ID will be here -->
        <?php
        // get passed parameter value, in this case, the record ID
        // isset() is a PHP function used to verify if a value is there or not
        $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR1: Record ID not found.');

        //include database connection
        include 'config/database.php';

        // read current record's data
        try {
            // prepare select query
            $query = "SELECT username, first_name, last_name, password, email, date_of_birth, registration_date_time, gender, status FROM customers WHERE user_id = ? LIMIT 0,1";
            $stmt = $con->prepare($query);

            // this is the first question mark
            $stmt->bindParam(1, $id);

            // execute our query
            $stmt->execute();

            // store retrieved row to a variable
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // values to fill up our form
            $username = $row['username'];
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            $email = $row['email'];
            $date_of_birth = $row['date_of_birth'];
            $registration_date_time = $row['registration_date_time'];
            $gender = $row['gender'];
            $status = $row['status'];
        }

        // show error
        catch (PDOException $exception) {
            die('ERROR2: ' . $exception->getMessage());
        }
        ?>

        <!-- HTML form to update record will be here -->
        <!-- PHP post to update record will be here -->
        <?php
        include 'upload.php';
        // check if form was submitted
        if (isset($_POST['submit'])) {
            try {
                $pwquery = "SELECT * FROM customers WHERE user_id = $id";
                $pwstmt = $con->prepare($pwquery);
                $pwstmt->execute();
                $pwrow = $pwstmt->fetch(PDO::FETCH_ASSOC);
                $dbpw = $pwrow['password'];

                // posted values
                $username = htmlspecialchars(strip_tags($_POST['username']));
                $first_name = htmlspecialchars(strip_tags($_POST['first_name']));
                $last_name = htmlspecialchars(strip_tags($_POST['last_name']));
                $password = $_POST['new_password'];
                $old_password = $_POST['old_password'];
                $cfm_new_password = $_POST['cfm_new_password'];
                $email = htmlspecialchars(strip_tags($_POST['email']));
                $date_of_birth = $_POST['date_of_birth'];
                $registration_date_time = $_POST['registration_date_time'];
                $gender = $_POST['gender'];
                $status = $_POST['status'];

                $pw_pattern = "/^[0-9A-Za-z]{6,}$/";
                $finalpassword = preg_match($pw_pattern, $password);
                $usernamepattern = "/^[0-9A-Za-z]{3,}$/";
                $finalusername = preg_match($usernamepattern, $username);

                $query = "UPDATE customers SET image=:image, username=:username, first_name=:first_name, last_name=:last_name, email=:email, date_of_birth=:date_of_birth, registration_date_time=:registration_date_time, gender=:gender, status=:status";
                if (!empty($_POST['old_password']) && !empty($_POST['new_password']) && !empty($_POST['cfm_new_password'])) {
                    $query .= ", password=:password WHERE user_id = :user_id";
                    $hashpassword = password_hash($password, PASSWORD_DEFAULT);
                }else {
                    $query .= " WHERE user_id=:user_id";
                }
                // prepare query for excecution
                $stmt = $con->prepare($query);

                // bind the parameters
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':first_name', $first_name);
                $stmt->bindParam(':last_name', $last_name);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':date_of_birth', $date_of_birth);
                $stmt->bindParam(':registration_date_time', $registration_date_time);
                $stmt->bindParam(':gender', $gender);
                $stmt->bindParam(':status', $status);
                $stmt->bindParam(':image', $image);
                $stmt->bindParam(':user_id', $id);

                if (!empty($hashpassword)) {
                    $stmt->bindParam(':password', $hashpassword);
                }

                $errormessage = array();
                // Execute the query
                if (!$finalusername) {
                    $errormessage[] = "Please enter at least 3 character for new username" . "<br>";
                }
                if (!password_verify($old_password, $dbpw) && !empty($old_password)) {
                    $errormessage[] = "Incorrect password. Please try again." . "<br>";
                }
                if ($password === $old_password  && !empty($password)) {
                    $errormessage[] = "New password cannot be same as old password. Please try again." . "<br>";
                }
                if (!$finalpassword && !empty($password)) {
                    $errormessage[] = "Please enter at least 6 character for new password" . "<br>";
                }
                if ($password != $cfm_new_password) {
                    $errormessage[] = "New Password not match. Please try again." . "<br>";
                }
                if (!empty($errormessage)) {
                    echo "<br><div class = 'alert alert-danger'>";
                    foreach ($errormessage as $displayerrormessage) {
                        echo $displayerrormessage;
                    }
                    echo "</div>";
                } else if ($stmt->execute()) {
                    echo "<div class='alert alert-success'>Record was updated.</div>";
                } else {
                    echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
                }
            }
            // show errors
            catch (PDOException $exception) {
                echo "<div class = 'alert alert-danger'>";
                echo $exception->getMessage();
                echo "</div>";
            }
        } ?>

        <!--we have our html form here where new record information can be updated-->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}"); ?>" method="post">
            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <td>Username</td>
                    <td><input type='text' name='username' value="<?php echo htmlspecialchars($username, ENT_QUOTES);  ?>" class='form-control' /></td>
                </tr>
                <tr>
                    <td>First Name</td>
                    <td><input type="text" name="first_name" value="<?php echo htmlspecialchars($first_name, ENT_QUOTES);  ?>" class='form-control'>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td><input type="text" name="last_name" value="<?php echo htmlspecialchars($last_name, ENT_QUOTES);  ?>" class='form-control'>
                </tr>
                <tr>
                    <td>Enter Old Password</td>
                    <td><input type="password" name="old_password" class='form-control'></td>
                </tr>
                <tr>
                    <td>New Password</td>
                    <td><input type="password" name="new_password" class='form-control'></td>
                </tr>
                <tr>
                    <td>Confirm New Password</td>
                    <td><input type="password" name="cfm_new_password" class='form-control'></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="text" name="email" value="<?php echo htmlspecialchars($email, ENT_QUOTES);  ?>" class='form-control'></td>
                </tr>
                <tr>
                    <td>Date of Birth</td>
                    <td><input type="date" name="date_of_birth" value="<?php echo htmlspecialchars($date_of_birth, ENT_QUOTES);  ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td>Registration date and time</td>
                    <td><input type="datetime-local" name="registration_date_time" value="<?php echo htmlspecialchars($registration_date_time, ENT_QUOTES);  ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td>Gender </td>
                    <td>
                        <label><?php echo ucfirst($row['gender']); ?></label></br>
                        <input type="radio" id="male" name="gender" value="male" <?php if ($row['gender'] == "male") {
                                                                                        echo "checked";
                                                                                    } ?> class="form-group">
                        <label for="male">Male</label><br>
                        <input type="radio" id="female" name="gender" value="female" <?php if ($row['gender'] == "female") {
                                                                                            echo "checked";
                                                                                        } ?> class="form-group">
                        <label for="female">Female</label><br>
                    </td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <label><?php echo ucfirst($row['status']); ?></label></br>
                        <input type="radio" id="active" name="status" value="active" <?php if ($row['status'] == "active") {
                                                                                            echo "checked";
                                                                                        } ?> class="form-group">
                        <label for="active">Active</label><br>
                        <input type="radio" id="inactive" name="status" value="inactive" <?php if ($row['status'] == "inactive") {
                                                                                                echo "checked";
                                                                                            } ?> class="form-group">
                        <label for="inactive">Inactive</label><br>
                    </td>
                </tr>
                <tr>
                    <td>Photo</td>
                    <td><input type="file" name="image" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' name="submit" value='Save Changes' class='btn btn-primary' />
                        <a href='customer_read.php' class='btn btn-danger'>Back to read customers</a>
                    </td>
                </tr>
            </table>
        </form>

    </div>
    <!-- end .container -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>