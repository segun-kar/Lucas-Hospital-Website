<?php

session_start();

include 'inc/config.php';
include 'inc/security.php';
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['user_id']) || strtolower($_SESSION['role'] ?? '') !== 'admin') {
    header("Location: login.php");
    exit();
}

$user_id = (int) $_SESSION['user_id'];

$stmtAdmin = mysqli_prepare($conn, "SELECT * FROM users WHERE id = ? LIMIT 1");
mysqli_stmt_bind_param($stmtAdmin, "i", $user_id);
mysqli_stmt_execute($stmtAdmin);
$adminQuery = mysqli_stmt_get_result($stmtAdmin);
$admin = mysqli_fetch_assoc($adminQuery);

$profileImage = !empty($admin['profile_image'])
    ? $admin['profile_image']
    : "uploads/profile/default.png";

$stmtUnread = mysqli_prepare(
    $conn,
    "SELECT id FROM notifications WHERE user_id = ? AND status='Unread'"
);
mysqli_stmt_bind_param($stmtUnread, "i", $user_id);
mysqli_stmt_execute($stmtUnread);
$unreadNotifications = mysqli_num_rows(mysqli_stmt_get_result($stmtUnread));
$getEmergency = mysqli_query(
$conn,
"SELECT COUNT(*) as total
 FROM emergency_requests
 WHERE status='Pending'"
);

$emergencyData = mysqli_fetch_assoc($getEmergency);

$emergencyCount = $emergencyData['total'];
$pendingEmergency = mysqli_num_rows(
    mysqli_query(
        $conn,
        "SELECT id FROM emergency_requests WHERE status='Pending'"
    )
);

/*
|--------------------------------------------------------------------------
| TOTAL COUNTS
|--------------------------------------------------------------------------
*/

$patients = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM users WHERE role='Patient'"));
$doctors = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM users WHERE role='Doctor'"));
$admins = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM users WHERE role='Admin'"));
$appointments = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM appointments"));
$records = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM medical_records"));
$prescriptions = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM prescriptions"));
$messages = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM contact_messages"));

?>


<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Admin Dashboard</title>

<script src="https://cdn.tailwindcss.com"></script>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

    background: rgba(255,255,255,0.05);

    backdrop-filter: blur(18px);

    border: 1px solid rgba(255,255,255,0.08);

}

.card-hover {

    transition: 0.4s;

}

