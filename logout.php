<?php
session_start();

// Hapus session
session_unset();
session_destroy();

// --- BONUS 2: HAPUS COOKIE REMEMBER ME SAAT LOGOUT ---
// Kita set waktu kadaluarsanya menjadi masa lalu (time() - 3600) agar browser menghapusnya
if (isset($_COOKIE['remember_email'])) {
    setcookie('remember_email', '', time() - 3600, "/");
}

// Redirect ke halaman login
header("Location: login.php");
exit;
?>