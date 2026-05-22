<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* SECURE SESSION */
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);

/* REGENERATE SESSION */
if (!isset($_SESSION['created'])) {

    session_regenerate_id(true);

    $_SESSION['created'] = time();
}

/* AUTO LOGOUT AFTER 30 MINUTES */
if (isset($_SESSION['LAST_ACTIVITY']) &&
   (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {

    session_unset();
    session_destroy();

    header("Location: login.php");
    exit();
}

$_SESSION['LAST_ACTIVITY'] = time();

/* PREVENT XSS */
function clean($data)
{
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}
?>