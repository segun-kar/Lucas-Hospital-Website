<?php
$title = 'Lucas Hospital – Home';
require 'inc/header.php';
?>

<main class="bg-slate-950 text-white overflow-hidden">

<!-- HERO -->
<section class="relative overflow-hidden bg-gradient-to-br from-slate-950 via-teal-950 to-cyan-900 text-white">

    <div class="absolute inset-0 bg-black/40"></div>
    <div class="absolute top-10 left-10 w-72 h-72 bg-cyan-400/20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-10 right-10 w-72 h-72 bg-teal-300/20 rounded-full blur-3xl"></div>

    <div class="relative max-w-7xl mx-auto px-6 py-24 lg:py-36">

        <div class="grid lg:grid-cols-2 gap-12 items-center">

            <div>

                <span class="bg-white/20 backdrop-blur-md px-4 py-2 rounded-full text-sm font-semibold inline-block mb-6">
                    Trusted By 50,000+ Patients Worldwide
                </span>

                <h1 class="text-5xl lg:text-7xl font-extrabold leading-tight mb-6">
                    Advanced Healthcare <br>
                    For A Better Life
                </h1>

                <p class="text-xl text-slate-300 leading-relaxed mb-8">
                    Lucas Hospital combines world-class medical expertise,
                    advanced technology, and compassionate care to deliver
                    exceptional healthcare experiences.
                </p>

                <div class="flex flex-wrap gap-4">

                    <a href="appointments.php"
                       class="bg-cyan-400 hover:bg-cyan-500 text-slate-900 font-bold px-8 py-4 rounded-xl transition shadow-xl">
                        Book Appointment
                    </a>

                    <a href="services.php"
                       class="border border-white/40 hover:bg-white hover:text-slate-900 px-8 py-4 rounded-xl transition">
                        Explore Services
                    </a>

                </div>

                <div class="grid grid-cols-3 gap-6 mt-14">

                    <div>
                        <h2 class="text-4xl font-bold text-cyan-300">150+</h2>
                        <p class="text-slate-300">Doctors</p>
                    </div>

                    <div>
                        <h2 class="text-4xl font-bold text-cyan-300">24/7</h2>
                        <p class="text-slate-300">Emergency</p>
                    </div>

                    <div>
                        <h2 class="text-4xl font-bold text-cyan-300">50K+</h2>
                        <p class="text-slate-300">Patients</p>
                    </div>

                </div>

            </div>

            <div class="relative">

                <img src="https://images.unsplash.com/photo-1587351021759-3e566b6af7cc?q=80&w=1200&auto=format&fit=crop"
                     alt="Hospital"
                     class="rounded-3xl shadow-2xl border border-white/20">

                <div class="absolute -bottom-8 -left-8 bg-slate-900/90 text-white border border-white/10 p-6 rounded-2xl shadow-2xl w-64 backdrop-blur-xl">

                    <div class="flex items-center gap-4">

                        <div class="w-14 h-14 rounded-full bg-green-500/20 flex items-center justify-center text-2xl">
                            <i class="fa-solid fa-check text-green-400"></i>
                        </div>

                        <div>
                            <h3 class="font-bold text-lg">Certified Care</h3>
                            <p class="text-sm text-slate-300">
                                International Medical Standards
                            </p>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- WHY CHOOSE US -->
