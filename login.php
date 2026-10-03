<?php
require 'functions.php';

// --- BONUS 2: AUTO LOGIN DENGAN COOKIE ---
if (!isset($_SESSION['user']) && isset($_COOKIE['remember_email'])) {
    $email_cookie = $_COOKIE['remember_email'];
    $users = getUsers();
    
    foreach ($users as $user) {
        if ($user['email'] === $email_cookie) {
            $_SESSION['user'] = [
                'name' => $user['name'],
                'email' => $user['email']
            ];
            redirect('dashboard.php');
        }
    }
}

// Jika sudah login, langsung lempar ke dashboard
if (isset($_SESSION['user'])) {
    redirect('dashboard.php');
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = sanitize($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $error = "Email dan Password harus diisi!";
    } else {
        $users = getUsers();
        $loggedIn = false;

        foreach ($users as $user) {
            if ($user['email'] === $email && password_verify($password, $user['password'])) {
                $_SESSION['user'] = [
                    'name' => $user['name'],
                    'email' => $user['email']
                ];
                $loggedIn = true;

                // --- BONUS 2: SET COOKIE JIKA CENTANG REMEMBER ME ---
                if (isset($_POST['remember'])) {
                    // Cookie berlaku 30 hari (86400 detik * 30)
                    setcookie('remember_email', $email, time() + (86400 * 30), "/");
                }
                break;
            }
        }

        if ($loggedIn) {
            redirect('dashboard.php');
        } else {
            $error = "Email atau Password salah!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Tugas Rutin 7</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Form Login</h2>
        
        <?php if(!empty($error)): ?>
            <div class="error"><?= $error; ?></div>
        <?php endif; ?>

        <form method="POST">
            <label>Email</label>
            <input type="email" name="email" required>
            
            <label>Password</label>
            <input type="password" name="password" required>
            
            <div style="margin-bottom: 15px; display: flex; align-items: center;">
                <input type="checkbox" name="remember" id="remember" style="width: auto; margin: 0 8px 0 0;">
                <label for="remember" style="font-weight: normal; margin: 0; cursor: pointer;">Remember Me (30 Hari)</label>
            </div>
            
            <button type="submit">Login</button>
        </form>
        
        <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
    </div>
</body>
</html>