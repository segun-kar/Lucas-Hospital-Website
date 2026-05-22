<?php

session_start();
include 'inc/config.php';
include 'inc/security.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id']) && isset($_GET['status'])) {

    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $status = mysqli_real_escape_string($conn, $_GET['status']);

    mysqli_query(
        $conn,
        "UPDATE appointments SET status='$status' WHERE id='$id'"
    );

    $appointmentQuery = mysqli_query(
        $conn,
        "SELECT * FROM appointments WHERE id='$id'"
    );

    $appointment = mysqli_fetch_assoc($appointmentQuery);

    if ($appointment) {

        $patient_id = $appointment['user_id'];
        $doctor_name = $appointment['doctor_name'];
        $appointment_date = $appointment['appointment_date'];
        $appointment_time = $appointment['appointment_time'];

        mysqli_query(
            $conn,
            "INSERT INTO notifications
            (user_id, title, message, type, status)
            VALUES
            (
                '$patient_id',
                'Appointment $status',
                'Your appointment with Dr. $doctor_name on $appointment_date at $appointment_time has been $status.',
                'Appointment',
                'Unread'
            )"
        );
    }
}

header("Location: doctor-dashboard.php");
exit();

?>