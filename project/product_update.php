<?php
include 'config/validate_login.php';
$_SESSION['image'] = "product";
?>

<!DOCTYPE HTML>
<html>

<head>
    <title>Update product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- custom css →
    <style>
       .m-r-1em{ margin-right:1em; }
       .m-b-1em{ margin-bottom:1em; }
       .m-l-1em{ margin-left:1em; }
       .mt0{ margin-top:0; }
    </style>-->
</head>

<body>
    <!-- container -->
    <div class="container">
        <div class="page-header">
            <?php
            include 'menu/menu.php';
            ?>
            <p>Update Product</p>
        </div>
        <!-- PHP read record by ID will be here -->
        <?php
        // get passed parameter value, in this case, the record ID
        // isset() is a PHP function used to verify if a value is there or not
        $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

        //include database connection
        include 'config/database.php';

        // read current record's data
        try {
            // prepare select query
            $query = "SELECT products.image, products.id, products.name, products.description, products.price, products.promote_price, category.category_id, category.category_name FROM products INNER JOIN category ON products.category_id=category.category_id WHERE id = ? LIMIT 0,1";
            $stmt = $con->prepare($query);

            // this is the first question mark
            $stmt->bindParam(1, $id);

            // execute our query
            $stmt->execute();

            // store retrieved row to a variable
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // values to fill up our form
            $name = $row['name'];
            $description = $row['description'];
            $price = $row['price'];
            $promote_price = $row['promote_price'];
            $cate_id = $row['category_id'];
            $cate_name = $row['category_name'];
            $img = $row['image'];
        }

        // show error
        catch (PDOException $exception) {
            die('ERROR: ' . $exception->getMessage());
        }
        ?>

        <!-- HTML form to update record will be here -->
        <!-- PHP post to update record will be here -->
        <?php

        // check if form was submitted
        if ($_POST) {
            include 'upload.php';
            try {
                // posted values
                $name = htmlspecialchars(strip_tags($_POST['name']));
                $description = htmlspecialchars(strip_tags($_POST['description']));
                $price = htmlspecialchars(strip_tags($_POST['price']));
                $promote_price = htmlspecialchars(strip_tags($_POST['promote_price']));
                $category = htmlspecialchars(strip_tags($_POST['category']));

                if ($promote_price >= $price) {
                    $errormessage[] = "Promote price should lower than normal price.";
                }
                if (!empty($errormessage)) {
                    foreach ($errormessage as $displayerrormessage) {
                        echo "<div class = 'alert alert-danger'>";
                        echo $displayerrormessage;
                        echo "</div>";
                    }
                } else {
                    // write update query
                    // in this case, it seemed like we have so many fields to pass and
                    // it is better to label them and not use question marks
                    if (isset($_POST['deleteimage'])) {
                        if ($img == "default_user.png" || $img == "product_image_coming_soon.jpg") {
                            //no need to delete default image
                        } else {
                            unlink('uploads/' . $img);
                            $unlinkquery = "UPDATE products SET image=:image WHERE id=:id";
                            $unlinkstmt = $con->prepare($unlinkquery);
                            $unlinkstmt->bindParam(':image', $image);
                            $unlinkstmt->bindParam(':id', $id);
                            $unlinkstmt->execute();
                        }
                    }
                    $query = "UPDATE products SET name=:name, description=:description, price=:price, promote_price=:promote_price, category_id =:category";
                    if (empty($_FILES['image']['tmp_name'])) {
                        $query .= " WHERE id=:id";
                        $stmt = $con->prepare($query);
                    } else {
                        if ($img == "default_user.png" || $img == "product_image_coming_soon.jpg") {
                            //no need to delete default image
                        } else {
                            unlink('uploads/' . $img);
                        }
                        $query .= ", image=:image WHERE id=:id";
                        $stmt = $con->prepare($query);
                        $stmt->bindParam(':image', $image);
                    }

                    // bind the parameters
                    $stmt->bindParam(':name', $name);
                    $stmt->bindParam(':description', $description);
                    $stmt->bindParam(':price', $price);
                    $stmt->bindParam(':promote_price', $promote_price);
                    $stmt->bindParam(':category', $category);
                    $stmt->bindParam(':id', $id);
                    if ($stmt->execute()) {
                        echo "<div class='alert alert-success'>Record was updated.</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
                    }
                }
            }
            // show errors
            catch (PDOException $exception) {
                echo "<div class = 'alert alert-danger'>";
                echo $exception->getMessage();
                echo "</div>";
            }
        } ?>

        <!--we have our html form here where new record information can be updated-->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}"); ?>" method="post" enctype="multipart/form-data">
            <table class='table table-hover table-responsive table-bordered'>
                <tr>
                    <td>Name</td>
                    <td><input type='text' name='name' value="<?php echo htmlspecialchars($name, ENT_QUOTES);  ?>" class='form-control' /></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td><textarea name='description' class='form-control'><?php echo htmlspecialchars($description, ENT_QUOTES);  ?></textarea></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><input type='text' name='price' value="<?php echo htmlspecialchars($price, ENT_QUOTES);  ?>" class='form-control' /></td>
                </tr>
                <tr>
                    <td>Promote Price</td>
                    <td><input type='text' name='promote_price' value="<?php echo htmlspecialchars($promote_price, ENT_QUOTES);  ?>" class='form-control' /></td>
                </tr>
                <tr>
                    <td>Category</td>
                    <td>
                        <select name='category' id="category" class="form-select">
                            <option value="<?php echo $cate_id ?>"><?php echo $cate_name ?></option>
                            <?php
                            include 'config/database.php';
                            $catequery = "SELECT category_id, category_name FROM category ORDER BY category_id ASC";
                            $catestmt = $con->prepare($catequery);
                            $catestmt->execute();
                            $num = $catestmt->rowCount();
                            if ($num > 0) {
                                $option = array();
                                while ($row = $catestmt->fetch(PDO::FETCH_ASSOC)) {
                                    $option[$row['category_id']] = $row['category_name'];
                                }
                            }
                            foreach ($option as $category_id => $category_name) {
                                echo "<option value = '" . $category_id . "'>" . $category_name . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Photo</td>
                    <td>
                        <img src="uploads/<?php echo $img ?>" alt="<?php echo $name ?>" width="100px">
                        <br>
                        <br>
                        <input type="file" name="image" />
                        <br>
                        <br>
                        <input type="submit" name="deleteimage" value="Delete Image">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Save Changes' name="submit" class='btn btn-primary' />
                        <a href='product_read.php' class='btn btn-danger'>Back to read products</a>
                    </td>
                </tr>
            </table>
        </form>

    </div>
    <!-- end .container -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>