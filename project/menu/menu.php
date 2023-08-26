<?php
if (isset($_POST['logout'])) {
    session_destroy();
    session_unset();
    header('location:login.php');
    exit();
}
?>

<div class="page-header">
    <nav class="navbar navbar-expand-lg bg-body-tertiary px-5">
        <div class="container-fluid d-flex">
            <a class="navbar-brand" href="index.php">PcAcce E-store</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-flex flex-row-reverse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="index.php">Home</a>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Product
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="product_read.php">Read Product</a></li>
                            <li><a class="dropdown-item" href="product_create.php">Create Product</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Customer
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="customer_read.php">Read Customer</a></li>
                            <li><a class="dropdown-item" href="customer_create.php">Create Customer</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Category
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="category_read.php">Read Catogary</a></li>
                            <li><a class="dropdown-item" href="category_create.php">Create Catogary</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Order
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="order_read.php">Read Order</a></li>
                            <li><a class="dropdown-item" href="order_create.php">Create Order</a></li>
                        </ul>
                    </li>
                    <a class="nav-link" href="contact.php">Contact Us</a>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php
                            echo "<img src='uploads/{$_SESSION['user_image']}' alt='{$_SESSION['username']}' width='30px'>";
                            ?>
                        </a>
                        <ul class="dropdown-menu">
                            <form action="" method="post">
                                <input type="submit" class="btn mx-1" name="logout" value="Log out">
                            </form>
                        </ul>
                    </li>
                </div>
            </div>
        </div>
    </nav>
</div>