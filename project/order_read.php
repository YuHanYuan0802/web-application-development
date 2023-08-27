<?php
include 'config/validate_login.php';
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
        $action = isset($_GET['action']) ? $_GET['action'] : "";

        // if it was redirected from delete.php
        if ($action == 'deleted') {
            echo "<div class='alert alert-success'>Record was deleted.</div>";
        }
        
        // select all data
        $searchKeyword = isset($_GET['search']) ? $_GET['search'] : '';
        $query = "SELECT customers.username, order_summary.order_date, order_summary.order_id FROM order_summary INNER JOIN customers ON customers.user_id = order_summary.customer_id";
        if (!empty($searchKeyword)) {
            $query .= " WHERE username LIKE :keyword";
            $searchKeyword = "%{$searchKeyword}%";
        }
        $query .= " ORDER BY order_id ASC";
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
        echo "<div><a href='order_create.php' class='btn btn-primary m-b-1em'>Create New Order</a></div>" . "<br>";

        //check if more than 0 record found
        if ($num > 0) {

            echo "<table id='product_table' class='table table-hover table-responsive table-bordered'>"; //start table

            //creating our table heading
            echo "<tr>";
            echo "<th>Order ID</th>";
            echo "<th>Customer</th>";
            echo "<th>Order Date</th>";
            echo "<th>Order Amount</th>";
            echo "<th>Action</th>";
            echo "</tr>";
            $total = 0;
            $decimaltotal=0;
            // retrieve our table contents
            for ($i = 1; $i <= $num; $i++) {
                $total = 0;
                $totalquery = "SELECT products.name, products.price, products.promote_price, order_detail.quantity FROM order_detail INNER JOIN products ON products.id = order_detail.product_id INNER JOIN order_summary ON order_summary.order_id = order_detail.order_id INNER JOIN customers ON customers.user_id = order_summary.customer_id WHERE order_detail.order_id=:id";
                $totalstmt = $con->prepare($totalquery);
                $totalstmt->bindParam(':id', $i);
                $totalstmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                extract($row);
                echo "<tr>";
                echo "<td>{$order_id}</td>";
                echo "<td><a href='order_detail_read.php?id={$order_id}'>{$username}</a></td>";
                echo "<td>{$order_date}</td>";
                while ($totalrow = $totalstmt->fetch(PDO::FETCH_ASSOC)) {
                    if ($totalrow['promote_price'] < $totalrow['price'] && $totalrow['promote_price'] > 0) {
                        $theprice = $totalrow['promote_price'];
                    } else {
                        $theprice = $totalrow['price'];
                    }
                    $amount = $totalrow['quantity'] * $theprice;
                    $total += $amount;
                    $decimaltotal = number_format($total, '2', '.');
                }
                echo "<td class = 'text-end'>RM {$decimaltotal}</td>";
                echo "<td>";
                // read one record
                echo "<a href='order_update.php?id={$order_id}' class='btn btn-primary m-r-1em mx-1'>Edit</a>";
                echo "<a href='#' onclick='delete_order({$order_id});'  class='btn btn-danger mx-1'>Delete</a>";
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
    <script type='text/javascript'>
        // confirm record deletion
        function delete_order(id) {

            if (confirm('Are you sure?')) {
                // if user clicked ok,
                // pass the id to delete.php and execute the delete query
                window.location = 'order_delete.php?id=' + id;
            }
        }
    </script>
</body>

</html>