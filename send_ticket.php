<?php
session_start();

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
exit();
}

echo "📧 Ticket sent to your email successfully (simulation)";
?>