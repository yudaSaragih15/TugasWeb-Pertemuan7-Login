<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

function getUsers() {
    $file = 'users.json';

    if (!file_exists($file)) {
        file_put_contents($file, json_encode([]));
    }

    $data = file_get_contents($file);
    $users = json_decode($data, true);

    if (!is_array($users)) {
        return [];
    }
    
    return $users;
}

function saveUsers($users) {
    file_put_contents('users.json', json_encode($users, JSON_PRETTY_PRINT));
}

function sanitize($data) {
    return htmlspecialchars(trim($data));
}

function redirect($url) {
    header("Location: $url");
    exit;
}
?>