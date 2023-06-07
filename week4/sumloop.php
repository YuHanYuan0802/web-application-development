<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SumDecrease</title>
</head>

<body>
    <form method="post" action="">
        <label for="number">Enter a number:</label>
        <input type="text" name="number" id="number" />
        <input type="submit" name="submit" value="Calculate" />
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $number = $_POST['number'];

        if (empty($number) || !is_numeric($number)) {
            echo '<p style="color: red;">Please fill in a number.</p>';
        } else {
            $sum = 0;

            for ($i = $number; $i >= 1; $i--) {
                $sum += $i;
            }

            echo "<p>{$number} + ";
            for ($i = $number - 1; $i > 1; $i--) {
                echo "{$i} + ";
            }
            echo "1 = {$sum}</p>";
        }
    }
    ?>
</body>

</html>