.card-hover:hover {

    transform: translateY(-10px);

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

    <!-- SIDEBAR -->
    <aside id="sidebar"
class="fixed lg:static top-0 left-0 z-40
w-72 h-screen lg:h-auto
bg-slate-900 text-white
transform -translate-x-full lg:translate-x-0
transition-transform duration-300
overflow-y-auto">

        <!-- LOGO -->
        <div class="flex items-center gap-4 mb-14">

            <div class="w-16 h-16 rounded-3xl bg-gradient-to-r from-cyan-500 to-teal-500 flex items-center justify-center text-3xl shadow-2xl">

                <i class="fa-solid fa-hospital"></i>

            </div>

            <div>

                <h1 class="text-3xl font-black">
                    Admin Panel
                </h1>

                <p class="text-cyan-200">
                    Lucas Hospital
                </p>

            </div>

        </div>
        <div class="glass rounded-3xl p-6 text-center mb-8">

    <img src="<?php echo $profileImage; ?>"
         class="w-24 h-24 rounded-full object-cover mx-auto border-4 border-cyan-500 shadow-2xl">

    <h2 class="text-xl font-bold mt-4">
        <?php echo $admin['fullname']; ?>
    </h2>

    <p class="text-cyan-200 text-sm">
        Administrator
    </p>

</div>
        <!-- MENU -->
        <nav class="space-y-4">

            <a href="admin-dashboard.php"
               class="flex items-center gap-4 px-6 py-5 rounded-2xl bg-gradient-to-r from-cyan-500 to-teal-500 font-bold shadow-xl">

                <i class="fa-solid fa-chart-line"></i>
                Dashboard

            </a>

    <a href="admin-users.php"
   class="flex items-center gap-4 px-6 py-5 rounded-2xl hover:bg-white/10 transition">
    <i class="fa-solid fa-users-gear"></i>
    Manage Users
</a>

<a href="admin-appointments.php"
   class="flex items-center gap-4 px-6 py-5 rounded-2xl hover:bg-white/10 transition">
    <i class="fa-solid fa-calendar-check"></i>
    Manage Appointments
</a>

<a href="admin-prescriptions.php"
   class="flex items-center gap-4 px-6 py-5 rounded-2xl hover:bg-white/10 transition">
    <i class="fa-solid fa-prescription-bottle-medical"></i>
    Prescriptions
</a>

<a href="admin-medical-records.php"
   class="flex items-center gap-4 px-6 py-5 rounded-2xl hover:bg-white/10 transition">
    <i class="fa-solid fa-notes-medical"></i>
    Medical Records
</a>

<a href="admin-emergency.php"
   class="relative flex items-center gap-4 px-6 py-5 rounded-2xl hover:bg-red-500/20 transition text-red-300">
    <i class="fa-solid fa-truck-medical"></i>
    Emergency Requests

    <?php if ($pendingEmergency > 0) { ?>
        <span class="absolute right-4 top-3 min-w-6 h-6 bg-red-600 text-white text-xs font-bold rounded-full flex items-center justify-center px-2">
            <?php echo $pendingEmergency; ?>
        </span>
    <?php } ?>
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
            <a href="admin-messages.php"
               class="flex items-center gap-4 px-6 py-5 rounded-2xl hover:bg-white/10 transition">

                <i class="fa-solid fa-envelope"></i>
                Messages

            </a>
            <a href="settings.php"
   class="flex items-center gap-4 px-6 py-5 rounded-2xl hover:bg-white/10 transition">
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

    <!-- MAIN -->
    <main class="flex-1 p-10">

        <!-- HEADER -->
        <div class="mb-12">

            <h1 class="text-6xl font-black mb-4">

                Hospital Analytics Dashboard

            </h1>

            <p class="text-slate-300 text-xl">

                Monitor healthcare operations and hospital performance

            </p>

        </div>

        <!-- STATISTICS -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">

            <!-- Patients -->
            <div class="glass rounded-[35px] p-8 card-hover">

                <div class="flex items-center justify-between mb-6">

                    <div class="w-20 h-20 rounded-3xl bg-cyan-500/20 flex items-center justify-center text-cyan-400 text-4xl">

                        <i class="fa-solid fa-user-injured"></i>

                    </div>

                    <span class="text-5xl font-black">

                        <?php echo $patients; ?>

                    </span>

                </div>

                <h3 class="text-2xl font-bold">
                    Patients
                </h3>

            </div>

            <!-- Doctors -->
            <div class="glass rounded-[35px] p-8 card-hover">

                <div class="flex items-center justify-between mb-6">

                    <div class="w-20 h-20 rounded-3xl bg-emerald-500/20 flex items-center justify-center text-emerald-400 text-4xl">

                        <i class="fa-solid fa-user-doctor"></i>

                    </div>

                    <span class="text-5xl font-black">

                        <?php echo $doctors; ?>

                    </span>

                </div>

                <h3 class="text-2xl font-bold">
                    Doctors
                </h3>

            </div>

            <!-- Appointments -->
            <div class="glass rounded-[35px] p-8 card-hover">

                <div class="flex items-center justify-between mb-6">

                    <div class="w-20 h-20 rounded-3xl bg-purple-500/20 flex items-center justify-center text-purple-400 text-4xl">

                        <i class="fa-solid fa-calendar-check"></i>

                    </div>

                    <span class="text-5xl font-black">

                        <?php echo $appointments; ?>

                    </span>

                </div>

                <h3 class="text-2xl font-bold">
                    Appointments
                </h3>

            </div>

            <!-- Prescriptions -->
            <div class="glass rounded-[35px] p-8 card-hover">

                <div class="flex items-center justify-between mb-6">

                    <div class="w-20 h-20 rounded-3xl bg-red-500/20 flex items-center justify-center text-red-400 text-4xl">

                        <i class="fa-solid fa-prescription-bottle-medical"></i>

                    </div>

                    <span class="text-5xl font-black">

                        <?php echo $prescriptions; ?>

                    </span>

                </div>

                <h3 class="text-2xl font-bold">
                    Prescriptions
                </h3>

            </div>

        </div>

        <!-- SECOND ROW -->
        <div class="grid lg:grid-cols-3 gap-8 mb-12">

            <!-- Medical Records -->
            <div class="glass rounded-[35px] p-8">

                <div class="flex items-center justify-between mb-6">

                    <div class="w-20 h-20 rounded-3xl bg-cyan-500/20 flex items-center justify-center text-cyan-400 text-4xl">

                        <i class="fa-solid fa-notes-medical"></i>

                    </div>

                    <span class="text-5xl font-black">

                        <?php echo $records; ?>

                    </span>

                </div>

                <h3 class="text-2xl font-bold">
                    Medical Records
                </h3>

            </div>

            <!-- Messages -->
            <div class="glass rounded-[35px] p-8">

                <div class="flex items-center justify-between mb-6">

                    <div class="w-20 h-20 rounded-3xl bg-yellow-500/20 flex items-center justify-center text-yellow-400 text-4xl">

                        <i class="fa-solid fa-envelope"></i>

                    </div>

                    <span class="text-5xl font-black">

                        <?php echo $messages; ?>

                    </span>

                </div>

                <h3 class="text-2xl font-bold">
                    Messages
                </h3>

            </div>

            <!-- Admins -->
            <div class="glass rounded-[35px] p-8">

                <div class="flex items-center justify-between mb-6">

                    <div class="w-20 h-20 rounded-3xl bg-emerald-500/20 flex items-center justify-center text-emerald-400 text-4xl">

                        <i class="fa-solid fa-user-shield"></i>

                    </div>

                    <span class="text-5xl font-black">

                        <?php echo $admins; ?>

                    </span>

                </div>

                <h3 class="text-2xl font-bold">
                    Admins
                </h3>

            </div>

        </div>

        <!-- CHART -->
        <div class="glass rounded-[40px] p-10">

            <h2 class="text-4xl font-black mb-10">

                Hospital Statistics

            </h2>

            <canvas id="hospitalChart"
                    height="120"></canvas>

        </div>

    </main>

</div>

<script>

const ctx = document.getElementById('hospitalChart');

new Chart(ctx, {

    type: 'bar',

    data: {

        labels: [

            'Patients',
            'Doctors',
            'Appointments',
            'Prescriptions',
            'Records',
            'Messages'

        ],

        datasets: [{

            label: 'Hospital Analytics',

            data: [

                <?php echo $patients; ?>,
                <?php echo $doctors; ?>,
                <?php echo $appointments; ?>,
                <?php echo $prescriptions; ?>,
                <?php echo $records; ?>,
                <?php echo $messages; ?>

            ],

            borderWidth: 2

        }]

    },

    options: {

        responsive: true,

        plugins: {

            legend: {

                labels: {

                    color: 'white'

                }

            }

        },

        scales: {

            x: {

                ticks: {

                    color: 'white'

                }

            },

            y: {

                ticks: {

                    color: 'white'

                }

            }

        }

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