<!-- SELECT customers.username, products.id, products.name, order_summary.customer_id, order_summary.order_date, order_detail.order_detail_id, order_detail.order_id, order_detail.product_id, order_detail.quantity FROM order_detail INNER JOIN products ON products.id = order_detail.product_id INNER JOIN order_summary ON order_summary.order_id = order_detail.order_id INNER JOIN customers ON customers.user_id = order_summary.customer_id -->
<?php 
include 'config/session.php';
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
            <p>Read Order Detail</p>
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
            $query = "SELECT customers.username, products.id, products.name, products.promote_price, products.price, order_summary.customer_id, order_summary.order_date, order_detail.order_detail_id, order_detail.order_id, order_detail.product_id, order_detail.quantity FROM order_detail INNER JOIN products ON products.id = order_detail.product_id INNER JOIN order_summary ON order_summary.order_id = order_detail.order_id INNER JOIN customers ON customers.user_id = order_summary.customer_id WHERE order_detail.order_detail_id = :id";
            $stmt = $con->prepare($query);

            // Bind the parameter
            $stmt->bindParam(":id", $id);

            // execute our query
            $stmt->execute();

            // store retrieved row to a variable
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // values to fill up our form
            $username = $row['username'];
            $product_name = $row['name'];
            $price = $row['price'];
            $decimalprice = number_format((float)$price, 2, '.', '');
            $promote_price = $row['promote_price'];
            $decimalpromote = number_format((float)$promote_price, 2, '.', '');
            $quantity = $row['quantity'];
            $order_date = $row['order_date'];
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
                <td>Name</td>
                <td><?php echo htmlspecialchars($username, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Product Name</td>
                <td><?php echo htmlspecialchars($product_name, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Price</td>
                <td><?php echo "RM " . htmlspecialchars($decimalprice, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Promote Price</td>
                <td><?php echo "RM " . htmlspecialchars($decimalpromote, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Quantity</td>
                <td><?php echo htmlspecialchars($quantity, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td>Order Date</td>
                <td><?php echo htmlspecialchars($order_date, ENT_QUOTES);  ?></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <a href='order_read.php' class='btn btn-danger'>Back to read order</a>
                </td>
            </tr>
        </table>


    </div>

</body>

</html>