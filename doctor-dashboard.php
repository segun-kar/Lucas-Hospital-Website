<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (strtolower($_SESSION['role']) != 'doctor') {
    header("Location: login.php");
    exit();
}

include 'inc/config.php';
include 'inc/security.php';
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Doctor') {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$doctor_id = $_SESSION['user_id'];

$unreadNotifications = mysqli_num_rows(
    mysqli_query(
        $conn,
        "SELECT * FROM notifications
         WHERE user_id='$user_id'
         AND status='Unread'"
    )
);

$doctorQuery = mysqli_query(
    $conn,
    "SELECT * FROM users
     WHERE id='$doctor_id'
     LIMIT 1"
);

$doctor = mysqli_fetch_assoc($doctorQuery);
$profileImage = !empty($doctor['profile_image'])
    ? $doctor['profile_image']
    : "uploads/profile/default.png";
$appointments = mysqli_query(
    $conn,
    "SELECT * FROM appointments
     WHERE doctor_id='$doctor_id'
     ORDER BY id DESC"
);

$totalAppointments = mysqli_num_rows($appointments);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Doctor Dashboard | Lucas Hospital</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body class="bg-slate-100 min-h-screen">
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
            <div class="flex items-center gap-4 mb-12">

                <div class="w-14 h-14 rounded-2xl bg-gradient-to-r from-cyan-600 to-teal-600 flex items-center justify-center text-2xl">

                    <i class="fa-solid fa-heart-pulse"></i>

                </div>

                <div>

                    <h1 class="text-2xl font-extrabold">
                        Lucas Hospital
                    </h1>

                    <p class="text-cyan-200 text-sm">
                        Doctor Portal
                    </p>

                </div>

            </div>

            <!-- Navigation -->
            <nav class="space-y-3">

                <a href="#"
                   class="flex items-center gap-4 bg-cyan-600 px-5 py-4 rounded-2xl font-semibold">

                    <i class="fa-solid fa-chart-line"></i>
                    Dashboard

                </a>

                <a href="#appointments"
                   class="flex items-center gap-4 hover:bg-slate-800 px-5 py-4 rounded-2xl transition">

                    <i class="fa-solid fa-calendar-check"></i>
                    Appointments

                </a>
                
                <a href="doctor-patients.php"
                   class="flex items-center gap-4 hover:bg-slate-800 px-5 py-4 rounded-2xl transition">

                    <i class="fa-solid fa-user-group"></i>
                    Patients

                </a>
                <a href="doctor-medical-records.php"
   class="flex items-center gap-4 px-6 py-5 rounded-2xl hover:bg-white/10 transition">

    <i class="fa-solid fa-notes-medical"></i>
    Medical Records

