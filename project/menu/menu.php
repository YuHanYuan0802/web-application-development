    <div class="page-header">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid d-flex">
                <a class="navbar-brand" href="#">Project</a>
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
                                <li><a class="dropdown-item" href="order_summary.php">Order Summary</a></li>
                                <li><a class="dropdown-item" href="#">Order Details</a></li>
                            </ul>
                        </li>
                        <a class="nav-link" href="contact.php">Contact Us</a>
                        <?php 
                        session_destroy();
                        echo "<a class='nav-link' href='login.php'>Log out</a>";
                        ?>
                    </div>
                </div>
            </div>
        </nav>
    </div>