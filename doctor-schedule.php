<?php
session_start();
include 'inc/config.php';
include 'inc/notify-admin.php';
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Doctor') {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$doctor_id = $_SESSION['user_id'];
$success = "";

mysqli_query($conn, "
CREATE TABLE IF NOT EXISTS doctor_schedules (
    id INT AUTO_INCREMENT PRIMARY KEY,
    doctor_id INT,
    available_date DATE,
    start_time TIME,
    end_time TIME,
    status VARCHAR(100) DEFAULT 'Available',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)
");

if (isset($_POST['add_schedule'])) {
    $available_date = $_POST['available_date'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    mysqli_query($conn, "INSERT INTO doctor_schedules
    (doctor_id, available_date, start_time, end_time)
    VALUES
    ('$doctor_id', '$available_date', '$start_time', '$end_time')");

    $success = "Schedule added successfully.";
}

$schedules = mysqli_query($conn, "SELECT * FROM doctor_schedules WHERE doctor_id='$doctor_id' ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Doctor Schedule</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-950 text-white min-h-screen p-10">

<div class="max-w-5xl mx-auto">

    <div class="flex justify-between items-center mb-10">
        <h1 class="text-5xl font-black">My Schedule</h1>

        <a href="doctor-dashboard.php"
           class="bg-cyan-600 px-6 py-3 rounded-xl font-bold">
            Back Dashboard
        </a>
    </div>

    <?php if ($success) { ?>
        <div class="bg-green-500/20 text-green-300 p-4 rounded-xl mb-8">
            <?php echo $success; ?>
        </div>
    <?php } ?>

    <div class="bg-white/5 border border-white/10 rounded-3xl p-8 mb-10">

        <form method="POST" class="grid md:grid-cols-3 gap-6">

            <input type="date" name="available_date" required
                   class="bg-white/10 border border-white/10 px-5 py-4 rounded-xl">

            <input type="time" name="start_time" required
                   class="bg-white/10 border border-white/10 px-5 py-4 rounded-xl">

            <input type="time" name="end_time" required
                   class="bg-white/10 border border-white/10 px-5 py-4 rounded-xl">

            <button type="submit" name="add_schedule"
                    class="md:col-span-3 bg-cyan-600 hover:bg-cyan-700 py-4 rounded-xl font-bold">
                Add Schedule
            </button>

        </form>

    </div>

    <div class="bg-white/5 border border-white/10 rounded-3xl p-8">

        <h2 class="text-3xl font-bold mb-6">My Available Times</h2>

        <table class="w-full">
            <thead>
                <tr class="border-b border-white/10">
                    <th class="text-left py-4">Date</th>
                    <th class="text-left py-4">Start</th>
                    <th class="text-left py-4">End</th>
                    <th class="text-left py-4">Status</th>
                </tr>
            </thead>

            <tbody>
                <?php while($row = mysqli_fetch_assoc($schedules)) { ?>
                <tr class="border-b border-white/5">
                    <td class="py-4"><?php echo $row['available_date']; ?></td>
                    <td class="py-4"><?php echo $row['start_time']; ?></td>
                    <td class="py-4"><?php echo $row['end_time']; ?></td>
                    <td class="py-4"><?php echo $row['status']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>

</div>

</body>
</html>