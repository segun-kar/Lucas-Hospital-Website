<?php
session_start();
include 'inc/config.php';
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.php");
    exit();
}
if (!isset($_SESSION['user_id']) || strtolower($_SESSION['role'] ?? '') !== 'admin') {
    header("Location: login.php");
    exit();
}

$message = "";

/* ADD USER */
if (isset($_POST['add_user'])) {
    $fullname = trim($_POST['fullname']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $role = trim($_POST['role']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $allowedRoles = ['Patient', 'Doctor', 'Admin'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email address.";
    } elseif (!in_array($role, $allowedRoles)) {
        $message = "Invalid role.";
    } else {
        $stmt = mysqli_prepare($conn, "INSERT INTO users (fullname, username, email, password, role) VALUES (?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sssss", $fullname, $username, $email, $password, $role);

        if (mysqli_stmt_execute($stmt)) {
            $message = "User added successfully.";
        } else {
            $message = "Failed to add user. Email or username may already exist.";
        }
    }
}

/* DELETE USER */
if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];

    if ($id > 0 && $id != (int) $_SESSION['user_id']) {
        $stmt = mysqli_prepare($conn, "DELETE FROM users WHERE id = ?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $message = "User deleted successfully.";
    }
}

/* FETCH USERS */
$users = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Users | Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-950 text-white min-h-screen p-10">

    <div class="max-w-7xl mx-auto">

        <div class="flex justify-between items-center mb-10">
            <div>
                <h1 class="text-5xl font-black">Manage Users</h1>
                <p class="text-slate-400 mt-2">Add or remove doctors and patients</p>
            </div>

            <a href="admin-dashboard.php"
               class="bg-cyan-600 px-6 py-3 rounded-xl font-bold">
                Back Dashboard
            </a>
        </div>

        <?php if ($message) { ?>
            <div class="bg-green-500/20 text-green-300 p-4 rounded-xl mb-8">
                <?php echo $message; ?>
            </div>
        <?php } ?>

        <!-- ADD USER FORM -->
        <div class="bg-white/5 border border-white/10 rounded-3xl p-8 mb-10">

            <h2 class="text-3xl font-bold mb-6">Add New User</h2>

            <form method="POST" class="grid md:grid-cols-2 gap-6">

                <input type="text" name="fullname" required placeholder="Full Name"
                       class="bg-white/10 border border-white/10 px-5 py-4 rounded-xl">

                <input type="text" name="username" required placeholder="Username"
                       class="bg-white/10 border border-white/10 px-5 py-4 rounded-xl">

                <input type="email" name="email" required placeholder="Email"
                       class="bg-white/10 border border-white/10 px-5 py-4 rounded-xl">

                <input type="password" name="password" required placeholder="Password"
                       class="bg-white/10 border border-white/10 px-5 py-4 rounded-xl">

                <select name="role"
                        class="bg-white/10 border border-white/10 px-5 py-4 rounded-xl">
                    <option value="Patient">Patient</option>
                    <option value="Doctor">Doctor</option>
                    <option value="Admin">Admin</option>
                </select>

                <button type="submit" name="add_user"
                        class="bg-cyan-600 hover:bg-cyan-700 px-6 py-4 rounded-xl font-bold">
                    Add User
                </button>

            </form>

        </div>

        <!-- USERS TABLE -->
        <div class="bg-white/5 border border-white/10 rounded-3xl p-8 overflow-x-auto">

            <h2 class="text-3xl font-bold mb-6">All Users</h2>

            <table class="w-full">
                <thead>
                    <tr class="border-b border-white/10">
                        <th class="text-left py-4">Name</th>
                        <th class="text-left py-4">Username</th>
                        <th class="text-left py-4">Email</th>
                        <th class="text-left py-4">Role</th>
                        <th class="text-left py-4">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($users)) { ?>
                    <tr class="border-b border-white/5">
                        <td class="py-4"><?php echo $row['fullname']; ?></td>
                        <td class="py-4"><?php echo $row['username']; ?></td>
                        <td class="py-4"><?php echo $row['email']; ?></td>
                        <td class="py-4"><?php echo $row['role']; ?></td>
                        <td class="py-4">
                            <a href="admin-users.php?delete=<?php echo $row['id']; ?>"
                               onclick="return confirm('Delete this user?')"
                               class="bg-red-600 px-4 py-2 rounded-lg">
                                Delete
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>

    </div>

</body>
</html>