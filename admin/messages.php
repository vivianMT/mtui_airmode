<?php
include("../config/db.php");

$result = mysqli_query($conn,"
SELECT messages.*, users.full_name
FROM messages
JOIN users ON messages.user_id = users.id
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Messages</title>
</head>
<body>

<h2>Customer Messages</h2>

<table border="1">

<tr>
<th>Passenger</th>
<th>Subject</th>
<th>Message</th>
<th>Status</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>
<td><?php echo $row['full_name']; ?></td>
<td><?php echo $row['subject']; ?></td>
<td><?php echo $row['message_content']; ?></td>
<td><?php echo $row['status']; ?></td>
</tr>

<?php } ?>

</table>

</body>
</html>