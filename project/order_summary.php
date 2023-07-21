<?php
include 'config/session.php';
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Create Order</title>
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
            // include database connection
            include 'config/database.php';
            try {
                // insert query
                $query = "INSERT INTO order_summary SET customer_id=:customer_id, order_date=:order_date";

                // prepare query for execution
                $stmt = $con->prepare($query);
                $reset = "ALTER TABLE order_summary AUTO_INCREMENT = 1";
                $resetdetail = "ALTER TABLE order_detail AUTO_INCREMENT = 1";
                $resetquery = $con->prepare($reset);
                $resetdetailquery = $con->prepare($resetdetail);
                $customer_id = $_POST['customer_id'];
                $product_id = $_POST['product_id'];
                $quantity = $_POST['quantity'];
                $order_date = $_POST['order_date'];
                $category_id = $_POST['category_id'];

                // bind the parameters
                $stmt->bindParam(':customer_id', $customer_id);
                $stmt->bindParam(':order_date', $order_date);

                // Execute the query
                $errormessage = array();
                if ($stmt->execute()) {
                    $selectquery = "SELECT * FROM order_summary";

                    $selectstmt = $con->prepare($selectquery);
                    $selectstmt->execute();
                    $selectrow = $selectstmt->fetch(PDO::FETCH_ASSOC);
                    $order_id = $selectrow['order_id'];
                    
                    $detailquery = "INSERT INTO order_detail SET product_id=:product_id, category_id=:category_id, quantity=:quantity, order_id = '$order_id'";
                    $detailstmt = $con->prepare($detailquery);
                    $detailstmt->bindParam(':product_id', $product_id);
                    $detailstmt->bindParam(':category_id', $category_id);
                    $detailstmt->bindParam(':quantity', $quantity);

                    if ($detailstmt->execute()) {
                        echo "<div class='alert alert-success'>Record saved.</div>";
                        $_POST = array();
                    } else {
                        echo "<div class='alert alert-danger'>Unable to save record.</div>";
                        $resetdetailquery->execute();
                    }
                } else {
                    echo "<div class='alert alert-danger'>Unable to save record.</div>";
                    $resetquery->execute();
                }
            }
            // show error
            catch (PDOException $exception) {
                echo "<div class = 'alert alert-danger'>";
                echo $exception->getMessage();
                echo "</div>";
                $resetquery->execute();
                $resetdetailquery->execute();
            }
        }
        ?>

        <!-- html form here where the product information will be entered -->
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <td>Customer Name</td>
                    <td><select name='customer_id' class="form-select">
                            <?php
                            include 'config/database.php';
                            $cusquery = "SELECT username, user_id FROM customers ORDER BY user_id ASC";
                            $cusstmt = $con->prepare($cusquery);
                            $cusstmt->execute();
                            $num = $cusstmt->rowCount();
                            if ($num > 0) {
                                $option = array();
                                while ($row = $cusstmt->fetch(PDO::FETCH_ASSOC)) {
                                    $option[$row['user_id']] = $row['username'];
                                }
                            }
                            foreach ($option as $user_id => $username) {
                                echo "<option value = '" . $user_id . "'>" . $username . "</option>";
                            }
                            ?>
                        </select></td>
                </tr>
                <tr>
                    <td>Product</td>
                    <td><select name='product_id' class="form-select">
                            <?php
                            include 'config/database.php';
                            $proquery = "SELECT name, id FROM products ORDER BY id ASC";
                            $prostmt = $con->prepare($proquery);
                            $prostmt->execute();
                            $num = $prostmt->rowCount();
                            if ($num > 0) {
                                $option = array();
                                while ($row = $prostmt->fetch(PDO::FETCH_ASSOC)) {
                                    $option[$row['id']] = $row['name'];
                                }
                            }
                            foreach ($option as $id => $name) {
                                echo "<option value = '" . $id . "'>" . $name . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Select Category</td>
                    <td><select name='category_id' class="form-select">
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
                    <td>Order Date</td>
                    <td><input type='date' name='order_date' class='form-control' value="<?php echo date('Y-m-d'); ?>" /></td>
                </tr>
                <tr>
                    <td>Quantity</td>
                    <td><input type='number' name='quantity' class='form-control ' min="1" max="10" /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Save' class='btn btn-primary' />

                    </td>
                </tr>
            </table>
        </form>
    </div>
    <!-- end .container -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>