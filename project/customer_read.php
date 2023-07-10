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
        <br>
        <div class="text-end">
            <input type="text" id="input" onkeyup="search()" placeholder="Search for usernames.." title="Type in a username">
            <input type="text" id="emailinput" onkeyup="searchemail()" placeholder="Search for gmails.." title="Type in a gmail">
        </div>
        <?php
        // include database connection
        include 'config/database.php';

        // delete message prompt will be here

        // select all data
        $query = "SELECT user_id, username, first_name, last_name, date_of_birth, registration_date_time, email, gender, status FROM customers ORDER BY user_id ASC";
        $stmt = $con->prepare($query);
        $stmt->execute();

        // this is how to get number of rows returned
        $num = $stmt->rowCount();

        // link to create record form
        echo "<div><a href='customer_create.php' class='btn btn-primary m-b-1em'>Create New Customer</a></div>" . "<br>";

        //check if more than 0 record found
        if ($num > 0) {

            echo "<table id='customer_table' class='table table-hover table-responsive table-bordered'>"; //start table

            //creating our table heading
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Username</th>";
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
                // creating new table row per record
                echo "<tr>";
                echo "<td>{$user_id}</td>";
                echo "<td>{$username}</td>";
                echo "<td>{$first_name}</td>";
                echo "<td>{$last_name}</td>";
                echo "<td>{$email}</td>";
                echo "<td>{$date_of_birth}</td>";
                echo "<td>{$registration_date_time}</td>";
                echo "<td>{$gender}</td>";
                echo "<td>{$status}</td>";
                echo "<td>";
                // read one record
                echo "<a href='customer_read_one.php?id={$user_id}' class='btn btn-info m-r-1em mx-1'>Read</a>";

                // we will use this links on next part of this post
                echo "<a href='customer_update.php?id={$user_id}' class='btn btn-primary m-r-1em mx-1'>Edit</a>";

                // we will use this links on next part of this post
                echo "<a href='#' onclick='delete_product({$user_id});'  class='btn btn-danger mx-1'>Delete</a>";
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
    <script>
        function search() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("input");
            filter = input.value.toUpperCase();
            table = document.getElementById("customer_table");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
    <script>
        function searchemail() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("emailinput");
            filter = input.value.toUpperCase();
            table = document.getElementById("customer_table");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[4];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>