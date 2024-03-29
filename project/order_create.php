<?php
include 'config/validate_login.php';
?>
<!DOCTYPE HTML>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        // include database connection
        include 'config/database.php';
        $proquery = "SELECT name, id, price FROM products ORDER BY id ASC";
        $prostmt = $con->prepare($proquery);
        $prostmt->execute();
        $prorow = $prostmt->fetchAll(PDO::FETCH_ASSOC);
        $productsRowCount = $prostmt->rowCount();
        $selectpro = 1;

        if ($_POST) {
            try {
                $customer_id = $_POST['customer_id'];
                $product_id = $_POST['product_id'];
                $quantity = $_POST['quantity'];
                $order_date = $_POST['order_date'];

                $statusquery = "SELECT status FROM customers WHERE user_id =:user_id";
                $statusstmt = $con->prepare($statusquery);
                $statusstmt->bindParam(':user_id', $customer_id);
                $statusstmt->execute();
                $statusrow = $statusstmt->fetch(PDO::FETCH_ASSOC);

                $errormessage = array();

                if (empty($customer_id)) {
                    $errormessage[] = "Please select the customer." . "<br>";
                } else if ($statusrow['status'] == "inactive") {
                    $errormessage[] = "Customer not active!" . "<br>";
                }
                foreach ($quantity as $quantity_array) {
                    if (empty($quantity_array)) {
                        $errormessage[] = "Please fill in the quantity for all products." . "<br>";
                    }
                    if ($quantity_array == 0) {
                        $errormessage[] = "Quantity cannot be zero." . "<br>";
                    }
                }
                foreach ($product_id as $product_array) {
                    if (empty($product_array)) {
                        $errormessage[] = "Please select the product." . "<br>";
                    }
                }
                if (empty($order_date)) {
                    $errormessage[] = "Please select the date and time." . "<br>";
                }
                $nodupliproduct = array_unique($product_id);

                if (count($nodupliproduct) < count($product_id)) {
                    foreach ($product_id as $key => $val) {
                        if (!array_key_exists($key, $nodupliproduct)) {
                            unset($quantity[$key]);
                        }
                    }
                    $errormessage[] = "Product duplicate.";
                    $nodupliproduct = array_values($nodupliproduct);
                    $quantity = array_values($quantity);
                }

                $selectpro = isset($nodupliproduct) ? count($nodupliproduct) : count($_POST['product_id']);

                if (!empty($errormessage)) {
                    echo "<div class = 'alert alert-danger'>";
                    foreach ($errormessage as $displayerrormessage) {
                        echo $displayerrormessage;
                    }
                    echo "</div>";
                } else {
                    $query = "INSERT INTO order_summary SET customer_id=:customer_id, order_date=:order_date";

                    // prepare query for execution
                    $stmt = $con->prepare($query);

                    // bind the parameters
                    $stmt->bindParam(':customer_id', $customer_id);
                    $stmt->bindParam(':order_date', $order_date);
                    if ($stmt->execute()) {
                        $last_order_id = $con->lastInsertId();
                        $multiquery = "INSERT INTO order_detail SET order_id=:order_id, product_id=:product_id, quantity=:quantity";
                        $multistmt = $con->prepare($multiquery);

                        for ($i = 0; $i < $selectpro; $i++) {
                            $multistmt->bindParam(':order_id', $last_order_id);
                            $multistmt->bindParam(':product_id', $nodupliproduct[$i]);
                            $multistmt->bindParam(':quantity', $quantity[$i]);
                            $multistmt->execute();
                        }
                        echo "<div class='alert alert-success'>Record saved.</div>";
                        echo "<script>window.location.href='order_detail_read.php?id={$last_order_id}'</script>";
                        $_POST = array();
                        $selectpro = 1;
                        exit();
                    } else {
                        echo "<div class='alert alert-danger'>Unable to save record.</div>";
                    }
                }
            }
            // show error
            catch (PDOException $exception) {
                echo "<div class = 'alert alert-danger'>";
                echo $exception->getMessage();
                echo "</div>";
            }
        }
        ?>

        <!-- html form here where the product information will be entered -->
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <div class="table-responsive">
                <table class='table table-hover table-responsive table-bordered'>
                    <tr>
                        <td>Customer Name</td>
                        <td><select name='customer_id' class="form-select">
                                <option value="">Please select customers</option>
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
                    <table class='table table-hover table-responsive table-bordered' id="row_del">
                        <tr>
                            <td class="text-center text-light">#</td>
                            <td class="text-center">Product</td>
                            <td class="text-center">Quantity</td>
                            <td class="text-center">Action</td>
                        </tr>
                        <?php for ($x = 0; $x < $selectpro; $x++) : ?>
                            <tr class="pRow">
                                <td class="text-center"><?php echo $x + 1; ?></td>
                                <td class="d-flex">
                                    <select class="form-select mb-3 col" name="product_id[]" aria-label=".form-select-lg example">
                                        <option value="">Please select product</option>
                                        <?php
                                        for ($i = 0; $i < $productsRowCount; $i++) {
                                            $selected = isset($_POST["product_id"]) && $prorow[$i]['id'] == $product_id[$x] ? "selected" : "";
                                            echo "<option value='{$prorow[$i]['id']}' $selected >{$prorow[$i]['name']} RM {$prorow[$i]['price']}</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td><input type="number" class="form-control mb-3" name="quantity[]" aria-label=".form-control-lg example" min="1" /></td>
                                <td><button onclick='deleteRow(this)' class='btn d-flex justify-content-center btn-danger mt-1'>Delete</button></td>
                            </tr>
                        <?php
                        endfor;
                        ?>
                        <tr>
                            <td>

                            </td>
                            <td colspan="4">
                                <input type="button" value="Add More Product" class="btn btn-success add_one" />
                            </td>
                        </tr>

                    </table>
                    <table class='table table-hover table-responsive table-bordered'>
                        <tr>
                            <td>Order Date</td>
                            <td><input type="input" name='order_date' class='form-control' value="<?php echo date("Y-m-d H:i:s") ?>" readonly="readonly" /></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" value="Submit" class="btn btn-primary m-1">
                                <a href="order_read.php" class="btn btn-danger m-1">Back to Read Order Summary</a>
                            </td>
                        </tr>
                    </table>
            </div>
        </form>
    </div>
    <!-- end .container -->
    <script>
        document.addEventListener('click', function(event) {
            if (event.target.matches('.add_one')) {
                var rows = document.getElementsByClassName('pRow');
                // Get the last row in the table
                var lastRow = rows[rows.length - 1];
                // Clone the last row
                var clone = lastRow.cloneNode(true);
                // Insert the clone after the last row
                lastRow.insertAdjacentElement('afterend', clone);

                // Loop through the rows
                for (var i = 0; i < rows.length; i++) {
                    // Set the inner HTML of the first cell to the current loop iteration number
                    rows[i].cells[0].innerHTML = i + 1;
                }
            }
        }, false);

        function deleteRow(r) {
            var total = document.querySelectorAll('.pRow').length;
            if (total > 1) {
                var i = r.parentNode.parentNode.rowIndex;
                document.getElementById("row_del").deleteRow(i);

                var rows = document.getElementsByClassName('pRow');
                for (var i = 0; i < rows.length; i++) {
                    // Set the inner HTML of the first cell to the current loop iteration number
                    rows[i].cells[0].innerHTML = i + 1;
                }
            } else {
                alert("You need order at least one item.");
            }
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>