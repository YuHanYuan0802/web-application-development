<?php
include 'config/validate_login.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Order Update</title>
</head>

<body>
    <div class="container">
        <div class="page-header">
            <?php
            include 'menu/menu.php';
            ?>
            <p>Update Order</p>
        </div>
        <?php
        //include database connection
        include 'config/database.php';

        // get passed parameter value, in this case, the record ID
        // isset() is a PHP function used to verify if a value is there or not
        $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR1: Record ID not found.');

        $customer_query = "SELECT user_id, username FROM customers";
        $customer_stmt = $con->prepare($customer_query);
        $customer_stmt->execute();
        $customers = $customer_stmt->fetchAll(PDO::FETCH_ASSOC);

        $product_query = "SELECT id, name, price FROM products ORDER BY id ASC";
        $product_stmt = $con->prepare($product_query);
        $product_stmt->execute();
        $products = $product_stmt->fetchAll(PDO::FETCH_ASSOC);

        $order_summary_query = "SELECT * FROM order_summary WHERE order_id=:id";
        $order_summary_stmt = $con->prepare($order_summary_query);
        $order_summary_stmt->bindParam(":id", $id);
        $order_summary_stmt->execute();
        $order_summaries = $order_summary_stmt->fetch(PDO::FETCH_ASSOC);

        $order_detail_query = "SELECT * FROM order_detail WHERE order_id=:id";
        $order_detail_stmt = $con->prepare($order_detail_query);
        $order_detail_stmt->bindParam(":id", $id);
        $order_detail_stmt->execute();
        $order_details = $order_detail_stmt->fetchAll(PDO::FETCH_ASSOC);

        $displayusernamequery = "SELECT customers.username FROM customers INNER JOIN order_summary ON customers.user_id = order_summary.customer_id WHERE order_summary.order_id =:id";
        $displayusernamestmt = $con->prepare($displayusernamequery);
        $displayusernamestmt->bindParam(':id', $id);
        $displayusernamestmt->execute();
        $displayusername = $displayusernamestmt->fetch(PDO::FETCH_ASSOC);

        $error = array();
        if ($_POST) {
            $product_id = $_POST["product"];
            $quantity = $_POST["quantity"];

            $noduplicate = array_unique($product_id);

            if (sizeof($noduplicate) != sizeof($product_id)) {
                foreach ($product_id as $key => $val) {
                    if (!array_key_exists($key, $noduplicate)) {
                        $error[] = "Duplicated products have been chosen " . $products[$val - 1]['name'] . ".";
                        unset($quantity[$key]);
                    }
                }
            }
            $product_id = array_values($noduplicate);
            $quantity = array_values($quantity);

            $selected_product_count = isset($noduplicate) ? count($noduplicate) : count($order_details);

            try {

                if (isset($selected_product_count)) {
                    for ($i = 0; $i < $selected_product_count; $i++) {
                        if ($product_id[$i] == "") {
                            $error[] = " Please choose the product for NO " . $i + 1 . ".";
                        }

                        if ($quantity[$i] == 0 || empty($quantity[$i])) {
                            $error[] = "Quantity Can not be zero or empty.";
                        } else if ($quantity[$i] < 0) {
                            $error[] = "Quantity Can not be negative number.";
                        }
                    }
                }

                if (!empty($error)) {
                    echo "<div class='alert alert-danger role='alert'>";
                    foreach ($error as $error_message) {
                        echo $error_message . "<br>";
                    }
                    echo "</div>";
                } else {
                    date_default_timezone_set('Asia/Kuala_Lumpur');
                    $order_date = date('Y-m-d H:i:s');
                    $delete_details_query = "DELETE FROM order_detail WHERE order_id=:id";
                    $delete_details_stmt = $con->prepare($delete_details_query);
                    $delete_details_stmt->bindParam(":id", $id);
                    $delete_details_stmt->execute();

                    // Insert updated order details into the database
                    for ($i = 0; $i < $selected_product_count; $i++) {
                        $order_details_query = "INSERT INTO order_detail SET order_id=:order_id, product_id=:product_id, quantity=:quantity";
                        $order_details_stmt = $con->prepare($order_details_query);
                        $order_details_stmt->bindParam(":order_id", $id);
                        $order_details_stmt->bindParam(":product_id", $product_id[$i]);
                        $order_details_stmt->bindParam(":quantity", $quantity[$i]);
                        $order_details_stmt->execute();
                    }
                    echo "<script>window.location.href='order_detail_read.php?id={$id}'</script>";
                    echo "<div class='alert alert-success' role='alert'>Order Placed Successfully.</div>";
                    $_POST = array();
                }
            } catch (PDOException $exception) {
                echo '<div class="alert alert-danger role=alert">' . $exception->getMessage() . '</div>';
            }
        }
        ?>
        <div>
            <form action="" method="post">
                <div class="table-responsive">
                    <table class="table table-hover table-responsive table-bordered" id="row_del">
                        <tr>
                            <td>Name</td>
                            <td><?php echo $displayusername['username']; ?></td>
                        </tr>
                        <tr>
                            <th>NO.</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Actions</th>
                        </tr>
                        <?php

                        $product_loop = empty($error) ? count($order_details) : count($noduplicate);
                        for ($x = 0; $x < $product_loop; $x++) {

                        ?>
                            <tr class="pRow">
                                <td class="col-1">
                                    <?php echo $x + 1; ?>
                                </td>
                                <td>
                                    <select name="product[]" id="product" class="form-select" value>
                                        <option value="">Choose a Product</option>
                                        <?php
                                        for ($i = 0; $i < count($products); $i++) {
                                            $product_selected = $products[$i]['id'] == $order_details[$x]['product_id'] ? "selected" : "";
                                            echo "<option value='{$products[$i]['id']}' $product_selected>{$products[$i]['name']}" . " RM " . "{$products[$i]['price']}" . "</option>";
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="quantity[]" id="quantity" value="<?php echo $order_details[$x]['quantity'] ?>">

                                </td>
                                <td>
                                    <button onclick='deleteRow(this)' class='btn d-flex justify-content-center btn-danger mt-1'>Delete</button>
                                </td>
                            </tr>
                        <?php }
                        ?>
                        <tr>
                            <td></td>
                            <td>
                                <input type="button" value="Add More Product" class="btn btn-success add_one" />
                            </td>
                            <td></td>
                        </tr>
                    </table>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary m-1">Update Order</button>
                    <a href="order_read.php" class="btn btn-danger m-1">Back to Read Order Summary</a>
                </div>
            </form>
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
        </div>
    </div> <!-- end .container -->

    <!-- confirm delete record will be here -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>