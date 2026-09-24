<?php
require 'functions.php';

// Proteksi halaman: jika belum login, tendang kembali ke halaman login
if (!isset($_SESSION['user'])) {
    redirect('login.php');
}

// Ambil data user dari session
$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Tugas Rutin 7</title>
</head>
<body>
    <h2>Selamat Datang, <?= htmlspecialchars($user['name']); ?>!</h2>
    <p>Anda berhasil login dengan email: <?= htmlspecialchars($user['email']); ?></p>
    
    <br>
    <a href="logout.php">Logout</a>
</body>
</html>