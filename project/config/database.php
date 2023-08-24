<?php
// used to connect to the database
$host = "localhost";
$db_name = "yuhanyuan0802";
$username = "yuhanyuan0802";
$password = "3_2q7Ay.ici/8nFT";
$db = mysqli_connect('localhost', 'yuhanyuan0802', '3_2q7Ay.ici/8nFT', 'yuhanyuan0802');
try {
    date_default_timezone_set('Asia/Kuala_Lumpur');
    $con = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // show error
    // echo "Connected successfully"; 
}
// show error
catch (PDOException $exception) {
    echo "Connection error: " . $exception->getMessage();
}
