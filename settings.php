<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

include 'inc/config.php';
include 'inc/security.php';
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Patient') {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = (int) $_SESSION['user_id'];
$success = "";

$stmtUser = mysqli_prepare($conn, "SELECT * FROM users WHERE id = ? LIMIT 1");
mysqli_stmt_bind_param($stmtUser, "i", $user_id);
mysqli_stmt_execute($stmtUser);
$userQuery = mysqli_stmt_get_result($stmtUser);
$user = mysqli_fetch_assoc($userQuery);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $gender = trim($_POST['gender']);
    $dob = trim($_POST['dob']);
    $newPassword = $_POST['new_password'];

    $profileImage = $user['profile_image'] ?? '';

    if (!empty($_FILES['profile_image']['name'])) {
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
        $originalName = $_FILES['profile_image']['name'];
        $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

        if (in_array($extension, $allowedExtensions)) {
            $imageName = time() . "_" . bin2hex(random_bytes(6)) . "." . $extension;
            $tmpName = $_FILES['profile_image']['tmp_name'];
            $uploadFolder = "uploads/profile/";

            if (!is_dir($uploadFolder)) {
                mkdir($uploadFolder, 0777, true);
            }

            $fullPath = $uploadFolder . $imageName;
$allowed = ['jpg', 'jpeg', 'png'];

$ext = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

if (!in_array($ext, $allowed)) {
    die("Invalid image type");
}

if ($_FILES['profile_image']['size'] > 2000000) {
    die("Image too large");
}
            if (move_uploaded_file($tmpName, $fullPath)) {
                $profileImage = $fullPath;
            }
        }
    }

    $stmtUpdate = mysqli_prepare(
        $conn,
        "UPDATE users SET fullname = ?, email = ?, phone = ?, gender = ?, dob = ?, profile_image = ? WHERE id = ?"
    );
    mysqli_stmt_bind_param($stmtUpdate, "ssssssi", $fullname, $email, $phone, $gender, $dob, $profileImage, $user_id);
    mysqli_stmt_execute($stmtUpdate);

    if (!empty($newPassword)) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $stmtPass = mysqli_prepare($conn, "UPDATE users SET password = ? WHERE id = ?");
        mysqli_stmt_bind_param($stmtPass, "si", $hashedPassword, $user_id);
        mysqli_stmt_execute($stmtPass);
    }

    $success = "Account settings updated successfully.";

    $stmtRefresh = mysqli_prepare($conn, "SELECT * FROM users WHERE id = ? LIMIT 1");
    mysqli_stmt_bind_param($stmtRefresh, "i", $user_id);
    mysqli_stmt_execute($stmtRefresh);
    $userQuery = mysqli_stmt_get_result($stmtRefresh);
    $user = mysqli_fetch_assoc($userQuery);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Settings | Serah Hospital</title>

<script src="https://cdn.tailwindcss.com"></script>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

body {

    background:
    linear-gradient(
        135deg,
        #0f172a,
        #111827,
        #1e293b
    );

}

.glass {

    background: rgba(255,255,255,0.08);

    backdrop-filter: blur(20px);

    border: 1px solid rgba(255,255,255,0.1);

}

.input {

    background: rgba(255,255,255,0.06);

    border: 1px solid rgba(255,255,255,0.1);

    color: white;

}

.input::placeholder {

    color: #cbd5e1;

}

.input:focus {

    outline: none;

    border-color: #06b6d4;

    box-shadow: 0 0 0 4px rgba(6,182,212,0.2);

}

</style>

</head>

<body class="min-h-screen text-white">

