<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>WEMS — Work Experience Management System</title>

    <!-- Tailwind CDN for quick prototyping. Remove if using compiled Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* small cosmetic smoothing for anchor jump */
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="antialiased text-gray-800 bg-gray-50">

    <!-- NAV -->
    <header class="fixed w-full z-40 bg-white/90 backdrop-blur-lg shadow">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-between h-16">

                <!-- Logo + Title -->
                <div class="flex items-center gap-3">
                    <img src="{{ asset('images/wemslogo.png') }}" class="h-10 w-auto" alt="WEMS Logo">

                    {{-- <span class="font-semibold text-xl">
                        SIWES Portal
                    </span> --}}
                </div>

                <!-- Desktop Nav -->
                <nav class="hidden md:flex items-center gap-6 font-medium">
                    <a href="#home" class="hover:text-blue-600 transition">Home</a>
                    <a href="#about" class="hover:text-blue-600 transition">About</a>
                    <a href="#how" class="hover:text-blue-600 transition">How It Works</a>
                    <a href="#features" class="hover:text-blue-600 transition">Features</a>
                    <a href="#privacy" class="hover:text-blue-600 transition">Privacy</a>
                    <a href="#contact" class="hover:text-blue-600 transition">Contact</a>
                </nav>

                <!-- Auth Buttons -->
                <div class="flex items-center gap-3">
                    @auth
                        @if (Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}"
                               class="px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 shadow transition">
                                Dashboard
                            </a>

                        @elseif(Auth::user()->role === 'officer')
                            <a href="{{ route('officer.dashboard') }}"
                               class="px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 shadow transition">
                                Dashboard
                            </a>

                        @else
                            <a href="{{ route('student.dashboard') }}"
                               class="px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 shadow transition">
                                Dashboard
                            </a>

                        @endif
                    @else
                        <a href="{{ route('login') }}"
                           class="px-4 py-2 border border-blue-600 text-blue-600 rounded-xl hover:bg-blue-50 transition">
                            Login
                        </a>
                        <a href="{{ route('register') }}"
                           class="px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 shadow transition">
                            Get Started
                        </a>
                    @endauth

                    <!-- Mobile toggle -->
                    <button id="navToggle" class="md:hidden p-2 rounded-lg hover:bg-gray-100 transition">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>

            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileNav" class="hidden md:hidden border-t bg-white/95 backdrop-blur-lg">
            <div class="px-6 py-3 flex flex-col gap-3 font-medium">
                <a href="#home" class="py-1">Home</a>
                <a href="#about" class="py-1">About</a>
                <a href="#how" class="py-1">How It Works</a>
                <a href="#features" class="py-1">Features</a>
                <a href="#privacy" class="py-1">Privacy</a>
                <a href="#contact" class="py-1">Contact</a>

                @auth
                    <a href="{{ url('/dashboard') }}" class="py-1 text-blue-600 font-semibold">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="py-1">Login</a>
                    <a href="{{ route('register') }}" class="py-1">Get Started</a>
                @endauth
            </div>
        </div>
    </header>

    <main class="pt-20">

        <!-- HERO -->
        <section id="home" class="relative overflow-hidden">
            <div class="max-w-6xl mx-auto px-6 py-20 grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight">
                        Work Experience Management System (WEMS)
                    </h1>
                    <p class="mt-6 text-lg text-gray-600 max-w-xl">
                        A simple digital platform for students to record weekly SIWES/Industrial Training activities,
                        upload company endorsements once, and generate an approved, professionally stamped logbook PDF.
                    </p>

                    {{-- <div class="mt-8 flex flex-wrap gap-3">
                        <a href="{{ route('register') }}"
                            class="px-6 py-3 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700">
                            Get Started
                        </a>
                        <a href="{{ route('login') }}"
                            class="px-6 py-3 border border-blue-600 text-blue-600 rounded-md hover:bg-blue-50">
                            Login
                        </a>
                        <a href="#how" class="px-6 py-3 text-gray-700 rounded-md hover:bg-gray-100">How it works</a>
                    </div> --}}

                    <div class="px-6 py-6 mt-8 bg-blue-600 text-sm text-white rounded-md shadow">
                        <span class="font-medium">For institutions:</span> reduces paperwork, centralizes records, and
                        improves verification.
                    </div>
                </div>

                <div class="relative">
                    <div class="bg-gradient-to-tr from-blue-50 to-white rounded-2xl p-6 shadow-lg">
                        <!-- mockup: sample PDF card -->
                        <div class="bg-white rounded-lg p-5 border">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-lg font-semibold">SIWES Weekly Log</h3>
                                    <p class="text-sm text-gray-500">Student: Jane Doe — Week 5</p>
                                </div>
                                <div class="text-xs text-gray-400">PDF Preview</div>
                            </div>

                            <div class="mt-4">
                                <p class="text-sm text-gray-600">Summary: Assisted in backend API integration and
                                    database migration.</p>
                            </div>

                            <div class="mt-4 flex items-center gap-3">
                                <img src="https://via.placeholder.com/48" alt="passport"
                                    class="rounded-full w-12 h-12 border">
                                <div>
                                    <div class="text-sm font-medium">Company: Acme Ltd.</div>
                                    <div class="text-xs text-gray-500">Status: Company Endorsed</div>
                                </div>
                            </div>

                            <div class="mt-4 flex justify-end gap-2">
                                <button class="px-3 py-1 text-sm border rounded">Download</button>
                                <button class="px-3 py-1 text-sm bg-blue-600 text-white rounded">Signed PDF</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ABOUT -->
        <section id="about" class="max-w-6xl mx-auto px-6 py-16">
            <div class="grid md:grid-cols-2 gap-8 items-center">
                <div>
                    <h2 class="text-3xl font-bold">About WEMS</h2>
                    <p class="mt-4 text-gray-600">
                        WEMS helps students replace physical SIWES logbooks with a secure, structured online log.
                        Students submit weekly summaries, upload the company stamp & signature once, and receive a final
                        approved PDF
                        signed by the SIWES officer.
                    </p>
                    <ul class="mt-6 space-y-2 text-gray-700">
                        <li class="flex items-start gap-3"><span class="text-blue-600 mt-1">•</span> Easy weekly
                            submission</li>
                        <li class="flex items-start gap-3"><span class="text-blue-600 mt-1">•</span> Company endorsement
                            applied automatically</li>
                        <li class="flex items-start gap-3"><span class="text-blue-600 mt-1">•</span> Centralized SIWES
                            approvals</li>
                    </ul>
                </div>
                <div>
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=900&auto=format&fit=crop&ixlib=rb-4.0.3&s=6b0a7d8f4f3b7b4b4d9637f6b78f0c46"
                        alt="students" class="rounded-xl shadow">
                </div>
            </div>
        </section>

        <!-- HOW IT WORKS -->
        <section id="how" class="bg-white border-t">
            <div class="max-w-6xl mx-auto px-6 py-16">
                <h2 class="text-3xl font-bold text-center">How It Works</h2>

                <div class="mt-10 grid md:grid-cols-4 gap-6">
                    <div class="p-6 bg-gray-50 rounded-lg text-center">
                        <div class="text-2xl font-semibold text-blue-600">1</div>
                        <h3 class="mt-3 font-semibold">Register</h3>
                        <p class="mt-2 text-sm text-gray-600">Create an account and complete your profile.</p>
                    </div>
                    <div class="p-6 bg-gray-50 rounded-lg text-center">
                        <div class="text-2xl font-semibold text-blue-600">2</div>
                        <h3 class="mt-3 font-semibold">Submit Weekly Logs</h3>
                        <p class="mt-2 text-sm text-gray-600">Write weekly summaries of tasks and skills gained.</p>
                    </div>
                    <div class="p-6 bg-gray-50 rounded-lg text-center">
                        <div class="text-2xl font-semibold text-blue-600">3</div>
                        <h3 class="mt-3 font-semibold">Upload Endorsement</h3>
                        <p class="mt-2 text-sm text-gray-600">Upload company stamp & signature once — applied to all
                            weeks.</p>
                    </div>
                    <div class="p-6 bg-gray-50 rounded-lg text-center">
                        <div class="text-2xl font-semibold text-blue-600">4</div>
                        <h3 class="mt-3 font-semibold">Final Approval</h3>
                        <p class="mt-2 text-sm text-gray-600">SIWES officer reviews and signs the final PDF.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- FEATURES -->
        <section id="features" class="max-w-6xl mx-auto px-6 py-16">
            <h2 class="text-3xl font-bold text-center">Key Features</h2>

            <div class="mt-10 grid md:grid-cols-3 gap-6">
                <div class="p-6 bg-white rounded-lg shadow-sm">
                    <h3 class="font-semibold">Weekly Log Submission</h3>
                    <p class="mt-2 text-sm text-gray-600">A standard form to keep entries consistent and professional.
                    </p>
                </div>

                <div class="p-6 bg-white rounded-lg shadow-sm">
                    <h3 class="font-semibold">Company Endorsement</h3>
                    <p class="mt-2 text-sm text-gray-600">Upload stamp & signature once — the system applies it to all
                        weekly pages.</p>
                </div>

                <div class="p-6 bg-white rounded-lg shadow-sm">
                    <h3 class="font-semibold">Auto PDF Generation</h3>
                    <p class="mt-2 text-sm text-gray-600">Download a final PDF containing stamps and official
                        signatures.</p>
                </div>

                <div class="p-6 bg-white rounded-lg shadow-sm">
                    <h3 class="font-semibold">SIWES Officer Panel</h3>
                    <p class="mt-2 text-sm text-gray-600">Easily review and approve student submissions.</p>
                </div>

                <div class="p-6 bg-white rounded-lg shadow-sm">
                    <h3 class="font-semibold">Secure Storage</h3>
                    <p class="mt-2 text-sm text-gray-600">Files and student data are stored securely with controlled
                        access.</p>
                </div>

                <div class="p-6 bg-white rounded-lg shadow-sm">
                    <h3 class="font-semibold">Mobile Friendly</h3>
                    <p class="mt-2 text-sm text-gray-600">Students can submit logs from their phones or laptops.</p>
                </div>
            </div>
        </section>

        <!-- PRIVACY (modal trigger) -->
        <section id="privacy" class="bg-blue-50 border-t">
            <div class="max-w-6xl mx-auto px-6 py-16 text-center">
                <h2 class="text-2xl font-bold">Privacy & Data Protection</h2>
                <p class="mt-4 text-gray-600 max-w-2xl mx-auto">
                    We collect only the data required for SIWES documentation (student details, passport photo, weekly
                    logs, uploaded stamps/signatures).
                    Data is stored securely and only accessible to authorized officers.
                </p>

                <div class="mt-6 flex justify-center gap-3">
                    <button id="openPrivacy" class="px-5 py-3 bg-white border rounded-md hover:bg-gray-100">Read Full
                        Policy</button>
                    <a href="#contact" class="px-5 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700">Contact
                        Support</a>
                </div>
            </div>
        </section>

        <!-- CONTACT -->
        <section id="contact" class="max-w-6xl mx-auto px-6 py-16">
            <div class="grid md:grid-cols-2 gap-8 items-center">
                <div>
                    <h2 class="text-3xl font-bold">Contact Us</h2>
                    <p class="mt-4 text-gray-600">For support or enquiries, reach out to the SIWES support team.</p>

                    <div class="mt-6 text-sm text-gray-700 space-y-2">
                        <div><span class="font-medium">Email:</span> siwes.support@example.com</div>
                        <div><span class="font-medium">Phone:</span> +234 (XXX) XXX XXXX</div>
                        <div><span class="font-medium">Office:</span> Department of SIWES, [Your Institution]</div>
                    </div>
                </div>

                <div>
                    <!-- Simple contact form (non-functional; replace action to use) -->
                    <form id="contactForm" class="bg-white p-6 rounded-lg shadow-sm space-y-4">
                        <div>
                            <label class="text-sm font-medium">Your name</label>
                            <input type="text" name="name" class="mt-1 block w-full border rounded px-3 py-2"
                                placeholder="John Doe" required>
                        </div>

                        <div>
                            <label class="text-sm font-medium">Your email</label>
                            <input type="email" name="email" class="mt-1 block w-full border rounded px-3 py-2"
                                placeholder="you@example.com" required>
                        </div>

                        <div>
                            <label class="text-sm font-medium">Message</label>
                            <textarea name="message" rows="4" class="mt-1 block w-full border rounded px-3 py-2"
                                placeholder="How can we help?" required></textarea>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Send
                                Message</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <!-- FOOTER -->
        <footer class="border-t mt-8">
            <div
                class="max-w-6xl mx-auto px-6 py-6 flex flex-col md:flex-row items-center justify-between text-sm text-gray-500">
                <div>© {{ date('Y') }} Work Experience Management System. All rights reserved.</div>
                <div class="mt-3 md:mt-0 flex items-center gap-4">
                    <a href="#home" class="hover:text-gray-700">Home</a>
                    <a href="#privacy" class="hover:text-gray-700">Privacy</a>
                    <a href="#contact" class="hover:text-gray-700">Contact</a>
                </div>
            </div>
        </footer>
    </main>

    <!-- PRIVACY MODAL -->
    <div id="privacyModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 p-6">
        <div class="bg-white max-w-3xl w-full rounded-lg overflow-auto max-h-[80vh]">
            <div class="p-6 border-b flex items-center justify-between">
                <h3 class="text-lg font-semibold">Privacy Policy</h3>
                <button id="closePrivacy" class="p-2 rounded hover:bg-gray-100">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="p-6 space-y-4 text-gray-700">
                <p><strong>Overview:</strong> We collect student data (name, matric number, passport photo), weekly
                    logs, and uploaded company stamps/signatures strictly for SIWES documentation and verification.</p>

                <p><strong>Storage & Access:</strong> All files are stored securely on our server. Only authenticated
                    SIWES officers and the student can access their logbooks.</p>

                <p><strong>Retention:</strong> Data is retained for the duration of the student’s training and for
                    institutional record-keeping. You can request deletion via the support email.</p>

                <p><strong>Security:</strong> We use standard web security practices (password hashing, protected
                    storage paths). For production, ensure HTTPS and server hardening.</p>

                <p><strong>Contact:</strong> For privacy concerns email siwes.support@example.com</p>

                <div class="flex justify-end">
                    <button id="closePrivacy2" class="px-4 py-2 bg-blue-600 text-white rounded-md">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Minimal JS (mobile nav + modal + contact form demo) -->
    <script>
        // Mobile nav toggle
        const navToggle = document.getElementById('navToggle');
        const mobileNav = document.getElementById('mobileNav');
        navToggle?.addEventListener('click', () => mobileNav.classList.toggle('hidden'));

        // Privacy modal
        const openPrivacy = document.getElementById('openPrivacy');
        const privacyModal = document.getElementById('privacyModal');
        const closePrivacy = document.getElementById('closePrivacy');
        const closePrivacy2 = document.getElementById('closePrivacy2');

        openPrivacy?.addEventListener('click', () => privacyModal.classList.remove('hidden'));
        closePrivacy?.addEventListener('click', () => privacyModal.classList.add('hidden'));
        closePrivacy2?.addEventListener('click', () => privacyModal.classList.add('hidden'));

        // Simple contact form handler (demo - replace with ajax or server action)
        const contactForm = document.getElementById('contactForm');
        contactForm?.addEventListener('submit', (e) => {
            e.preventDefault();
            alert('Message sent (demo). Hook this to your backend to actually send messages.');
            contactForm.reset();
        });
    </script>
</body>

</html>
