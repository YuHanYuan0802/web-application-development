<?php
session_start();
if (empty($_SESSION['username'])) {
    echo '<script>alert("Please Login to continue!!");';
    echo 'window.location.href="login.php";';
    echo '</script>';
}
?>