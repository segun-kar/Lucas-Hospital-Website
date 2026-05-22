<?php

session_start();
session_destroy();

?>

<!DOCTYPE html>
<html>
<head>

    <title>Logged Out</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-slate-950 text-white min-h-screen flex items-center justify-center">

<div class="bg-white/5 border border-white/10 rounded-[40px] p-16 text-center max-w-2xl">

    <div class="w-28 h-28 rounded-full bg-cyan-500/20 flex items-center justify-center text-cyan-400 text-5xl mx-auto mb-8">

        ✓

    </div>

    <h1 class="text-5xl font-black mb-6">

        Logged Out Successfully

    </h1>

    <p class="text-slate-300 text-xl mb-10">

        Thank you for using Lucas Hospital Management System.

    </p>

    <div class="flex justify-center gap-5 flex-wrap">

        <a href="index.php"
           class="bg-cyan-500 hover:bg-cyan-600 px-8 py-4 rounded-2xl font-bold">

            Back Home

        </a>

        <a href="login.php"
           class="bg-white/10 hover:bg-white/20 px-8 py-4 rounded-2xl font-bold">

            Login Again

        </a>

    </div>

</div>

</body>
</html>