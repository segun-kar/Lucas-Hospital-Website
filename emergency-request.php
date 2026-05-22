<?php

include 'inc/config.php';
include 'inc/security.php';

$message = "";

if (isset($_POST['send_emergency'])) {

    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $emergency = mysqli_real_escape_string($conn, $_POST['emergency']);

    mysqli_query(
        $conn,
        "INSERT INTO emergency_requests
(fullname, email, phone, location, emergency, status)
VALUES
('$fullname', '$email', '$phone', '$location', '$emergency', 'Pending')"
    );

    $message = "Emergency request sent successfully. Admin will review it.";
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Emergency Request</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-950 min-h-screen flex items-center justify-center p-6 text-white">

<div class="w-full max-w-2xl bg-white/5 border border-white/10 rounded-[40px] p-10">

    <h1 class="text-4xl font-black text-center mb-4">
        Emergency Request
    </h1>

    <p class="text-slate-300 text-center mb-8">
        Fill this form and the admin will receive your emergency request.
    </p>

    <?php if ($message != "") { ?>
        <div class="bg-green-500/20 text-green-300 p-4 rounded-2xl mb-6 text-center">
            <?php echo $message; ?>
        </div>
    <?php } ?>

    <form method="POST" class="space-y-5">

        <input type="text"
               name="fullname"
               required
               placeholder="Full Name"
               class="w-full px-5 py-4 rounded-2xl bg-white/10 border border-white/10 outline-none">
        <input type="email"
               name="email"
               required
               placeholder="Email Address"
               class="w-full px-5 py-4 rounded-2xl bg-white/10 border border-white/10 outline-none">
        <input type="text"
               name="phone"
               required
               placeholder="Phone Number"
               class="w-full px-5 py-4 rounded-2xl bg-white/10 border border-white/10 outline-none">

        <input type="text"
               name="location"
               required
               placeholder="Current Location"
               class="w-full px-5 py-4 rounded-2xl bg-white/10 border border-white/10 outline-none">

        <textarea name="emergency"
                  required
                  rows="5"
                  placeholder="Describe the emergency"
                  class="w-full px-5 py-4 rounded-2xl bg-white/10 border border-white/10 outline-none"></textarea>

        <button type="submit"
                name="send_emergency"
                class="w-full bg-red-600 hover:bg-red-700 py-4 rounded-2xl font-bold">
            Send Emergency Request
        </button>

    </form>

    <div class="text-center mt-8">
        <a href="index.php" class="text-cyan-400 font-semibold">
            ← Back To Home
        </a>
    </div>

</div>

</body>
</html>