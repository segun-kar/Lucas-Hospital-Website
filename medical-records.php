<?php

session_start();

include 'inc/config.php';

if (!isset($_SESSION['user_id'])) {

    header("Location: login.php");
    exit();

}

$success = "";

// Save Record
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $patient_name = $_POST['patient_name'];
    $doctor_name = $_SESSION['fullname'];
    $diagnosis = $_POST['diagnosis'];
    $treatment = $_POST['treatment'];
    $doctor_notes = $_POST['doctor_notes'];
    $visit_date = $_POST['visit_date'];

    $sql = "INSERT INTO medical_records
    (patient_name, doctor_name, diagnosis, treatment, doctor_notes, visit_date)

    VALUES
    ('$patient_name', '$doctor_name', '$diagnosis', '$treatment', '$doctor_notes', '$visit_date')";

    if (mysqli_query($conn, $sql)) {

        $success = "Medical record saved successfully.";

    }

}

// Fetch Records
$records = mysqli_query(
    $conn,
    "SELECT * FROM medical_records ORDER BY id DESC"
);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Medical Records | Serah Hospital</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body class="bg-slate-100 min-h-screen">

    <div class="flex">

        <!-- Sidebar -->
        <aside class="w-72 bg-slate-900 text-white min-h-screen p-8">

            <div class="flex items-center gap-4 mb-12">

                <div class="w-14 h-14 rounded-2xl bg-gradient-to-r from-cyan-600 to-teal-600 flex items-center justify-center text-2xl">

                    <i class="fa-solid fa-heart-pulse"></i>

                </div>

                <div>

                    <h1 class="text-2xl font-extrabold">
                        Serah Hospital
                    </h1>

                    <p class="text-cyan-200 text-sm">
                        Medical Records
                    </p>

                </div>

            </div>

            <!-- Navigation -->
            <nav class="space-y-3">

                <a href="doctor-dashboard.php"
                   class="flex items-center gap-4 hover:bg-slate-800 px-5 py-4 rounded-2xl transition">

                    <i class="fa-solid fa-chart-line"></i>
                    Dashboard

                </a>

                <a href="prescription.php"
                   class="flex items-center gap-4 hover:bg-slate-800 px-5 py-4 rounded-2xl transition">

                    <i class="fa-solid fa-file-medical"></i>
                    Prescriptions

                </a>

                <a href="#"
                   class="flex items-center gap-4 bg-cyan-600 px-5 py-4 rounded-2xl font-semibold">

                    <i class="fa-solid fa-notes-medical"></i>
                    Medical Records

                </a>

            </nav>

        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-10">

            <!-- Header -->
            <div class="mb-10">

                <h1 class="text-4xl font-extrabold text-slate-800">
                    Medical Records System
                </h1>

                <p class="text-gray-500 mt-2">
                    Manage diagnosis, treatment, and patient healthcare history
                </p>

            </div>

            <!-- Success Message -->
            <?php if ($success) { ?>

                <div class="bg-green-100 text-green-700 p-5 rounded-2xl mb-8">
                    <?php echo $success; ?>
                </div>

            <?php } ?>

            <!-- Record Form -->
            <div class="bg-white rounded-3xl shadow-lg p-10 mb-10">

                <form method="POST" class="space-y-6">

                    <div class="grid md:grid-cols-2 gap-6">

                        <!-- Patient Name -->
                        <div>

                            <label class="block font-semibold mb-2">
                                Patient Name
                            </label>

                            <input type="text"
                                   name="patient_name"
                                   required
                                   class="w-full px-5 py-4 border border-gray-300 rounded-2xl focus:ring-4 focus:ring-cyan-200 outline-none">

                        </div>

                        <!-- Visit Date -->
                        <div>

                            <label class="block font-semibold mb-2">
                                Visit Date
                            </label>

                            <input type="date"
                                   name="visit_date"
                                   required
                                   class="w-full px-5 py-4 border border-gray-300 rounded-2xl focus:ring-4 focus:ring-cyan-200 outline-none">

                        </div>

                    </div>

                    <!-- Diagnosis -->
                    <div>

                        <label class="block font-semibold mb-2">
                            Diagnosis
                        </label>

                        <textarea name="diagnosis"
                                  rows="4"
                                  required
                                  class="w-full px-5 py-4 border border-gray-300 rounded-2xl focus:ring-4 focus:ring-cyan-200 outline-none"></textarea>

                    </div>

                    <!-- Treatment -->
                    <div>

                        <label class="block font-semibold mb-2">
                            Treatment Plan
                        </label>

                        <textarea name="treatment"
                                  rows="4"
                                  required
                                  class="w-full px-5 py-4 border border-gray-300 rounded-2xl focus:ring-4 focus:ring-cyan-200 outline-none"></textarea>

                    </div>

                    <!-- Doctor Notes -->
                    <div>

                        <label class="block font-semibold mb-2">
                            Doctor Notes
                        </label>

                        <textarea name="doctor_notes"
                                  rows="4"
                                  required
                                  class="w-full px-5 py-4 border border-gray-300 rounded-2xl focus:ring-4 focus:ring-cyan-200 outline-none"></textarea>

                    </div>

                    <!-- Submit -->
                    <button type="submit"
                            class="bg-gradient-to-r from-cyan-600 to-teal-600 hover:from-cyan-700 hover:to-teal-700 text-white px-8 py-4 rounded-2xl font-bold shadow-lg transition">

                        Save Medical Record

                    </button>

                </form>

            </div>

            <!-- Records Table -->
            <div class="bg-white rounded-3xl shadow-lg overflow-hidden">

                <div class="p-8 border-b">

                    <h2 class="text-3xl font-extrabold text-slate-800">
                        Medical History
                    </h2>

                </div>

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead class="bg-slate-100">

                            <tr>

                                <th class="text-left px-6 py-5">
                                    Patient
                                </th>

                                <th class="text-left px-6 py-5">
                                    Doctor
                                </th>

                                <th class="text-left px-6 py-5">
                                    Diagnosis
                                </th>

                                <th class="text-left px-6 py-5">
                                    Visit Date
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php while ($row = mysqli_fetch_assoc($records)) { ?>

                            <tr class="border-b hover:bg-slate-50 transition">

                                <td class="px-6 py-5 font-semibold">
                                    <?php echo $row['patient_name']; ?>
                                </td>

                                <td class="px-6 py-5">
                                    Dr. <?php echo $row['doctor_name']; ?>
                                </td>

                                <td class="px-6 py-5">
                                    <?php echo $row['diagnosis']; ?>
                                </td>

                                <td class="px-6 py-5">
                                    <?php echo $row['visit_date']; ?>
                                </td>

                            </tr>

                            <?php } ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </main>

    </div>

</body>

</html>