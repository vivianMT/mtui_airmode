<?php
session_start();
include '../config/db.php';

if(!isset($_SESSION['user_id'])){
header("Location: ../login.php");
exit();
}

$flight_id = $_GET['flight_id'];

$flight = $conn->query("SELECT * FROM flights WHERE id='$flight_id'")->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<title>Select Seat</title>
<link rel="stylesheet" href="../style.css">
</head>

<body>

<h2>💺 Select Your Seat</h2>

<div class="seat-grid">

<?php
$rows = range(1,5);
$cols = ['A','B','C','D'];

foreach($rows as $r){
foreach($cols as $c){
$seat = $r.$c;

echo "<div class='seat'>$seat</div>";
}
}
?>

</div>

<a href="booking.php?flight_id=<?= $flight_id ?>" class="btn">Continue Booking</a>

</body>
</html>