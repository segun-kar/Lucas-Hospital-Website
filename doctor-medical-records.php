<?php

session_start();

include 'inc/config.php';
include 'inc/notify-admin.php';
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Doctor') {
    header("Location: login.php");
    exit();
}
if(!isset($_SESSION['user_id'])){

    header("Location: login.php");
    exit();

}

$doctor_id = $_SESSION['user_id'];

/*
|--------------------------------------------------------------------------
| FETCH DOCTOR
|--------------------------------------------------------------------------
*/

$doctorQuery = mysqli_query(

    $conn,

    "SELECT * FROM users
     WHERE id='$doctor_id'"

);

$doctor = mysqli_fetch_assoc($doctorQuery);

/*
|--------------------------------------------------------------------------
| CREATE MEDICAL RECORD
|--------------------------------------------------------------------------
*/

$success = "";

if(isset($_POST['create_record'])){

    $patient_name = mysqli_real_escape_string(
        $conn,
        $_POST['patient_name']
    );

    $patient_email = mysqli_real_escape_string(
        $conn,
        $_POST['patient_email']
    );

    $diagnosis = mysqli_real_escape_string(
        $conn,
        $_POST['diagnosis']
    );

    $treatment = mysqli_real_escape_string(
        $conn,
        $_POST['treatment']
    );

    $record_date = $_POST['record_date'];

    $doctor_name = $doctor['fullname'];

    $doctor_email = $doctor['email'];

    mysqli_query(

        $conn,

        "INSERT INTO medical_records (

            patient_name,
            patient_email,
            doctor_name,
            doctor_email,
            diagnosis,
            treatment,
            record_date

        )

        VALUES (

            '$patient_name',
            '$patient_email',
            '$doctor_name',
            '$doctor_email',
            '$diagnosis',
            '$treatment',
            '$record_date'

        )"

    );

    $success = "Medical record created successfully.";

}

/*
|--------------------------------------------------------------------------
| FETCH RECORDS
|--------------------------------------------------------------------------
*/

$records = mysqli_query(

    $conn,

    "SELECT * FROM medical_records
     WHERE doctor_email='".$doctor['email']."'
     ORDER BY id DESC"

);
$doctor_name = $_SESSION['fullname'] ?? 'Doctor';

$patient_name = $_POST['patient_name'] ?? $_POST['fullname'] ?? 'Patient';

notifyAdmins(
    $conn,
    "New Medical Record Added",
    "Dr. $doctor_name added a medical record for $patient_name.",
    "Medical Record"
);
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Doctor Medical Records</title>

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

        <div class="flex items-center gap-4 mb-14">

            <div class="w-16 h-16 rounded-3xl bg-gradient-to-r from-cyan-500 to-teal-500 flex items-center justify-center text-3xl shadow-2xl">

                <i class="fa-solid fa-user-doctor"></i>

            </div>

            <div>

                <h1 class="text-3xl font-black">
                    Doctor Portal
                </h1>

                <p class="text-cyan-200">
                    Medical Records
                </p>

            </div>

        </div>

        <!-- MENU -->
        <nav class="space-y-4">

            <a href="doctor-dashboard.php"
               class="flex items-center gap-4 px-6 py-5 rounded-2xl hover:bg-white/10 transition">

                <i class="fa-solid fa-chart-line"></i>
                Dashboard

            </a>

            <a href="doctor-medical-records.php"
               class="flex items-center gap-4 px-6 py-5 rounded-2xl bg-gradient-to-r from-cyan-500 to-teal-500 font-bold shadow-xl">

                <i class="fa-solid fa-notes-medical"></i>
                Medical Records

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
        <div class="mb-12">

            <h1 class="text-5xl font-black mb-3">

                Create Medical Record

            </h1>

            <p class="text-slate-300 text-lg">

                Add diagnosis and treatment information

            </p>

        </div>

        <!-- Success -->
        <?php if($success){ ?>

        <div class="bg-emerald-500/20 border border-emerald-400 text-emerald-200 p-5 rounded-2xl mb-8">

            <?php echo $success; ?>

        </div>

        <?php } ?>

        <!-- FORM -->
        <div class="glass rounded-[40px] p-10 mb-12">

            <form method="POST"
                  class="grid md:grid-cols-2 gap-8">

                <!-- Patient Name -->
                <div>

                    <label class="block mb-3 font-semibold">
                        Patient Name
                    </label>

                    <input type="text"
                           name="patient_name"
                           required
                           class="input w-full px-5 py-4 rounded-2xl">

                </div>

                <!-- Patient Email -->
                <div>

                    <label class="block mb-3 font-semibold">
                        Patient Email
                    </label>

                    <input type="email"
                           name="patient_email"
                           required
                           class="input w-full px-5 py-4 rounded-2xl">

                </div>

                <!-- Diagnosis -->
                <div class="md:col-span-2">

                    <label class="block mb-3 font-semibold">
                        Diagnosis
                    </label>

                    <textarea name="diagnosis"
                              rows="5"
                              required
                              class="input w-full px-5 py-4 rounded-2xl"></textarea>

                </div>

                <!-- Treatment -->
                <div class="md:col-span-2">

                    <label class="block mb-3 font-semibold">
                        Treatment
                    </label>

                    <textarea name="treatment"
                              rows="5"
                              required
                              class="input w-full px-5 py-4 rounded-2xl"></textarea>

                </div>

                <!-- Date -->
                <div>

                    <label class="block mb-3 font-semibold">
                        Record Date
                    </label>

                    <input type="date"
                           name="record_date"
                           required
                           class="input w-full px-5 py-4 rounded-2xl">

                </div>

                <!-- Submit -->
                <div class="flex items-end">

                    <button type="submit"
                            name="create_record"
                            class="w-full bg-gradient-to-r from-cyan-500 to-teal-500 hover:scale-105 transition transform py-5 rounded-2xl text-lg font-bold shadow-2xl">

                        Create Record

                    </button>

                </div>

            </form>

        </div>

        <!-- RECORDS -->
        <div class="glass rounded-[40px] p-10">

            <h2 class="text-4xl font-black mb-8">

                My Medical Records

            </h2>

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead>

                        <tr class="border-b border-white/10">

                            <th class="text-left py-5">
                                Patient
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

                        </tr>

                    </thead>

                    <tbody>

                        <?php while($row = mysqli_fetch_assoc($records)){ ?>

                        <tr class="border-b border-white/5">

                            <td class="py-6">

                                <?php echo $row['patient_name']; ?>

                            </td>

                            <td class="py-6">

                                <?php echo $row['diagnosis']; ?>

                            </td>

                            <td class="py-6">

                                <?php echo $row['treatment']; ?>

                            </td>

                            <td class="py-6">

                                <?php echo $row['record_date']; ?>

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