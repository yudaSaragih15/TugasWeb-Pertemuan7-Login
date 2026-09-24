<?php
require 'functions.php';

// Jika sudah login, langsung lempar ke dashboard
if (isset($_SESSION['user'])) {
    redirect('dashboard.php');
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitasi input email
    $email = sanitize($_POST['email']);
    $password = $_POST['password']; // Password tidak di-sanitize htmlspecialchars

    // Validasi kosong
    if (empty($email) || empty($password)) {
        $error = "Email dan Password harus diisi!";
    } else {
        $users = getUsers();
        $loggedIn = false;

        // Looping untuk mencari user yang cocok
        foreach ($users as $user) {
            // Verifikasi email dan password
            if ($user['email'] === $email && password_verify($password, $user['password'])) {
                // Set session
                $_SESSION['user'] = [
                    'name' => $user['name'],
                    'email' => $user['email']
                ];
                $loggedIn = true;
                break;
            }
        }

        // Jika berhasil login
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
</head>
<body>
    <h2>Form Login</h2>
    
    <!-- Menampilkan pesan error jika ada -->
    <?php if(!empty($error)): ?>
        <p style="color:red;"><?= $error; ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>
        
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        
        <button type="submit">Login</button>
    </form>
    
    <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
</body>
</html>