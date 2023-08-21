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

        $id = isset($_GET['id']) ? $_GET['id'] :  die('ERROR: Record ID not found.');

        $selectimage = "SELECT image FROM customers WHERE user_id = ?";
        $imagestmt = $con->prepare($selectimage);
        $imagestmt->bindParam(1, $id);
        $imagestmt->execute();
        $row = $imagestmt->fetch(PDO::FETCH_ASSOC);
        $image = $row['image'];

        // delete query
        $query = "DELETE FROM customers WHERE user_id = ?";
        $stmt = $con->prepare($query);
        $stmt->bindParam(1, $id);
        if ($stmt->execute()) {
            if ($image == "default_user.png" || $image == "product_image_coming_soon.jpg") {
                //no need delete default image.
                header('Location: customer_read.php?action=deleted');
            } else {
                unlink("uploads/" . $image);
                header('Location: customer_read.php?action=imagedeleted');
            }
            // redirect to read records page and
            // tell the user record was deleted
        } else {
            die('Unable to delete record.');
        }
    }
    // show error
    catch (PDOException $exception) {
        if ($exception->getCode() == 23000) {
            echo '<script>alert("This customer have activity in another place.");';
            echo 'window.location.href="customer_read.php";';
            echo '</script>';
        } else {
            echo "<div class = 'alert alert-danger'>";
            echo $exception->getMessage();
            echo "</div>";
        }
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>