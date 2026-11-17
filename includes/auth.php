<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/config.php';

const PASSWORD_MIN = 8;
const PASSWORD_MAX = 72; 

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function redirect(string $url): never
{
    header('Location: ' . $url);
    exit;
}

function csrf_token(): string
{
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf'];
}

function csrf_valid(?string $token): bool
{
    return is_string($token) && isset($_SESSION['csrf']) && hash_equals($_SESSION['csrf'], $token);
}

function current_user(): ?array
{
    return $_SESSION['user'] ?? null;
}

function home_for(string $type): string
{
    return $type === 'seller' ? 'seller.php' : 'home.php';
}

function login_page_for(string $type): string
{
    return $type === 'seller' ? 'sell.php' : 'buy.php';
}

function login_user(array $row): void
{
    session_regenerate_id(true);
    $_SESSION['user'] = [
        'id'       => (int) $row['user_id'],
        'username' => $row['username'],
        'email'    => $row['email'],
        'type'     => $row['account_type'],
    ];
    unset($_SESSION['csrf']);
}

function logout_user(): void
{
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $p = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
    }
    session_destroy();
}

function require_login(string $type): array
{
    header('Cache-Control: no-store, no-cache, must-revalidate');
    header('Pragma: no-cache');

    $user = current_user();
    if ($user === null || $user['type'] !== $type) {
        redirect(login_page_for($type));
    }
    return $user;
}

function handle_auth(string $type): array
{
    $state = [
        'mode'   => (($_GET['mode'] ?? '') === 'register') ? 'register' : 'login',
        'errors' => [],
        'old'    => [],
        'notice' => $_SESSION['notice'] ?? '',
    ];
    unset($_SESSION['notice']);

    $user = current_user();
    if ($user !== null && $user['type'] === $type) {
        redirect(home_for($type));
    }

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        return $state;
    }

    $state['mode'] = (($_POST['action'] ?? '') === 'register') ? 'register' : 'login';
    $state['old']  = [
        'identifier' => trim((string) ($_POST['identifier'] ?? '')),
        'username'   => trim((string) ($_POST['username'] ?? '')),
        'email'      => trim((string) ($_POST['email'] ?? '')),
    ];

    if (!csrf_valid($_POST['csrf'] ?? null)) {
        $state['errors'][] = 'Your session expired. Please try again.';
        return $state;
    }

    try {
        if ($state['mode'] === 'register') {
            $state['errors'] = register_user($type, $_POST);
            if (!$state['errors']) {
                $_SESSION['notice'] = 'Account created! You can now sign in.';
                redirect(login_page_for($type));
            }
        } else {
            $state['errors'] = attempt_login($type, $_POST);
            if (!$state['errors']) {
                redirect(home_for($type));
            }
        }
    } catch (PDOException $ex) {
        error_log('Fretastic DB error: ' . $ex->getMessage());
        $state['errors'][] = 'We could not reach the database. Please try again later.';
    }

    return $state;
}

function register_user(string $type, array $in): array
{
    $username = trim((string) ($in['username'] ?? ''));
    $email    = trim((string) ($in['email'] ?? ''));
    $password = (string) ($in['password'] ?? '');
    $confirm  = (string) ($in['confirm'] ?? '');
    $label    = $type === 'seller' ? 'Brand or company name' : 'Username';
    $errors   = [];

    if (!preg_match('/^[\p{L}\p{N} ._&\'-]{3,80}$/u', $username)) {
        $errors[] = "$label must be 3-80 characters (letters, numbers, spaces and . _ & ' - only).";
    }
    if (strlen($email) > 254 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    }
    if (strlen($password) < PASSWORD_MIN) {
        $errors[] = 'Password must be at least ' . PASSWORD_MIN . ' characters.';
    } elseif (strlen($password) > PASSWORD_MAX) {
        $errors[] = 'Password must be at most ' . PASSWORD_MAX . ' characters.';
    }
    if ($password !== $confirm) {
        $errors[] = 'Passwords do not match.';
    }
    if ($errors) {
        return $errors;
    }

    $pdo = db();

    $check = $pdo->prepare('SELECT username, email FROM users WHERE username = ? OR email = ?');
    $check->execute([$username, $email]);
    foreach ($check->fetchAll() as $row) {
        if (strcasecmp($row['username'], $username) === 0) {
            $errors[] = "That " . strtolower($label) . " is already taken.";
        }
        if (strcasecmp($row['email'], $email) === 0) {
            $errors[] = 'That email is already registered.';
        }
    }
    if ($errors) {
        return array_values(array_unique($errors));
    }

    try {
        $insert = $pdo->prepare(
            'INSERT INTO users (username, email, password_hash, account_type) VALUES (?, ?, ?, ?)'
        );
        $insert->execute([$username, $email, password_hash($password, PASSWORD_DEFAULT), $type]);
    } catch (PDOException $ex) {
        if ($ex->getCode() === '23000') { // duplicate (race between check and insert)
            return ['That name or email is already registered.'];
        }
        throw $ex;
    }

    return [];
}

function attempt_login(string $type, array $in): array
{
    $identifier = trim((string) ($in['identifier'] ?? ''));
    $password   = (string) ($in['password'] ?? '');

    if ($identifier === '' || $password === '') {
        return ['Please enter your ' . ($type === 'seller' ? 'brand name or email' : 'username or email') . ' and password.'];
    }

    $stmt = db()->prepare(
        'SELECT user_id, username, email, password_hash, account_type
           FROM users
          WHERE account_type = ? AND (username = ? OR email = ?)
          LIMIT 1'
    );
    $stmt->execute([$type, $identifier, $identifier]);
    $row = $stmt->fetch();

    $hash = $row['password_hash'] ?? '$2y$10$84BqTyRIodo0PxIX6x3b7O9I0ir2wo8wkiVXi/VlCaHtfvcM9DHam';
    if (!password_verify($password, $hash) || !$row) {
        return ['Incorrect login details. Please check and try again.'];
    }

    if (password_needs_rehash($row['password_hash'], PASSWORD_DEFAULT)) {
        db()->prepare('UPDATE users SET password_hash = ? WHERE user_id = ?')
            ->execute([password_hash($password, PASSWORD_DEFAULT), $row['user_id']]);
    }

    login_user($row);
    return [];
}
