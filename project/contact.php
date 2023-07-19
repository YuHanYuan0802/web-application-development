<?php 
include 'config/session.php';
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Contact Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <?php
    if ($_POST) {
        include 'config/database.php';
        try {
            // insert query
            $query = "INSERT INTO contact SET first_name=:firstname, last_name=:lastname, email=:email, phone=:phone, address=:address, message=:message";
            // prepare query for execution
            $stmt = $con->prepare($query);
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $message = $_POST['message'];
            // bind the parameters
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':lastname', $lastname);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':message', $message);

            $errorMessage = array();

            if (empty($firstname) || empty($lastname)) {
                $errorMessage[] = "First name and last name fields are required.";
            }

            if (empty($email)) {
                $errorMessage[] = "Email field is empty.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errorMessage[] = "Invalid email format.";
            }

            if (empty($phone)) {
                $errorMessage[] = "Phone number field is empty.";
            }

            if (empty($address)) {
                $errorMessage[] = "Address field is empty.";
            }

            if (empty($message)) {
                $errorMessage[] = "Message field is empty.";
            }

            if (!empty($errorMessage)) {
                echo "<div class='alert alert-danger m-3'>";
                foreach ($errorMessage as $displayErrorMessage) {
                    echo $displayErrorMessage . "<br>";
                }
                echo "</div>";
            } else if ($stmt->execute()) {
                echo "<div class='alert alert-success'>Record saved.</div>";
                $_POST = array();
            } else {
                echo "<div class='alert alert-danger'>Unable to save record.</div>";
            }
        } catch (PDOException $exception) {
            die('ERROR: ' . $exception->getMessage());
        }
    }
    ?>
    <div class="container">
        <?php
        include 'menu/menu.php';
        ?>
        <form method="post">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="firstname" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo isset($_POST['firstname']) ? $_POST['firstname'] : ''; ?>">
                </div>
                <div class="col-md-6">
                    <label for="lastname" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo isset($_POST['lastname']) ? $_POST['lastname'] : ''; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                </div>
                <div class="col-md-6">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : ''; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="<?php echo isset($_POST['address']) ? $_POST['address'] : ''; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="5"><?php echo isset($_POST['message']) ? $_POST['message'] : ''; ?></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>