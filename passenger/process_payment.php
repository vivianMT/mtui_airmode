<?php
include '../config/db.php';

$booking_id = $_POST['booking_id'] ?? null;
$method = $_POST['method'] ?? null;
$phone = $_POST['phone'] ?? null;
$account = $_POST['account'] ?? null;

if(!$booking_id || !$method){
die("❌ Missing payment data");
}

/* update payment */
$conn->query("
UPDATE bookings
SET payment_status='paid'
WHERE id='$booking_id'
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Payment Successful</title>

<style>
body{
margin:0;
font-family:Segoe UI;
background:#0b1220;
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
padding:30px;
border-radius:20px;
text-align:center;
}

.success{
font-size:26px;
color:#22c55e;
font-weight:bold;
margin-bottom:10px;
}

.btn{
display:inline-block;
padding:12px 20px;
background:#38bdf8;
color:black;
text-decoration:none;
border-radius:10px;
margin-top:20px;
font-weight:bold;
}
</style>

</head>

<body>

<div class="card">

<div class="success">
✅ You Have Successfully Paid
</div>

<p>
Your booking has been confirmed.
</p>

<p style="color:#22c55e;">
Status: PAID
</p>

<?php if($phone): ?>
<p>📩 SMS will be sent to: <?= $phone ?></p>
<?php endif; ?>

<a href="ticket.php?booking_id=<?= $booking_id ?>" class="btn">
Continue to Ticket Center 🎟
</a>

</div>

</body>
</html>