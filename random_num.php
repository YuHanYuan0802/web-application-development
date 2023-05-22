<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RandomNumber</title>
</head>
<style>
    .line1{
        color: green;
        font-style: italic;
        font-size: xx-large;
    }

    .line2{
        color: blue;
        font-style: italic;
        font-size: xx-large;
    }

    .line3{
        color: red;
        font-weight: bold;
        font-size: xx-large;
    }

    .line4{
        font-weight: bold;
        font-style: italic;
        font-size: xx-large;
    }
</style>
<body>
    <?php
    $num=rand(100,200);
    $plus = $num+$num;
    $multi = $num*$num;
    echo "<p class='line1'>Line1: $num</p>";
    echo "<p class='line2'>Line2: $num</p>";
    echo "<p class='line3'>Line3: $plus</p>";
    echo "<p class='line4'>Line4: $multi</p>";
    ?>
</body>
</html>