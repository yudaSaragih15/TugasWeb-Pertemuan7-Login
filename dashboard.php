<?php
require 'functions.php';

if (!isset($_SESSION['user'])) {
    redirect('login.php');
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Tugas Rutin 7</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container dashboard-box">
        <h2>Selamat Datang! 🎉</h2>
        <p>Halo, <strong><?= htmlspecialchars($user['name']); ?></strong></p>
        <p>Anda berhasil login dengan email: <br> <em><?= htmlspecialchars($user['email']); ?></em></p>
        
        <br><br>
        <a href="logout.php" style="display: inline-block; padding: 10px 20px; background: #dc3545; color: white; border-radius: 5px; text-decoration: none;">Logout</a>
    </div>
</body>
</html>