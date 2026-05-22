<?php
// Simple PDO helper. Copy and set your credentials or export env vars.
// Usage: require_once __DIR__.'/db.php'; then use $pdo (PDO instance) if available.

// Try to read config from environment first, then fallback to defaults.
$dbHost = getenv('DB_HOST') ?: '127.0.0.1';
$dbName = getenv('DB_NAME') ?: 'healthcare';
$dbUser = getenv('DB_USER') ?: 'root';
$dbPass = getenv('DB_PASS') ?: '';
$dbCharset = 'utf8mb4';

try {
    $dsn = "mysql:host={$dbHost};dbname={$dbName};charset={$dbCharset}";
    $pdo = new PDO($dsn, $dbUser, $dbPass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (Exception $e) {
    // If connection fails, leave $pdo undefined and let the app fall back to non-DB behavior.
    $pdo = null;
}
