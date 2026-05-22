<?php

include 'inc/config.php';
include 'inc/notify-admin.php';
$success = "";

if(isset($_POST['send_message'])){

    $fullname = mysqli_real_escape_string(
        $conn,
        $_POST['fullname']
    );

    $email = mysqli_real_escape_string(
        $conn,
        $_POST['email']
    );

    $subject = mysqli_real_escape_string(
        $conn,
        $_POST['subject']
    );

    $message = mysqli_real_escape_string(
        $conn,
        $_POST['message']
    );

    mysqli_query(

        $conn,

        "INSERT INTO contact_messages (

            fullname,
            email,
            subject,
            message

        )

        VALUES (

            '$fullname',
            '$email',
            '$subject',
            '$message'

        )"

    );

    $success = "Message sent successfully.";
notifyAdmins(
    $conn,
    "New Contact Message",
    "$fullname sent a contact message.",
    "Message"
);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1.0">

<title>Contact Us | Lucas Hospital</title>

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

.hero-bg {

    background:
    linear-gradient(
        rgba(2,6,23,0.88),
        rgba(2,6,23,0.92)
    ),

    url('https://images.unsplash.com/photo-1586773860418-d37222d8fce3?q=80&w=1600');

    background-size: cover;
    background-position: center;

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

.card-hover {

    transition: 0.4s;

}

.card-hover:hover {

    transform: translateY(-10px);

}

</style>

</head>

<body class="text-white overflow-x-hidden">

<!-- NAVBAR -->
<nav class="fixed top-0 left-0 w-full z-50 glass">

    <div class="max-w-7xl mx-auto px-8 py-5 flex items-center justify-between">

        <!-- Logo -->
        <div class="flex items-center gap-4">

            <div class="w-14 h-14 rounded-2xl bg-gradient-to-r from-cyan-500 to-teal-500 flex items-center justify-center text-2xl shadow-2xl">

                <i class="fa-solid fa-heart-pulse"></i>

            </div>

            <div>

                <h1 class="text-2xl font-black">
                    Lucas Hospital
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
               class="hover:text-cyan-400 transition">

                About

            </a>

            <a href="services.php"
               class="hover:text-cyan-400 transition">

                Services

            </a>

            <a href="contact.php"
               class="text-cyan-400 font-bold">

                Contact

            </a>

        </div>

    </div>

</nav>

<!-- HERO -->
<section class="hero-bg min-h-screen flex items-center">

    <div class="max-w-7xl mx-auto px-8">

        <div class="max-w-3xl">

            <span class="bg-cyan-500/20 text-cyan-300 px-5 py-2 rounded-full">

                24/7 Healthcare Support

            </span>

            <h1 class="text-7xl font-black leading-tight mt-8 mb-8">

                Contact
                <span class="text-cyan-400">
                    Lucas Hospital
                </span>

            </h1>

            <p class="text-2xl text-slate-300 leading-relaxed mb-10">

                Reach out to our healthcare team for appointments,
                emergencies, consultations,
                and premium medical assistance.

            </p>

            <div class="flex flex-wrap gap-6">

                <a href="#contact-form"
                   class="bg-gradient-to-r from-cyan-500 to-teal-500 px-10 py-5 rounded-2xl font-bold text-lg shadow-2xl hover:scale-105 transition">

                    Send Message

                </a>

                <a href="appointments.php"
                   class="glass px-10 py-5 rounded-2xl font-bold text-lg hover:bg-white/10 transition">

                    Book Appointment

                </a>

            </div>

        </div>

    </div>

</section>

<!-- CONTACT CARDS -->
<section class="py-32">

    <div class="max-w-7xl mx-auto px-8">

        <div class="grid lg:grid-cols-4 gap-8">

            <!-- Phone -->
            <div class="glass rounded-[35px] p-10 text-center card-hover">

                <div class="w-20 h-20 rounded-3xl bg-cyan-500/20 flex items-center justify-center text-cyan-400 text-4xl mx-auto mb-8">

                    <i class="fa-solid fa-phone"></i>

                </div>

                <h3 class="text-3xl font-black mb-4">
                    Call Us
                </h3>

                <p class="text-slate-300">

                    +234 803 208 0522

                </p>

            </div>

            <!-- Email -->
            <div class="glass rounded-[35px] p-10 text-center card-hover">

                <div class="w-20 h-20 rounded-3xl bg-emerald-500/20 flex items-center justify-center text-emerald-400 text-4xl mx-auto mb-8">

                    <i class="fa-solid fa-envelope"></i>

                </div>

                <h3 class="text-3xl font-black mb-4">
                    Email
                </h3>

                <p class="text-slate-300">

                   Lucas@gmail.com

                </p>

            </div>

            <!-- Address -->
            <div class="glass rounded-[35px] p-10 text-center card-hover">

                <div class="w-20 h-20 rounded-3xl bg-purple-500/20 flex items-center justify-center text-purple-400 text-4xl mx-auto mb-8">

                    <i class="fa-solid fa-location-dot"></i>

                </div>

                <h3 class="text-3xl font-black mb-4">
                    Address
                </h3>

                <p class="text-slate-300">

                    Niger State, Nigeria

                </p>

            </div>

            <!-- Emergency -->
            <div class="glass rounded-[35px] p-10 text-center card-hover">

                <div class="w-20 h-20 rounded-3xl bg-red-500/20 flex items-center justify-center text-red-400 text-4xl mx-auto mb-8">

                    <i class="fa-solid fa-truck-medical"></i>

                </div>

                <h3 class="text-3xl font-black mb-4">
                    Emergency
                </h3>

                <p class="text-slate-300">

                    Available 24/7

                </p>

            </div>

        </div>

    </div>

</section>

<!-- CONTACT FORM -->
<section id="contact-form" class="pb-32">

    <div class="max-w-7xl mx-auto px-8">

        <div class="grid lg:grid-cols-2 gap-12 items-center">

            <?php if($success){ ?>

<div class="bg-emerald-500/20 border border-emerald-400 text-emerald-200 p-5 rounded-2xl mb-6">

    <?php echo $success; ?>

</div>

<?php } ?>

<form method="POST" class="space-y-6">

    <!-- Name -->
    <div>

        <label class="block mb-3 font-semibold">
            Full Name
        </label>

        <input type="text"
               name="fullname"
               required
               placeholder="Enter your full name"
               class="input w-full px-6 py-5 rounded-2xl">

    </div>

    <!-- Email -->
    <div>

        <label class="block mb-3 font-semibold">
            Email Address
        </label>

        <input type="email"
               name="email"
               required
               placeholder="Enter your email"
               class="input w-full px-6 py-5 rounded-2xl">

    </div>

    <!-- Subject -->
    <div>

        <label class="block mb-3 font-semibold">
            Subject
        </label>

        <input type="text"
               name="subject"
               required
               placeholder="Enter message subject"
               class="input w-full px-6 py-5 rounded-2xl">

    </div>

    <!-- Message -->
    <div>

        <label class="block mb-3 font-semibold">
            Message
        </label>

        <textarea rows="6"
                  name="message"
                  required
                  placeholder="Write your message..."
                  class="input w-full px-6 py-5 rounded-2xl"></textarea>

    </div>

    <!-- Button -->
    <button type="submit"
            name="send_message"
            class="w-full bg-gradient-to-r from-cyan-500 to-teal-500 hover:scale-105 transition transform py-5 rounded-2xl text-lg font-bold shadow-2xl">

        Send Message

    </button>

</form>

            <!-- Info -->
            <div>

                <h2 class="text-6xl font-black leading-tight mb-8">

                    We Are Always
                    Ready To Help

                </h2>

                <p class="text-slate-300 text-xl leading-relaxed mb-10">

                    Our healthcare specialists and support team
                    are available to assist you with appointments,
                    medical consultations,
                    and emergency services.

                </p>

                <!-- Working Hours -->
                <div class="glass rounded-[35px] p-10 mb-8">

                    <h3 class="text-3xl font-black mb-8">
                        Working Hours
                    </h3>

                    <div class="space-y-5">

                        <div class="flex items-center justify-between">

                            <span class="text-slate-300">
                                Monday - Friday
                            </span>

                            <span class="font-bold">
                                24 Hours
                            </span>

                        </div>

                        <div class="flex items-center justify-between">

                            <span class="text-slate-300">
                                Saturday
                            </span>

                            <span class="font-bold">
                                24 Hours
                            </span>

                        </div>

                        <div class="flex items-center justify-between">

                            <span class="text-slate-300">
                                Sunday
                            </span>

                            <span class="font-bold">
                                Emergency Only
                            </span>

                        </div>

                    </div>

                </div>

                <!-- Emergency Banner -->
                <div class="bg-gradient-to-r from-red-500/20 to-red-600/10 border border-red-500/20 rounded-[35px] p-10">

                    <div class="flex items-center gap-5">

                        <div class="w-20 h-20 rounded-3xl bg-red-500/20 flex items-center justify-center text-red-400 text-4xl">

                            <i class="fa-solid fa-truck-medical"></i>

                        </div>

                        <div>

                            <h3 class="text-3xl font-black mb-2">
                                Emergency Service
                            </h3>

                            <p class="text-slate-300">

                                Immediate healthcare support available 24/7.

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- MAP -->
<section class="pb-32">

    <div class="max-w-7xl mx-auto px-8">

        <div class="glass rounded-[40px] overflow-hidden">

            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18"
                width="100%"
                height="500"
                style="border:0;"
                allowfullscreen=""
                loading="lazy">
            </iframe>

        </div>

    </div>

</section>

<!-- FOOTER -->
<footer class="border-t border-white/10 glass">

    <div class="max-w-7xl mx-auto px-8 py-10 flex flex-col md:flex-row items-center justify-between gap-6">

        <p class="text-slate-300">

            © 2026 Lucas Hospital.
            All Rights Reserved.

        </p>

        <div class="flex items-center gap-6 text-2xl">

            <a href="#"
               class="hover:text-cyan-400 transition">

                <i class="fab fa-facebook"></i>

            </a>

            <a href="#"
               class="hover:text-cyan-400 transition">

                <i class="fab fa-twitter"></i>

            </a>

            <a href="#"
               class="hover:text-cyan-400 transition">

                <i class="fab fa-instagram"></i>

            </a>

            <a href="#"
               class="hover:text-cyan-400 transition">

                <i class="fab fa-linkedin"></i>

            </a>

        </div>

    </div>

</footer>

</body>

</html>