<section class="py-24 bg-slate-950 text-white">

    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center mb-16">

            <span class="text-cyan-400 font-bold uppercase tracking-wider">
                Why Choose Lucas Hospital
            </span>

            <h2 class="text-4xl md:text-5xl font-extrabold text-white mt-4 mb-6">
                Excellence In Modern Healthcare
            </h2>

            <p class="max-w-3xl mx-auto text-lg text-slate-300 leading-relaxed">
                We combine advanced medical technology, experienced specialists,
                and compassionate patient care to provide world-class healthcare.
            </p>

        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">

            <div class="bg-white/5 border border-white/10 rounded-3xl p-8 hover:shadow-2xl transition">
                <div class="w-16 h-16 rounded-2xl bg-cyan-500/20 flex items-center justify-center text-3xl mb-6"><i class="fa-solid fa-stethoscope text-cyan-400"></i></div>
                <h3 class="text-2xl font-bold text-white mb-4">Expert Doctors</h3>
                <p class="text-slate-300 leading-relaxed">
                    Qualified specialists with strong medical experience.
                </p>
            </div>

            <div class="bg-white/5 border border-white/10 rounded-3xl p-8 hover:shadow-2xl transition">
                <div class="w-16 h-16 rounded-2xl bg-emerald-500/20 flex items-center justify-center text-3xl mb-6"><i class="fa-solid fa-hospital text-emerald-400"></i></div>
                <h3 class="text-2xl font-bold text-white mb-4">Modern Facilities</h3>
                <p class="text-slate-300 leading-relaxed">
                    Advanced equipment and modern treatment centers.
                </p>
            </div>

            <div class="bg-white/5 border border-white/10 rounded-3xl p-8 hover:shadow-2xl transition">
                <div class="w-16 h-16 rounded-2xl bg-red-500/20 flex items-center justify-center text-3xl mb-6"><i class="fa-solid fa-truck-medical text-red-400"></i></div>
                <h3 class="text-2xl font-bold text-white mb-4">24/7 Emergency</h3>
                <p class="text-slate-300 leading-relaxed">
                    Emergency response teams available around the clock.
                </p>
            </div>

            <div class="bg-white/5 border border-white/10 rounded-3xl p-8 hover:shadow-2xl transition">
                <div class="w-16 h-16 rounded-2xl bg-purple-500/20 flex items-center justify-center text-3xl mb-6"><i class="fa-solid fa-heart-pulse text-pink-400"></i></div>
                <h3 class="text-2xl font-bold text-white mb-4">Patient Care</h3>
                <p class="text-slate-300 leading-relaxed">
                    Healthcare focused on comfort, safety, and recovery.
                </p>
            </div>

        </div>

    </div>

</section>
<!-- HOW IT WORKS -->
<section class="py-24 bg-slate-900 text-white">

    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center mb-16">

            <span class="text-cyan-400 font-bold uppercase tracking-wider">
                Simple Healthcare Process
            </span>

            <h2 class="text-4xl md:text-5xl font-extrabold mt-4 mb-6">
                How Lucas Hospital Works
            </h2>

            <p class="max-w-3xl mx-auto text-lg text-slate-300">
                Access quality healthcare services quickly and easily
                through our modern hospital management platform.
            </p>

        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">

            <!-- STEP 1 -->
            <div class="bg-white/5 border border-white/10 rounded-3xl p-8 text-center hover:shadow-2xl transition">

                <div class="w-20 h-20 rounded-full bg-cyan-500/20 text-cyan-400 flex items-center justify-center text-4xl mx-auto mb-6">
                    <i class="fa-solid fa-user-plus"></i>
                </div>

                <h3 class="text-2xl font-bold mb-4">
                    Create Account
                </h3>

                <p class="text-slate-300 leading-relaxed">
                    Register securely as a patient to access hospital services.
                </p>

            </div>

            <!-- STEP 2 -->
            <div class="bg-white/5 border border-white/10 rounded-3xl p-8 text-center hover:shadow-2xl transition">

                <div class="w-20 h-20 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-4xl mx-auto mb-6">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>

                <h3 class="text-2xl font-bold mb-4">
                    Book Appointment
                </h3>

                <p class="text-slate-300 leading-relaxed">
                    Choose your preferred doctor and appointment schedule.
                </p>

            </div>

            <!-- STEP 3 -->
            <div class="bg-white/5 border border-white/10 rounded-3xl p-8 text-center hover:shadow-2xl transition">

                <div class="w-20 h-20 rounded-full bg-purple-500/20 text-purple-400 flex items-center justify-center text-4xl mx-auto mb-6">
                    <i class="fa-solid fa-user-doctor"></i>
                </div>

                <h3 class="text-2xl font-bold mb-4">
                    Meet Doctor
                </h3>

                <p class="text-slate-300 leading-relaxed">
                    Receive professional consultation and medical care.
                </p>

            </div>

            <!-- STEP 4 -->
            <div class="bg-white/5 border border-white/10 rounded-3xl p-8 text-center hover:shadow-2xl transition">

                <div class="w-20 h-20 rounded-full bg-red-500/20 text-red-400 flex items-center justify-center text-4xl mx-auto mb-6">
                    <i class="fa-solid fa-file-medical"></i>
                </div>

                <h3 class="text-2xl font-bold mb-4">
                    Access Records
                </h3>

                <p class="text-slate-300 leading-relaxed">
                    View prescriptions, medical records, and notifications.
                </p>

            </div>

        </div>

    </div>

