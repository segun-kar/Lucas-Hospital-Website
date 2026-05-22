<?php

session_start();

include 'inc/config.php';
include 'inc/security.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

$appointmentQuery = mysqli_query(
    $conn,
    "SELECT * FROM appointments WHERE id='$id'"
);

$appointment = mysqli_fetch_assoc($appointmentQuery);

if (isset($_POST['update'])) {

    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $appointment_date = mysqli_real_escape_string($conn, $_POST['appointment_date']);
    $appointment_time = mysqli_real_escape_string($conn, $_POST['appointment_time']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    mysqli_query(
        $conn,
        "UPDATE appointments SET
        fullname='$fullname',
        email='$email',
        department='$department',
        appointment_date='$appointment_date',
        appointment_time='$appointment_time',
        status='$status'
        WHERE id='$id'"
    );

    header("Location: doctor-dashboard.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Appointment</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 min-h-screen p-10">

    <div class="max-w-3xl mx-auto bg-white p-10 rounded-3xl shadow-lg">

        <h1 class="text-4xl font-bold mb-8 text-slate-800">
            Edit Appointment
        </h1>

        <form method="POST" class="space-y-6">

            <input type="text" name="fullname"
                   value="<?php echo $appointment['fullname']; ?>"
                   class="w-full border px-5 py-4 rounded-xl"
                   placeholder="Patient Name">

            <input type="email" name="email"
                   value="<?php echo $appointment['email']; ?>"
                   class="w-full border px-5 py-4 rounded-xl"
                   placeholder="Patient Email">

            <input type="text" name="department"
                   value="<?php echo $appointment['department']; ?>"
                   class="w-full border px-5 py-4 rounded-xl"
                   placeholder="Department">

            <input type="date" name="appointment_date"
                   value="<?php echo $appointment['appointment_date']; ?>"
                   class="w-full border px-5 py-4 rounded-xl">

            <input type="time" name="appointment_time"
                   value="<?php echo $appointment['appointment_time']; ?>"
                   class="w-full border px-5 py-4 rounded-xl">

            <select name="status"
                    class="w-full border px-5 py-4 rounded-xl">

                <option <?php if($appointment['status']=="Pending") echo "selected"; ?>>
                    Pending
                </option>

                <option <?php if($appointment['status']=="Approved") echo "selected"; ?>>
                    Approved
                </option>

                <option <?php if($appointment['status']=="Rejected") echo "selected"; ?>>
                    Rejected
                </option>

            </select>

            <button type="submit" name="update"
                    class="bg-cyan-600 text-white px-8 py-4 rounded-xl font-bold">
                Update Appointment
            </button>

            <a href="doctor-dashboard.php"
               class="ml-4 text-gray-600">
                Cancel
            </a>

        </form>

    </div>

</body>
</html>