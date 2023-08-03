<?php
include 'config/session.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Order Update</title>
</head>

<body>
    <div class="container">
        <div class="page-header">
            <?php
            include 'menu/menu.php';
            ?>
            <p>Update Order</p>
        </div>
        <?php
        // get passed parameter value, in this case, the record ID
        // isset() is a PHP function used to verify if a value is there or not
        $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR1: Record ID not found.');

        //include database connection
        include 'config/database.php';
        try {
            // prepare select query
            $query = "SELECT customers.username, products.name, order_detail.quantity FROM order_detail INNER JOIN products ON products.id = order_detail.product_id INNER JOIN order_summary ON order_summary.order_id = order_detail.order_id INNER JOIN customers ON customers.user_id = order_summary.customer_id WHERE order_detail.order_detail_id = :id";
            $stmt = $con->prepare($query);

            // Bind the parameter
            $stmt->bindParam(":id", $id);

            // execute our query
            $stmt->execute();

            // store retrieved row to a variable
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // values to fill up our form
            $name = $row['username'];
            $product_name = $row['name'];
            $quantity = $row['quantity'];
        }

        // show error
        catch (PDOException $exception) {
            echo "<div class = 'alert alert-danger'>";
            echo $exception->getMessage();
            echo "</div>";
        }
        ?>

        <?php
        if (isset($_POST['submit'])) {
            //Update order detail
            try {
                $product_id = $_POST['product_id'];
                $quantity = $_POST['quantity'];

                $query = "UPDATE order_detail SET product_id=:product_id, quantity=:quantity WHERE order_detail_id = :id";

                $stmt = $con->prepare($query);

                $stmt->bindParam(':id', $id);
                $stmt->bindParam(':product_id', $product_id);
                $stmt->bindParam(':quantity', $quantity);

                $errormessage = array();
                if ($quantity < 1) {
                    $errormessage[] = "Quantity must be 1 and above.";
                }
                if (empty($product_id)) {
                    $errormessage[] = "Product must not be empty.";
                }
                if (!empty($errormessage)) {
                    foreach ($errormessage as $displayerrormessage) {
                        echo "<div class = 'alert alert-danger'>";
                        echo $displayerrormessage;
                        var_dump($product_id);
                        var_dump($quantity);
                        echo "</div>";
                    }
                } else if ($stmt->execute()) {
                    echo "<div class='alert alert-success'>Record was updated.</div>";
                } else {
                    echo "<div class='alert alert-danger'>Unable to update record.</div>";
                }

            } catch (PDOException $exception) {
                echo "<div class = 'alert alert-danger'>";
                echo $exception->getMessage();
                echo "</div>";
            }
        }
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}"); ?>" method="post">
            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <td>Name</td>
                    <td><?php echo htmlspecialchars($name, ENT_QUOTES);  ?></td>
                </tr>
                <tr>
                    <td>Product</td>
                    <td>
                        <select class="form-select mb-3 col" name="product_id" aria-label=".form-select-lg example">
                            <?php
                            include 'config/database.php';
                            $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR1: Record ID not found.');
                            $proquery = "SELECT name, id, price FROM products ORDER BY id ASC";
                            $proselect = "SELECT name, id, price FROM products INNER JOIN order_detail ON products.id = order_detail.product_id WHERE order_detail.order_detail_id = $id";
                            $prostmt = $con->prepare($proquery);
                            $proselectstmt = $con->prepare($proselect);
                            $prostmt->execute();
                            $proselectstmt->execute();
                            $num = $proselectstmt->rowCount();
                            if ($num > 0) {
                                $proselectrow = $proselectstmt->fetch(PDO::FETCH_ASSOC);
                                $proselectid = $proselectrow['id'];
                                $proselectname = $proselectrow['name'];
                                $proselectprice = $proselectrow['price'];
                                echo "<option value=' " . $proselectid . " '>" . $proselectname . " RM " . $proselectprice . "</option>";
                                while ($row = $prostmt->fetch(PDO::FETCH_ASSOC)) {
                                    $id = $row['id'];
                                    $name = $row['name'];
                                    $price = $row['price'];
                                    echo "<option value='" . $id . "'>" . $name . " RM " . $price . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Quantity</td>
                    <td><input type='number' name='quantity' value="<?php echo htmlspecialchars($quantity, ENT_QUOTES);  ?>" class='form-control' /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' name="submit" value='Save Changes' class='btn btn-primary' />
                        <a href='order_read.php' class='btn btn-danger'>Back to read order</a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>