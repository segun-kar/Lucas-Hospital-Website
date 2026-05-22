<?php
session_start();
include 'inc/config.php';
include 'inc/send-mail.php';

$message = "";

if (isset($_POST['send_code'])) {
    $email = trim($_POST['email']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email address.";
    } else {
        $stmt = mysqli_prepare($conn, "SELECT id FROM users WHERE email = ? LIMIT 1");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $check = mysqli_stmt_get_result($stmt);

        if ($check && mysqli_num_rows($check) > 0) {
            $code = (string) random_int(100000, 999999);
            $expires = date("Y-m-d H:i:s", strtotime("+10 minutes"));

            $stmtDelete = mysqli_prepare($conn, "DELETE FROM password_resets WHERE email = ?");
            mysqli_stmt_bind_param($stmtDelete, "s", $email);
            mysqli_stmt_execute($stmtDelete);

            $stmtInsert = mysqli_prepare($conn, "INSERT INTO password_resets (email, code, expires_at) VALUES (?, ?, ?)");
            mysqli_stmt_bind_param($stmtInsert, "sss", $email, $code, $expires);
            mysqli_stmt_execute($stmtInsert);

            if (sendResetCode($email, $code)) {
                $_SESSION['reset_email'] = $email;
                header("Location: reset_password.php");
                exit();
            } else {
                $message = "Failed to send email. Check your SMTP settings.";
            }
        } else {
            $message = "No account found with this email.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-950 min-h-screen flex items-center justify-center p-6 text-white">

<div class="w-full max-w-xl bg-white/5 border border-white/10 rounded-[40px] p-10">

    <h1 class="text-5xl font-black mb-4 text-center">Forgot Password</h1>

    <p class="text-slate-300 text-center mb-8">
        Enter your email. We will send you a 6-digit reset code.
    </p>

    <?php if ($message != "") { ?>
        <div class="bg-red-500/20 text-red-200 p-4 rounded-2xl mb-6 text-center">
            <?php echo $message; ?>
        </div>
    <?php } ?>

    <form method="POST" class="space-y-6">

        <input type="email"
               name="email"
               required
               placeholder="Enter your email"
               class="w-full px-5 py-4 rounded-2xl bg-white/10 border border-white/10 outline-none">

        <button type="submit"
                name="send_code"
                class="w-full bg-cyan-600 hover:bg-cyan-700 py-4 rounded-2xl font-bold">
            Send Reset Code
        </button>

    </form>

    <div class="text-center mt-8">
        <a href="login.php" class="text-cyan-400 font-semibold">
            ← Back To Login
        </a>
    </div>

</div>

</body>
</html>