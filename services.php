<?php
$title = 'Our Services | Lucas Hospital';
require 'inc/header.php';
?>

<section class="relative bg-gradient-to-br from-slate-950 via-teal-950 to-cyan-900 text-white py-28 overflow-hidden">
    <div class="absolute top-0 left-0 w-96 h-96 bg-cyan-500/20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-teal-500/20 rounded-full blur-3xl"></div>

    <div class="relative max-w-7xl mx-auto px-6 text-center">
        <span class="bg-cyan-400/20 text-cyan-200 px-5 py-2 rounded-full font-semibold">
            World-Class Medical Departments
        </span>

        <h1 class="text-5xl md:text-7xl font-black mt-8 mb-6">
            Our Medical Services
        </h1>

        <p class="text-xl text-slate-300 max-w-3xl mx-auto leading-relaxed">
            Explore advanced healthcare services delivered by expert specialists,
            modern facilities, and compassionate patient care.
        </p>
    </div>
</section>

<section class="py-24 bg-slate-950 text-white">
    <div class="max-w-7xl mx-auto px-6">

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

            <?php
            $services = [
                ['Emergency Care', '24/7 emergency support with rapid response and critical care specialists.', 'fa-truck-medical', 'red'],
                ['Cardiology', 'Advanced heart care, diagnostics, ECG, hypertension, and cardiac treatment.', 'fa-heart-pulse', 'pink'],
                ['Neurology', 'Expert diagnosis and treatment for brain, spine, and nervous system conditions.', 'fa-brain', 'blue'],
                ['Pediatrics', 'Specialized healthcare for infants, children, teenagers, and young patients.', 'fa-baby', 'green'],
                ['Orthopedics', 'Bone, joint, muscle, injury, and mobility care using modern treatment methods.', 'fa-bone', 'yellow'],
                ['Maternity Care', 'Complete antenatal, delivery, postnatal, and women’s health support.', 'fa-person-pregnant', 'purple'],
                ['Radiology', 'Modern imaging services including X-ray, ultrasound, CT scan, and MRI support.', 'fa-x-ray', 'cyan'],
                ['Physical Therapy', 'Rehabilitation care to restore movement, strength, and body function.', 'fa-person-running', 'emerald'],
                ['Dental Care', 'Preventive, restorative, and cosmetic dental healthcare for all ages.', 'fa-tooth', 'orange'],
            ];

            foreach ($services as $service) {
            ?>

            <div class="group bg-white/5 border border-white/10 rounded-[32px] p-8 hover:bg-white/10 hover:-translate-y-2 transition duration-500 shadow-xl">

                <div class="w-20 h-20 rounded-3xl bg-cyan-500/20 flex items-center justify-center text-cyan-300 text-4xl mb-8 group-hover:scale-110 transition">
                    <i class="fa-solid <?php echo $service[2]; ?>"></i>
                </div>

                <h3 class="text-3xl font-black mb-4">
                    <?php echo $service[0]; ?>
                </h3>

                <p class="text-slate-300 leading-relaxed mb-8">
                    <?php echo $service[1]; ?>
                </p>

                <a href="appointments.php"
                   class="inline-flex items-center gap-3 text-cyan-300 font-bold hover:text-cyan-200">
                    Book Appointment
                    <i class="fa-solid fa-arrow-right"></i>
                </a>

            </div>

            <?php } ?>

        </div>
    </div>
</section>

<section class="py-24 bg-slate-900 text-white">
    <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-12 items-center">

        <div>
            <span class="text-cyan-300 font-bold uppercase tracking-wider">
                Why Our Services Stand Out
            </span>

            <h2 class="text-5xl font-black mt-5 mb-6">
                Advanced Care With Trusted Medical Experts
            </h2>

            <p class="text-slate-300 text-lg leading-relaxed mb-8">
                Lucas Hospital combines experienced doctors, digital healthcare systems,
                modern equipment, and patient-focused service delivery.
            </p>

            <div class="grid md:grid-cols-2 gap-5">
                <div class="bg-white/5 border border-white/10 rounded-2xl p-5">
                    <h3 class="font-bold text-xl mb-2">24/7 Emergency</h3>
                    <p class="text-slate-400">Fast support for urgent medical needs.</p>
                </div>

                <div class="bg-white/5 border border-white/10 rounded-2xl p-5">
                    <h3 class="font-bold text-xl mb-2">Digital Records</h3>
                    <p class="text-slate-400">Secure medical record management.</p>
                </div>

                <div class="bg-white/5 border border-white/10 rounded-2xl p-5">
                    <h3 class="font-bold text-xl mb-2">Expert Doctors</h3>
                    <p class="text-slate-400">Qualified specialists across departments.</p>
                </div>

                <div class="bg-white/5 border border-white/10 rounded-2xl p-5">
                    <h3 class="font-bold text-xl mb-2">Patient Portal</h3>
                    <p class="text-slate-400">Appointments, records, and prescriptions online.</p>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-cyan-500/20 to-teal-500/10 border border-white/10 rounded-[40px] p-10">
            <h3 class="text-4xl font-black mb-8">
                Quick Service Access
            </h3>

            <div class="space-y-5">
                <a href="appointments.php" class="block bg-white/10 hover:bg-white/20 rounded-2xl p-5 transition">
                    Book Appointment
                </a>

                <a href="contact.php" class="block bg-white/10 hover:bg-white/20 rounded-2xl p-5 transition">
                    Contact Hospital
                </a>

                <a href="doctor-dashboard.php" class="block bg-white/10 hover:bg-white/20 rounded-2xl p-5 transition">
                    Doctor Portal
                </a>

                <a href="patient-dashboard.php" class="block bg-white/10 hover:bg-white/20 rounded-2xl p-5 transition">
                    Patient Portal
                </a>
            </div>
        </div>

    </div>
</section>

<?php
require 'inc/footer.php';
?>