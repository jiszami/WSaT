<?php
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Pragma: no-cache');

$user = current_user();

if ($user !== null && $user['type'] === 'buyer') {
    echo json_encode([
        'loggedIn' => true,
        'username' => $user['username'],
        'email'    => $user['email'],
    ]);
} else {
    echo json_encode(['loggedIn' => false]);
}