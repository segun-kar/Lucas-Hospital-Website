<?php
session_start();
include 'inc/config.php';
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.php");
    exit();
}

$messages = mysqli_query($conn, "SELECT * FROM contact_messages ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Messages | Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-950 text-white min-h-screen p-10">

<div class="max-w-6xl mx-auto">

    <div class="flex justify-between mb-10">
        <h1 class="text-5xl font-black">Contact Messages</h1>
        <a href="admin-dashboard.php" class="bg-cyan-600 px-6 py-3 rounded-xl">Back</a>
    </div>

    <div class="space-y-6">
        <?php while($row = mysqli_fetch_assoc($messages)){ ?>
            <div class="bg-white/5 border border-white/10 rounded-3xl p-8">
                <h2 class="text-2xl font-bold"><?php echo $row['subject']; ?></h2>
                <p class="text-cyan-300 mt-2"><?php echo $row['fullname']; ?> — <?php echo $row['email']; ?></p>
                <p class="text-slate-300 mt-5"><?php echo $row['message']; ?></p>
                <p class="text-slate-500 mt-4"><?php echo $row['created_at']; ?></p>
            </div>
        <?php } ?>
    </div>

</div>

</body>
</html>