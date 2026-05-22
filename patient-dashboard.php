<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

include 'inc/config.php';
include 'inc/security.php';
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Patient') {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['user_id'])) {

    header("Location: login.php");
    exit();

}

$user_id = $_SESSION['user_id'];
$unreadNotifications = mysqli_num_rows(
    mysqli_query(
        $conn,
        "SELECT * FROM notifications
         WHERE user_id='$user_id'
         AND status='Unread'"
    )
);
$notifications = mysqli_query(
    $conn,
    "SELECT * FROM notifications
     WHERE user_id='$user_id'
     ORDER BY id DESC"
);

mysqli_query(
    $conn,
    "UPDATE notifications
     SET status='Read'
     WHERE user_id='$user_id'
     AND status='Unread'"
);
/*
|--------------------------------------------------------------------------
| SAFE QUERY FUNCTION
|--------------------------------------------------------------------------
*/

function safeCount($conn, $query)
{
    $result = mysqli_query($conn, $query);

    if ($result) {

        return mysqli_num_rows($result);

    }

    return 0;
}

/*
|--------------------------------------------------------------------------
| FETCH USER
|--------------------------------------------------------------------------
*/

$userQuery = mysqli_query(
    $conn,
    "SELECT * FROM users WHERE id='$user_id'"
);

$user = mysqli_fetch_assoc($userQuery);

/*
|--------------------------------------------------------------------------
| SAFE COUNTS
|--------------------------------------------------------------------------
*/

$totalAppointments = safeCount(
    $conn,
    "SELECT * FROM appointments WHERE user_id='$user_id'"
);

$totalPrescriptions = safeCount(
    $conn,
    "SELECT * FROM prescriptions WHERE patient_email='".$user['email']."'"
);

$totalRecords = safeCount(
    $conn,
    "SELECT * FROM medical_records WHERE patient_email='".$user['email']."'"
);

$totalNotifications = safeCount(
    $conn,
    "SELECT * FROM notifications WHERE user_id='$user_id' AND status='Unread'"
);
$profileImage = !empty($patient['profile_image'])
    ? $admin['profile_image']
    : "uploads/profile/default.png";
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Patient Dashboard | Lucas Hospital</title>

<script src="https://cdn.tailwindcss.com"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

    backdrop-filter: blur(20px);

    border: 1px solid rgba(255,255,255,0.08);

}

.card-hover {

    transition: 0.4s;

}

.card-hover:hover {

    transform: translateY(-8px);

}

</style>

</head>

<body class="text-white min-h-screen">
<button onclick="toggleSidebar()"
class="lg:hidden fixed top-4 right-4 z-50
bg-cyan-600 text-white
w-12 h-12 rounded-xl shadow-lg">

    <i class="fa-solid fa-bars"></i>

</button>
<div class="flex flex-col lg:flex-row">

    <!-- Sidebar -->
    <aside id="sidebar"
class="fixed lg:static top-0 left-0 z-40
w-72 h-screen lg:h-auto
bg-slate-900 text-white
transform -translate-x-full lg:translate-x-0
transition-transform duration-300
overflow-y-auto">

        <!-- Logo -->
        <div class="flex items-center gap-4 mb-14">

            <div class="w-16 h-16 rounded-3xl bg-gradient-to-r from-cyan-500 to-teal-500 flex items-center justify-center text-3xl shadow-2xl">

                <i class="fa-solid fa-heart-pulse"></i>

            </div>

            <div>

                <h1 class="text-3xl font-black">
                    Lucas Hospital
                </h1>

                <p class="text-cyan-200">
                    Patient Portal
                </p>

            </div>

        </div>

<!-- Patient Profile -->
<div class="glass rounded-3xl p-8 text-center mb-10">

    <?php
    $profileImage = !empty($user['profile_image'])
        ? $user['profile_image']
        : "uploads/profile/default.png";
    ?>

    <img src="<?php echo $profileImage; ?>"
         class="w-32 h-32 rounded-full object-cover mx-auto border-4 border-cyan-500 shadow-2xl">

    <h2 class="text-2xl font-bold mt-6">
        <?php echo $user['fullname']; ?>
    </h2>

    <p class="text-cyan-200 mt-2">
        Healthcare Member
    </p>

</div>

        <!-- Navigation -->
        <nav class="space-y-4">

            <a href="#"
               class="flex items-center gap-4 px-6 py-5 rounded-2xl bg-gradient-to-r from-cyan-500 to-teal-500 shadow-xl font-bold">

                <i class="fa-solid fa-chart-line"></i>
                Dashboard

            </a>

            <a href="appointments.php"
               class="flex items-center gap-4 px-6 py-5 rounded-2xl hover:bg-white/10 transition">

                <i class="fa-solid fa-calendar-check"></i>
                Appointments

            </a>

            <a href="patient-medical-records.php"
               class="flex items-center gap-4 px-6 py-5 rounded-2xl hover:bg-white/10 transition">

                <i class="fa-solid fa-notes-medical"></i>
                Medical Records

            </a>
<a href="patient-prescriptions.php"
   class="flex items-center gap-4 px-6 py-5 rounded-2xl hover:bg-white/10 transition">

    <i class="fa-solid fa-prescription-bottle-medical"></i>
    Prescriptions

