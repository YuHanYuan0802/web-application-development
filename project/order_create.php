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
                $second_product_id = $_POST['second_product_id'];
                $third_product_id = $_POST['third_product_id'];
                $quantity = $_POST['quantity'];
                $second_quantity = $_POST['second_quantity'];
                $third_quantity = $_POST['third_quantity'];
                $order_date = $_POST['order_date'];

                // bind the parameters
                $stmt->bindParam(':customer_id', $customer_id);
                $stmt->bindParam(':order_date', $order_date);

                // Execute the query
                $errormessage = array();
                if (empty($quantity)) {
                    $errormessage[] = "Please enter quantity." . "<br>";
                }
                if ($quantity > 10 || $quantity < 1) {
                    $errormessage[] = "The minimum of the quantity must at least 1 and the maximum of the quantity must be 10" . "<br>";
                }
                if (!empty($errormessage)) {
                    echo "<div class = 'alert alert-danger'>";
                    foreach ($errormessage as $displayerrormessage) {
                        echo $displayerrormessage;
                    }
                    echo "</div>";
                } else if ($stmt->execute()) {
                    $selectquery = "SELECT * FROM order_summary";

                    $selectstmt = $con->prepare($selectquery);
                    $selectstmt->execute();
                    $selectrow = $selectstmt->fetch(PDO::FETCH_ASSOC);
                    $order_id = $selectrow['order_id'];

                    $detailquery = "INSERT INTO order_detail SET product_id=:product_id, quantity=:quantity, order_id = '$order_id'";
                    $detailstmt = $con->prepare($detailquery);
                    $detailstmt->bindParam(':product_id', $product_id);
                    $detailstmt->bindParam(':quantity', $quantity);

                    $multiquery = "INSERT INTO order_detail(order_id, product_id, quantity) VALUES ('$order_id', '$second_product_id' , '$second_quantity'), ('$order_id', '$third_product_id', '$third_quantity')";
                    $multistmt = $con->prepare($multiquery);
                    $multistmt->execute();
                    if ($detailstmt->execute()) {
                        echo "<div class='alert alert-success'>Record saved.</div>";
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
                    <td>
                        <select name="product_id" class="form-select">
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
                                echo "<option value='" . $id . "'>" . $name . "</option>";
                            }
                            ?>
                        </select>
                        <br>
                        <select name="second_product_id" class="form-select">
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
                                echo "<option value='" . $id . "'>" . $name . "</option>";
                            }
                            ?>
                        </select>
                        <br>
                        <select name="third_product_id" class="form-select">
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
                                echo "<option value='" . $id . "'>" . $name . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Order Date</td>
                    <td><input type='date' name='order_date' class='form-control' value="<?php echo date('Y-m-d'); ?>" /></td>
                </tr>
                <tr>
                    <td>Quantity</td>
                    <td>
                        <input type='number' name='quantity' class='form-control ' min="1" max="10" />
                        <br>
                        <input type='number' name='second_quantity' class='form-control ' min="1" max="10" />
                        <br>
                        <input type='number' name='third_quantity' class='form-control ' min="1" max="10" />
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" value="Save" class="btn btn-primary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
        include 'config/database.php';
        if (!empty($product_id)) {
            $pricequery = "SELECT name, price, promote_price FROM products WHERE id='$product_id'";
            $secondpricequery = "SELECT name, price, promote_price FROM products WHERE id='$second_product_id'";
            $thirdpricequery = "SELECT name, price, promote_price FROM products WHERE id='$third_product_id'";
            $pricestmt = $con->prepare($pricequery);
            $secondpricestmt = $con->prepare($secondpricequery);
            $thirdpricestmt = $con->prepare($thirdpricequery);
            $pricestmt->execute();
            $secondpricestmt->execute();
            $thirdpricestmt->execute();
            while ($pricerow = $pricestmt->fetch(PDO::FETCH_ASSOC)) {
                $errormessage = array();
                if (empty($quantity)) {
                    $errormessage[] = "Please enter quantity." . "<br>";
                }
                if ($quantity > 10 || $quantity < 1) {
                    $errormessage[] = "The minimum of the quantity must at least 1 and the maximum of the quantity must be 10" . "<br>";
                }
                if (!empty($errormessage)) {
                    echo "<div class = 'alert alert-danger'>";
                    foreach ($errormessage as $displayerrormessage) {
                        echo $displayerrormessage;
                    }
                    echo "</div>";
                } else {
                    $name = $pricerow['name'];
                    $promote_price = $pricerow['promote_price'];
                    $price = $pricerow['price'];
                    $quanprice = $quantity * $promote_price;
                    $decimalprice = number_format((float)$price, 2, '.', '');
                    $decimalpromote = number_format((float)$promote_price, 2, '.', '');
                    echo "<table id='price_table' class='table table-hover table-responsive table-bordered'>";
                    echo "<tr>";
                    echo "<th>Name</th>";
                    echo "<th>Price</th>";
                    echo "<th>Quantity</th>";
                    echo "<th>Subtotal</th>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>$name</td>";
                    if ($promote_price < $decimalprice && $promote_price > 0) {
                        echo "<td class = 'd-flex'><div class = 'mx-1 text-decoration-line-through'>RM $decimalprice</div><div class = 'mx-1'>RM $decimalpromote</div></td>";
                    } else {
                        echo "<td class = 'text-end'>{$decimalprice}</td>";
                    }
                    echo "<td>x$quantity</td>";
                    echo "<td>RM $quanprice</td>";
                    echo "</tr>";
                }
            }
            while ($secondpricerow = $secondpricestmt->fetch(PDO::FETCH_ASSOC)) {
                $name = $secondpricerow['name'];
                $promote_price = $secondpricerow['promote_price'];
                $price = $secondpricerow['price'];
                $quanprice = $second_quantity * $promote_price;
                $decimalprice = number_format((float)$price, 2, '.', '');
                $decimalpromote = number_format((float)$promote_price, 2, '.', '');

                echo "<tr>";
                echo "<td>$name</td>";
                if ($promote_price < $decimalprice && $promote_price > 0) {
                    echo "<td class = 'd-flex'><div class = 'mx-1 text-decoration-line-through'>RM $decimalprice</div><div class = 'mx-1'>RM $decimalpromote</div></td>";
                } else {
                    echo "<td class = 'text-end'>{$decimalprice}</td>";
                }
                echo "<td>x$second_quantity</td>";
                echo "<td>RM $quanprice</td>";
                echo "</tr>";
            }
            while ($thirdpricerow = $thirdpricestmt->fetch(PDO::FETCH_ASSOC)) {
                $name = $thirdpricerow['name'];
                $promote_price = $thirdpricerow['promote_price'];
                $price = $thirdpricerow['price'];
                $quanprice = $third_quantity * $promote_price;
                $decimalprice = number_format((float)$price, 2, '.', '');
                $decimalpromote = number_format((float)$promote_price, 2, '.', '');

                echo "<tr>";
                echo "<td>$name</td>";
                if ($promote_price < $decimalprice && $promote_price > 0) {
                    echo "<td class = 'd-flex'><div class = 'mx-1 text-decoration-line-through'>RM $decimalprice</div><div class = 'mx-1'>RM $decimalpromote</div></td>";
                } else {
                    echo "<td class = 'text-end'>{$decimalprice}</td>";
                }
                echo "<td>x$third_quantity</td>";
                echo "<td>RM $quanprice</td>";
                echo "</tr>";
                echo "</table>";
            }
        } else {
            echo "<div class='alert alert-danger'>Unable to found order record.</div>";
        }

        ?>
    </div>
    <!-- end .container -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>