<?php
include '../config/db.php';

$flights = $conn->query("SELECT * FROM flights WHERE status='scheduled'");
?>

<!DOCTYPE html>
<html>
<head>
<title>Flights</title>
</head>
<body>

<h2>Available Flights</h2>

<?php while($f = $flights->fetch_assoc()): ?>

<div style="border:1px solid #ccc; padding:10px; margin:10px;">

<b><?= $f['flight_number'] ?></b><br>
<?= $f['origin'] ?> → <?= $f['destination'] ?><br>
💰 <?= $f['price_economy'] ?><br>

<a href="booking.php?flight_id=<?= $f['id'] ?>">
Book Now
</a>

</div>

<?php endwhile; ?>

</body>
</html>