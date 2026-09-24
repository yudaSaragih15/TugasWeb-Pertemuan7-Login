<?php
session_start();

// Hapus semua variabel session
session_unset();

// Hancurkan session
session_destroy();

// Alihkan (redirect) pengguna kembali ke halaman login
header("Location: login.php");
exit;
?>