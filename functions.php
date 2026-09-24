<?php
// 1. Pengaturan Error (Berguna untuk melihat error saat proses belajar)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 2. Memulai Session (Wajib untuk sistem login)
session_start();

// 3. Fungsi untuk membaca data dari file JSON
function getUsers() {
    $file = 'users.json';
    
    // Jika file belum ada, buat file baru berisi array kosong
    if (!file_exists($file)) {
        file_put_contents($file, json_encode([]));
    }
    
    // Baca isi file
    $data = file_get_contents($file);
    $users = json_decode($data, true);
    
    // PENGAMAN: Jika file JSON kosong atau rusak, kembalikan array kosong
    if (!is_array($users)) {
        return [];
    }
    
    return $users;
}

// 4. Fungsi untuk menyimpan data ke file JSON
function saveUsers($users) {
    // JSON_PRETTY_PRINT membuat format JSON rapi saat dibuka di text editor
    file_put_contents('users.json', json_encode($users, JSON_PRETTY_PRINT));
}

// 5. Fungsi Sanitasi Input (Mencegah XSS)
function sanitize($data) {
    return htmlspecialchars(trim($data));
}

// 6. Fungsi Redirect (Pindah halaman)
function redirect($url) {
    header("Location: $url");
    exit;
}
?>