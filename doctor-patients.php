<?php

session_start();
include 'inc/config.php';
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Doctor') {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$doctor_id = $_SESSION['user_id'];

$patients = mysqli_query(
    $conn,
    "SELECT DISTINCT user_id, fullname, email, phone
     FROM appointments
     WHERE doctor_id='$doctor_id'
     ORDER BY fullname ASC"
);

?>

<!DOCTYPE html>
<html>
<head>
    <title>My Patients | Doctor</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-950 text-white min-h-screen p-10">

<div class="max-w-6xl mx-auto">

    <div class="flex justify-between items-center mb-10">
        <div>
            <h1 class="text-5xl font-black">My Patients</h1>
            <p class="text-slate-400 mt-2">Patients who booked appointments with you</p>
        </div>

        <a href="doctor-dashboard.php"
           class="bg-cyan-600 px-6 py-3 rounded-xl font-bold">
            Back Dashboard
        </a>
    </div>

    <div class="bg-white/5 border border-white/10 rounded-3xl p-8 overflow-x-auto">

        <table class="w-full">
            <thead>
                <tr class="border-b border-white/10">
                    <th class="text-left py-4">Patient Name</th>
                    <th class="text-left py-4">Email</th>
                    <th class="text-left py-4">Phone</th>
                    <th class="text-left py-4">Action</th>
                </tr>
            </thead>

            <tbody>
                <?php while($row = mysqli_fetch_assoc($patients)) { ?>
                <tr class="border-b border-white/5">
                    <td class="py-5"><?php echo $row['fullname']; ?></td>
                    <td class="py-5"><?php echo $row['email']; ?></td>
                    <td class="py-5"><?php echo $row['phone']; ?></td>
                    <td class="py-5">
                        <a href="doctor-medical-records.php"
                           class="bg-cyan-600 hover:bg-cyan-700 px-4 py-2 rounded-lg">
                            Add Record
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>

</div>

</body>
</html>