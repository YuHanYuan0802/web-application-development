<?php
include 'config/validate_login.php';
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Read Product</title>
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
        if ($action == 'imagedeleted') {
            echo "<div class='alert alert-success'>Record and image was deleted.</div>";
        } else if($action == "deleted") {
            echo "<div class='alert alert-success'>Record was deleted.</div>";
            echo "<div class='alert alert-success'>Default image no need delete.</div>";
        }

        // select all data
        $searchKeyword = isset($_GET['search']) ? $_GET['search'] : '';
        $query = "SELECT products.image, products.id, products.name, products.description, products.price, products.promote_price, products.manufacture_date, category.category_name FROM products INNER JOIN category ON products.category_id = category.category_id";
        if (!empty($searchKeyword)) {
            $query .= "  WHERE category_name LIKE :keyword OR name LIKE :keyword";
            $searchKeyword = "%{$searchKeyword}%";
        }
        $query .= " ORDER BY products.id ASC";
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
                    <input type="text" class="form-control" name="search" placeholder="Search product or category..." value="' . str_replace('%', '', $searchKeyword) . '">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
        </div>';
        // link to create record form
        echo "<div><a href='product_create.php' class='btn btn-primary m-b-1em'>Create New Product</a></div>" . "<br>";

        //check if more than 0 record found
        if ($num > 0) {
            echo "<div class='table-responsive'>";
            echo "<table id='product_table' class='table table-hover table-bordered'>"; //start table

            //creating our table heading
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Name</th>";
            echo "<th>Image</th>";
            echo "<th>Description</th>";
            echo "<th>Price</th>";
            echo "<th>Manufacture date</th>";
            echo "<th>Category</th>";
            echo "<th>Action</th>";
            echo "</tr>";

            // retrieve our table contents
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // extract row
                // this will make $row['firstname'] to just $firstname only
                extract($row);
                $decimalprice = number_format((float)$price, 2, '.', '');
                $decimalpromote = number_format((float)$promote_price, 2, '.', '');
                // creating new table row per record
                echo "<tr>";
                echo "<td>{$id}</td>";
                echo "<td><a href='product_read_one.php?id={$id}'>{$name}</a></td>";
                echo "<td class='text-center'><img src='uploads/{$image}' class='img-fluid' alt='{$name}' width='100px'></td>";
                echo "<td>{$description}</td>";
                if ($promote_price < $decimalprice && $promote_price > 0) {
                    echo "<td class = 'd-flex justify-content-end'><div class = 'mx-1 text-decoration-line-through'>RM {$decimalprice}</div><div class = 'mx-1'>RM {$decimalpromote}</div></td>";
                } else {
                    echo "<td class = 'text-end'>RM {$decimalprice}</td>";
                }
                echo "<td>{$manufacture_date}</td>";
                echo "<td>{$category_name}</td>";
                echo "<td>";

                // we will use this links on next part of this post
                echo "<a href='product_update.php?id={$id}' class='btn btn-primary m-r-1em m-1'>Edit</a>";

                // we will use this links on next part of this post
                echo "<a href='#' onclick='delete_product({$id});'  class='btn btn-danger m-1'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }


            // end table
            echo "</table>";
            echo "</div>";
        } else {
            echo "<div class='alert alert-danger'>No records found.</div>";
        }
        ?>
    </div>
    <script type='text/javascript'>
        // confirm record deletion
        function delete_product(id) {

            if (confirm('Are you sure?')) {
                // if user clicked ok,
                // pass the id to delete.php and execute the delete query
                window.location = 'product_delete.php?id=' + id;
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>