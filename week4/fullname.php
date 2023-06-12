<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <title>FullName</title>
</head>

<body>
    <form action="" class="fs-3" method="post">
        First Name: <input type="text" name="firstname" class="fs-3"><br>
        Last Name: <input type="text" name="lastname" class="fs-3"><br>
        <input type="submit" name="submit" class="fs-3"><br>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $first = $_POST["firstname"];
        $last = $_POST["lastname"];
        if (ctype_alpha(str_replace(' ', '', $first)) && ctype_alpha(str_replace(' ', '', $last))) {
            echo "<span class='fs-3'>";
            echo ucwords(strtolower($first));
            echo " ";
            echo ucwords(strtolower($last));
            echo "</span>";
        } else if (empty($first) || empty($last)) {
            echo "<h3 class='text-danger'> Please enter your name. </h3>";
        } else {
            echo "<h3 class='text-danger'> Please enter your name. </h3>";
        }
    }
    ?>
</body>

</html>