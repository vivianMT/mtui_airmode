<?php
include("../config/db.php");

$result = mysqli_query($conn, "SELECT * FROM flights");
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Flights</title>
</head>
<body>

<h2>Flights List</h2>

<table border="1">

<tr>
<th>ID</th>
<th>Flight</th>
<th>Origin</th>
<th>Destination</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['flight_number']; ?></td>
<td><?php echo $row['origin']; ?></td>
<td><?php echo $row['destination']; ?></td>
</tr>

<?php } ?>

</table>

</body>
</html>