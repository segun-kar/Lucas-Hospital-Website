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

/* UPDATE STATUS */
if (isset($_GET['status']) && isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $status = $_GET['status'];

    $allowedStatus = ['Approved', 'Rejected'];

    if ($id > 0 && in_array($status, $allowedStatus)) {
        $stmt = mysqli_prepare($conn, "UPDATE appointments SET status = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "si", $status, $id);
        mysqli_stmt_execute($stmt);

        $stmtGet = mysqli_prepare($conn, "SELECT user_id, doctor_name, appointment_date, appointment_time FROM appointments WHERE id = ? LIMIT 1");
        mysqli_stmt_bind_param($stmtGet, "i", $id);
        mysqli_stmt_execute($stmtGet);
        $result = mysqli_stmt_get_result($stmtGet);
        $appointment = mysqli_fetch_assoc($result);

        if ($appointment) {
            $title = "Appointment $status";
            $message = "Your appointment with Dr. " . $appointment['doctor_name'] . " on " . $appointment['appointment_date'] . " at " . $appointment['appointment_time'] . " has been $status.";
            $type = "Appointment";
            $stmtNotify = mysqli_prepare($conn, "INSERT INTO notifications (user_id, title, message, type) VALUES (?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmtNotify, "isss", $appointment['user_id'], $title, $message, $type);
            mysqli_stmt_execute($stmtNotify);
        }
    }

    header("Location: admin-appointments.php");
    exit();
}

/* DELETE APPOINTMENT */
if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];

    if ($id > 0) {
        $stmt = mysqli_prepare($conn, "DELETE FROM appointments WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
    }

    header("Location: admin-appointments.php");
    exit();
}

/* FETCH APPOINTMENTS */
$appointments = mysqli_query($conn, "SELECT * FROM appointments ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Appointments | Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-950 text-white min-h-screen p-10">

<div class="max-w-7xl mx-auto">

    <div class="flex justify-between items-center mb-10">
        <div>
            <h1 class="text-5xl font-black">Manage Appointments</h1>
            <p class="text-slate-400 mt-2">Approve, reject, and delete hospital appointments</p>
        </div>

        <a href="admin-dashboard.php"
           class="bg-cyan-600 px-6 py-3 rounded-xl font-bold">
            Back Dashboard
        </a>
    </div>

    <div class="bg-white/5 border border-white/10 rounded-3xl p-8 overflow-x-auto">

        <table class="w-full">
            <thead>
                <tr class="border-b border-white/10">
                    <th class="text-left py-4">Patient</th>
                    <th class="text-left py-4">Email</th>
                    <th class="text-left py-4">Doctor</th>
                    <th class="text-left py-4">Department</th>
                    <th class="text-left py-4">Date</th>
                    <th class="text-left py-4">Time</th>
                    <th class="text-left py-4">Status</th>
                    <th class="text-left py-4">Action</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($row = mysqli_fetch_assoc($appointments)) { ?>

                <tr class="border-b border-white/5">

                    <td class="py-5">
                        <?php echo $row['fullname']; ?>
                    </td>

                    <td class="py-5">
                        <?php echo $row['email']; ?>
                    </td>

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
                        <span class="px-4 py-2 rounded-full text-sm
                            <?php
                            if ($row['status'] == 'Approved') {
                                echo 'bg-green-500/20 text-green-300';
                            } elseif ($row['status'] == 'Rejected') {
                                echo 'bg-red-500/20 text-red-300';
                            } else {
                                echo 'bg-yellow-500/20 text-yellow-300';
                            }
                            ?>">
                            <?php echo $row['status']; ?>
                        </span>
                    </td>

                    <td class="py-5">
                        <div class="flex gap-3 flex-wrap">

                            <a href="admin-appointments.php?id=<?php echo $row['id']; ?>&status=Approved"
                               class="bg-green-600 px-4 py-2 rounded-lg">
                                Approve
                            </a>

                            <a href="admin-appointments.php?id=<?php echo $row['id']; ?>&status=Rejected"
                               class="bg-yellow-600 px-4 py-2 rounded-lg">
                                Reject
                            </a>

                            <a href="admin-appointments.php?delete=<?php echo $row['id']; ?>"
                               onclick="return confirm('Delete this appointment?')"
                               class="bg-red-600 px-4 py-2 rounded-lg">
                                Delete
                            </a>

                        </div>
                    </td>

                </tr>

                <?php } ?>
            </tbody>
        </table>

    </div>

</div>

</body>
</html>