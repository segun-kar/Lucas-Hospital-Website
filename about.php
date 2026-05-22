<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>About Us | Serah Hospital</title>

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

    backdrop-filter: blur(18px);

    border: 1px solid rgba(255,255,255,0.08);

}

.hero-bg {

    background:
    linear-gradient(
        rgba(2,6,23,0.85),
        rgba(2,6,23,0.9)
    ),

    url('https://images.unsplash.com/photo-1516549655169-df83a0774514?q=80&w=1600');

    background-size: cover;
    background-position: center;

}

.card-hover {

    transition: 0.4s;

}

.card-hover:hover {

    transform: translateY(-10px);

}

</style>

</head>

<body class="text-white">

<!-- Navbar -->
<nav class="fixed top-0 left-0 w-full z-50 glass">

    <div class="max-w-7xl mx-auto px-8 py-5 flex items-center justify-between">

        <!-- Logo -->
        <div class="flex items-center gap-4">

            <div class="w-14 h-14 rounded-2xl bg-gradient-to-r from-cyan-500 to-teal-500 flex items-center justify-center text-2xl shadow-2xl">

                <i class="fa-solid fa-heart-pulse"></i>

            </div>

            <div>

                <h1 class="text-2xl font-black">
                    Serah Hospital
                </h1>

                <p class="text-cyan-200 text-sm">
                    Premium Healthcare
                </p>

            </div>

        </div>

        <!-- Links -->
        <div class="hidden md:flex items-center gap-8">

            <a href="index.php"
               class="hover:text-cyan-400 transition">

                Home

            </a>

            <a href="about.php"
               class="text-cyan-400 font-bold">

                About

            </a>

            <a href="services.php"
               class="hover:text-cyan-400 transition">

                Services

            </a>

            <a href="contact.php"
               class="hover:text-cyan-400 transition">

                Contact

            </a>

        </div>

    </div>

</nav>

<!-- Hero -->
<section class="hero-bg min-h-screen flex items-center">

    <div class="max-w-7xl mx-auto px-8">

        <div class="max-w-3xl">

            <span class="bg-cyan-500/20 text-cyan-300 px-5 py-2 rounded-full">

                World-Class Healthcare

            </span>

            <h1 class="text-7xl font-black leading-tight mt-8 mb-8">

                About
                <span class="text-cyan-400">
                    Lucas Hospital
                </span>

            </h1>

            <p class="text-2xl text-slate-300 leading-relaxed mb-10">

                We are committed to delivering exceptional healthcare
                services through advanced medical technology,
                expert professionals, and compassionate patient care.

            </p>

            <div class="flex flex-wrap gap-6">

                <a href="contact.php"
                   class="bg-gradient-to-r from-cyan-500 to-teal-500 px-10 py-5 rounded-2xl font-bold text-lg shadow-2xl hover:scale-105 transition">

                    Contact Us

                </a>

                <a href="services.php"
                   class="glass px-10 py-5 rounded-2xl font-bold text-lg hover:bg-white/10 transition">

                    Our Services

                </a>

            </div>

        </div>

    </div>

</section>

<!-- Mission & Vision -->
<section class="py-32">

    <div class="max-w-7xl mx-auto px-8">

        <div class="grid lg:grid-cols-2 gap-10">

            <!-- Mission -->
            <div class="glass rounded-[40px] p-12 card-hover">

                <div class="w-20 h-20 rounded-3xl bg-cyan-500/20 flex items-center justify-center text-cyan-400 text-4xl mb-8">

                    <i class="fa-solid fa-bullseye"></i>

                </div>

                <h2 class="text-4xl font-black mb-6">
                    Our Mission
                </h2>

                <p class="text-slate-300 text-lg leading-relaxed">

                    To provide world-class healthcare services
                    with compassion, innovation, and excellence
                    while improving the quality of life
                    for every patient we serve.

                </p>

            </div>

            <!-- Vision -->
            <div class="glass rounded-[40px] p-12 card-hover">

                <div class="w-20 h-20 rounded-3xl bg-emerald-500/20 flex items-center justify-center text-emerald-400 text-4xl mb-8">

                    <i class="fa-solid fa-eye"></i>

                </div>

                <h2 class="text-4xl font-black mb-6">
                    Our Vision
                </h2>

                <p class="text-slate-300 text-lg leading-relaxed">

                    To become a globally recognized healthcare institution
                    known for advanced medical care,
                    cutting-edge technology,
                    and patient-centered excellence.

                </p>

            </div>

        </div>

    </div>

</section>

