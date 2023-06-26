<!DOCTYPE HTML>
<html>

<head>
    <title>PDO - Create a Record - PHP CRUD Tutorial</title>
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <!-- container -->
    <div class="container">
        <div class="page-header">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid d-flex">
                    <a class="navbar-brand" href="#">Create Product</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse d-flex flex-row-reverse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="nav-link" href="index.php">Home</a>
                            <a class="nav-link" href="product_create.php">Create Product</a>
                            <a class="nav-link" href="customer_create.php">Create Customer</a>
                            <a class="nav-link" href="contact.php">Contact Us</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>

        <!-- html form to create product will be here -->
        <!-- PHP insert code will be here -->
        <?php
        if ($_POST) {
            // include database connection
            include 'config/database.php';
            try {
                // insert query
                $query = "INSERT INTO products SET name=:name, description=:description, price=:price, promote_price=:promote_price, manufacture_date=:manufacture_date, expired_date=:expired_date, created=:created";
                // prepare query for execution
                $stmt = $con->prepare($query);
                $name = $_POST['name'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $promote_price = $_POST['promote_price'];
                $manufacture_date = $_POST['manufacture_date'];
                $expired_date = $_POST['expired_date'];
                // bind the parameters
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':description', $description);
                $stmt->bindParam(':price', $price);
                $stmt->bindParam(':promote_price', $promote_price);
                $stmt->bindParam(':manufacture_date', $manufacture_date);
                $stmt->bindParam(':expired_date', $expired_date);
                $created = date('Y-m-d H:i:s'); // get the current date and time
                $stmt->bindParam(':created', $created);
                // Execute the query
                $errormessage = array();

                if (empty($name)) {
                    $errormessage[] = "Please fill in your name" . "<br>";
                }
                if (empty($description)) {
                    $errormessage[] = "Please fill in your description" . "<br>";
                }
                if (empty($price)) {
                    $errormessage[] = "Please fill in your price" . "<br>";
                }
                if (empty($promote_price)) {
                    $errormessage[] = "Please fill in your promote price" . "<br>";
                }
                if (empty($manufacture_date)) {
                    $errormessage[] = "Please fill in your manufacture date" . "<br>";
                }
                if (empty($expired_date)) {
                    $errormessage[] = "Please fill in your expired date" . "<br>";
                }
                if ($promote_price >= $price) {
                    $errormessage[] = "Promote price cannot be same and more than original price" . "<br>";
                }
                if ($expired_date <= $manufacture_date) {
                    $errormessage[] = "Expired date cannot smaller than manufacture date" . "<br>";
                }
                if (!is_numeric($price)) {
                    $errormessage[] = "Please enter number for price";
                }
                if (!is_numeric($promote_price)) {
                    $errormessage[] = "Please enter number for promote price";
                }
                if (!empty($errormessage)) {
                    echo "<div class = 'alert alert-danger'>";
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
            }
            // show error
            catch (PDOException $exception) {
                die('ERROR: ' . $exception->getMessage());
            }
        }
        ?>

        <!-- html form here where the product information will be entered -->
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <td>Name</td>
                    <td><input type='text' name='name' class='form-control' value="<?php echo isset($_POST["name"]) ? $_POST["name"] : "" ?>" /></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td><textarea name='description' class='form-control' value="<?php echo isset($_POST["description"]) ? $_POST["description"] : "" ?>"></textarea></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><input type='text' name='price' class='form-control' value="<?php echo isset($_POST["price"]) ? $_POST["price"] : "" ?>" /></td>
                </tr>
                <tr>
                    <td>Promote Price</td>
                    <td><input type='text' name='promote_price' class='form-control' value="<?php echo isset($_POST["promote_price"]) ? $_POST["promote_price"] : "" ?>" /></td>
                </tr>
                <tr>
                    <td>Manufacture Date</td>
                    <td><input type='date' name='manufacture_date' class='form-control' value="<?php echo isset($_POST["manufacture_date"]) ? $_POST["manufacture_date"] : "" ?>" /></td>
                </tr>
                <tr>
                    <td>Expired Date</td>
                    <td><input type='date' name='expired_date' class='form-control' value="<?php echo isset($_POST["expired_date"]) ? $_POST["expired_date"] : "" ?>" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Save' class='btn btn-primary' />
                        <a href='index.php' class='btn btn-danger'>Back to read products</a>
                    </td>
                </tr>
            </table>
        </form>

    </div>
    <!-- end .container -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>