<?php

session_start();

include 'inc/config.php';
include 'inc/security.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: doctor-dashboard.php");
    exit();
}

$id = mysqli_real_escape_string($conn, $_GET['id']);

mysqli_query(
    $conn,
    "DELETE FROM appointments WHERE id='$id'"
);

header("Location: doctor-dashboard.php");
exit();

?>