<?php

session_start();

include 'inc/config.php';
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.php");
    exit();
}

/*
|--------------------------------------------------------------------------
| DELETE RECORD
|--------------------------------------------------------------------------
*/

if(isset($_GET['delete'])){

    $delete_id = $_GET['delete'];

    mysqli_query(

        $conn,

        "DELETE FROM medical_records
         WHERE id='$delete_id'"

    );

}

/*
|--------------------------------------------------------------------------
| SEARCH
|--------------------------------------------------------------------------
*/

$search = "";

if(isset($_GET['search'])){

    $search = mysqli_real_escape_string(
        $conn,
        $_GET['search']
    );

    $records = mysqli_query(

        $conn,

        "SELECT * FROM medical_records

         WHERE

         patient_name LIKE '%$search%'

         OR

         doctor_name LIKE '%$search%'

         OR

         diagnosis LIKE '%$search%'

         ORDER BY id DESC"

    );

} else {

    $records = mysqli_query(

        $conn,

        "SELECT * FROM medical_records
         ORDER BY id DESC"

    );

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Admin Medical Records</title>

<script src="https://cdn.tailwindcss.com"></script>

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

    background: rgba(255,255,255,0.05);

    backdrop-filter: blur(18px);

    border: 1px solid rgba(255,255,255,0.08);

}

.input {

    background: rgba(255,255,255,0.05);

    border: 1px solid rgba(255,255,255,0.1);

    color: white;

}

.input:focus {

    outline: none;

    border-color: #06b6d4;

}

</style>

</head>

<body class="text-white min-h-screen">

<div class="flex">

    <!-- SIDEBAR -->
    <aside class="w-80 min-h-screen glass p-8">

        <!-- Logo -->
        <div class="flex items-center gap-4 mb-14">

            <div class="w-16 h-16 rounded-3xl bg-gradient-to-r from-cyan-500 to-teal-500 flex items-center justify-center text-3xl shadow-2xl">

                <i class="fa-solid fa-notes-medical"></i>

            </div>

            <div>

                <h1 class="text-3xl font-black">
                    Admin Panel
                </h1>

                <p class="text-cyan-200">
                    Medical Records
                </p>

            </div>

        </div>

        <!-- Navigation -->
        <nav class="space-y-4">

            <a href="admin-dashboard.php"
               class="flex items-center gap-4 px-6 py-5 rounded-2xl hover:bg-white/10 transition">

                <i class="fa-solid fa-chart-line"></i>
                Dashboard

            </a>

            <a href="admin-medical-records.php"
               class="flex items-center gap-4 px-6 py-5 rounded-2xl bg-gradient-to-r from-cyan-500 to-teal-500 font-bold shadow-xl">

                <i class="fa-solid fa-notes-medical"></i>
                Medical Records

            </a>

            <a href="admin-messages.php"
               class="flex items-center gap-4 px-6 py-5 rounded-2xl hover:bg-white/10 transition">

                <i class="fa-solid fa-envelope"></i>
                Messages

            </a>

            <a href="logout.php"
               class="flex items-center gap-4 px-6 py-5 rounded-2xl hover:bg-red-500/20 transition text-red-300">

                <i class="fa-solid fa-right-from-bracket"></i>
                Logout

            </a>

        </nav>

    </aside>

    <!-- MAIN -->
    <main class="flex-1 p-10">

        <!-- Header -->
        <div class="flex items-center justify-between mb-12">

            <div>

                <h1 class="text-5xl font-black mb-3">

                    Medical Records

                </h1>

                <p class="text-slate-300 text-lg">

                    Manage patient healthcare records

                </p>

            </div>

        </div>

        <!-- SEARCH -->
        <div class="glass rounded-3xl p-8 mb-10">

            <form method="GET"
                  class="flex gap-5">

                <input type="text"
                       name="search"
                       placeholder="Search patient, doctor or diagnosis..."
                       class="input flex-1 px-6 py-5 rounded-2xl">

                <button type="submit"
                        class="bg-gradient-to-r from-cyan-500 to-teal-500 px-10 py-5 rounded-2xl font-bold shadow-2xl">

                    Search

                </button>

            </form>

        </div>

        <!-- RECORD TABLE -->
        <div class="glass rounded-3xl p-8 overflow-x-auto">

            <table class="w-full">

                <thead>

                    <tr class="border-b border-white/10">

                        <th class="text-left py-5">
                            Patient
                        </th>

                        <th class="text-left py-5">
                            Doctor
                        </th>

                        <th class="text-left py-5">
                            Diagnosis
                        </th>

                        <th class="text-left py-5">
                            Treatment
                        </th>

                        <th class="text-left py-5">
                            Date
                        </th>

                        <th class="text-left py-5">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    <?php while($row = mysqli_fetch_assoc($records)){ ?>

                    <tr class="border-b border-white/5">

                        <!-- Patient -->
                        <td class="py-6">

                            <?php echo $row['patient_name']; ?>

                        </td>

                        <!-- Doctor -->
                        <td class="py-6">

                            Dr. <?php echo $row['doctor_name']; ?>

                        </td>

                        <!-- Diagnosis -->
                        <td class="py-6">

                            <?php echo $row['diagnosis']; ?>

                        </td>

                        <!-- Treatment -->
                        <td class="py-6">

                            <?php echo $row['treatment']; ?>

                        </td>

                        <!-- Date -->
                        <td class="py-6">

                            <?php echo $row['record_date']; ?>

                        </td>

                        <!-- Delete -->
                        <td class="py-6">

                            <a href="?delete=<?php echo $row['id']; ?>"

                               onclick="return confirm('Delete this medical record?')"

                               class="bg-red-500/20 text-red-300 px-5 py-3 rounded-xl hover:bg-red-500/30 transition">

                                Delete

                            </a>

                        </td>

                    </tr>

                    <?php } ?>

                </tbody>

            </table>

        </div>

    </main>

</div>

</body>

</html>