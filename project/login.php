<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Login Page</title>
</head>

<body>
    <div class="container">
        <?php
        include 'menu/headerlogin.php';
        ?>
    </div>
    <?php
    if (isset($_POST['submit'])) {
        include 'config/database.php';
        try {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $query = "SELECT * FROM customers WHERE (username = :username)";
            $values = [':username' => $username];
            $res = $con->prepare($query);
            $res->execute($values);
            $row = $res->fetch(PDO::FETCH_ASSOC);
            if (is_array($row)) {
                if (password_verify($password, $row['password'])) {
                    header('location:index.php');
                } else {
                    echo "<div class = 'container w-25 alert alert-danger text-center'>";
                    echo "Invalid password" . "<br>";
                    echo "</div>";
                }
            } else {
                echo "<div class = 'container w-25 alert alert-danger text-center'>";
                echo "No username found";
                echo "</div>";
            }
        } catch (PDOException $exception) {
            echo "<div class = 'container w-25 alert alert-danger text-center'>";
            echo $exception->getMessage();
            echo "</div>";
        }
    }
    ?>
    <div class="container w-25">
        <form action="" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>