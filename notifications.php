<?php

session_start();
include 'inc/config.php';
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.php");
    exit();
}
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$role = $_SESSION['role'];

/*
|--------------------------------------------------------------------------
| FETCH NOTIFICATIONS
|--------------------------------------------------------------------------
*/

$notifications = mysqli_query(
    $conn,
    "SELECT * FROM notifications
     WHERE user_id='$user_id'
     ORDER BY id DESC"
);

/*
|--------------------------------------------------------------------------
| MARK AS READ AFTER OPENING PAGE
|--------------------------------------------------------------------------
*/

mysqli_query(
    $conn,
    "UPDATE notifications
     SET status='Read'
     WHERE user_id='$user_id'
     AND status='Unread'"
);

/*
|--------------------------------------------------------------------------
| BACK LINK BASED ON ROLE
|--------------------------------------------------------------------------
*/

$backLink = "patient-dashboard.php";

if (strtolower($role) == "doctor") {
    $backLink = "doctor-dashboard.php";
}

if (strtolower($role) == "admin") {
    $backLink = "admin-dashboard.php";
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Notifications</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-950 text-white min-h-screen p-10">

<div class="max-w-5xl mx-auto">

    <div class="flex justify-between items-center mb-10">
        <div>
            <h1 class="text-5xl font-black">Notifications</h1>
            <p class="text-slate-400 mt-2">Hospital alerts and updates</p>
        </div>

        <a href="<?php echo $backLink; ?>"
           class="bg-cyan-600 px-6 py-3 rounded-xl font-bold">
            Back Dashboard
        </a>
    </div>

    <div class="space-y-6">

        <?php if (mysqli_num_rows($notifications) > 0) { ?>

            <?php while ($row = mysqli_fetch_assoc($notifications)) { ?>

                <div class="bg-white/5 border border-white/10 rounded-3xl p-8">

                    <div class="flex justify-between gap-5 mb-4">

                        <div>
                            <h2 class="text-2xl font-bold">
                                <?php echo $row['title']; ?>
                            </h2>

                            <p class="text-cyan-300 mt-1">
                                <?php echo $row['type']; ?>
                            </p>
                        </div>

                        <span class="text-sm px-4 py-2 rounded-full bg-slate-800 text-slate-300">
                            <?php echo $row['status']; ?>
                        </span>

                    </div>

                    <p class="text-slate-300 leading-relaxed">
                        <?php echo $row['message']; ?>
                    </p>

                    <p class="text-slate-500 mt-5 text-sm">
                        <?php echo $row['created_at']; ?>
                    </p>
                    <?php if (strtolower($_SESSION['role']) == 'admin') { ?>

    <?php
    $type = strtolower($row['type']);
    $viewLink = "#";

    if ($type == "message") {
        $viewLink = "admin-messages.php";
    } elseif ($type == "appointment") {
        $viewLink = "admin-appointments.php";
    } elseif ($type == "emergency") {
        $viewLink = "admin-emergency.php";
    } elseif ($type == "prescription") {
        $viewLink = "admin-prescriptions.php";
    } elseif ($type == "medical record") {
        $viewLink = "admin-medical-records.php";
    }
    ?>

    <a href="<?php echo $viewLink; ?>"
       class="inline-block mt-5 bg-cyan-600 hover:bg-cyan-700 text-white px-5 py-3 rounded-xl font-bold">

        View Message

    </a>

<?php } ?>
                </div>

            <?php } ?>

        <?php } else { ?>

            <div class="bg-white/5 border border-white/10 rounded-3xl p-16 text-center">
                <h2 class="text-3xl font-bold mb-3">No Notifications Yet</h2>
                <p class="text-slate-400">Your updates will appear here.</p>
            </div>

        <?php } ?>
      
    </div>

</div>

</body>
</html>