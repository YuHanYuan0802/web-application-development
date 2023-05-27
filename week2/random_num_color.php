<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RandomNumberColor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container-fluid">

            <?php
            $firstnum = rand(100, 200);
            $secondnum = rand(100, 200);
            if ($firstnum > $secondnum) {
                echo "<div class='col'>";
                echo "<span class='fw-bold text-primary fs-1'>Num1: $firstnum</span>";
                echo "<span class='text-secondary'>\tNum2: $secondnum</span>";
                echo "</div>";
            } else if ($secondnum > $firstnum) {
                echo "<div class='col'>";
                echo "<span class='text-secondary'>Num1: $firstnum</span>";
                echo "<span class='fw-bold text-primary fs-1'>\tNum2: $secondnum</span>";
                echo "</div>";
            } else {
                echo "<span class='h1'>Two number same..</span>";
            }
            ?>
        </div>
</body>

</html>