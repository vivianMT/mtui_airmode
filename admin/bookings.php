<?php
include '../config/db.php';

$result = $conn->query("
SELECT b.*, u.full_name, f.flight_number
FROM bookings b
JOIN users u ON b.user_id = u.id
JOIN flights f ON b.flight_id = f.id
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Bookings</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<h2>📊 All Bookings</h2>

<table border="1">
<tr>
    <th>User</th>
    <th>Flight</th>
    <th>Ticket</th>
    <th>Status</th>
    <th>Action</th>
</tr>

<?php while($b = $result->fetch_assoc()): ?>
<tr>
    <td><?= $b['full_name'] ?></td>
    <td><?= $b['flight_number'] ?></td>
    <td><?= $b['ticket_number'] ?></td>
    <td><?= $b['payment_status'] ?></td>
    <td>
        <a href="update_payment.php?id=<?= $b['id'] ?>">Mark Paid</a>
    </td>
</tr>
<?php endwhile; ?>

</table>

</body>
</html>