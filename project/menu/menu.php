<?php
if (isset($_POST['logout'])) {
    session_destroy();
    session_unset();
    header('location:login.php');
    exit();
}
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid align-items-baseline">
        <div>
            <a class="navbar-brand" href="index.php">PcAcce E-store</a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="index.php">Home</a>
                </li>
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
            </ul>
        </div>
    </div>
</nav>