<?php
if (!empty($_SESSION['login'])) {
    session_start();
} else {
    header('location:login.php');
}
?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Read One Record</title>
</head>

<body>
    <div class="container">
        <?php
        include 'menu/menu.php';
        ?>
        <div>
            <p>Read One Customer</>
        </div>

        <!-- PHP read one record will be here -->
        <?php
        // get passed parameter value, in this case, the record ID
        // isset() is a PHP function used to verify if a value is there or not
        $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

        //include database connection
        include 'config/database.php';

        // read current record's data
        try {
            // prepare select query
            $query = "SELECT user_id, username, first_name, last_name, date_of_birth, registration_date_time, gender, status FROM customers WHERE user_id = :id ";
            $stmt = $con->prepare($query);

            // Bind the parameter
            $stmt->bindParam(":id", $id);

            // execute our query
            $stmt->execute();

            // store retrieved row to a variable
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // values to fill up our form
            $username = $row['username'];
            $firstname = $row['first_name'];
            $lastname = $row['last_name'];
            $date_of_birth = $row['date_of_birth'];
            $registration_date_time = $row['registration_date_time'];
            $gender = $row['gender'];
            $status = $row['status'];
            // shorter way to do that is extract($row)
        }

        // show error
        catch (PDOException $exception) {
            die('ERROR: ' . $exception->getMessage());
        }
        ?>


        <!-- HTML read one record table will be here -->
        <!--we have our html table here where the record will be displayed-->
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td>Username</td>
                <td><?php echo htmlspecialchars($username, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>First name</td>
                <td><?php echo htmlspecialchars($firstname, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Last name</td>
                <td><?php echo htmlspecialchars($lastname, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Birthday</td>
                <td><?php echo htmlspecialchars($date_of_birth, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Registration date and time</td>
                <td><?php echo htmlspecialchars($registration_date_time, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Gender</td>
                <td><?php echo htmlspecialchars($gender, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Status</td>
                <td><?php echo htmlspecialchars($status, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <a href='customer_read.php' class='btn btn-danger'>Back to read customers</a>
                </td>
            </tr>
        </table>


    </div>

</body>

</html>