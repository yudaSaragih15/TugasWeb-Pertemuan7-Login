<?php
require 'functions.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitasi input (Req 9)
    $name = sanitize($_POST['name']);
    $email = sanitize($_POST['email']);
    $password = $_POST['password']; // Password jangan di-sanitize htmlspecialchars, nanti berubah

    // Validasi kosong
    if (empty($name) || empty($email) || empty($password)) {
        $error = "Semua field harus diisi!";
    } 
    // Validasi email (Req 2)
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Format email tidak valid!";
    } 
    else {
        $users = getUsers();
        
        // Cek duplikasi email (Req 5)
        $emailExists = false;
        foreach ($users as $user) {
            if ($user['email'] === $email) {
                $emailExists = true;
                break;
            }
        }

        if ($emailExists) {
            $error = "Email sudah terdaftar!";
        } else {
            // Hash password (Req 3)
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            
            // Tambah user baru
            $users[] = [
                'name' => $name,
                'email' => $email,
                'password' => $hashedPassword
            ];
            
            // Simpan ke JSON (Req 4)
            saveUsers($users);
            $success = "Registrasi berhasil! Silakan login.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Register</title>
    <!-- Tambahkan CSS sederhana di sini untuk nilai Bonus -->
</head>
<body>
    <h2>Form Registrasi</h2>
    <?php if($error): ?><p style="color:red;"><?= $error; ?></p><?php endif; ?>
    <?php if($success): ?><p style="color:green;"><?= $success; ?></p><?php endif; ?>

    <form method="POST">
        <label>Nama:</label><br>
        <input type="text" name="name" required><br><br>
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        <button type="submit">Daftar</button>
    </form>
    <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
</body>
</html>