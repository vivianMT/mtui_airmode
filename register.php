<?php
include 'config/db.php';

$error = "";
$success = "";

/* HIDE PHP WARNINGS FROM UI */
error_reporting(0);
ini_set('display_errors', 0);

if($_SERVER["REQUEST_METHOD"] == "POST"){

$full_name = $_POST['full_name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$role = "user";

/* CHECK USER */
$check = $conn->query("SELECT * FROM users WHERE email='$email'");

if($check->num_rows > 0){
$error = "❌ Email already exists";
}else{

$conn->query("
INSERT INTO users (full_name, email, password, role)
VALUES ('$full_name', '$email', '$password', '$role')
");

$success = "✔ Account created successfully. Please login.";
}

}
?>

<!DOCTYPE html>
<html>
<head>
<title>MTUI AIRMODE Register</title>

<style>
body{
margin:0;
font-family:Segoe UI;
background:linear-gradient(135deg,#0b1220,#1e293b);
color:white;
}

/* BIG HEADER */
.header{
text-align:center;
font-size:32px;
font-weight:bold;
padding:25px;
color:#38bdf8;
letter-spacing:3px;
}

/* CENTER AREA */
.wrapper{
display:flex;
justify-content:center;
align-items:center;
height:70vh;
}

/* REGISTER BOX */
.box{
width:380px;
background:rgba(255,255,255,0.08);
padding:25px;
border-radius:18px;
backdrop-filter:blur(12px);
box-shadow:0 0 20px rgba(0,0,0,0.4);
}

input{
width:100%;
padding:12px;
margin:10px 0;
border:none;
border-radius:8px;
outline:none;
}

button{
width:100%;
padding:12px;
background:#22c55e;
border:none;
border-radius:8px;
font-weight:bold;
cursor:pointer;
color:black;
}

/* MESSAGES INSIDE BOX ONLY */
.msg{
text-align:center;
margin-top:10px;
}

.error{
color:#ff4d4d;
}

.success{
color:#22c55e;
}

/* FOOTER */
.footer{
text-align:center;
padding:20px;
margin-top:10px;
background:rgba(0,0,0,0.4);
color:#cbd5e1;
}
</style>

</head>

<body>

<!-- HEADER -->
<div class="header">
✈ MTUI_AIRMODE
</div>

<!-- CENTER BOX -->
<div class="wrapper">

<div class="box">

<h2 style="text-align:center;color:#38bdf8;">Create Account</h2>

<form method="POST">

<input type="text" name="full_name" placeholder="Full Name" required>
<input type="email" name="email" placeholder="Email" required>
<input type="password" name="password" placeholder="Password" required>

<button type="submit">Register</button>

</form>

<!-- MESSAGES INSIDE BOX ONLY -->
<div class="msg">
<?php if($error){ ?>
<p class="error"><?= $error ?></p>
<?php } ?>

<?php if($success){ ?>
<p class="success"><?= $success ?></p>
<?php } ?>
</div>

<p style="text-align:center;margin-top:10px;">
Already have account? <a href="login.php" style="color:#38bdf8;">Login</a>
</p>

</div>

</div>

<!-- FOOTER -->
<div class="footer">
📞 +255 700 000 111 | 📧 support@mtuiairmode.com | ✈ 24/7 Support
</div>

</body>
</html>