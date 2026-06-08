<?php
include '../config/db.php';

if(!isset($_GET['flight_id'])){
die("❌ No flight selected");
}

$flight_id = $_GET['flight_id'];

$q = $conn->query("SELECT * FROM flights WHERE id='$flight_id'");
if($q->num_rows == 0){
die("❌ Flight not found");
}

$f = $q->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<title>Confirm Booking</title>

<style>
body{
margin:0;
font-family:Segoe UI;
background:linear-gradient(135deg,#0b1220,#111827);
color:white;
display:flex;
justify-content:center;
align-items:center;
height:100vh;
}

.card{
width:380px;
background:rgba(255,255,255,0.08);
backdrop-filter:blur(15px);
padding:25px;
border-radius:18px;
border:1px solid rgba(255,255,255,0.1);
box-shadow:0 10px 30px rgba(0,0,0,0.5);
text-align:center;
}

.route{
font-size:22px;
font-weight:bold;
color:#38bdf8;
margin-bottom:10px;
}

.info{
font-size:14px;
opacity:0.9;
line-height:1.8;
}

.price{
font-size:20px;
margin:15px 0;
color:#22c55e;
font-weight:bold;
}

.btn{
background:#38bdf8;
border:none;
padding:12px 18px;
border-radius:12px;
font-weight:bold;
cursor:pointer;
width:100%;
transition:0.3s;
}

.btn:hover{
background:#0ea5e9;
transform:scale(1.03);
}
</style>

</head>

<body>

<div class="card">

<div class="route">
✈ <?= $f['origin'] ?> → <?= $f['destination'] ?>
</div>

<div class="info">
Flight: <b><?= $f['flight_number'] ?></b><br>
Date: <?= $f['departure_date'] ?><br>
Time: <?= $f['departure_time'] ?><br>
Seats: <?= $f['seats_available'] ?>
</div>

<div class="price">
💰 <?= $f['price_economy'] ?> TZS
</div>

<form method="POST" action="process_booking.php">
<input type="hidden" name="flight_id" value="<?= $f['id'] ?>">
<button class="btn">Confirm Booking</button>
</form>

</div>

</body>
</html>