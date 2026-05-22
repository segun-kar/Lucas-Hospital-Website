<?php
// Simple auth helpers. For demo only — replace with real user store for production.
if (session_status() === PHP_SESSION_NONE) session_start();

// Try to load PDO helper if available
if (file_exists(__DIR__ . '/db.php')) {
    require_once __DIR__ . '/db.php';
}

function is_logged_in(): bool {
    return !empty($_SESSION['user']);
}

function current_user(): ?array {
    return $_SESSION['user'] ?? null;
}

function login_user(string $username, string $password): bool {
    // If PDO is available, try to verify against `admins` table
    global $pdo;
    if (!empty($pdo)) {
        $stmt = $pdo->prepare('SELECT id, username, password FROM admins WHERE username = :u LIMIT 1');
        $stmt->execute(['u' => $username]);
        $row = $stmt->fetch();
        if ($row && password_verify($password, $row['password'])) {
            $_SESSION['user'] = ['id' => $row['id'], 'username' => $row['username']];
            return true;
        }
        return false;
    }

    // Fallback: hardcoded demo credentials
    if ($username === 'admin' && $password === 'password') {
        $_SESSION['user'] = ['username' => 'admin'];
        return true;
    }
    return false;
}

function logout_user(): void {
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params['path'], $params['domain'], $params['secure'], $params['httponly']
        );
    }
    session_destroy();
}

/**
 * Helper to create an admin user (use from a secure script).
 * Returns the new admin id on success, false on failure.
 */
function create_admin(string $username, string $password, ?string $email = null) {
    global $pdo;
    if (empty($pdo)) return false;
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $pdo->prepare('INSERT INTO admins (username, password, email) VALUES (:u, :p, :e)');
    try {
        $stmt->execute(['u' => $username, 'p' => $hash, 'e' => $email]);
        return (int)$pdo->lastInsertId();
    } catch (Exception $e) {
        return false;
    }
}
