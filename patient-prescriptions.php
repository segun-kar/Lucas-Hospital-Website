<?php

session_start();

include 'inc/config.php';

if(!isset($_SESSION['user_id'])){

    header("Location: login.php");
    exit();

}

$user_id = $_SESSION['user_id'];

/*
|--------------------------------------------------------------------------
| FETCH USER
|--------------------------------------------------------------------------
*/

$userQuery = mysqli_query(

    $conn,

    "SELECT * FROM users
     WHERE id='$user_id'"

);

$user = mysqli_fetch_assoc($userQuery);

$email = $user['email'];

/*
|--------------------------------------------------------------------------
| FETCH PRESCRIPTIONS
|--------------------------------------------------------------------------
*/

$prescriptions = mysqli_query(

    $conn,

    "SELECT * FROM prescriptions
     WHERE patient_email='$email'
     ORDER BY id DESC"

);

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>My Prescriptions</title>

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

.card-hover {

    transition: 0.4s;

}

.card-hover:hover {

    transform: translateY(-8px);

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
                    Patient Portal
                </h1>

                <p class="text-cyan-200">
                    Prescriptions
                </p>

            </div>

        </div>

        <!-- MENU -->
        <nav class="space-y-4">

            <a href="patient-dashboard.php"
               class="flex items-center gap-4 px-6 py-5 rounded-2xl hover:bg-white/10 transition">

                <i class="fa-solid fa-chart-line"></i>
                Dashboard

            </a>

            <a href="patient-prescriptions.php"
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

                My Prescriptions

            </h1>

            <p class="text-slate-300 text-lg">

                View doctor prescriptions and medications

            </p>

        </div>

        <!-- PRESCRIPTIONS -->
        <div class="grid gap-8">

            <?php if(mysqli_num_rows($prescriptions) > 0){ ?>

                <?php while($row = mysqli_fetch_assoc($prescriptions)){ ?>

                <div class="glass rounded-[40px] p-10 card-hover">

                    <!-- TOP -->
                    <div class="flex flex-wrap items-center justify-between gap-5 mb-8">

                        <div>

                            <h2 class="text-3xl font-black mb-2">

                                Dr. <?php echo $row['doctor_name']; ?>

                            </h2>

                            <p class="text-cyan-300">

                                Prescription Specialist

                            </p>

                        </div>

                        <div class="bg-cyan-500/20 text-cyan-300 px-5 py-3 rounded-2xl">

                            <?php echo $row['prescription_date']; ?>

                        </div>

                    </div>

                    <!-- MEDICATION -->
                    <div class="mb-8">

                        <h3 class="text-2xl font-bold mb-4 text-cyan-400">

                            Medication

                        </h3>

                        <p class="text-slate-300 text-lg leading-relaxed">

                            <?php echo $row['medication']; ?>

                        </p>

                    </div>

                    <!-- DOSAGE -->
                    <div class="mb-8">

                        <h3 class="text-2xl font-bold mb-4 text-emerald-400">

                            Dosage

                        </h3>

                        <p class="text-slate-300 text-lg leading-relaxed">

                            <?php echo $row['dosage']; ?>

                        </p>

                    </div>

                    <!-- INSTRUCTIONS -->
                    <div>

                        <h3 class="text-2xl font-bold mb-4 text-purple-400">

                            Instructions

                        </h3>

                        <p class="text-slate-300 text-lg leading-relaxed">

                            <?php echo $row['instructions']; ?>

                        </p>

                    </div>

                </div>

                <?php } ?>

            <?php } else { ?>

                <!-- EMPTY -->
                <div class="glass rounded-[40px] p-20 text-center">

                    <div class="w-28 h-28 rounded-full bg-cyan-500/20 flex items-center justify-center text-cyan-400 text-5xl mx-auto mb-8">

                        <i class="fa-solid fa-prescription-bottle-medical"></i>

                    </div>

                    <h2 class="text-4xl font-black mb-5">

                        No Prescriptions Found

                    </h2>

                    <p class="text-slate-300 text-xl leading-relaxed">

                        Your doctor prescriptions will appear here.

                    </p>

                </div>

            <?php } ?>

        </div>

    </main>

</div>

</body>

</html>