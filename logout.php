<?php
session_start();

session_unset();
session_destroy();

// Kita set waktu kadaluarsanya menjadi masa lalu (time() - 3600) agar browser menghapusnya
if (isset($_COOKIE['remember_email'])) {
    setcookie('remember_email', '', time() - 3600, "/");
}

header("Location: login.php");
exit;
?>
