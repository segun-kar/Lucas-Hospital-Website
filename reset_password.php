<?php
session_start();
include 'inc/config.php';
include 'inc/send-mail.php';

$message = "";

if (!isset($_SESSION['reset_email'])) {
    header("Location: forgot-password.php");
    exit();
}

$email = $_SESSION['reset_email'];
$now = date("Y-m-d H:i:s");

/* RESEND OTP */
if (isset($_POST['resend_code'])) {
    $code = (string) random_int(100000, 999999);
    $expires = date("Y-m-d H:i:s", strtotime("+10 minutes"));

    $stmtDelete = mysqli_prepare($conn, "DELETE FROM password_resets WHERE email = ?");
    mysqli_stmt_bind_param($stmtDelete, "s", $email);
    mysqli_stmt_execute($stmtDelete);

    $stmtInsert = mysqli_prepare($conn, "INSERT INTO password_resets (email, code, expires_at) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmtInsert, "sss", $email, $code, $expires);
    mysqli_stmt_execute($stmtInsert);

    if (sendResetCode($email, $code)) {
        unset($_SESSION['otp_verified']);
        $message = "A new OTP has been sent to your email.";
    } else {
        $message = "Failed to resend OTP.";
    }
}

/* GET OTP EXPIRY TIME */
$stmtExpiry = mysqli_prepare($conn, "SELECT * FROM password_resets WHERE email = ? ORDER BY id DESC LIMIT 1");
mysqli_stmt_bind_param($stmtExpiry, "s", $email);
mysqli_stmt_execute($stmtExpiry);
$getCode = mysqli_stmt_get_result($stmtExpiry);
$resetData = mysqli_fetch_assoc($getCode);
$expires_at = $resetData ? strtotime($resetData['expires_at']) : time();

/* VERIFY OTP FIRST */
if (isset($_POST['verify_code'])) {
    $code = trim($_POST['code']);

    $stmtCheck = mysqli_prepare(
        $conn,
        "SELECT id FROM password_resets WHERE email = ? AND code = ? AND expires_at >= ? LIMIT 1"
    );
    mysqli_stmt_bind_param($stmtCheck, "sss", $email, $code, $now);
    mysqli_stmt_execute($stmtCheck);
    $checkCode = mysqli_stmt_get_result($stmtCheck);

    if ($checkCode && mysqli_num_rows($checkCode) > 0) {
        $_SESSION['otp_verified'] = true;
        $message = "OTP verified. You can now create a new password.";
    } else {
        $message = "Invalid or expired OTP.";
    }
}

/* RESET PASSWORD ONLY AFTER OTP VERIFIED */
if (isset($_POST['reset_password'])) {
    if (!isset($_SESSION['otp_verified'])) {
        $message = "Please verify your OTP first.";
    } else {
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if ($password !== $confirm_password) {
            $message = "Passwords do not match.";
        } elseif (strlen($password) < 6) {
            $message = "Password must be at least 6 characters.";
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmtUpdate = mysqli_prepare($conn, "UPDATE users SET password = ? WHERE email = ?");
            mysqli_stmt_bind_param($stmtUpdate, "ss", $hashedPassword, $email);
            mysqli_stmt_execute($stmtUpdate);

            $stmtDelete = mysqli_prepare($conn, "DELETE FROM password_resets WHERE email = ?");
            mysqli_stmt_bind_param($stmtDelete, "s", $email);
            mysqli_stmt_execute($stmtDelete);

            unset($_SESSION['reset_email']);
            unset($_SESSION['otp_verified']);

            $message = "Password reset successful. You can now login.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-950 min-h-screen flex items-center justify-center p-6 text-white">

<div class="w-full max-w-xl bg-white/5 border border-white/10 rounded-[40px] p-10">

    <h1 class="text-5xl font-black mb-4 text-center">Reset Password</h1>

    <p class="text-slate-300 text-center mb-6">
        Enter the OTP sent to your email.
    </p>

    <div class="text-center mb-6">
        <p class="text-slate-400">OTP expires in:</p>
        <h2 id="countdown" class="text-3xl font-black text-cyan-400"></h2>
    </div>

    <?php if ($message != "") { ?>
        <div class="bg-cyan-500/20 text-cyan-200 p-4 rounded-2xl mb-6 text-center">
            <?php echo $message; ?>
        </div>
    <?php } ?>

    <?php if (!isset($_SESSION['otp_verified'])) { ?>

        <form method="POST" class="space-y-6">

            <input type="text"
                   name="code"
                   required
                   maxlength="6"
                   placeholder="Enter 6-digit OTP"
                   class="w-full px-5 py-4 rounded-2xl bg-white/10 border border-white/10 outline-none">

            <button type="submit"
                    name="verify_code"
                    class="w-full bg-cyan-600 hover:bg-cyan-700 py-4 rounded-2xl font-bold">
                Verify OTP
            </button>

        </form>

    <?php } else { ?>

        <form method="POST" class="space-y-6">

            <input type="password"
                   name="password"
                   required
                   placeholder="New password"
                   class="w-full px-5 py-4 rounded-2xl bg-white/10 border border-white/10 outline-none">

            <input type="password"
                   name="confirm_password"
                   required
                   placeholder="Confirm new password"
                   class="w-full px-5 py-4 rounded-2xl bg-white/10 border border-white/10 outline-none">

            <button type="submit"
                    name="reset_password"
                    class="w-full bg-green-600 hover:bg-green-700 py-4 rounded-2xl font-bold">
                Reset Password
            </button>

        </form>

    <?php } ?>

    <form method="POST" class="mt-6 text-center">
        <button type="submit"
                name="resend_code"
                class="text-cyan-400 font-semibold hover:underline">
            Resend OTP
        </button>
    </form>

    <div class="text-center mt-8">
        <a href="login.php" class="text-cyan-400 font-semibold">
            Back To Login
        </a>
    </div>

</div>

<script>
let expiryTime = <?php echo $expires_at * 1000; ?>;

function updateCountdown() {
    let now = new Date().getTime();
    let distance = expiryTime - now;

    if (distance <= 0) {
        document.getElementById("countdown").innerHTML = "Expired";
        return;
    }

    let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    let seconds = Math.floor((distance % (1000 * 60)) / 1000);

    document.getElementById("countdown").innerHTML =
        minutes + "m " + seconds + "s";
}

setInterval(updateCountdown, 1000);
updateCountdown();
</script>

</body>
</html>