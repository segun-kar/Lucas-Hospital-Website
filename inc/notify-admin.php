<?php

function notifyAdmins($conn, $title, $message, $type) {

    $admins = mysqli_query(
        $conn,
        "SELECT id FROM users WHERE role='Admin'"
    );

    while ($admin = mysqli_fetch_assoc($admins)) {

        $admin_id = $admin['id'];

        mysqli_query(
            $conn,
            "INSERT INTO notifications
            (user_id, title, message, type, status)
            VALUES
            (
                '$admin_id',
                '$title',
                '$message',
                '$type',
                'Unread'
            )"
        );
    }
}

?>