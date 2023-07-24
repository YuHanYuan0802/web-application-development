<?php 
include 'config/session.php';
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Read Order</title>
</head>

<body>
    <div class="container">
        <?php
        include 'menu/menu.php';
        ?>
        <?php
        // include database connection
        include 'config/database.php';

        // delete message prompt will be here

        // select all data
        $searchKeyword = isset($_GET['search']) ? $_GET['search'] : '';
        $query = "SELECT customers.username, order_summary.order_date, order_detail.order_detail_id, order_detail.order_id, order_detail.quantity FROM order_detail INNER JOIN products ON products.id = order_detail.product_id INNER JOIN order_summary ON order_summary.order_id = order_detail.order_id INNER JOIN customers ON customers.user_id = order_summary.customer_id";
        if (!empty($searchKeyword)) {
            $query .= " WHERE username LIKE :keyword";
            $searchKeyword = "%{$searchKeyword}%";
        }
        $query .= " ORDER BY order_detail_id ASC";
        $stmt = $con->prepare($query);
        if (!empty($searchKeyword)) {
            $stmt->bindParam(':keyword', $searchKeyword);
        }
        $stmt->execute();

        // this is how to get number of rows returned
        $num = $stmt->rowCount();
        echo '<div class="p-3">
            <form method="GET" action="">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="search" placeholder="Search customer..." value="' . str_replace('%', '', $searchKeyword) . '">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
        </div>';
        // link to create record form
        echo "<br><div><a href='order_create.php' class='btn btn-primary m-b-1em'>Create New Order</a></div>" . "<br>";

        //check if more than 0 record found
        if ($num > 0) {

            echo "<table id='product_table' class='table table-hover table-responsive table-bordered'>"; //start table

            //creating our table heading
            echo "<tr>";
            echo "<th>Order Detail ID</th>";
            echo "<th>Customer</th>";
            echo "<th>Order Date</th>";
            echo "<th>Quantity</th>";
            echo "<th>Action</th>";
            echo "</tr>";

            // retrieve our table contents
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // extract row
                // this will make $row['firstname'] to just $firstname only
                extract($row);
                // creating new table row per record
                echo "<tr>";
                echo "<td>{$order_detail_id}</td>";
                echo "<td>{$username}</td>";
                echo "<td>{$order_date}</td>";
                echo "<td>x{$quantity}</td>";
                echo "<td>";
                // read one record
                echo "<a href='order_detail_read.php?id={$order_detail_id}' class='btn btn-info m-r-1em mx-1'>Read</a>";
                echo "</td>";
                echo "</tr>";
            }


            // end table
            echo "</table>";
        } else {
            echo "<div class='alert alert-danger'>No records found.</div>";
        }
        ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>