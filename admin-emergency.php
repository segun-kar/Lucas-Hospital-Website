<?php
session_start();
include 'inc/config.php';
include 'inc/send-mail.php';
include 'inc/security.php';
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['user_id']) || strtolower($_SESSION['role'] ?? '') !== 'admin') {
    header("Location: login.php");
    exit();
}

if (isset($_GET['status']) && isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $status = $_GET['status'];

    $allowedStatus = ['Dispatched', 'Pending'];

    if ($id > 0 && in_array($status, $allowedStatus)) {
        $stmt = mysqli_prepare($conn, "UPDATE emergency_requests SET status = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "si", $status, $id);
        mysqli_stmt_execute($stmt);

        $stmtGet = mysqli_prepare($conn, "SELECT * FROM emergency_requests WHERE id = ? LIMIT 1");
        mysqli_stmt_bind_param($stmtGet, "i", $id);
        mysqli_stmt_execute($stmtGet);
        $result = mysqli_stmt_get_result($stmtGet);
        $request = mysqli_fetch_assoc($result);

        if ($request && $status == "Dispatched") {
            sendEmergencyDispatchMail($request['email'], $request['fullname']);
        }

        $success = "Emergency request dispatched successfully and notification sent.";
    }
}

$requests = mysqli_query($conn, "SELECT * FROM emergency_requests ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Emergency Requests | Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-950 text-white min-h-screen p-10">

<div class="max-w-7xl mx-auto">
<?php if(isset($success)) { ?>

<div class="bg-green-500/20 border border-green-500/30
text-green-300 p-4 rounded-2xl mb-6 text-center">

    <?php echo $success; ?>

</div>

<?php } ?>
    <div class="flex justify-between mb-10">
        <h1 class="text-5xl font-black">Emergency Requests</h1>
        <a href="admin-dashboard.php" class="bg-cyan-600 px-6 py-3 rounded-xl">Back</a>
    </div>

    <div class="bg-white/5 border border-white/10 rounded-3xl p-8 overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-white/10">
                    <th class="text-left py-4">Patient</th>
                    <th class="text-left py-4">Phone</th>
                    <th class="text-left py-4">Location</th>
                    <th class="text-left py-4">Type</th>
                    <th class="text-left py-4">Message</th>
                    <th class="text-left py-4">Status</th>
                    <th class="text-left py-4">Action</th>
                </tr>
            </thead>

            <tbody>
                <?php while($row = mysqli_fetch_assoc($requests)){ ?>
                <tr class="border-b border-white/5">
                    <td class="py-4"><?php echo $row['fullname']; ?></td>
                    <td class="py-4"><?php echo $row['phone']; ?></td>
                    <td class="py-4"><?php echo $row['location']; ?></td>
                    <td class="py-4">Emergency</td>
                    <td class="py-4"><?php echo $row['emergency']; ?></td>
                    <td class="py-4"><?php echo $row['status']; ?></td>
                    <td class="py-4">
                        <?php if($row['status'] != 'Dispatched') { ?>

<a href="?id=<?php echo $row['id']; ?>&status=Dispatched"
   class="bg-green-600 px-4 py-2 rounded-lg">
    Dispatch
</a>

<?php } else { ?>

<span class="text-green-400 font-bold">
    Dispatched
</span>

<?php } ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</div>

</body>
</html>