</section>
<!-- STATS -->
<section class="py-20 bg-gradient-to-r from-cyan-700 to-teal-700 text-white">

    <div class="max-w-7xl mx-auto px-6">

        <div class="grid grid-cols-2 md:grid-cols-4 gap-10 text-center">

            <div>
                <h2 class="text-5xl font-extrabold mb-3 counter" data-target="25">0</h2>
                <p class="text-lg text-cyan-100">Years Experience</p>
            </div>

            <div>
                <h2 class="text-5xl font-extrabold mb-3 counter" data-target="150">0</h2>
                <p class="text-lg text-cyan-100">Medical Experts</p>
            </div>

            <div>
                <h2 class="text-5xl font-extrabold mb-3 counter" data-target="50000">0</h2>
                <p class="text-lg text-cyan-100">Happy Patients</p>
            </div>

            <div>
                <h2 class="text-5xl font-extrabold mb-3">24/7</h2>
                <p class="text-lg text-cyan-100">Emergency Support</p>
            </div>

        </div>

    </div>

</section>

<!-- DOCTORS -->
<section class="py-24 bg-slate-900 text-white">

    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center mb-16">

            <span class="text-cyan-400 font-bold uppercase tracking-wider">
                Our Specialists
            </span>

            <h2 class="text-4xl md:text-5xl font-extrabold text-white mt-4 mb-6">
                Meet Our Expert Doctors
            </h2>

            <p class="max-w-3xl mx-auto text-lg text-slate-300">
                Our medical professionals are dedicated to delivering
                exceptional patient care and advanced treatment solutions.
            </p>

        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">

            <?php
            $doctors = [
                ['Dr. Sarah Johnson', 'Cardiologist', 'Specialist in cardiovascular treatment.', 'https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?q=80&w=1200&auto=format&fit=crop'],
                ['Dr. Michael Lee', 'Neurologist', 'Expert in brain and nervous system care.', 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?q=80&w=1200&auto=format&fit=crop'],
                ['Dr. Emily Brown', 'Emergency Specialist', 'Rapid and life-saving emergency care.', 'https://images.unsplash.com/photo-1594824476967-48c8b964273f?q=80&w=1200&auto=format&fit=crop'],
                ['Dr. James Wilson', 'Orthopedic Surgeon', 'Bone, joint, and surgery specialist.', 'https://images.unsplash.com/photo-1651008376811-b90baee60c1f?q=80&w=1200&auto=format&fit=crop']
            ];

            foreach ($doctors as $doctor) {
            ?>

            <div class="bg-white/5 border border-white/10 rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition group">

                <div class="relative overflow-hidden">
                    <img src="<?php echo $doctor[3]; ?>"
                         class="w-full h-80 object-cover group-hover:scale-110 transition duration-700">

                    <div class="absolute top-4 right-4 bg-cyan-500 text-white text-sm px-3 py-1 rounded-full">
                        Available
                    </div>
                </div>

                <div class="p-6">

                    <h3 class="text-2xl font-bold text-white mb-2">
                        <?php echo $doctor[0]; ?>
                    </h3>

                    <p class="text-cyan-400 font-semibold mb-4">
                        <?php echo $doctor[1]; ?>
                    </p>

                    <p class="text-slate-300 mb-6">
                        <?php echo $doctor[2]; ?>
                    </p>

                    <a href="appointments.php"
                       class="block text-center bg-cyan-600 hover:bg-cyan-700 text-white py-3 rounded-xl font-semibold transition">
                        Book Appointment
                    </a>

                </div>

            </div>

            <?php } ?>

        </div>

    </div>

</section>

<!-- SERVICES -->
<section class="py-24 bg-slate-950 text-white">

    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center mb-16">

            <h2 class="text-4xl md:text-5xl font-bold text-white mb-4">
                Our Medical Services
            </h2>

            <p class="text-slate-300 max-w-2xl mx-auto">
                We offer a comprehensive range of healthcare services
                to meet all your medical needs.
            </p>

        </div>

        <div class="grid md:grid-cols-3 gap-8">

            <div class="bg-white/5 border border-white/10 rounded-3xl shadow-lg p-8">
                <div class="bg-red-500/20 w-16 h-16 rounded-full flex items-center justify-center text-3xl mb-4"><i class="fa-solid fa-truck-medical text-red-400"></i></div>
                <h3 class="text-2xl font-bold text-white mb-3">Emergency Care</h3>
                <p class="text-slate-300">
                    24/7 emergency services with rapid response teams.
                </p>
            </div>

            <div class="bg-white/5 border border-white/10 rounded-3xl shadow-lg p-8">
                <div class="bg-pink-500/20 w-16 h-16 rounded-full flex items-center justify-center text-3xl mb-4"><i class="fa-solid fa-heart-pulse text-pink-400"></i></div>
                <h3 class="text-2xl font-bold text-white mb-3">Cardiology</h3>
                <p class="text-slate-300">
                    Comprehensive heart care and diagnostics.
                </p>
            </div>

            <div class="bg-white/5 border border-white/10 rounded-3xl shadow-lg p-8">
                <div class="bg-blue-500/20 w-16 h-16 rounded-full flex items-center justify-center text-3xl mb-4"><i class="fa-solid fa-brain text-blue-400"></i></div>
                <h3 class="text-2xl font-bold text-white mb-3">Neurology</h3>
                <p class="text-slate-300">
                    Brain, spine, and nervous system treatment.
                </p>
            </div>

        </div>

        <div class="text-center mt-12">
            <a href="services.php"
               class="border-2 border-cyan-500 text-cyan-400 hover:bg-cyan-500 hover:text-white font-semibold px-8 py-4 rounded-xl transition inline-block">
                View All Services →
            </a>
        </div>

    </div>

</section>

<!-- CTA -->
<section class="py-20 bg-gradient-to-r from-cyan-700 to-teal-700 text-white">

    <div class="max-w-7xl mx-auto px-6 text-center">

        <h2 class="text-4xl md:text-5xl font-bold mb-4">
            Need Immediate Medical Attention?
        </h2>

        <p class="text-xl mb-8 text-cyan-100 max-w-2xl mx-auto">
            Our emergency department is open 24/7.
            Do not hesitate to contact us for urgent medical support.
        </p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">

            <a href="tel:+2348032080522"
               class="bg-amber-500 hover:bg-amber-600 text-white font-semibold px-8 py-4 rounded-xl transition">
                Call Emergency: (+234) 8032080522
            </a>

            <a href="contact.php"
               class="border-2 border-white text-white hover:bg-white hover:text-cyan-800 font-semibold px-8 py-4 rounded-xl transition">
                Find Location
            </a>

        </div>

    </div>

</section>

<!-- TESTIMONIALS -->
<section class="py-24 bg-slate-950 text-white">

    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center mb-16">

            <h2 class="text-4xl md:text-5xl font-bold text-white mb-4">
                What Our Patients Say
            </h2>

            <p class="text-slate-300 max-w-2xl mx-auto">
                Real stories from patients who trusted us with their health.
            </p>

        </div>

        <div class="grid md:grid-cols-3 gap-8">

            <div class="bg-white/5 border border-white/10 rounded-3xl shadow-lg p-8">
                <h4 class="font-bold text-white text-xl">Micheal John</h4>
                <p class="text-sm text-slate-400 mb-3">Cardiac Patient</p>
                <div class="text-yellow-400 mb-3">★★★★★</div>
                <p class="text-slate-300 italic">
                    "The care I received was exceptional. The doctors and nurses were professional and compassionate."
                </p>
            </div>

            <div class="bg-white/5 border border-white/10 rounded-3xl shadow-lg p-8">
                <h4 class="font-bold text-white text-xl">Vivian joseph</h4>
                <p class="text-sm text-slate-400 mb-3">Mother of Patient</p>
                <div class="text-yellow-400 mb-3">★★★★★</div>
                <p class="text-slate-300 italic">
                    "Outstanding pediatric care. The staff made us feel comfortable and safe."
                </p>
            </div>

            <div class="bg-white/5 border border-white/10 rounded-3xl shadow-lg p-8">
                <h4 class="font-bold text-white text-xl">David Andrew</h4>
                <p class="text-sm text-slate-400 mb-3">Orthopedic Patient</p>
                <div class="text-yellow-400 mb-3">★★★★☆</div>
                <p class="text-slate-300 italic">
                    "Successful treatment and excellent rehabilitation support. Highly recommended."
                </p>
            </div>

        </div>

    </div>

</section>

</main>

<!-- WHATSAPP FLOATING BUTTON -->
<button id="contact-btn"
   type="button"
   onclick="contactAction()"
   class="fixed bottom-6 right-6 bg-green-500 hover:bg-green-600 text-white w-16 h-16 rounded-full flex items-center justify-center shadow-2xl z-50 animate-bounce">
    <i class="fa-brands fa-whatsapp fa-2x"></i>
</button>

<!-- CONTACT MODAL -->
<div id="contact-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">

    <div class="absolute inset-0 bg-black/60" onclick="closeContactModal()"></div>

    <div class="relative bg-slate-900 text-white border border-white/10 rounded-2xl shadow-xl w-full max-w-sm p-6 z-10">

        <h3 class="text-xl font-bold mb-2">Contact Options</h3>

        <p class="text-sm text-slate-300 mb-5">
            Choose how you would like to reach us.
        </p>

        <div class="flex gap-3">

            <a href="https://wa.me/2348032080522"
               target="_blank"
               class="flex-1 bg-green-500 hover:bg-green-600 text-white py-3 rounded-lg text-center">
                WhatsApp
            </a>

            <a href="tel:+2348032080522"
               class="flex-1 bg-white/10 hover:bg-white/20 text-white py-3 rounded-lg text-center">
                Call
            </a>

        </div>

        <button type="button"
                onclick="closeContactModal()"
                class="mt-4 w-full text-sm text-slate-300">
            Cancel
        </button>

    </div>

</div>

<!-- AI CHATBOT -->
<div class="fixed bottom-24 right-6 z-50">

    <div id="chatWindow"
         class="hidden w-96 max-w-[90vw] bg-slate-900 text-white rounded-3xl shadow-2xl overflow-hidden border border-white/10">

        <div class="bg-gradient-to-r from-cyan-600 to-teal-600 text-white p-5 flex items-center justify-between">

            <div>
                <h3 class="font-bold text-lg">Lucas AI Assistant</h3>
                <p class="text-sm text-cyan-100">Online Healthcare Support</p>
            </div>

            <button onclick="toggleChat()" class="text-white text-2xl">
                ×
            </button>

        </div>

        <div id="chatMessages"
             class="h-96 overflow-y-auto p-5 space-y-4 bg-slate-950">

            <div class="flex items-start gap-3">
                <div class="w-10 h-10 rounded-full bg-cyan-600 text-white flex items-center justify-center"><i class="fa-solid fa-robot text-cyan-400"></i></div>
                <div class="bg-white/10 p-4 rounded-2xl shadow text-slate-200 max-w-xs">
                    Hello 👋 Welcome to Lucas Hospital. How can I help you today?
                </div>
            </div>

        </div>

        <div class="px-4 py-3 border-t border-white/10 bg-slate-900 flex flex-wrap gap-2">

            <button onclick="quickReply('Book appointment')"
                    class="bg-cyan-500/20 hover:bg-cyan-500/30 text-cyan-300 px-3 py-2 rounded-full text-sm">
                Appointment
            </button>

            <button onclick="quickReply('Emergency help')"
                    class="bg-red-500/20 hover:bg-red-500/30 text-red-300 px-3 py-2 rounded-full text-sm">
                Emergency
            </button>

            <button onclick="quickReply('Find doctor')"
                    class="bg-emerald-500/20 hover:bg-emerald-500/30 text-emerald-300 px-3 py-2 rounded-full text-sm">
                Find Doctor
            </button>

        </div>

        <div class="p-4 border-t border-white/10 bg-slate-900 flex items-center gap-3">

            <input type="text"
                   id="chatInput"
                   placeholder="Type your message..."
                   class="flex-1 bg-white/10 border border-white/10 text-white rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-cyan-300">

            <button onclick="sendMessage()"
                    class="bg-cyan-600 hover:bg-cyan-700 text-white px-5 py-3 rounded-2xl">
                Send
            </button>

        </div>

    </div>

    <button onclick="toggleChat()"
            class="mt-4 w-16 h-16 rounded-full bg-gradient-to-r from-cyan-600 to-teal-600 text-white text-3xl shadow-2xl hover:scale-110 transition">
        <i class="fa-solid fa-comment-medical"></i>
    </button>

</div>

<script>
function contactAction() {
    document.getElementById('contact-modal').classList.remove('hidden');
}

function closeContactModal() {
    document.getElementById('contact-modal').classList.add('hidden');
}

function toggleChat() {
    document.getElementById('chatWindow').classList.toggle('hidden');
}

function addMessage(message, sender = 'user') {
    const messages = document.getElementById('chatMessages');
    const wrapper = document.createElement('div');

    wrapper.className = `flex items-start gap-3 ${sender === 'user' ? 'justify-end' : ''}`;

    wrapper.innerHTML = `
        ${sender === 'bot'
            ? `<div class="w-10 h-10 rounded-full bg-cyan-600 text-white flex items-center justify-center"><i class="fa-solid fa-robot text-cyan-400"></i></div>`
            : ''
        }

        <div class="${sender === 'user'
            ? 'bg-cyan-600 text-white'
            : 'bg-white/10 text-slate-200'} p-4 rounded-2xl shadow max-w-xs">
            ${message}
        </div>
    `;

    messages.appendChild(wrapper);
    messages.scrollTop = messages.scrollHeight;
}

function botReply(userMessage) {
    let response = "I'm here to assist you.";

    userMessage = userMessage.toLowerCase();

    if (userMessage.includes('appointment')) {
        response = "You can book an appointment by visiting the appointment page.";
    } else if (userMessage.includes('doctor')) {
        response = "We have cardiologists, neurologists, emergency specialists, and orthopedic doctors.";
    } else if (userMessage.includes('emergency')) {
        response = "For emergencies, call our emergency line immediately: +2348032080522.";
    } else if (userMessage.includes('hello')) {
        response = "Hello 👋 How may I assist you today?";
    } else if (userMessage.includes('services')) {
        response = "We provide emergency care, cardiology, neurology, pediatrics, radiology, and more.";
    }

    setTimeout(() => {
        addMessage(response, 'bot');
    }, 700);
}

function sendMessage() {
    const input = document.getElementById('chatInput');
    const message = input.value.trim();

    if (message === '') return;

    addMessage(message, 'user');
    botReply(message);
    input.value = '';
}

function quickReply(message) {
    addMessage(message, 'user');
    botReply(message);
}

const counters = document.querySelectorAll('.counter');

counters.forEach(counter => {
    counter.innerText = '0';

    const updateCounter = () => {
        const target = +counter.getAttribute('data-target');
        const current = +counter.innerText;
        const increment = target / 100;

        if (current < target) {
            counter.innerText = `${Math.ceil(current + increment)}`;
            setTimeout(updateCounter, 20);
        } else {
            counter.innerText = target.toLocaleString() + '+';
        }
    };

    updateCounter();
});
</script>

<?php
require 'inc/footer.php';
?>