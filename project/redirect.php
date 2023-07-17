<?php
session_start();
if (empty($_SESSION)) {
    header('location:login.php');
} else {
    echo "<meta http-equiv='refresh' content='2;url=index.php'>";
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting</title>
</head>

<body>
    <?php
    echo "Welcome " . $_SESSION['username'];
    ?>
</body>

</html>