<?php
include 'config/validate_login.php';
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Home</title>
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <!-- container -->
    <div class="container">
        <?php
        include 'menu/menu.php';
        include 'config/database.php';

        echo "<h5 class = 'text-center'>Welcome Back " . $_SESSION['username'] . "</h5>";

        $cusnumquery = "SELECT * FROM customers";
        $cusnumstmt = $con->prepare($cusnumquery);
        $cusnumstmt->execute();
        $cusnum = $cusnumstmt->rowCount();

        $pronumquery = "SELECT * FROM products";
        $pronumstmt = $con->prepare($pronumquery);
        $pronumstmt->execute();
        $pronum = $pronumstmt->rowCount();

        $ornumquery = "SELECT * FROM order_summary";
        $ornumstmt = $con->prepare($ornumquery);
        $ornumstmt->execute();
        $ornum = $ornumstmt->rowCount();

        $latestquery = "SELECT customers.username, order_summary.order_id, order_summary.order_date, order_detail.product_id, order_detail.quantity, products.name, products.price, products.promote_price FROM order_summary INNER JOIN order_detail ON order_summary.order_id=order_detail.order_id INNER JOIN products ON order_detail.product_id=products.id INNER JOIN customers ON order_summary.customer_id=customers.user_id ORDER BY order_id DESC LIMIT 1";
        $lateststmt = $con->prepare($latestquery);
        $lateststmt->execute();

        $mostquery = "SELECT customers.username, order_summary.order_date, COUNT(order_id) AS count FROM order_summary INNER JOIN customers ON customers.user_id=order_summary.order_id GROUP BY customer_id ORDER BY COUNT(order_id) DESC LIMIT 1";
        $moststmt = $con->prepare($mostquery);
        $moststmt->execute();

        $topquery = "SELECT products.image, products.name, products.description, category.category_name FROM order_detail INNER JOIN products ON products.id=order_detail.product_id INNER JOIN category ON category.category_id=products.category_id GROUP BY order_detail.product_id LIMIT 5";
        $topstmt = $con->prepare($topquery);
        $topstmt->execute();
        $counttop = $topstmt->rowCount();

        $nobuyquery = "SELECT products.image, products.name, products.description, category.category_name FROM products INNER JOIN category ON category.category_id=products.category_id WHERE NOT EXISTS(SELECT products.id FROM order_detail WHERE order_detail.product_id=products.id)";
        $nobuystmt = $con->prepare($nobuyquery);
        $nobuystmt->execute();
        $countnobuy = $nobuystmt->rowCount();
        ?>
        <div class="d-flex justify-content-around">
            <div class="text-center shadow p-5 m-5 bg-body-tertiary rounded flex-fill">
                <?php
                echo "<h1>$cusnum<h1>";
                echo "<br>";
                echo "<h5>Customers Registered<h5>"
                ?>
            </div>
            <div class="text-center shadow p-5 m-5 bg-body-tertiary rounded flex-fill">
                <?php
                echo "<h1>$pronum<h1>";
                echo "<br>";
                echo "<h5>Products Available<h5>"
                ?>
            </div>
            <div class="text-center shadow p-5 m-5 bg-body-tertiary rounded flex-fill">
                <?php
                echo "<h1>$ornum<h1>";
                echo "<br>";
                echo "<h5>Orders Created<h5>"
                ?>
            </div>
        </div>
        <div class="text-center shadow p-5 m-5 bg-body-tertiary rounded">
            <?php
            $total = 0;
            while ($latestrow = $lateststmt->fetch(PDO::FETCH_ASSOC)) {
                extract($latestrow);
                echo "<h5>Our Latest Order Make By </h5>";
                echo "<h5><strong>$username</strong></h5>";
                echo "<h5>Bought <strong>$quantity</strong> </h5>";
                echo "<h5><strong>$name</strong></h5>";
                echo "<h5>And Order At</h5>";
                echo "<h5><strong>$order_date</strong></h5>";
                echo "<h5>With Total Of</h5>";
                if ($promote_price < $price && $promote_price > 0) {
                    $theprice = $promote_price;
                } else {
                    $theprice = $price;
                }
                $total = $quantity * $theprice;
                echo "<h5><strong>RM $total </strong></h5>";
            }
            ?>
        </div>

        <div class="text-center shadow p-5 m-5 bg-body-tertiary rounded">
            <?php
            $total = 0;
            while ($mostrow = $moststmt->fetch(PDO::FETCH_ASSOC)) {
                extract($mostrow);
                echo "<h5>The Most Order Make By </h5>";
                echo "<h5><strong>$username</strong></h5>";
                echo "<h5>With " . "<strong>" . $mostrow['count'] . "</strong>" .  " Order</h5>";
                echo "<h5>At</h5>";
                echo "<h5><strong>$order_date</strong></h5>";
            }
            ?>
        </div>

        <div class="text-center shadow p-5 m-5 bg-body-tertiary rounded">
            <h5>Top 5 Products Ordered by Our Customers</h5>
            <div class="d-flex justify-content-around flex-wrap">
                <?php
                for ($i = 0; $i < $counttop; $i++) {
                    echo "<div class='shadow p-5 m-5 bg-body-tertiary rounded text-start' style='width:25rem;'>";
                    $toprow = $topstmt->fetch(PDO::FETCH_ASSOC);
                    echo "<img src='uploads/{$toprow['image']}' class='img-fluid' alt='{$toprow['name']}' width='100px'/>";
                    echo "<h5><strong>" . $toprow['name'] . "</strong></h5>";
                    echo "<h5>Category</h5>";
                    echo "<h5><strong>" . $toprow['category_name'] . "</strong></h5>";
                    echo "<h5>Description</h5>";
                    echo "<h5><strong>" . $toprow['description'] . "</strong></h5>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>


        <div class="text-center shadow p-5 m-5 bg-body-tertiary rounded">
            <h5>Products Never Buy From The Store</h5>
            <div class="d-flex justify-content-around flex-wrap">
                <?php
                for ($i = 0; $i < $countnobuy; $i++) {
                    echo "<div class='shadow p-5 m-5 bg-body-tertiary rounded text-start' style='width:25rem;'>";
                    $nobuyrow = $nobuystmt->fetch(PDO::FETCH_ASSOC);
                    echo "<img src='uploads/{$nobuyrow['image']}' class='img-fluid' alt='{$nobuyrow['name']}' width='100px'/>";
                    echo "<h5><strong>" . $nobuyrow['name'] . "</strong></h5>";
                    echo "<h5>Category</h5>";
                    echo "<h5><strong>" . $nobuyrow['category_name'] . "</strong></h5>";
                    echo "<h5>Description</h5>";
                    echo "<h5><strong>" . $nobuyrow['description'] . "</strong></h5>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>