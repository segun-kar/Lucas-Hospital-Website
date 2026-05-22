<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

include 'inc/config.php';
include 'inc/notify-admin.php';
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Patient') {
    header("Location: login.php");
    exit();
}
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Patient') {
    header("Location: login.php");
    exit();
}
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = (int) $_SESSION['user_id'];

$doctors = mysqli_query($conn, "SELECT id, fullname FROM users WHERE role='Doctor'");

$stmtUser = mysqli_prepare($conn, "SELECT * FROM users WHERE id = ? LIMIT 1");
mysqli_stmt_bind_param($stmtUser, "i", $user_id);
mysqli_stmt_execute($stmtUser);
$userQuery = mysqli_stmt_get_result($stmtUser);
$user = mysqli_fetch_assoc($userQuery);

$fullname = $user['fullname'] ?? '';
$email = $user['email'] ?? '';
$phone = $user['phone'] ?? '';

mysqli_query($conn, "
CREATE TABLE IF NOT EXISTS appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    doctor_id INT DEFAULT NULL,
    fullname VARCHAR(255),
    email VARCHAR(255),
    phone VARCHAR(50),
    doctor_name VARCHAR(255),
    department VARCHAR(255),
    appointment_date DATE,
    appointment_time TIME,
    status VARCHAR(100) DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)
");

$success = "";

if (isset($_POST['book_appointment'])) {
    $doctor_id = (int) $_POST['doctor_id'];
    $department = trim($_POST['department']);
    $appointment_date = trim($_POST['appointment_date']);
    $appointment_time = trim($_POST['appointment_time']);

    $allowedDepartments = ['Cardiology', 'Neurology', 'Orthopedics', 'Pediatrics', 'Emergency'];

    if ($doctor_id <= 0 || !in_array($department, $allowedDepartments)) {
        $success = "Invalid appointment details.";
    } else {
        $stmtDoctor = mysqli_prepare($conn, "SELECT fullname FROM users WHERE id = ? AND role='Doctor' LIMIT 1");
        mysqli_stmt_bind_param($stmtDoctor, "i", $doctor_id);
        mysqli_stmt_execute($stmtDoctor);
        $doctorResult = mysqli_stmt_get_result($stmtDoctor);
        $doctor = mysqli_fetch_assoc($doctorResult);

        if ($doctor) {
            $doctor_name = $doctor['fullname'];

            $stmt = mysqli_prepare(
                $conn,
                "INSERT INTO appointments
                (user_id, doctor_id, fullname, email, phone, doctor_name, department, appointment_date, appointment_time, status)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'Pending')"
            );

            mysqli_stmt_bind_param(
                $stmt,
                "iisssssss",
                $user_id,
                $doctor_id,
                $fullname,
                $email,
                $phone,
                $doctor_name,
                $department,
                $appointment_date,
                $appointment_time
            );

            mysqli_stmt_execute($stmt);

            notifyAdmins(
                $conn,
                "New Appointment Booked",
                "$fullname booked an appointment with Dr. $doctor_name.",
                "Appointment"
            );

            $stmtNotify = mysqli_prepare(
                $conn,
                "INSERT INTO notifications (user_id, title, message, type) VALUES (?, ?, ?, ?)"
            );
            $title = "New Appointment Request";
            $msg = "$fullname booked an appointment with you.";
            $type = "Appointment";
            mysqli_stmt_bind_param($stmtNotify, "isss", $doctor_id, $title, $msg, $type);
            mysqli_stmt_execute($stmtNotify);

            $success = "Appointment booked successfully.";
        } else {
            $success = "Selected doctor was not found.";
        }
    }
}

$stmtAppt = mysqli_prepare($conn, "SELECT * FROM appointments WHERE user_id = ? ORDER BY id DESC");
mysqli_stmt_bind_param($stmtAppt, "i", $user_id);
mysqli_stmt_execute($stmtAppt);
$appointments = mysqli_stmt_get_result($stmtAppt);
?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Appointments | Serah Hospital</title>

<script src="https://cdn.tailwindcss.com"></script>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

body {

    background:
    linear-gradient(
        135deg,
        #020617,
        #0f172a,
        #111827
    );

}

.glass {

    background: rgba(255,255,255,0.06);

    backdrop-filter: blur(18px);

    border: 1px solid rgba(255,255,255,0.08);

}

.input {

    background: rgba(255,255,255,0.05);

    border: 1px solid rgba(255,255,255,0.1);

    color: white;

}

.input:focus {

    outline: none;

    border-color: #06b6d4;

}

</style>

</head>

<body class="text-white min-h-screen">

