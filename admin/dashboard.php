<?php
include '../config/db.php';
session_start();

/* SIMPLE SECURITY CHECK */
if(!isset($_SESSION['role']) || $_SESSION['role'] != "admin"){
header("Location: ../login.php");
exit();
}

/* COUNTS */
$flights = $conn->query("SELECT COUNT(*) as total FROM flights")->fetch_assoc();
$bookings = $conn->query("SELECT COUNT(*) as total FROM bookings")->fetch_assoc();
$users = $conn->query("SELECT COUNT(*) as total FROM users")->fetch_assoc();

/* RECENT BOOKINGS */
$recent = $conn->query("
SELECT b.*, f.origin, f.destination, f.flight_number
FROM bookings b
JOIN flights f ON b.flight_id = f.id
ORDER BY b.id DESC LIMIT 5
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard - MTUI AIRMODE</title>

<style>
body{
margin:0;
font-family:Segoe UI;
background:#0b1220;
color:white;
}

/* HEADER */
.header{
background:#111827;
padding:20px;
text-align:center;
font-size:24px;
color:#38bdf8;
font-weight:bold;
}

/* CONTAINER */
.container{
padding:20px;
max-width:1100px;
margin:auto;
}

/* CARDS */
.cards{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
gap:15px;
margin-bottom:20px;
}

.card{
background:rgba(255,255,255,0.08);
padding:20px;
border-radius:15px;
text-align:center;
backdrop-filter:blur(10px);
}

.card h3{
margin:0;
color:#38bdf8;
}

/* FORM */
.form-box{
background:rgba(255,255,255,0.08);
padding:20px;
border-radius:15px;
margin-bottom:20px;
}

input{
width:100%;
padding:10px;
margin:8px 0;
border:none;
border-radius:8px;
}

button{
width:100%;
padding:10px;
background:#22c55e;
border:none;
border-radius:8px;
font-weight:bold;
cursor:pointer;
}

/* TABLE */
table{
width:100%;
border-collapse:collapse;
margin-top:10px;
}

th, td{
padding:10px;
border-bottom:1px solid rgba(255,255,255,0.1);
text-align:left;
}

th{
color:#38bdf8;
}
</style>

</head>

<body>

<div class="header">
✈ MTUI AIRMODE ADMIN PANEL
</div>

<div class="container">

<!-- STATS -->
<div class="cards">

<div class="card">
<h3><?= $flights['total'] ?></h3>
<p>Flights</p>
</div>

<div class="card">
<h3><?= $bookings['total'] ?></h3>
<p>Bookings</p>
</div>

<div class="card">
<h3><?= $users['total'] ?></h3>
<p>Users</p>
</div>

</div>

<!-- ADD FLIGHT -->
<div class="form-box">

<h3 style="color:#38bdf8;">➕ Add Flight</h3>

<form method="POST" action="add_flight.php">

<input type="text" name="origin" placeholder="From (e.g Dar es Salaam)" required>
<input type="text" name="destination" placeholder="To (e.g Nairobi)" required>
<input type="text" name="flight_number" placeholder="Flight Number" required>
<input type="date" name="departure_date" required>
<input type="time" name="departure_time" required>
<input type="number" name="price" placeholder="Price (TZS)" required>

<button type="submit">Add Flight</button>

</form>

</div>

<!-- RECENT BOOKINGS -->
<div class="form-box">

<h3 style="color:#38bdf8;">📋 Recent Bookings</h3>

<table>
<tr>
<th>Flight</th>
<th>Route</th>
<th>Status</th>
</tr>

<?php while($b = $recent->fetch_assoc()){ ?>
<tr>
<td><?= $b['flight_number'] ?></td>
<td><?= $b['origin'] ?> → <?= $b['destination'] ?></td>
<td style="color:#22c55e;">Paid</td>
</tr>
<?php } ?>

</table>

</div>

</div>

</body>
</html>