<div class="flex">

    <!-- Sidebar -->
    <aside class="w-80 min-h-screen glass p-8">

        <!-- Logo -->
        <div class="flex items-center gap-4 mb-14">

            <div class="w-16 h-16 rounded-3xl bg-gradient-to-r from-cyan-500 to-teal-500 flex items-center justify-center text-3xl shadow-2xl">

                <i class="fa-solid fa-heart-pulse"></i>

            </div>

            <div>

                <h1 class="text-3xl font-black">
                    Serah Hospital
                </h1>

                <p class="text-cyan-200">
                    Premium Healthcare
                </p>

            </div>

        </div>

        <!-- Profile Card -->
        <div class="glass rounded-3xl p-8 text-center mb-10">

            <?php if (!empty($user['profile_image'])) { ?>

                <img src="<?php echo $user['profile_image']; ?>"
                     class="w-32 h-32 rounded-full mx-auto object-cover border-4 border-cyan-500 shadow-2xl">

            <?php } else { ?>

                <div class="w-32 h-32 rounded-full bg-gradient-to-r from-cyan-500 to-teal-500 flex items-center justify-center text-5xl mx-auto shadow-2xl">

                    <i class="fa-solid fa-user"></i>

                </div>

            <?php } ?>

            <h2 class="text-2xl font-bold mt-6">

                <?php echo $user['fullname']; ?>

            </h2>

            <p class="text-cyan-200 mt-2">

                <?php echo $user['role']; ?>

            </p>

        </div>

        <!-- Navigation -->
        <nav class="space-y-4">

            <a href="javascript:history.back()"
               class="flex items-center gap-4 px-6 py-5 rounded-2xl hover:bg-white/10 transition">

                <i class="fa-solid fa-arrow-left"></i>
                Back Dashboard

            </a>

            <a href="#"
               class="flex items-center gap-4 px-6 py-5 rounded-2xl bg-gradient-to-r from-cyan-500 to-teal-500 shadow-xl font-bold">

                <i class="fa-solid fa-gear"></i>
                Settings

            </a>

        </nav>

    </aside>

    <!-- Main -->
    <main class="flex-1 p-10">

        <!-- Header -->
        <div class="mb-10">

            <h1 class="text-5xl font-black mb-3">
                Account Settings
            </h1>

            <p class="text-slate-300 text-lg">
                Manage your healthcare account and profile
            </p>

        </div>

        <!-- Success -->
        <?php if ($success) { ?>

            <div class="bg-emerald-500/20 border border-emerald-400 text-emerald-200 p-5 rounded-2xl mb-8">

                <?php echo $success; ?>

            </div>

        <?php } ?>

        <!-- Settings Form -->
        <div class="glass rounded-[40px] p-10 shadow-2xl">

            <form method="POST"
                  enctype="multipart/form-data"
                  class="space-y-10">

                <!-- Section -->
                <div>

                    <h2 class="text-2xl font-bold mb-8">
                        Personal Information
                    </h2>

                    <!-- Profile Upload -->
                    <div class="mb-8">

                        <label class="block mb-4 font-semibold">
                            Profile Picture
                        </label>

                        <input type="file"
                               name="profile_image"
                               class="input w-full px-5 py-4 rounded-2xl">

                    </div>

                    <div class="grid md:grid-cols-2 gap-8">

                        <!-- Fullname -->
                        <div>

                            <label class="block mb-3 font-semibold">
                                Full Name
                            </label>

                            <input type="text"
                                   name="fullname"
                                   value="<?php echo $user['fullname']; ?>"
                                   class="input w-full px-5 py-4 rounded-2xl">

                        </div>

                        <!-- Email -->
                        <div>

                            <label class="block mb-3 font-semibold">
                                Email Address
                            </label>

                            <input type="email"
                                   name="email"
                                   value="<?php echo $user['email']; ?>"
                                   class="input w-full px-5 py-4 rounded-2xl">

                        </div>

                    </div>

                </div>

                <!-- Contact -->
                <div>

                    <h2 class="text-2xl font-bold mb-8">
                        Contact Information
                    </h2>

                    <div class="grid md:grid-cols-2 gap-8">

                        <!-- Phone -->
                        <div>

                            <label class="block mb-3 font-semibold">
                                Phone Number
                            </label>

                            <input type="text"
                                   name="phone"
                                   value="<?php echo $user['phone']; ?>"
                                   class="input w-full px-5 py-4 rounded-2xl">

                        </div>

                        <!-- Gender -->
                        <div>

                            <label class="block mb-3 font-semibold">
                                Gender
                            </label>

                            <select name="gender"
                                    class="input w-full px-5 py-4 rounded-2xl">

                                <option value="Male"
                                <?php if($user['gender']=="Male") echo "selected"; ?>>
                                Male
                                </option>

                                <option value="Female"
                                <?php if($user['gender']=="Female") echo "selected"; ?>>
                                Female
                                </option>

                            </select>

                        </div>

                    </div>

                </div>

                <!-- Security -->
                <div>

                    <h2 class="text-2xl font-bold mb-8">
                        Security
                    </h2>

                    <div class="grid md:grid-cols-2 gap-8">

                        <!-- DOB -->
                        <div>

                            <label class="block mb-3 font-semibold">
                                Date of Birth
                            </label>

                            <input type="date"
                                   name="dob"
                                   value="<?php echo $user['dob']; ?>"
                                   class="input w-full px-5 py-4 rounded-2xl">

                        </div>

                        <!-- Password -->
                        <div>

                            <label class="block mb-3 font-semibold">
                                New Password
                            </label>

                            <input type="password"
                                   name="new_password"
                                   placeholder="Enter new password"
                                   class="input w-full px-5 py-4 rounded-2xl">

                        </div>

                    </div>

                </div>

                <!-- Button -->
                <button type="submit"
                        class="bg-gradient-to-r from-cyan-500 to-teal-500 hover:scale-105 transition transform px-10 py-5 rounded-2xl text-lg font-bold shadow-2xl">

                    Save Changes

                </button>

            </form>

        </div>

    </main>

</div>

</body>

</html>