</a>
                <a href="doctor-prescriptions.php"
                  class="flex items-center gap-4 px-6 py-5 rounded-2xl hover:bg-white/10 transition">

                    <i class="fa-solid fa-file-medical"></i>
                    Prescriptions

                </a>

                <a href="doctor-schedule.php"
                   class="flex items-center gap-4 hover:bg-slate-800 px-5 py-4 rounded-2xl transition">

                    <i class="fa-solid fa-clock"></i>
                    Schedule

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
            </nav>

            <!-- Logout -->
            <div class="mt-20">

                <a href="logout-success.php"
                   class="flex items-center justify-center gap-3 bg-red-600 hover:bg-red-700 py-4 rounded-2xl font-bold transition">

                    <i class="fa-solid fa-right-from-bracket"></i>
                    Logout

                </a>

            </div>

        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-4 sm:p-6 lg:p-10">

            <!-- Header -->
            <div class="flex items-center justify-between mb-10">

                <div>

                    <h1 class="text-4xl font-extrabold text-slate-800">
                        Doctor Dashboard
                    </h1>

                    <p class="text-gray-500 mt-2">
                        Manage patients and medical appointments
                    </p>

                </div>

                <!-- Doctor Profile -->
                <div class="flex items-center gap-4 bg-white p-4 rounded-2xl shadow">

                   <img src="<?php echo $profileImage; ?>"
     class="w-14 h-14 rounded-full object-cover border-2 border-cyan-500">

                    <div>

                        <h2 class="font-bold text-slate-800">

                            Dr. <?php echo $doctor['fullname']; ?>
                            
                        </h2>

                        <p class="text-gray-500 text-sm">
                            Medical Specialist
                        </p>

                    </div>

                </div>

            </div>

            <!-- Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">

                <!-- Card -->
                <div class="bg-white p-8 rounded-3xl shadow-lg">

                    <div class="w-16 h-16 rounded-2xl bg-cyan-100 flex items-center justify-center text-cyan-600 text-3xl mb-6">

                        <i class="fa-solid fa-calendar-check"></i>

                    </div>

                    <h2 class="text-5xl font-extrabold text-slate-800 mb-3">
                        <?php echo $totalAppointments; ?>
                    </h2>

                    <p class="text-gray-500">
                        Appointments
                    </p>

                </div>

                <!-- Card -->
                <div class="bg-white p-8 rounded-3xl shadow-lg">

                    <div class="w-16 h-16 rounded-2xl bg-emerald-100 flex items-center justify-center text-emerald-600 text-3xl mb-6">

                        <i class="fa-solid fa-user-group"></i>

                    </div>

                    <h2 class="text-5xl font-extrabold text-slate-800 mb-3">
                       <?php echo $totalAppointments; ?>
                    </h2>

                    <p class="text-gray-500">
                        Patients
                    </p>

                </div>

                <!-- Card -->
                <div class="bg-white p-8 rounded-3xl shadow-lg">

                    <div class="w-16 h-16 rounded-2xl bg-purple-100 flex items-center justify-center text-purple-600 text-3xl mb-6">

                        <i class="fa-solid fa-stethoscope"></i>

                    </div>

                    <h2 class="text-5xl font-extrabold text-slate-800 mb-3">
                        Active
                    </h2>

                    <p class="text-gray-500">
                        Duty Status
                    </p>

                </div>

            </div>
            <!-- Search & Filter -->
<div class="bg-white p-6 rounded-3xl shadow-lg mb-8">

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

        <!-- Search -->
        <div>

            <label class="block font-semibold mb-2">
                Search Patient
            </label>

            <input type="text"
                   id="searchInput"
                   placeholder="Search by patient name..."
                   class="w-full px-5 py-4 border border-gray-300 rounded-2xl focus:ring-4 focus:ring-cyan-200 outline-none">

        </div>

        <!-- Department Filter -->
        <div>

            <label class="block font-semibold mb-2">
                Filter Department
            </label>

            <select id="departmentFilter"
                    class="w-full px-5 py-4 border border-gray-300 rounded-2xl focus:ring-4 focus:ring-cyan-200 outline-none">

                <option value="">All Departments</option>
                <option>Cardiology</option>
                <option>Neurology</option>
                <option>Orthopedics</option>
                <option>Pediatrics</option>
                <option>Emergency</option>

            </select>

        </div>

        <!-- Status Filter -->
        <div>

            <label class="block font-semibold mb-2">
                Appointment Status
            </label>

            <select id="statusFilter"
                    class="w-full px-5 py-4 border border-gray-300 rounded-2xl focus:ring-4 focus:ring-cyan-200 outline-none">

                <option value="">All Status</option>
                <option>Approved</option>
                <option>Pending</option>
                <option>Rejected</option>

            </select>

        </div>

    </div>

</div> 
            <!-- Appointment Table -->
            <div id="appointments"
                 class="bg-white rounded-3xl shadow-lg overflow-hidden">

                <!-- Header -->
                <div class="p-8 border-b flex items-center justify-between">

                    <h2 class="text-3xl font-extrabold text-slate-800">
                        Patient Appointments
                    </h2>
<a href="doctor-schedule.php"
   class="bg-cyan-600 hover:bg-cyan-700 text-white px-5 py-3 rounded-xl font-semibold">

    + Add Schedule

