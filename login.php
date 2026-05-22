<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

include 'inc/config.php';
include 'inc/security.php';
$error = "";

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE email = ? LIMIT 1");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $query = mysqli_stmt_get_result($stmt);

    if ($query && mysqli_num_rows($query) > 0) {
        $user = mysqli_fetch_assoc($query);

        if (password_verify($password, $user['password'])) {
            session_regenerate_id(true);

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['fullname'] = $user['fullname'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] == "Admin") {
                header("Location: admin-dashboard.php");
                exit();
            } elseif ($user['role'] == "Doctor") {
                header("Location: doctor-dashboard.php");
                exit();
            } else {
                header("Location: patient-dashboard.php");
                exit();
            }
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "Account not found.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Login | Lucas Hospital</title>

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

    background: rgba(255,255,255,0.06);

    backdrop-filter: blur(20px);

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

<body class="bg-slate-950 min-h-screen overflow-hidden">

<!-- Background Effects -->
<div class="absolute top-0 left-0 w-96 h-96 bg-cyan-500/20 rounded-full blur-3xl"></div>
<div class="absolute bottom-0 right-0 w-96 h-96 bg-teal-500/20 rounded-full blur-3xl"></div>

<div class="relative min-h-screen flex items-center justify-center px-6 py-10">

    <div class="max-w-7xl w-full grid lg:grid-cols-2 bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl overflow-hidden shadow-2xl">

        <!-- LEFT SIDE -->
        <div class="relative hidden lg:flex flex-col justify-between p-12 text-white overflow-hidden">

            <!-- IMAGE -->
            <img src="hospital-banner.jpg3"
                 class="absolute inset-0 w-full h-full object-cover"
                 alt="Hospital">

            <!-- OVERLAY -->
            <div class="absolute inset-0 bg-gradient-to-br from-cyan-900/80 via-slate-950/80 to-slate-950/90"></div>

            <!-- CONTENT -->
            <div class="relative z-10">

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

                    Secure Access To
                    Smart Healthcare

                </h2>

                <p class="text-lg text-cyan-100 leading-relaxed mb-10">

                    Login to access appointments,
                    prescriptions, notifications,
                    medical records, and hospital services.

                </p>

                <!-- BUTTONS -->
                <div class="flex gap-5 flex-wrap">

                    <a href="index.php"
                       class="bg-cyan-500 hover:bg-cyan-600 px-8 py-4 rounded-2xl font-bold transition">

                        Back Home

                    </a>

                    <a href="services.php"
                       class="bg-white/10 hover:bg-white/20 border border-white/10 px-8 py-4 rounded-2xl font-bold transition">

                        Explore Services

                    </a>

                </div>

            </div>

            <!-- BOTTOM -->
            <div class="relative z-10 mt-10">

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

                <!-- TOP -->
                <div class="text-center mb-10">

                    <div class="w-20 h-20 bg-cyan-100 rounded-3xl flex items-center justify-center mx-auto mb-6 text-cyan-700 text-4xl">

                        <i class="fa-solid fa-user-lock"></i>

                    </div>

                    <h2 class="text-4xl font-extrabold text-slate-800 mb-3">

                        Welcome Back

                    </h2>

                    <p class="text-gray-500">

                        Login to your hospital account

                    </p>

                </div>

                <!-- ERROR -->
                <?php if ($error) { ?>

                    <div class="bg-red-100 text-red-700 p-4 rounded-2xl mb-6">

                        <?php echo $error; ?>

                    </div>

                <?php } ?>

                <!-- FORM -->
                <form method="POST" class="space-y-6">

                    <!-- EMAIL -->
                    <div>

                        <label class="block text-sm font-semibold text-gray-700 mb-2">

                            Email Address

                        </label>

                        <input type="email"
                               name="email"
                               required
                               placeholder="Enter email"
                               class="w-full px-5 py-4 border border-gray-300 rounded-2xl focus:ring-4 focus:ring-cyan-200 focus:border-cyan-500 outline-none transition">

                    </div>

<!-- Password -->
<div>

    <label class="block text-sm font-semibold text-gray-700 mb-2">
        Password
    </label>

    <div class="relative">

        <input type="password"
               name="password"
               id="password"
               required
               placeholder="Enter password"
               class="w-full px-5 py-4 pr-14 border border-gray-300 rounded-2xl focus:ring-4 focus:ring-cyan-200 focus:border-cyan-500 outline-none transition">

        <button type="button"
                onclick="togglePassword()"
                class="absolute right-5 top-1/2 -translate-y-1/2 text-gray-500 hover:text-cyan-600">

            <i id="eyeIcon" class="fa-solid fa-eye"></i>

        </button>

    </div>

</div>

<!-- Forgot Password -->
<div class="flex justify-end">

    <a href="forgot-password.php"

       class="text-cyan-600 font-semibold hover:text-cyan-700 text-sm">

        Forgot Password?

    </a>

</div>

</div>

                    <!-- BUTTON -->
                    <button type="submit"
                            name="login"
                            class="w-full bg-gradient-to-r from-cyan-600 to-teal-600 hover:from-cyan-700 hover:to-teal-700 text-white py-4 rounded-2xl font-bold text-lg shadow-xl transition duration-300">

                        Login Securely

                    </button>

                </form>

                <!-- REGISTER -->
                <div class="text-center mt-8">

                    <p class="text-gray-600">

                        Don't have an account?

                        <a href="register.php"
                           class="text-cyan-600 font-bold hover:text-cyan-700">

                            Create Account

                        </a>

                    </p>

                </div>

            </div>

        </div>

    </div>

</div>
<script>
function togglePassword() {

    const password = document.getElementById("password");
    const eyeIcon = document.getElementById("eyeIcon");

    if (password.type === "password") {
        password.type = "text";
        eyeIcon.classList.remove("fa-eye");
        eyeIcon.classList.add("fa-eye-slash");
    } else {
        password.type = "password";
        eyeIcon.classList.remove("fa-eye-slash");
        eyeIcon.classList.add("fa-eye");
    }

}
</script>
</body>

</html>