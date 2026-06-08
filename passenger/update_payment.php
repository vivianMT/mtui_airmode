<?php
session_start();
include '../config/db.php';

if(!isset($_POST['id'])){
die("No payment ID");
}

$id = $_POST['id'];

// update booking payment status
$conn->query("UPDATE bookings SET payment_status='paid' WHERE id='$id'");

// redirect to ticket page
header("Location: ticket.php");
exit();
?>