<?php
include '../config/db.php';

$booking_id = $_GET['booking_id'] ?? null;

if(!$booking_id){
die("❌ No booking selected");
}

$q = $conn->query("
SELECT b.*, f.origin, f.destination, f.flight_number
FROM bookings b
JOIN flights f ON b.flight_id = f.id
WHERE b.id='$booking_id'
");

if(!$q || $q->num_rows == 0){
die("❌ Booking not found");
}

$data = $q->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<title>Payment Center</title>

<style>
body{
margin:0;
font-family:Segoe UI;
background:linear-gradient(135deg,#0b1220,#111827);
display:flex;
justify-content:center;
align-items:center;
height:100vh;
color:white;
}

.card{
width:450px;
background:rgba(255,255,255,0.08);
backdrop-filter:blur(15px);
padding:25px;
border-radius:18px;
}

h2{text-align:center;color:#38bdf8;}

label{font-size:13px;opacity:0.8;}

input, select{
width:100%;
padding:10px;
margin:8px 0 12px 0;
border:none;
border-radius:8px;
outline:none;
}

.btn{
width:100%;
padding:12px;
background:#22c55e;
border:none;
border-radius:10px;
font-weight:bold;
cursor:pointer;
}

.route{
text-align:center;
margin-bottom:10px;
color:#38bdf8;
}
.amount{
text-align:center;
margin-bottom:15px;
color:#22c55e;
font-size:20px;
font-weight:bold;
}
</style>

</head>

<body>

<div class="card">

<h2>💳 Payment Center</h2>

<div class="route">
✈ <?= $data['origin'] ?> → <?= $data['destination'] ?>
</div>

<div class="amount">
💰 <?= $data['total_amount'] ?> TZS
</div>

<form method="POST" action="process_payment.php">

<input type="hidden" name="booking_id" value="<?= $data['id'] ?>">

<label>Payment Method</label>
<select name="method" required>
<option value="">Select Method</option>
<option value="mpesa">M-Pesa</option>
<option value="tigo">Tigo Pesa</option>
<option value="airtel">Airtel Money</option>
<option value="halopesa">HaloPesa</option>
<option value="bank">Bank Transfer</option>
<option value="card">Visa/Mastercard</option>
</select>

<label>Phone (for mobile money)</label>
<input type="text" name="phone" placeholder="07xxxxxxxx">

<label>Bank / Card Number (optional)</label>
<input type="text" name="account" placeholder="Account or Card Number">

<button class="btn" type="submit">
Pay & Confirm
</button>

</form>

</div>

</body>
</html>