</a>
<a href="notifications.php"
   class="relative flex items-center gap-4 px-6 py-5 rounded-2xl hover:bg-white/10 transition">

    <i class="fa-solid fa-bell"></i>
    Notifications

    <?php if ($unreadNotifications > 0) { ?>

        <span class="absolute right-4 top-3 min-w-6 h-6 bg-red-500 text-white text-xs font-bold rounded-full flex items-center justify-center px-2">

            <?php echo $unreadNotifications; ?>

        </span>

    <?php } ?>
</a>
            <a href="settings.php"
                   class="flex items-center gap-4 hover:bg-slate-800 px-5 py-4 rounded-2xl transition">

                    <i class="fa-solid fa-gear"></i>
                    Settings

                </a>
            <a href="logout-success.php"
               class="flex items-center gap-4 px-6 py-5 rounded-2xl hover:bg-red-500/20 transition text-red-300">

                <i class="fa-solid fa-right-from-bracket"></i>
                Logout

            </a>

        </nav>

    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-10">

        <!-- Header -->
        <div class="flex items-center justify-between mb-12">

            <div>

                <h1 class="text-5xl font-black mb-3">
                    Welcome Back
                </h1>

                <p class="text-slate-300 text-lg">
                    Monitor your health and appointments
                </p>

            </div>

            <div class="glass px-8 py-5 rounded-2xl">

                <p class="text-cyan-200">
                    <?php echo date("l, d F Y"); ?>
                </p>

            </div>

        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">

            <!-- Appointments -->
            <div class="glass rounded-3xl p-8 card-hover">

                <div class="flex items-center justify-between mb-8">

                    <div class="w-16 h-16 rounded-2xl bg-cyan-500/20 flex items-center justify-center text-cyan-400 text-3xl">

                        <i class="fa-solid fa-calendar-check"></i>

                    </div>

                </div>

                <h2 class="text-5xl font-black">
                    <?php echo $totalAppointments; ?>
                </h2>

                <p class="text-cyan-200 mt-3">
                    Appointments
                </p>

            </div>

            <!-- Prescriptions -->
            <div class="glass rounded-3xl p-8 card-hover">

                <div class="flex items-center justify-between mb-8">

                    <div class="w-16 h-16 rounded-2xl bg-emerald-500/20 flex items-center justify-center text-emerald-400 text-3xl">

                        <i class="fa-solid fa-file-medical"></i>

                    </div>

                </div>

                <h2 class="text-5xl font-black">
                    <?php echo $totalPrescriptions; ?>
                </h2>

                <p class="text-emerald-200 mt-3">
                    Prescriptions
                </p>

            </div>

            <!-- Records -->
            <div class="glass rounded-3xl p-8 card-hover">

                <div class="flex items-center justify-between mb-8">

                    <div class="w-16 h-16 rounded-2xl bg-purple-500/20 flex items-center justify-center text-purple-400 text-3xl">

                        <i class="fa-solid fa-notes-medical"></i>

                    </div>

                </div>

                <h2 class="text-5xl font-black">
                    <?php echo $totalRecords; ?>
                </h2>

                <p class="text-purple-200 mt-3">
                    Medical Records
                </p>

            </div>

            <!-- Notifications -->
            <div class="glass rounded-3xl p-8 card-hover">

                <div class="flex items-center justify-between mb-8">

                    <div class="w-16 h-16 rounded-2xl bg-red-500/20 flex items-center justify-center text-red-400 text-3xl">

                        <i class="fa-solid fa-bell"></i>

                    </div>

                </div>

                <h2 class="text-5xl font-black">
                    <?php echo $totalNotifications; ?>
                </h2>

                <p class="text-red-200 mt-3">
                    Notifications
                </p>

            </div>

        </div>

        <!-- Charts -->
        <div class="grid lg:grid-cols-2 gap-8">

            <!-- Health Progress -->
            <div class="glass rounded-3xl p-8">

                <h2 class="text-2xl font-bold mb-8">
                    Health Progress
                </h2>

                <canvas id="healthChart"></canvas>

            </div>

            <!-- Wellness -->
            <div class="glass rounded-3xl p-8">

                <h2 class="text-2xl font-bold mb-8">
                    Wellness Score
                </h2>

                <canvas id="wellnessChart"></canvas>

            </div>

        </div>

    </main>

</div>

<script>

const healthCtx =
document.getElementById('healthChart');

new Chart(healthCtx, {

    type: 'line',

    data: {

        labels: [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'May',
            'Jun'
        ],

        datasets: [{

            label: 'Health Score',

            data: [
                60,
                65,
                70,
                78,
                85,
                92
            ],

            borderColor: '#06b6d4',

            backgroundColor:
            'rgba(6,182,212,0.1)',

            tension: 0.4,

            fill: true

        }]

    }

});

const wellnessCtx =
document.getElementById('wellnessChart');

new Chart(wellnessCtx, {

    type: 'doughnut',

    data: {

        labels: [
            'Fitness',
            'Sleep',
            'Nutrition',
            'Heart'
        ],

        datasets: [{

            data: [
                80,
                75,
                85,
                90
            ],

            backgroundColor: [
                '#06b6d4',
                '#10b981',
                '#8b5cf6',
                '#f59e0b'
            ]

        }]

    }

});

</script>
<script>

function toggleSidebar() {

    const sidebar =
    document.getElementById('sidebar');

    sidebar.classList.toggle('-translate-x-full');

}

</script>
</body>

</html>