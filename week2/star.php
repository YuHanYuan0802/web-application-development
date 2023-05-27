<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Star</title>
</head>

<body>
    <?php
    for ($i = 10; $i > 0; $i--) {
        for ($j = 0; $j < $i; $j++) {
            echo "*";
        }
        echo "\n <br>";
    }
    ?>
</body>

</html>