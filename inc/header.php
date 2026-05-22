<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Lucas Hospital'; ?></title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="assets/responsive.css">

    <style>
        .nav-link {
            color: #0f172a;
        }

        .nav-link:hover {
            color: #06b6d4;
        }

        .dark-mode {
            background: #020617;
            color: white;
        }

        .dark-mode section {
            background-color: #0f172a !important;
            color: white !important;
        }

        .dark-mode h1,
        .dark-mode h2,
        .dark-mode h3,
        .dark-mode p {
            color: white !important;
        }

        .dark-mode .nav-link,
        .dark-mode .brand-text {
            color: white !important;
        }
        .dark-mode #mobileMenu {
        background: #0f172a !important;
        border-color: rgba(255,255,255,0.1) !important;
        }
        .dark-mode .brand-subtitle {
            color: #a5f3fc !important;
        }

        .dark-mode .bg-white {
            background-color: #1e293b !important;
        }
    </style>
</head>

<body class="bg-gray-50 text-slate-800">

<header id="navbar"
        class="fixed top-0 left-0 w-full z-50 bg-white/95 backdrop-blur-xl shadow-lg transition-all duration-500">

    <div class="max-w-7xl mx-auto px-4 sm:px-6">

       <div class="flex items-center justify-between py-4 relative">

           <a href="index.php" class="flex items-center gap-3">

                <div class="w-12 h-12 rounded-2xl bg-gradient-to-r from-cyan-600 to-teal-600 flex items-center justify-center text-white text-xl shadow-lg">
                    <i class="fa-solid fa-heart-pulse"></i>
                </div>

                <div>
                    <h1 class="brand-text text-xl sm:text-2xl font-extrabold text-slate-900">
                        Lucas Hospital
                    </h1>

                    <p class="brand-subtitle text-xs sm:text-sm text-cyan-700">
                        Advanced Healthcare
                    </p>
                </div>

            </a>

            <nav class="hidden lg:flex items-center gap-8">
                <a href="index.php" class="nav-link font-semibold transition">Home</a>
                <a href="about.php" class="nav-link font-semibold transition">About</a>
                <a href="services.php" class="nav-link font-semibold transition">Services</a>
                <a href="doctors.php" class="nav-link font-semibold transition">Doctors</a>
                <a href="appointments.php" class="nav-link font-semibold transition">Appointments</a>
                <a href="contact.php" class="nav-link font-semibold transition">Contact</a>
            </nav>

            <div class="hidden lg:flex items-center gap-4">

                <button id="darkModeToggle"
                        class="w-12 h-12 rounded-xl bg-slate-100 text-slate-900 hover:bg-slate-900 hover:text-white transition">
                    <i class="fa-solid fa-moon"></i>
                </button>

                <a href="emergency-request.php"
                   class="bg-red-600 hover:bg-red-700 text-white px-5 py-3 rounded-xl font-semibold shadow-lg transition">
                    <i class="fa-solid fa-truck-medical mr-2"></i>
                    Emergency
                </a>

                <a href="login.php"
                   class="bg-cyan-600 hover:bg-cyan-700 text-white px-5 py-3 rounded-xl font-semibold shadow-lg transition">
                    Login
                </a>

            </div>

           <button id="menuBtn"
        class="lg:hidden mr-3 w-11 h-11 rounded-xl bg-slate-900 text-white flex items-center justify-center text-xl">                <i class="fa-solid fa-bars"></i>
            </button>

        </div>

    </div>

    <div id="mobileMenu"
     class="hidden lg:hidden absolute right-4 top-20 w-72 bg-white border border-slate-200 rounded-2xl shadow-2xl z-50">

        <div class="px-4 py-4 space-y-2">

            <a href="index.php" class="mobile-link block px-5 py-4 rounded-xl font-semibold text-slate-800 hover:bg-cyan-50 hover:text-cyan-700">Home</a>
            <a href="about.php" class="mobile-link block px-5 py-4 rounded-xl font-semibold text-slate-800 hover:bg-cyan-50 hover:text-cyan-700">About</a>
            <a href="services.php" class="mobile-link block px-5 py-4 rounded-xl font-semibold text-slate-800 hover:bg-cyan-50 hover:text-cyan-700">Services</a>
            <a href="doctors.php" class="mobile-link block px-5 py-4 rounded-xl font-semibold text-slate-800 hover:bg-cyan-50 hover:text-cyan-700">Doctors</a>
            <a href="appointments.php" class="mobile-link block px-5 py-4 rounded-xl font-semibold text-slate-800 hover:bg-cyan-50 hover:text-cyan-700">Appointments</a>
            <a href="contact.php" class="mobile-link block px-5 py-4 rounded-xl font-semibold text-slate-800 hover:bg-cyan-50 hover:text-cyan-700">Contact</a>

            <div class="grid grid-cols-1 gap-3 pt-4">

                <button id="mobileDarkModeToggle"
                        class="w-full bg-slate-900 text-white py-4 rounded-xl font-bold">
                    <i class="fa-solid fa-moon mr-2"></i>
                    Dark Mode
                </button>

                <a href="login.php"
                   class="bg-cyan-600 text-white py-4 rounded-xl text-center font-bold">
                    Login
                </a>

                <a href="emergency-request.php"
                   class="bg-red-600 text-white py-4 rounded-xl text-center font-bold">
                    Emergency
                </a>

            </div>

        </div>

    </div>

</header>

<div class="h-24"></div>

<script>
    const navbar = document.getElementById('navbar');
    const menuBtn = document.getElementById('menuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    const darkModeToggle = document.getElementById('darkModeToggle');
    const mobileDarkModeToggle = document.getElementById('mobileDarkModeToggle');

    menuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });

    function toggleDarkMode() {
        document.body.classList.toggle('dark-mode');

        navbar.classList.toggle('bg-white/95');
        navbar.classList.toggle('bg-slate-900/95');

        mobileMenu.classList.toggle('bg-white');
        mobileMenu.classList.toggle('bg-slate-900');

        document.querySelectorAll('.mobile-link').forEach(link => {
            link.classList.toggle('text-slate-800');
            link.classList.toggle('text-white');
        });
    }

    darkModeToggle.addEventListener('click', toggleDarkMode);
    mobileDarkModeToggle.addEventListener('click', toggleDarkMode);
</script>