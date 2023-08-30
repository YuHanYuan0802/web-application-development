<?php
include 'config/validate_login.php';
$_SESSION['image'] = "product";
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Create Products</title>
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <!-- container -->
    <div class="container">
        <?php
        include 'menu/menu.php';
        ?>

        <!-- html form to create product will be here -->
        <!-- PHP insert code will be here -->
        <?php
        if ($_POST) {
            include 'upload.php';
            // include database connection
            include 'config/database.php';
            try {
                $name = $_POST['name'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $promote_price = $_POST['promote_price'];
                $manufacture_date = $_POST['manufacture_date'];
                $expired_date = $_POST['expired_date'];
                $category = $_POST['category'];
                $currentdate = date("Y-m-d");

                if (empty($name)) {
                    $errormessage[] = "Please fill in your name" . "<br>";
                }
                if (empty($description)) {
                    $errormessage[] = "Please fill in your description" . "<br>";
                }
                if (empty($price)) {
                    $errormessage[] = "Please fill in your price" . "<br>";
                } else if (!is_numeric($price)) {
                    $errormessage[] = "Please enter number for price" . "<br>";
                }
                if (empty($promote_price)) {
                    $promote_price = "";
                } else if (!is_numeric($promote_price)) {
                    $errormessage[] = "Please enter number for promote price" . "<br>";
                }
                if (empty($manufacture_date)) {
                    $errormessage[] = "Please fill in your manufacture date" . "<br>";
                }
                if ($manufacture_date >= $currentdate) {
                    $errormessage[] = "Manufacture date cannot bigger than current year" . "<br>";
                }
                if ($promote_price >= $price) {
                    $errormessage[] = "Promote price cannot be same and more than original price" . "<br>";
                }
                if (!empty($errormessage)) {
                    echo "<div class = 'alert alert-danger'>";
                    foreach ($errormessage as $displayerrormessage) {
                        echo $displayerrormessage;
                    }
                    echo "</div>";
                } else {
                    $query = "INSERT INTO products SET name=:name, description=:description, price=:price, promote_price=:promote_price, manufacture_date=:manufacture_date, expired_date=:expired_date, created=:created, category_id=:category, image=:image";
                    // prepare query for execution
                    $stmt = $con->prepare($query);
                    $reset = "ALTER TABLE products AUTO_INCREMENT = 1";
                    $resetquery = $con->prepare($reset);

                    // bind the parameters
                    $stmt->bindParam(':name', $name);
                    $stmt->bindParam(':description', $description);
                    $stmt->bindParam(':price', $price);
                    $stmt->bindParam(':promote_price', $promote_price);
                    $stmt->bindParam(':manufacture_date', $manufacture_date);
                    $stmt->bindParam(':expired_date', $expired_date);
                    $created = date('Y-m-d H:i:s'); // get the current date and time
                    $stmt->bindParam(':created', $created);
                    $stmt->bindParam(':category', $category);
                    $stmt->bindParam(':image', $image);
                    if ($stmt->execute()) {
                        echo "<div class='alert alert-success'>Record saved.</div>";
                        $_POST = array();
                    } else {
                        echo "<div class='alert alert-danger'>Unable save the record.</div>";
                        $resetquery->execute();
                    }
                }
            }
            // show error
            catch (PDOException $exception) {
                if ($exception->getCode() == 23000) {
                    echo "<div class = 'alert alert-danger'>";
                    echo "Product name have taken, please enter other product name";
                    echo "</div>";
                    $resetquery->execute();
                } else {
                    echo "<div class = 'alert alert-danger'>";
                    echo $exception->getMessage();
                    echo "</div>";
                    $resetquery->execute();
                }
            }
        }
        ?>

        <!-- html form here where the product information will be entered -->
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST" enctype="multipart/form-data">
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
                    <td>Select category</td>
                    <td><select name='category' class="form-select">
                            <?php
                            include 'config/database.php';
                            $catequery = "SELECT category_id, category_name FROM category ORDER BY category_id ASC";
                            $catestmt = $con->prepare($catequery);
                            $catestmt->execute();
                            $num = $catestmt->rowCount();
                            if ($num > 0) {
                                $option = array();
                                while ($row = $catestmt->fetch(PDO::FETCH_ASSOC)) {
                                    $option[$row['category_id']] = $row['category_name'];
                                }
                            }
                            foreach ($option as $category_id => $category_name) {
                                echo "<option value = '" . $category_id . "'>" . $category_name . "</option>";
                            }
                            ?>
                        </select></td>
                </tr>
                <tr>
                    <td>Photo</td>
                    <td><input type="file" name="image" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Submit' class='btn btn-primary' />
                        <a href='product_read.php' class='btn btn-danger'>Back to read products</a>
                    </td>
                </tr>
            </table>
        </form>

    </div>
    <!-- end .container -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>