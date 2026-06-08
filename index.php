<?php
session_start();
include 'config/db.php';

/* LOGIN CHECK */
if(!isset($_SESSION['user_id'])){
?>
<!DOCTYPE html>
<html>
<head>
<title>MTUI AIRMODE - Login</title>

<style>
body{
margin:0;
font-family:Segoe UI;
background:#0b1220;
color:white;
display:flex;
justify-content:center;
align-items:center;
height:100vh;
}

.box{
width:350px;
background:rgba(255,255,255,0.08);
padding:25px;
border-radius:20px;
backdrop-filter:blur(10px);
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
background:#38bdf8;
border:none;
border-radius:8px;
font-weight:bold;
cursor:pointer;
}
</style>

</head>
<body>

<div class="box">
<h2>✈ MTUI AIRMODE</h2>

<form method="POST" action="login.php">
<input type="text" name="username" placeholder="Username" required>
<input type="password" name="password" placeholder="Password" required>
<button>Login</button>
</form>

</div>

</body>
</html>
<?php exit(); } ?>

<!DOCTYPE html>
<html>
<head>
<title>Flights</title>

<style>
body{
margin:0;
font-family:Segoe UI;
background:#0b1220;
color:white;
}

.header{
padding:20px;
text-align:center;
background:#111827;
}

.search{
display:flex;
gap:10px;
flex-wrap:wrap;
padding:20px;
max-width:1100px;
margin:auto;
}

.search select, .search input, .search button{
padding:10px;
border:none;
border-radius:8px;
}

.search select, .search input{
flex:1;
}

.search button{
background:#22c55e;
font-weight:bold;
cursor:pointer;
}

.container{
max-width:1100px;
margin:auto;
padding:20px;
}

.card{
background:rgba(255,255,255,0.08);
padding:15px;
border-radius:15px;
margin-bottom:15px;
display:flex;
justify-content:space-between;
align-items:center;
}

.price{
color:#22c55e;
font-weight:bold;
font-size:18px;
}

.btn{
padding:10px 15px;
background:#38bdf8;
border-radius:8px;
color:black;
text-decoration:none;
font-weight:bold;
}
</style>

</head>

<body>

<div class="header">
<h2>✈ Available Flights</h2>
</div>

<!-- SEARCH -->
<form class="search" method="GET">

<select name="from" required>
<option value="">✈ From</option>
<option>Dar es Salaam</option>
<option>Mwanza</option>
<option>Arusha</option>
<option>Dodoma</option>
<option>Mbeya</option>
<option>Zanzibar</option>
<option>Kilimanjaro</option>
</select>

<select name="to" required>
<option value="">🛬 To</option>
<option>Dar es Salaam</option>
<option>Mwanza</option>
<option>Arusha</option>
<option>Dodoma</option>
<option>Mbeya</option>
<option>Zanzibar</option>
<option>Kilimanjaro</option>
</select>

<input type="date" name="date">

<button type="submit">Search Flights</button>

</form>

<div class="container">

<?php

$where = "1=1";

if(!empty($_GET['from'])){
$from = $_GET['from'];
$where .= " AND origin='$from'";
}

if(!empty($_GET['to'])){
$to = $_GET['to'];
$where .= " AND destination='$to'";
}

if(!empty($_GET['date'])){
$date = $_GET['date'];
$where .= " AND departure_date='$date'";
}

/* IMPORTANT: ensure price exists in DB */
$flights = $conn->query("
SELECT id, origin, destination, flight_number, departure_date, departure_time, price
FROM flights
WHERE $where
ORDER BY id DESC
");

while($f = $flights->fetch_assoc()){
?>

<div class="card">

<div>
<strong><?= $f['origin'] ?> → <?= $f['destination'] ?></strong><br>
✈ <?= $f['flight_number'] ?><br>
📅 <?= $f['departure_date'] ?> | ⏰ <?= $f['departure_time'] ?><br>
</div>

<div class="price">
💰 <?= $f['price'] ?> TZS
</div>

<a class="btn" href="passenger/booking.php?flight_id=<?= $f['id'] ?>">
Book Now
</a>

</div>

<?php } ?>

</div>

</body>
</html>