<div class="flex">

    <!-- Sidebar -->
    <aside class="w-80 min-h-screen glass p-8">

        <div class="flex items-center gap-4 mb-14">

            <div class="w-16 h-16 rounded-3xl bg-gradient-to-r from-cyan-500 to-teal-500 flex items-center justify-center text-3xl shadow-2xl">

                <i class="fa-solid fa-calendar-check"></i>

            </div>

            <div>

                <h1 class="text-3xl font-black">
                    Appointments
                </h1>

                <p class="text-cyan-200">
                    Patient Booking
                </p>

            </div>

        </div>

        <nav class="space-y-4">

            <a href="patient-dashboard.php"
               class="flex items-center gap-4 px-6 py-5 rounded-2xl hover:bg-white/10 transition">

                <i class="fa-solid fa-arrow-left"></i>
                Dashboard

            </a>

        </nav>

    </aside>

    <!-- Main -->
    <main class="flex-1 p-10">

        <!-- Header -->
        <div class="mb-12">

            <h1 class="text-5xl font-black mb-3">
                Book Appointment
            </h1>

            <p class="text-slate-300 text-lg">
                Schedule consultation with hospital specialists
            </p>

        </div>

        <!-- Success -->
        <?php if ($success) { ?>

            <div class="bg-emerald-500/20 border border-emerald-400 text-emerald-200 p-5 rounded-2xl mb-8">

                <?php echo $success; ?>

            </div>

        <?php } ?>

        <!-- Booking Form -->
        <div class="glass rounded-3xl p-10 mb-12">

            <form method="POST"
                  class="grid md:grid-cols-2 gap-8">

                <!-- Doctor -->
                <!-- Doctor -->
<div>

    <label class="block mb-3 font-semibold">
        Select Doctor
    </label>

    <select name="doctor_id"
            required
            class="input w-full px-5 py-4 rounded-2xl">

        <option value="">Select Doctor</option>

        <?php while($doctor = mysqli_fetch_assoc($doctors)){ ?>

            <option value="<?php echo $doctor['id']; ?>">

                Dr. <?php echo $doctor['fullname']; ?>

            </option>

        <?php } ?>

    </select>

</div>

                <!-- Department -->
                <div>

                    <label class="block mb-3 font-semibold">
                        Department
                    </label>

                    <select name="department"
                            required
                            class="input w-full px-5 py-4 rounded-2xl">

                        <option value="">Select Department</option>

                        <option>Cardiology</option>
                        <option>Neurology</option>
                        <option>Orthopedics</option>
                        <option>Pediatrics</option>
                        <option>Emergency</option>

                    </select>

                </div>

                <!-- Date -->
                <div>

                    <label class="block mb-3 font-semibold">
                        Appointment Date
                    </label>

                    <input type="date"
                           name="appointment_date"
                           required
                           class="input w-full px-5 py-4 rounded-2xl">

                </div>

                <!-- Time -->
                <div>

                    <label class="block mb-3 font-semibold">
                        Appointment Time
                    </label>

                    <input type="time"
                           name="appointment_time"
                           required
                           class="input w-full px-5 py-4 rounded-2xl">

                </div>

                <!-- Button -->
                <div class="md:col-span-2">

                    <button type="submit"
                            name="book_appointment"
                            class="bg-gradient-to-r from-cyan-500 to-teal-500 hover:scale-105 transition transform px-10 py-5 rounded-2xl text-lg font-bold shadow-2xl">

                        Book Appointment

                    </button>

                </div>

            </form>

        </div>

        <!-- Appointment History -->
        <div class="glass rounded-3xl p-10">

            <h2 class="text-3xl font-black mb-8">
                Appointment History
            </h2>

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead>

                        <tr class="border-b border-white/10">

                            <th class="text-left py-4">
                                Doctor
                            </th>

                            <th class="text-left py-4">
                                Department
                            </th>

                            <th class="text-left py-4">
                                Date
                            </th>

                            <th class="text-left py-4">
                                Time
                            </th>

                            <th class="text-left py-4">
                                Status
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php while($row = mysqli_fetch_assoc($appointments)) { ?>

                        <tr class="border-b border-white/5">

                            <td class="py-5">
                                Dr. <?php echo $row['doctor_name']; ?>
                            </td>

                            <td class="py-5">
                                <?php echo $row['department']; ?>
                            </td>

                            <td class="py-5">
                                <?php echo $row['appointment_date']; ?>
                            </td>

                            <td class="py-5">
                                <?php echo $row['appointment_time']; ?>
                            </td>

                            <td class="py-5">

                                <span class="bg-cyan-500/20 text-cyan-300 px-4 py-2 rounded-full">

                                    <?php echo $row['status']; ?>

                                </span>

                            </td>

                        </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </main>

</div>

</body>

</html>