<!-- Stats -->
<section class="pb-32">

    <div class="max-w-7xl mx-auto px-8">

        <div class="grid lg:grid-cols-4 gap-8">

            <!-- Patients -->
            <div class="glass rounded-3xl p-10 text-center card-hover">

                <h2 class="text-6xl font-black text-cyan-400 mb-4">
                    25K+
                </h2>

                <p class="text-slate-300 text-lg">
                    Patients Treated
                </p>

            </div>

            <!-- Doctors -->
            <div class="glass rounded-3xl p-10 text-center card-hover">

                <h2 class="text-6xl font-black text-emerald-400 mb-4">
                    120+
                </h2>

                <p class="text-slate-300 text-lg">
                    Specialist Doctors
                </p>

            </div>

            <!-- Awards -->
            <div class="glass rounded-3xl p-10 text-center card-hover">

                <h2 class="text-6xl font-black text-purple-400 mb-4">
                    35+
                </h2>

                <p class="text-slate-300 text-lg">
                    Medical Awards
                </p>

            </div>

            <!-- Experience -->
            <div class="glass rounded-3xl p-10 text-center card-hover">

                <h2 class="text-6xl font-black text-yellow-400 mb-4">
                    15+
                </h2>

                <p class="text-slate-300 text-lg">
                    Years Experience
                </p>

            </div>

        </div>

    </div>

</section>

<!-- Why Choose Us -->
<section class="pb-32">

    <div class="max-w-7xl mx-auto px-8">

        <div class="text-center mb-20">

            <h2 class="text-6xl font-black mb-6">
                Why Choose Us
            </h2>

            <p class="text-slate-300 text-xl max-w-3xl mx-auto">

                Experience modern healthcare powered by innovation,
                expertise, and patient-focused excellence.

            </p>

        </div>

        <div class="grid lg:grid-cols-3 gap-10">

            <!-- Card -->
            <div class="glass rounded-[40px] p-10 card-hover">

                <div class="w-20 h-20 rounded-3xl bg-cyan-500/20 flex items-center justify-center text-cyan-400 text-4xl mb-8">

                    <i class="fa-solid fa-user-doctor"></i>

                </div>

                <h3 class="text-3xl font-black mb-5">
                    Expert Doctors
                </h3>

                <p class="text-slate-300 leading-relaxed">

                    Our highly qualified specialists deliver
                    advanced and compassionate medical care.

                </p>

            </div>

            <!-- Card -->
            <div class="glass rounded-[40px] p-10 card-hover">

                <div class="w-20 h-20 rounded-3xl bg-emerald-500/20 flex items-center justify-center text-emerald-400 text-4xl mb-8">

                    <i class="fa-solid fa-laptop-medical"></i>

                </div>

                <h3 class="text-3xl font-black mb-5">
                    Smart Technology
                </h3>

                <p class="text-slate-300 leading-relaxed">

                    We use innovative healthcare technologies
                    to improve diagnosis and patient outcomes.

                </p>

            </div>

            <!-- Card -->
            <div class="glass rounded-[40px] p-10 card-hover">

                <div class="w-20 h-20 rounded-3xl bg-purple-500/20 flex items-center justify-center text-purple-400 text-4xl mb-8">

                    <i class="fa-solid fa-heart"></i>

                </div>

                <h3 class="text-3xl font-black mb-5">
                    Patient Care
                </h3>

                <p class="text-slate-300 leading-relaxed">

                    Every patient receives personalized attention
                    and exceptional healthcare experience.

                </p>

            </div>

        </div>

    </div>

</section>

<!-- CTA -->
<section class="pb-32">

    <div class="max-w-6xl mx-auto px-8">

        <div class="glass rounded-[50px] p-16 text-center">

            <h2 class="text-6xl font-black mb-8">

                Your Health,
                Our Priority

            </h2>

            <p class="text-slate-300 text-2xl leading-relaxed max-w-4xl mx-auto mb-12">

                Experience premium healthcare services
                designed to deliver comfort,
                trust, and medical excellence.

            </p>

            <a href="register.php"
               class="bg-gradient-to-r from-cyan-500 to-teal-500 px-12 py-6 rounded-2xl text-xl font-bold shadow-2xl hover:scale-105 transition inline-block">

                Get Started

            </a>

        </div>

    </div>

</section>

<!-- Footer -->
<footer class="glass border-t border-white/10">

    <div class="max-w-7xl mx-auto px-8 py-10 flex flex-col md:flex-row items-center justify-between gap-6">

        <p class="text-slate-300">

            © 2026 Serah Hospital.
            All Rights Reserved.

        </p>

        <div class="flex items-center gap-6 text-2xl">

            <a href="#" class="hover:text-cyan-400 transition">

                <i class="fab fa-facebook"></i>

            </a>

            <a href="#" class="hover:text-cyan-400 transition">

                <i class="fab fa-twitter"></i>

            </a>

            <a href="#" class="hover:text-cyan-400 transition">

                <i class="fab fa-instagram"></i>

            </a>

            <a href="#" class="hover:text-cyan-400 transition">

                <i class="fab fa-linkedin"></i>

            </a>

        </div>

    </div>

</footer>

</body>

</html>