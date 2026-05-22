<?php

function createNotification(
    $conn,
    $user_id,
    $title,
    $message,
    $type = "General"
) {
    // Ensure table exists (create if missing)
    $check = mysqli_query($conn, "SHOW TABLES LIKE 'notifications'");

    if (!$check || mysqli_num_rows($check) == 0) {
        $createSql = "CREATE TABLE IF NOT EXISTS notifications (
            id INT UNSIGNED NOT NULL AUTO_INCREMENT,
            user_id INT UNSIGNED DEFAULT NULL,
            title VARCHAR(255) DEFAULT NULL,
            message TEXT DEFAULT NULL,
            type VARCHAR(100) DEFAULT 'General',
            status VARCHAR(20) DEFAULT 'Unread',
            created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            INDEX (user_id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

        if (!mysqli_query($conn, $createSql)) {
            error_log('Failed to create notifications table: ' . mysqli_error($conn));
            return false;
        }
    }

    // Escape inputs and insert
    $title = mysqli_real_escape_string($conn, $title);
    $message = mysqli_real_escape_string($conn, $message);
    $type = mysqli_real_escape_string($conn, $type);

    $sql = "INSERT INTO notifications (user_id, title, message, type, status)
            VALUES ('$user_id', '$title', '$message', '$type', 'Unread')";

    if (!mysqli_query($conn, $sql)) {
        error_log('Failed to insert notification: ' . mysqli_error($conn));
        return false;
    }

    return true;

}
?>
?>