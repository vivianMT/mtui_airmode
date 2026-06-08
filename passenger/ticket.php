<?php  
include '../config/db.php';  

$booking_id = $_GET['booking_id'] ?? null;  

if(!$booking_id){  
die("❌ No ticket selected");  
}  

$q = $conn->query("  
SELECT b.*, f.origin, f.destination, f.flight_number, f.departure_date, f.departure_time  
FROM bookings b  
JOIN flights f ON b.flight_id = f.id  
WHERE b.id='$booking_id' AND b.payment_status='paid'  
");  

if(!$q || $q->num_rows == 0){  
die("❌ Ticket not found or not paid yet");  
}  

$data = $q->fetch_assoc();  
?>  

<!DOCTYPE html>  
<html>  
<head>  
<title>My Ticket</title>  

<style>  
body{  
margin:0;  
font-family:Segoe UI;  
background:#0b1220;  
color:white;  
padding:30px;  
}  

.container{  
max-width:900px;  
margin:auto;  
}  

.card{  
background:rgba(255,255,255,0.08);  
padding:25px;  
border-radius:20px;  
margin-bottom:20px;  
backdrop-filter:blur(10px);  
}  

h2{  
color:#38bdf8;  
}  

.ticket{  
display:flex;  
flex-wrap:wrap;  
gap:10px;  
}  

.box{  
flex:1;  
min-width:200px;  
background:#1e293b;  
padding:10px;  
border-radius:10px;  
}  

.status{  
color:#22c55e;  
font-weight:bold;  
}  

input, select{  
width:100%;  
padding:10px;  
margin:8px 0;  
border:none;  
border-radius:8px;  
}  

.btn{  
display:inline-block;  
padding:10px 15px;  
background:#38bdf8;  
color:black;  
text-decoration:none;  
border-radius:10px;  
margin-top:10px;  
font-weight:bold;  
cursor:pointer;  
border:none;  
}  

.note{  
background:#1e293b;  
padding:10px;  
border-radius:10px;  
margin-top:8px;  
}  

.offer{  
color:#22c55e;  
font-weight:bold;  
}  
</style>  

<script>
function downloadTicket(){
alert("🎉 Congratulations! You have downloaded the ticket successfully.");
}
</script>

</head>  

<body>  

<div class="container">  

<!-- TICKET INFO -->  
<div class="card">  

<h2>🎟 My Flight Ticket</h2>  

<p>Status: <span class="status">PAID ✔</span></p>  

<div class="ticket">  

<div class="box">  
<strong>Flight No</strong><br>  
<?= $data['flight_number'] ?>  
</div>  

<div class="box">  
<strong>Route</strong><br>  
<?= $data['origin'] ?> → <?= $data['destination'] ?>  
</div>  

<div class="box">  
<strong>Date</strong><br>  
<?= $data['departure_date'] ?>  
</div>  

<div class="box">  
<strong>Time</strong><br>  
<?= $data['departure_time'] ?>  
</div>  

</div>  
</div>  

<!-- RECEIVE TICKET -->  
<div class="card">  

<h2>📩 Receive Your Ticket</h2>  

<form onsubmit="downloadTicket(); return false;">  

<input type="text" placeholder="Enter Phone Number (SMS Ticket)">  
<input type="email" placeholder="Enter Email Address">  

<select>  
<option>Download Ticket Only</option>  
<option>Download + SMS</option>  
<option>Download + Email</option>  
</select>  

<button class="btn" type="submit">⬇ Download Ticket</button>  

</form>  

<p class="note">🎉 Congratulations! You have downloaded the ticket successfully.</p>  

</div>  

<!-- TRAVEL RULES -->  
<div class="card">  

<h2>⚠ Important Travel Information</h2>  

<div class="note">✈ Arrive at airport at least <b>2 hours before departure</b>.</div>  
<div class="note">🧳 Baggage: <b>23kg checked + 7kg hand luggage</b>.</div>  
<div class="note">🆔 Carry valid ID or Passport.</div>  
<div class="note">📴 Phone must be on airplane mode during flight.</div>  

</div>  

<!-- EARLY BOOKING OFFER -->  
<div class="card">  

<h2>🔥 Special Discount Offer</h2>  

<p class="offer">
Book your flight 7–30 days early and get up to <b>15% discount</b> on selected flights.
</p>  

</div>  

<!-- EXTRA SERVICES THANK YOU -->  
<div class="card">  

<h2>🏨 Extra Services</h2>  


<div class="note">🏨 Hotel booking available at destination</div>  
<div class="note">🚗 Car rental available on arrival</div>  
<div class="note">🛬 Airport pickup available 24/7</div>  
<p>🙏 Thank you for choosing <b>MTUI AIRMODE</b>.</p>  
</div>  

</div>  

</body>  
</html>