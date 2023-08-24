<?php 
include 'config/validate_login.php';
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Read Customer</title>
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
        } else if($action == "deleted"){
            echo "<div class='alert alert-success'>Record was deleted.</div>";
            echo "<div class='alert alert-success'>Default image no need delete.</div>";
        }

        // select all data
        $searchKeyword = isset($_GET['search']) ? $_GET['search'] : '';
        $query = "SELECT image, user_id, username, first_name, last_name, date_of_birth, registration_date_time, email, gender, status FROM customers";
        if (!empty($searchKeyword)) {
            $query .= " WHERE username LIKE :keyword OR first_name LIKE :keyword OR last_name LIKE :keyword OR email LIKE :keyword";
            $searchKeyword = "%{$searchKeyword}%";
        }
        $query .= " ORDER BY user_id ASC";
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
                    <input type="text" class="form-control" name="search" placeholder="Search name..." value="' . str_replace('%', '', $searchKeyword) . '">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
        </div>';
        // link to create record form
        echo "<div><a href='customer_create.php' class='btn btn-primary m-b-1em'>Create New Customer</a></div>" . "<br>";

        //check if more than 0 record found
        if ($num > 0) {

            echo "<table id='customer_table' class='table table-hover table-responsive table-bordered'>"; //start table

            //creating our table heading
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Username</th>";
            echo "<th>Image</th>";
            echo "<th>First name</th>";
            echo "<th>Last name</th>";
            echo "<th>Email</th>";
            echo "<th>Birthday</th>";
            echo "<th>Registration date and time</th>";
            echo "<th>Gender</th>";
            echo "<th>Status</th>";
            echo "<th>Action</th>";
            echo "</tr>";

            // retrieve our table contents
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // extract row
                // this will make $row['firstname'] to just $firstname only
                extract($row);

                $gender = ucfirst($gender);
                $status = ucfirst($status);
                // creating new table row per record
                echo "<tr>";
                echo "<td>{$user_id}</td>";
                echo "<td>{$username}</td>";
                echo "<td><img src='uploads/{$image}' alt='{$username}' width='100px'</td>";
                echo "<td>{$first_name}</td>";
                echo "<td>{$last_name}</td>";
                echo "<td>{$email}</td>";
                echo "<td>{$date_of_birth}</td>";
                echo "<td>{$registration_date_time}</td>";
                echo "<td>{$gender}</td>";
                echo "<td>{$status}</td>";
                echo "<td>";
                // read one record
                echo "<a href='customer_read_one.php?id={$user_id}' class='btn btn-info m-r-1em m-1'>Read</a>";

                // we will use this links on next part of this post
                echo "<a href='customer_update.php?id={$user_id}' class='btn btn-primary m-r-1em m-1'>Edit</a>";

                // we will use this links on next part of this post
                echo "<a href='#' onclick='delete_customer({$user_id});'  class='btn btn-danger m-1'>Delete</a>";
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
    <script type='text/javascript'>
        // confirm record deletion
        function delete_customer(id) {

            if (confirm('Are you sure?')) {
                // if user clicked ok,
                // pass the id to delete.php and execute the delete query
                window.location = 'customer_delete.php?id=' + id;
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>