<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Delete Warning</title>
</head>

<body>
    <?php
    // include database connection
    include 'config/database.php';
    try {
        // get record ID
        // isset() is a PHP function used to verify if a value is there or not
        //exists example
        // SELECT name FROM products WHERE EXISTS(SELECT products.id FROM order_detail WHERE order_detail.product_id=products.id)
        $id = isset($_GET['id']) ? $_GET['id'] :  die('ERROR: Record ID not found.');

        // delete query
        $query = "DELETE FROM order_detail WHERE order_id = ?";
        $stmt = $con->prepare($query);
        $stmt->bindParam(1, $id);

        $summaryquery = "DELETE FROM order_summary WHERE order_id = ?";
        $summarystmt = $con->prepare($summaryquery);
        $summarystmt->bindParam(1, $id);

        if ($stmt->execute() && $summarystmt->execute()) {
            // redirect to read records page and
            // tell the user record was deleted
            header('Location: order_read.php?action=deleted');
        } else {
            die('Unable to delete record.');
        }
    }
    // show error
    catch (PDOException $exception) {
            echo "<div class = 'alert alert-danger'>";
            echo $exception->getMessage();
            echo "</div>";
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>