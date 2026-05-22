<?php
$title = 'Our Doctors – Lucas Hospital';
require 'inc/header.php';

$doctors = [
    ['Dr. Chinedu Okafor', 'Cardiologist', '15+ years', 'MD, FACC', 'Expert in interventional cardiology and heart failure management.', 'https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?q=80&w=1200&auto=format&fit=crop'],
    ['Dr. Amina Bello', 'Neurologist', '12+ years', 'MD, PhD', 'Specializes in stroke treatment and neurological conditions.', 'https://images.unsplash.com/photo-1594824476967-48c8b964273f?q=80&w=1200&auto=format&fit=crop'],
    ['Dr. Adaora Nwosu', 'Pediatrician', '10+ years', 'MD, FAAP', 'Passionate about child health and developmental care.', 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?q=80&w=1200&auto=format&fit=crop'],
    ['Dr. Tunde Adeyemi', 'Orthopedic Surgeon', '18+ years', 'MD, FACS', 'Specializes in bone, joint, and sports injury treatment.', 'https://images.unsplash.com/photo-1651008376811-b90baee60c1f?q=80&w=1200&auto=format&fit=crop'],
    ['Dr. Fatima Yusuf', 'Dermatologist', '8+ years', 'MD, FAAD', 'Expert in skin treatment, skincare, and cosmetic dermatology.', 'https://images.unsplash.com/photo-1622253692010-333f2da6031d?q=80&w=1200&auto=format&fit=crop'],
    ['Dr. Emeka Obi', 'Oncologist', '20+ years', 'MD, FACP', 'Cancer care specialist focused on advanced treatment support.', 'https://images.unsplash.com/photo-1582750433449-648ed127bb54?q=80&w=1200&auto=format&fit=crop']
];
?>

<section class="relative overflow-hidden bg-gradient-to-br from-slate-950 via-cyan-950 to-teal-900 text-white py-24">
    <div class="absolute inset-0 bg-black/40"></div>
    <div class="absolute top-0 left-0 w-96 h-96 bg-cyan-500/20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-teal-500/20 rounded-full blur-3xl"></div>

    <div class="relative max-w-7xl mx-auto px-6 text-center">
        <span class="bg-white/10 backdrop-blur-md px-5 py-2 rounded-full text-cyan-300 font-semibold inline-block mb-6">
            Professional Healthcare Specialists
        </span>

        <h1 class="text-5xl md:text-6xl font-extrabold mb-6">
            Meet Our Expert Doctors
        </h1>

        <p class="text-xl text-slate-300 max-w-3xl mx-auto leading-relaxed">
            Our experienced healthcare professionals are dedicated to delivering
            world-class medical treatment, compassionate care, and advanced healthcare solutions.
        </p>
    </div>
</section>

<section class="py-24 bg-slate-950 text-white">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        <?php foreach ($doctors as $doctor) { ?>

            <div class="bg-white/5 border border-white/10 rounded-3xl overflow-hidden shadow-2xl hover:shadow-cyan-500/10 transition duration-500 group">

                <div class="overflow-hidden">
                    <img src="<?php echo $doctor[5]; ?>"
                         alt="<?php echo $doctor[0]; ?>"
                         class="w-full h-72 object-cover group-hover:scale-110 transition duration-700">
                </div>

                <div class="p-6">

                    <h3 class="text-2xl font-bold text-white">
                        <?php echo $doctor[0]; ?>
                    </h3>

                    <p class="text-cyan-400 font-semibold mt-1">
                        <?php echo $doctor[1]; ?>
                    </p>

                    <div class="flex flex-wrap gap-4 text-sm text-slate-300 mt-4">
                        <span class="flex items-center gap-2">
                            <i class="fa-regular fa-calendar"></i>
                            <?php echo $doctor[2]; ?>
                        </span>

                        <span class="flex items-center gap-2">
                            <i class="fa-solid fa-graduation-cap"></i>
                            <?php echo $doctor[3]; ?>
                        </span>
                    </div>

                    <p class="text-slate-300 mt-4 text-sm leading-relaxed">
                        <?php echo $doctor[4]; ?>
                    </p>

                    <a href="appointments.php"
                       class="mt-6 block text-center bg-cyan-600 hover:bg-cyan-700 text-white py-3 rounded-xl font-semibold transition">
                        Book Appointment
                    </a>

                </div>

            </div>

        <?php } ?>

    </div>
</section>

<?php
require 'inc/footer.php';
?>