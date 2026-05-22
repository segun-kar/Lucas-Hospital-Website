<?php
include 'inc/config.php';
include 'inc/notify-admin.php';
include 'inc/security.php';
$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = trim($_POST['fullname']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $gender = trim($_POST['gender']);
    $dob = trim($_POST['dob']);
    $role = trim($_POST['role']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    $allowedRoles = ['Patient', 'Doctor', 'Nurse'];

    if ($password !== $confirmPassword) {
        $error = "Passwords do not match.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email address.";
    } elseif (!in_array($role, $allowedRoles)) {
        $error = "Invalid role selected.";
    } else {
        $check = mysqli_prepare($conn, "SELECT id FROM users WHERE email = ? OR username = ? LIMIT 1");
        mysqli_stmt_bind_param($check, "ss", $email, $username);
        mysqli_stmt_execute($check);
        $checkResult = mysqli_stmt_get_result($check);

        if ($checkResult && mysqli_num_rows($checkResult) > 0) {
            $error = "Email or username already exists.";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = mysqli_prepare(
                $conn,
                "INSERT INTO users (fullname, username, email, password, role, phone, gender, dob)
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
            );

            if ($stmt) {
                mysqli_stmt_bind_param(
                    $stmt,
                    "ssssssss",
                    $fullname,
                    $username,
                    $email,
                    $hashedPassword,
                    $role,
                    $phone,
                    $gender,
                    $dob
                );

                if (mysqli_stmt_execute($stmt)) {
                    $stmt2 = mysqli_prepare(
                        $conn,
                        "INSERT INTO patients (fullname, username, email, phone, gender, dob, role)
                         VALUES (?, ?, ?, ?, ?, ?, ?)"
                    );

                    if ($stmt2) {
                        mysqli_stmt_bind_param($stmt2, "sssssss", $fullname, $username, $email, $phone, $gender, $dob, $role);
                        mysqli_stmt_execute($stmt2);
                    }

                    if (function_exists('notifyAdmins')) {
                        notifyAdmins($conn, "New User Registration", "$fullname created a new $role account.", "User");
                    }

                    $success = "Account created successfully! You can now login.";
                } else {
                    $error = "Registration failed.";
                }
            } else {
                $error = "Registration failed. Check that users table has phone, gender, and dob columns.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Account | Lucas Hospital</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body class="bg-slate-950 min-h-screen overflow-hidden">

    <!-- Background Effects -->
    <div class="absolute top-0 left-0 w-96 h-96 bg-cyan-500/20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-teal-500/20 rounded-full blur-3xl"></div>

    <div class="relative min-h-screen flex items-center justify-center px-6 py-10">

        <div class="max-w-7xl w-full grid lg:grid-cols-2 bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl overflow-hidden shadow-2xl">

            <!-- LEFT SIDE -->
            <div class="hidden lg:flex flex-col justify-between p-12 bg-gradient-to-br from-cyan-700 to-teal-800 text-white">

                <div>

                    <div class="flex items-center gap-4 mb-10">

                        <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center text-3xl">
                            <i class="fa-solid fa-heart-pulse"></i>
                        </div>

                        <div>
                            <h1 class="text-3xl font-extrabold">
                                Lucas Hospital
                            </h1>
                            <p class="text-cyan-100">
                                Digital Healthcare Platform
                            </p>
                        </div>

                    </div>

                    <h2 class="text-5xl font-extrabold leading-tight mb-6">
                        Create Your Secure Healthcare Account
                    </h2>

                    <p class="text-lg text-cyan-100 leading-relaxed mb-10">
                        Register to access appointments, medical records,
                        doctor consultations, and advanced healthcare services.
                    </p>
 <!-- BUTTONS -->
<div class="flex gap-5 flex-wrap mb-10">

    <a href="index.php"
       class="bg-white text-cyan-700 hover:bg-cyan-100 px-8 py-4 rounded-2xl font-bold transition">

        Back Home

    </a>

    <a href="services.php"
       class="bg-white/10 hover:bg-white/20 border border-white/10 px-8 py-4 rounded-2xl font-bold transition">

        Explore Services

    </a>

</div>                  
                    <!-- Feature Cards -->
                    <div class="space-y-5">

                        <div class="bg-white/10 p-5 rounded-2xl backdrop-blur-md flex items-center gap-4">
                            <div class="w-14 h-14 rounded-xl bg-white/20 flex items-center justify-center text-2xl">
                                <i class="fa-solid fa-user-doctor"></i>
                            </div>

                            <div>
                                <h3 class="font-bold text-lg">
                                    Expert Doctors
                                </h3>

                                <p class="text-cyan-100 text-sm">
                                    Access top medical specialists
                                </p>
                            </div>
                        </div>

                        <div class="bg-white/10 p-5 rounded-2xl backdrop-blur-md flex items-center gap-4">
                            <div class="w-14 h-14 rounded-xl bg-white/20 flex items-center justify-center text-2xl">
                                <i class="fa-solid fa-calendar-check"></i>
                            </div>

                            <div>
                                <h3 class="font-bold text-lg">
                                    Easy Appointments
                                </h3>

                                <p class="text-cyan-100 text-sm">
                                    Book appointments online instantly
                                </p>
                            </div>
                        </div>

                        <div class="bg-white/10 p-5 rounded-2xl backdrop-blur-md flex items-center gap-4">
                            <div class="w-14 h-14 rounded-xl bg-white/20 flex items-center justify-center text-2xl">
                                <i class="fa-solid fa-shield-halved"></i>
                            </div>

                            <div>
                                <h3 class="font-bold text-lg">
                                    Secure Medical Data
                                </h3>

                                <p class="text-cyan-100 text-sm">
                                    Protected healthcare information
                                </p>
                            </div>
                        </div>

                    </div>

                </div>

                <!-- Bottom -->
                <div class="mt-10">

                    <div class="flex items-center gap-3 mb-3">
                        <i class="fa-solid fa-lock text-green-300"></i>
                        <span>Encrypted Authentication System</span>
                    </div>

                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-shield text-green-300"></i>
                        <span>Trusted Digital Healthcare Platform</span>
                    </div>

                </div>

            </div>

            <!-- RIGHT SIDE -->
            <div class="bg-white p-8 lg:p-14 overflow-y-auto max-h-screen">

                <div class="max-w-xl mx-auto">

                    <div class="text-center mb-10">

                        <div class="w-20 h-20 bg-cyan-100 rounded-3xl flex items-center justify-center mx-auto mb-6 text-cyan-700 text-4xl">
                            <i class="fa-solid fa-user-plus"></i>
                        </div>

                        <h2 class="text-4xl font-extrabold text-slate-800 mb-3">
                            Create Account
                        </h2>

                        <p class="text-gray-500">
                            Join Lucas Hospital digital healthcare platform
                        </p>

                    </div>

                    <!-- Success Message -->
                    <?php if ($success): ?>

                        <div class="bg-green-100 text-green-700 p-4 rounded-2xl mb-6">
                            <?php echo $success; ?>
                        </div>

                    <?php endif; ?>

                    <!-- Error Message -->
                    <?php if ($error): ?>

                        <div class="bg-red-100 text-red-700 p-4 rounded-2xl mb-6">
                            <?php echo $error; ?>
                        </div>

                    <?php endif; ?>

                    <!-- Registration Form -->
                    <form method="POST" class="space-y-6">

                        <!-- Full Name -->
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Full Name
                            </label>

                            <input type="text"
                                   name="fullname"
                                   required
                                   class="w-full px-5 py-4 border border-gray-300 rounded-2xl focus:ring-4 focus:ring-cyan-200 focus:border-cyan-500 outline-none transition"
                                   placeholder="Enter full name">

                        </div>

                        <!-- Username -->
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Username
                            </label>

                            <input type="text"
                                   name="username"
                                   required
                                   class="w-full px-5 py-4 border border-gray-300 rounded-2xl focus:ring-4 focus:ring-cyan-200 focus:border-cyan-500 outline-none transition"
                                   placeholder="Choose username">

                        </div>

                        <!-- Email -->
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Email Address
                            </label>

                            <input type="email"
                                   name="email"
                                   required
                                   class="w-full px-5 py-4 border border-gray-300 rounded-2xl focus:ring-4 focus:ring-cyan-200 focus:border-cyan-500 outline-none transition"
                                   placeholder="Enter email address">

                        </div>

                        <!-- Phone -->
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Phone Number
                            </label>

                            <input type="text"
                                   name="phone"
                                   required
                                   class="w-full px-5 py-4 border border-gray-300 rounded-2xl focus:ring-4 focus:ring-cyan-200 focus:border-cyan-500 outline-none transition"
                                   placeholder="Enter phone number">

                        </div>

                        <!-- Gender + DOB -->
                        <div class="grid md:grid-cols-2 gap-6">

                            <div>

                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Gender
                                </label>

                                <select name="gender"
                                        required
                                        class="w-full px-5 py-4 border border-gray-300 rounded-2xl focus:ring-4 focus:ring-cyan-200 focus:border-cyan-500 outline-none transition">

                                    <option value="">Select Gender</option>
                                    <option>Male</option>
                                    <option>Female</option>

                                </select>

                            </div>

                            <div>

                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Date of Birth
                                </label>

                                <input type="date"
                                       name="dob"
                                       required
                                       class="w-full px-5 py-4 border border-gray-300 rounded-2xl focus:ring-4 focus:ring-cyan-200 focus:border-cyan-500 outline-none transition">

                            </div>

                        </div>

                        <!-- Role -->
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Select Role
                            </label>

                            <select name="role"
                                    required
                                    class="w-full px-5 py-4 border border-gray-300 rounded-2xl focus:ring-4 focus:ring-cyan-200 focus:border-cyan-500 outline-none transition">

                                <option value="">Select Role</option>
                                <option>Patient</option>
                                <option>Doctor</option>
                                <option>Nurse</option>

                            </select>

                        </div>

                        <!-- Password -->
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Password
                            </label>

                            <input type="password"
                                   name="password"
                                   id="password"
                                   required
                                   class="w-full px-5 py-4 border border-gray-300 rounded-2xl focus:ring-4 focus:ring-cyan-200 focus:border-cyan-500 outline-none transition"
                                   placeholder="Create password">

                        </div>

                        <!-- Confirm Password -->
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Confirm Password
                            </label>

                            <input type="password"
                                   name="confirm_password"
                                   required
                                   class="w-full px-5 py-4 border border-gray-300 rounded-2xl focus:ring-4 focus:ring-cyan-200 focus:border-cyan-500 outline-none transition"
                                   placeholder="Confirm password">

                        </div>

                        <!-- Terms -->
                        <div class="flex items-start gap-3">

                            <input type="checkbox"
                                   required
                                   class="mt-1 rounded border-gray-300 text-cyan-600">

                            <p class="text-gray-600 text-sm">
                                I agree to the Terms & Conditions and Privacy Policy
                            </p>

                        </div>

                        <!-- Button -->
                        <button type="submit"
                                class="w-full bg-gradient-to-r from-cyan-600 to-teal-600 hover:from-cyan-700 hover:to-teal-700 text-white py-4 rounded-2xl font-bold text-lg shadow-xl transition duration-300">

                            Create Secure Account

                        </button>

                    </form>

                    <!-- Login Link -->
                    <div class="text-center mt-8">

                        <p class="text-gray-600">

                            Already have an account?

                            <a href="login.php"
                               class="text-cyan-600 font-bold hover:text-cyan-700">
                                Login Here
                            </a>

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>