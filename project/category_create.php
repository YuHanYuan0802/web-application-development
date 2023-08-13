<?php 
include 'config/validate_login.php';
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Create Category</title>
    <!-- Latest compiled and minified Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <!-- container -->
    <div class="container">
        <?php 
        include 'menu/menu.php';
        ?>

        <!-- html form to create product will be here -->
        <!-- PHP insert code will be here -->
        <?php
        if ($_POST) {
            // include database connection
            include 'config/database.php';
            try {
                // insert query
                $query = "INSERT INTO category SET category_name=:category_name, description=:description";
                // prepare query for execution
                $stmt = $con->prepare($query);
                $reset = "ALTER TABLE products AUTO_INCREMENT = 1";
                $resetquery = $con->prepare($reset);
                $category_name = $_POST['category_name'];
                $description = $_POST['description'];
                // bind the parameters
                $stmt->bindParam(':category_name', $category_name);
                $stmt->bindParam(':description', $description);
                // Execute the query
                $errormessage = array();

                if (empty($category_name)) {
                    $errormessage[] = "Please fill in category_name" . "<br>";
                }
                if (empty($description)) {
                    $errormessage[] = "Please fill in your description" . "<br>";
                }
                if (!empty($errormessage)) {
                    echo "<div class = 'alert alert-danger'>";
                    foreach ($errormessage as $displayerrormessage) {
                        echo $displayerrormessage;
                    }
                    echo "</div>";
                } else if ($stmt->execute()) {
                    echo "<div class='alert alert-success'>Record saved.</div>";
                    $_POST = array();
                } else {
                    echo "<div class='alert alert-danger'>Unable to save record.</div>";
                    $resetquery->execute();
                }
            }
            // show error
            catch (PDOException $exception) {
                if ($exception->getCode() == 23000) {
                    echo "<div class = 'alert alert-danger'>";
                    echo "Category name have taken, please enter other category name";
                    echo "</div>";
                    $resetquery->execute();
                } else {
                    echo "<div class = 'alert alert-danger'>";
                    echo $exception->getMessage();
                    echo "</div>";
                    $resetquery->execute();
                }
            }
        }
        ?>

        <!-- html form here where the product information will be entered -->
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <td>Category Name</td>
                    <td><input type='text' name='category_name' class='form-control' value="<?php echo isset($_POST["category_name"]) ? $_POST["category_name"] : "" ?>" /></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td><textarea name='description' class='form-control' value="<?php echo isset($_POST["description"]) ? $_POST["description"] : "" ?>"></textarea></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Submit' class='btn btn-primary' />
                        
                    </td>
                </tr>
            </table>
        </form>

    </div>
    <!-- end .container -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>