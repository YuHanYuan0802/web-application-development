<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <title>SumTwoNumber</title>
</head>

<body>
    <form action="" class="fs-3" method="post">
        Number 1: <input type="text" name="number1" class="fs-3"><br>
        Number 2: <input type="text" name="number2" class="fs-3"><br>
        <input type="submit" name="submit" class="fs-3"><br>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $firstnum = $_POST["number1"];
        $secondnum = $_POST["number2"];

        if (is_numeric($firstnum) && is_numeric($secondnum)) {
            $total = $firstnum + $secondnum;
            echo "<div class='fs-3'>Your total number is: $total </div>";
        } else {
            echo "<h3 class='text-danger'> Please fill in a number. </h3>";
        }
    }
    ?>
</body>

</html>