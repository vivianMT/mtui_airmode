<?php
session_start();
include '../config/db.php';

$user_id = $_SESSION['user_id'];
$flight_id = $_POST['flight_id'];

$flight = $conn->query("SELECT * FROM flights WHERE id='$flight_id'")->fetch_assoc();

if(!$flight){
die("Invalid flight");
}

$ticket = "MTUI-".rand(10000,99999);

$conn->query("
INSERT INTO bookings (user_id, flight_id, ticket_number, total_amount, payment_status)
VALUES ('$user_id','$flight_id','$ticket','".$flight['price_economy']."','pending')
");

$booking_id = $conn->insert_id;

header("Location: payment.php?booking_id=$booking_id");
exit();
?>