<?php
include '../config/db.php';

if(!isset($_GET['id'])){
    die("Invalid request");
}

$id = $_GET['id'];

// update payment status to paid
$conn->query("UPDATE bookings SET payment_status='paid' WHERE id='$id'");

header("Location: bookings.php");
exit();
?>