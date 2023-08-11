<?php
include 'config/validate_login.php';
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
            $query = "SELECT products.name, products.price, products.promote_price, order_detail.quantity FROM order_detail INNER JOIN products ON products.id = order_detail.product_id INNER JOIN order_summary ON order_summary.order_id = order_detail.order_id INNER JOIN customers ON customers.user_id = order_summary.customer_id WHERE order_detail.order_id = :id";
            $stmt = $con->prepare($query);
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            $cusquery = "SELECT customers.username, order_summary.order_date FROM order_summary INNER JOIN customers ON customers.user_id = order_summary.customer_id INNER JOIN order_detail ON order_detail.order_id = order_summary.order_id WHERE order_detail.order_id =:id";
            $cusstmt = $con->prepare($cusquery);
            $cusstmt->bindParam(":id", $id);
            $cusstmt->execute();
            if ($cusrow = $cusstmt->fetch(PDO::FETCH_ASSOC)){
                extract($cusrow);
                echo "<div class = 'd-flex justify-content-between'>";
                echo "<div>";
                echo "<strong>Username: " . $username . "</strong>";
                echo "</div>";
                echo "<div>";
                echo "<strong>Order Date: " . $order_date . "</strong>";
                echo "</div>";
                echo "</div>";
                echo "<br>";
            }

            $countrow = $stmt->rowCount();
            echo "<table class='table table-hover table-responsive table-bordered'>";

            echo "<tr>";
            echo "<th>Product Name</th>";
            echo "<th>Price</th>";
            echo "<th>Quantity</th>";
            echo "<th>Amount (RM)</th>";
            echo "</tr>";

            $total = 0;

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $product_name = $row['name'] . "</td>";
                $price = $row['price'];
                $promote_price = $row['promote_price'];
                $decimalprice = number_format((float)$price, 2, '.', '');
                $decimalpromote = number_format((float)$promote_price, 2, '.', '');
                if ($promote_price < $decimalprice && $promote_price > 0) {
                    echo "<td class = 'd-flex justify-content-end'><div class = 'mx-1 text-decoration-line-through'>RM {$decimalprice}</div><div class = 'mx-1'>RM {$decimalpromote}</div></td>";
                } else {
                    echo "<td class = 'text-end'>{$decimalprice}</td>";
                }
                echo "<td class='text-end'>x" . $row['quantity'] . "</td>";
                $amount = $row['quantity'] * $decimalpromote;
                $decimalamount = number_format((float)$amount, 2, '.', '');
                echo "<td class = 'text-end'>Rm " . $decimalamount . "</td>";
                echo "</tr>";
                $total += $decimalamount;
                $decimaltotal = number_format((float)$total, 2, '.', '');
            }
            echo "<th></th>";
            echo "<th></th>";
            echo "<th></th>";
            echo "<th class = 'text-end'>Total Price: RM $decimaltotal</th>";
            echo "</table>";
            echo "<td><a href='order_read.php' class='btn btn-danger'>Back to read order</a></td>";
        }

        // show error
        catch (PDOException $exception) {
            die('ERROR: ' . $exception->getMessage());
        }
        ?>
    </div>

</body>

</html>