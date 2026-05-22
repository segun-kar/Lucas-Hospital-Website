<?php

session_start();
include 'inc/config.php';
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

/* DELETE PRESCRIPTION */
if (isset($_GET['delete'])) {

    $id = $_GET['delete'];

    mysqli_query(
        $conn,
        "DELETE FROM prescriptions WHERE id='$id'"
    );

    header("Location: admin-prescriptions.php");
    exit();
}

/* FETCH PRESCRIPTIONS */
$prescriptions = mysqli_query(
    $conn,
    "SELECT * FROM prescriptions ORDER BY id DESC"
);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Prescriptions | Admin</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body class="bg-slate-950 text-white min-h-screen p-10">

<div class="max-w-7xl mx-auto">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-10">

        <div>

            <h1 class="text-5xl font-black">
                Manage Prescriptions
            </h1>

            <p class="text-slate-400 mt-2">
                Monitor all hospital prescriptions
            </p>

        </div>

        <a href="admin-dashboard.php"
           class="bg-cyan-600 hover:bg-cyan-700 px-6 py-3 rounded-xl font-bold">

            Back Dashboard

        </a>

    </div>

    <!-- TABLE -->
    <div class="bg-white/5 border border-white/10 rounded-3xl p-8 overflow-x-auto">

        <table class="w-full">

            <thead>

                <tr class="border-b border-white/10">

                    <th class="text-left py-4">Patient</th>

                    <th class="text-left py-4">Doctor</th>

                    <th class="text-left py-4">Medication</th>

                    <th class="text-left py-4">Dosage</th>

                    <th class="text-left py-4">Date</th>

                    <th class="text-left py-4">Status</th>

                    <th class="text-left py-4">Action</th>

                </tr>

            </thead>

            <tbody>

                <?php while($row = mysqli_fetch_assoc($prescriptions)){ ?>

                <tr class="border-b border-white/5">

                    <!-- PATIENT -->
                    <td class="py-5">

                        <?php echo $row['patient_name']; ?>

                    </td>

                    <!-- DOCTOR -->
                    <td class="py-5">

                        Dr. <?php echo $row['doctor_name']; ?>

                    </td>

                    <!-- MEDICATION -->
                    <td class="py-5">

                        <?php echo $row['medication']; ?>

                    </td>

                    <!-- DOSAGE -->
                    <td class="py-5">

                        <?php echo $row['dosage']; ?>

                    </td>

                    <!-- DATE -->
                    <td class="py-5">

                        <?php echo $row['prescription_date']; ?>

                    </td>

                    <!-- STATUS -->
                    <td class="py-5">

                        <span class="bg-green-500/20 text-green-300 px-4 py-2 rounded-full text-sm">

                      <?php echo $row['status'] ?? 'Active'; ?>

                        </span>

                    </td>

                    <!-- ACTION -->
                    <td class="py-5">

                        <a href="admin-prescriptions.php?delete=<?php echo $row['id']; ?>"
                           onclick="return confirm('Delete this prescription?')"
                           class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-lg">

                            Delete

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