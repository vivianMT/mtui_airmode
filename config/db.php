<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mtui_airmode_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// echo "Database Connected Successfully";

?>