</a>

                </div>

                <!-- Table -->
                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead class="bg-slate-100">

                            <tr>

                                <th class="text-left px-6 py-5">
                                    Patient
                                </th>

                                <th class="text-left px-6 py-5">
                                    Department
                                </th>

                                <th class="text-left px-6 py-5">
                                    Date
                                </th>

                                <th class="text-left px-6 py-5">
                                    Time
                                </th>

                                <th class="text-left px-6 py-5">
                                    Status
                                </th>

                                <th class="text-left px-6 py-5">
                                    Actions
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php while ($row = mysqli_fetch_assoc($appointments)) { ?>

                           <tr class="appointment-row border-b hover:bg-slate-50 transition">
<td class="px-6 py-5 patient-name">

    <div>

        <h3 class="font-bold text-slate-800">
            <?php echo $row['fullname']; ?>
        </h3>

        <p class="text-sm text-gray-500">
            <?php echo $row['email']; ?>
        </p>

    </div>

</td>

                               <td class="px-6 py-5 department-name">
                                 <?php echo $row['department']; ?>
                                    </td>

                                <td class="px-6 py-5">
                                 <?php echo $row['appointment_date']; ?>
                                </td>

                                <td class="px-6 py-5">
                                    <?php echo $row['appointment_time']; ?>
                                </td>

                               <td class="px-6 py-5 status-name">

                                  <?php

$status = $row['status'];

if ($status == 'Approved') {

    echo '<span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-semibold">
            Approved
          </span>';

} elseif ($status == 'Rejected') {

    echo '<span class="bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm font-semibold">
            Rejected
          </span>';

} else {

    echo '<span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full text-sm font-semibold">
            Pending
          </span>';
}
?>
</td>


        <td class="px-6 py-5">

    <div class="flex gap-3 flex-wrap">

        <!-- EDIT -->
        <a href="edit-appointment.php?id=<?php echo $row['id']; ?>"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">

            Edit

        </a>

        <!-- DELETE -->
        <a href="delete-appointment.php?id=<?php echo $row['id']; ?>"
           onclick="return confirm('Delete this appointment?')"
           class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm">

            Delete

        </a>

        <!-- APPROVE -->
        <a href="update-appointment.php?id=<?php echo $row['id']; ?>&status=Approved"
           class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm">

            Approve

        </a>

        <!-- REJECT -->
        <a href="update-appointment.php?id=<?php echo $row['id']; ?>&status=Rejected"
           class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm">

            Reject

        </a>

    </div>

</td>

                            </tr>

                            <?php } ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </main>

    </div>
<script>

function toggleSidebar() {

    const sidebar =
    document.getElementById('sidebar');

    sidebar.classList.toggle('-translate-x-full');

}

</script>
</body>

</html>

<script>

    const searchInput = document.getElementById('searchInput');
    const departmentFilter = document.getElementById('departmentFilter');
    const statusFilter = document.getElementById('statusFilter');

    const rows = document.querySelectorAll('.appointment-row');

    function filterAppointments() {

        const searchValue = searchInput.value.toLowerCase();
        const departmentValue = departmentFilter.value.toLowerCase();
        const statusValue = statusFilter.value.toLowerCase();

        rows.forEach(row => {

            const patient = row.querySelector('.patient-name')
                .innerText.toLowerCase();

            const department = row.querySelector('.department-name')
                .innerText.toLowerCase();

            const status = row.querySelector('.status-name')
                .innerText.toLowerCase();

            const matchSearch = patient.includes(searchValue);

            const matchDepartment =
                departmentValue === '' ||
                department.includes(departmentValue);

            const matchStatus =
                statusValue === '' ||
                status.includes(statusValue);

            if (matchSearch && matchDepartment && matchStatus) {

                row.style.display = '';

            } else {

                row.style.display = 'none';

            }

        });

    }

    searchInput.addEventListener('keyup', filterAppointments);

    departmentFilter.addEventListener('change', filterAppointments);

    statusFilter.addEventListener('change', filterAppointments);

</script>