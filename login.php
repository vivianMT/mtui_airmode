<?php
session_start();
include 'config/db.php';

$error = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

$email = $_POST['email'];
$password = $_POST['password'];

$result = $conn->query("SELECT * FROM users WHERE email='$email'");

if($result->num_rows > 0){

$user = $result->fetch_assoc();

if(password_verify($password, $user['password'])){

$_SESSION['user_id'] = $user['id'];
$_SESSION['name'] = $user['full_name'];
$_SESSION['role'] = $user['role'];

/* ALL USERS GO TO INDEX */
header("Location: index.php");
exit();

}else{
$error = "❌ Wrong password";
}

}else{
$error = "❌ User not found";
}

}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
</head>

<body style="background:#0b1220;color:white;font-family:Segoe UI;display:flex;justify-content:center;align-items:center;height:100vh;">

<div style="width:350px;background:rgba(255,255,255,0.08);padding:25px;border-radius:15px;">

<h2 style="text-align:center;">✈ Login</h2>

<form method="POST">

<input type="email" name="email" placeholder="Email" required style="width:100%;padding:10px;margin:10px 0;">
<input type="password" name="password" placeholder="Password" required style="width:100%;padding:10px;margin:10px 0;">

<button style="width:100%;padding:10px;background:#22c55e;border:none;border-radius:8px;">Login</button>

</form>

<p style="color:red;text-align:center;"><?= $error ?></p>

<p style="text-align:center;">
No account? <a href="register.php" style="color:#38bdf8;">Register</a>
</p>

</div>

</body>
</html>