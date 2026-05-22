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
| CREATE PRESCRIPTION
|--------------------------------------------------------------------------
*/

$success = "";

if(isset($_POST['create_prescription'])){

    $patient_name = mysqli_real_escape_string(
        $conn,
        $_POST['patient_name']
    );

    $patient_email = mysqli_real_escape_string(
        $conn,
        $_POST['patient_email']
    );

    $medication = mysqli_real_escape_string(
        $conn,
        $_POST['medication']
    );

    $dosage = mysqli_real_escape_string(
        $conn,
        $_POST['dosage']
    );

    $instructions = mysqli_real_escape_string(
        $conn,
        $_POST['instructions']
    );

    $prescription_date = $_POST['prescription_date'];

    $doctor_name = $doctor['fullname'];

    $doctor_email = $doctor['email'];

    mysqli_query(

        $conn,

        "INSERT INTO prescriptions (

            patient_name,
            patient_email,
            doctor_name,
            doctor_email,
            medication,
            dosage,
            instructions,
            prescription_date

        )

        VALUES (

            '$patient_name',
            '$patient_email',
            '$doctor_name',
            '$doctor_email',
            '$medication',
            '$dosage',
            '$instructions',
            '$prescription_date'

        )"

    );
notifyAdmins(
    $conn,
    "New Prescription Created",
    "Dr. $doctor_name created a prescription for $patient_name.",
    "Prescription"
);
    $success = "Prescription created successfully.";

}

/*
|--------------------------------------------------------------------------
| FETCH PRESCRIPTIONS
|--------------------------------------------------------------------------
*/

$prescriptions = mysqli_query(

    $conn,

    "SELECT * FROM prescriptions
     WHERE doctor_email='".$doctor['email']."'
     ORDER BY id DESC"

);

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Doctor Prescriptions</title>

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

                <i class="fa-solid fa-prescription-bottle-medical"></i>

            </div>

            <div>

                <h1 class="text-3xl font-black">
                    Doctor Portal
                </h1>

                <p class="text-cyan-200">
                    Prescriptions
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

            <a href="doctor-prescriptions.php"
               class="flex items-center gap-4 px-6 py-5 rounded-2xl bg-gradient-to-r from-cyan-500 to-teal-500 font-bold shadow-xl">

                <i class="fa-solid fa-prescription-bottle-medical"></i>
                Prescriptions

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

        <div class="mb-12">

            <h1 class="text-5xl font-black mb-3">

                Create Prescription

            </h1>

            <p class="text-slate-300 text-lg">

                Prescribe medication for patients

            </p>

        </div>

        <!-- SUCCESS -->
        <?php if($success){ ?>

        <div class="bg-emerald-500/20 border border-emerald-400 text-emerald-200 p-5 rounded-2xl mb-8">

            <?php echo $success; ?>

        </div>

        <?php } ?>

        <!-- FORM -->
        <div class="glass rounded-[40px] p-10 mb-12">

            <form method="POST"
                  class="grid md:grid-cols-2 gap-8">

                <div>

                    <label class="block mb-3 font-semibold">
                        Patient Name
                    </label>

                    <input type="text"
                           name="patient_name"
                           required
                           class="input w-full px-5 py-4 rounded-2xl">

                </div>

                <div>

                    <label class="block mb-3 font-semibold">
                        Patient Email
                    </label>

                    <input type="email"
                           name="patient_email"
                           required
                           class="input w-full px-5 py-4 rounded-2xl">

                </div>

                <div class="md:col-span-2">

                    <label class="block mb-3 font-semibold">
                        Medication
                    </label>

                    <textarea name="medication"
                              rows="4"
                              required
                              class="input w-full px-5 py-4 rounded-2xl"></textarea>

                </div>

                <div>

                    <label class="block mb-3 font-semibold">
                        Dosage
                    </label>

                    <input type="text"
                           name="dosage"
                           required
                           placeholder="Example: 2 tablets daily"
                           class="input w-full px-5 py-4 rounded-2xl">

                </div>

                <div>

                    <label class="block mb-3 font-semibold">
                        Prescription Date
                    </label>

                    <input type="date"
                           name="prescription_date"
                           required
                           class="input w-full px-5 py-4 rounded-2xl">

                </div>

                <div class="md:col-span-2">

                    <label class="block mb-3 font-semibold">
                        Instructions
                    </label>

                    <textarea name="instructions"
                              rows="5"
                              required
                              class="input w-full px-5 py-4 rounded-2xl"></textarea>

                </div>

                <div class="md:col-span-2">

                    <button type="submit"
                            name="create_prescription"
                            class="w-full bg-gradient-to-r from-cyan-500 to-teal-500 hover:scale-105 transition transform py-5 rounded-2xl text-lg font-bold shadow-2xl">

                        Create Prescription

                    </button>

                </div>

            </form>

        </div>

    </main>

</div>

</body>

</html>