<?php
session_start();
if (empty($_SESSION['username'])) {
    echo '<script>alert("Please Login to continue!!");';
    sleep(1);
    echo 'window.location.href="login.php";';
    echo '</script>';
}