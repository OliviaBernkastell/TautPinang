<x-guest-layout>
    <!-- Theme-aware Background -->
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-emerald-50"
         style="transition: background 0.3s ease;">
        <div class="min-h-screen" data-theme-bg="true">
        <!-- Theme-aware Background Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <!-- Floating shapes dengan data-theme control -->
            <div class="light-shape absolute w-32 h-32 rounded-full top-20 left-10 bg-blue-200/20 blur-2xl"></div>
            <div class="light-shape absolute w-40 h-40 rounded-full top-40 right-20 bg-emerald-200/20 blur-2xl"></div>
            <div class="light-shape absolute rounded-full bottom-20 left-1/4 w-36 h-36 bg-orange-200/20 blur-2xl"></div>

            <div class="dark-shape absolute w-32 h-32 rounded-full top-20 left-10 bg-blue-600/10 blur-2xl"></div>
            <div class="dark-shape absolute w-40 h-40 rounded-full top-40 right-20 bg-emerald-600/10 blur-2xl"></div>
            <div class="dark-shape absolute rounded-full bottom-20 left-1/4 w-36 h-36 bg-orange-600/10 blur-2xl"></div>
        </div>

        <!-- Main Content -->
        <div class="relative flex items-center justify-center min-h-screen px-4 py-12">
            <!-- Dark Mode Toggle Button -->
            <button id="darkModeToggle" class="absolute top-4 right-4 p-3 rounded-lg bg-white/80 backdrop-blur-sm border border-gray-200 hover:bg-white transition-all duration-300 shadow-md toggle-button">
                <i id="sunIcon" class="w-5 h-5 text-yellow-500 hidden fas fa-sun"></i>
                <i id="moonIcon" class="w-5 h-5 text-gray-700 fas fa-moon"></i>
            </button>

            <div class="w-full max-w-5xl mx-auto">
                <div class="grid items-center grid-cols-1 gap-12 lg:grid-cols-2">

                    <!-- Left Side - Branding -->
                    <div class="order-2 space-y-8 text-center lg:text-left lg:order-1">
                        <!-- Logo -->
                        <div class="flex justify-center lg:justify-start">
                            <div class="relative">
                                <div class="logo-glow absolute inset-0 bg-gradient-to-r from-blue-400 to-emerald-400 rounded-2xl blur-xl opacity-30">
                                </div>
                                <div class="relative p-6 bg-white border border-blue-100 shadow-xl rounded-2xl logo-container">
                                    <img src="{{ asset('img/favicon.png') }}" alt="Taut Pinang"
                                        class="object-contain w-24 h-24">
                                </div>
                            </div>
                        </div>

                        <!-- Title and Description -->
                        <div class="space-y-4">
                            <h1 class="text-4xl font-bold lg:text-5xl">
                                <span class="brand-title text-transparent bg-gradient-to-r from-blue-600 via-cyan-600 to-emerald-600 bg-clip-text">
                                    Taut Pinang
                                </span>
                            </h1>
                            <p class="brand-desc text-xl font-light text-gray-600">Website Pembuat Tautan</p>
                        </div>

                        <!-- Features -->
                        <div class="space-y-4">
                            <div class="feature-card feature-card-blue flex items-start p-4 space-x-4 border border-blue-100 rounded-xl bg-white/50 backdrop-blur-sm">
                                <div class="icon-container-blue flex items-center justify-center flex-shrink-0 w-12 h-12 bg-blue-100 rounded-lg">
                                    <i class="text-lg text-blue-600 fas fa-link"></i>
                                </div>
                                <div>
                                    <h3 class="feature-title text-lg font-semibold text-gray-800">Pembuat Tautan Cerdas</h3>
                                    <p class="feature-desc text-gray-600">Buat tautan pendek yang efisien dan profesional</p>
                                </div>
                            </div>

                            <div class="feature-card feature-card-emerald flex items-start p-4 space-x-4 border rounded-xl bg-white/50 backdrop-blur-sm border-emerald-100">
                                <div class="icon-container-emerald flex items-center justify-center flex-shrink-0 w-12 h-12 rounded-lg bg-emerald-100">
                                    <i class="text-lg fas fa-bolt text-emerald-600"></i>
                                </div>
                                <div>
                                    <h3 class="feature-title text-lg font-semibold text-gray-800">Super Cepat</h3>
                                    <p class="feature-desc text-gray-600">Akses instan tanpa hambatan</p>
                                </div>
                            </div>

                            <div class="feature-card feature-card-orange flex items-start p-4 space-x-4 border border-orange-100 rounded-xl bg-white/50 backdrop-blur-sm">
                                <div class="icon-container-orange flex items-center justify-center flex-shrink-0 w-12 h-12 bg-orange-100 rounded-lg">
                                    <i class="text-lg text-orange-600 fas fa-users"></i>
                                </div>
                                <div>
                                    <h3 class="feature-title text-lg font-semibold text-gray-800">User Friendly</h3>
                                    <p class="feature-desc text-gray-600">Mudah digunakan untuk semua kalangan</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side - Login Form -->
                    <div class="order-1 lg:order-2">
                        <div class="login-card">
                            <!-- Form Header -->
                            <div class="mb-8 text-center">
                                <div class="form-icon-gradient inline-flex items-center justify-center w-16 h-16 mb-4 bg-gradient-to-br from-blue-500 to-emerald-500 rounded-2xl">
                                    <i class="text-2xl text-white fas fa-user"></i>
                                </div>
                                <h2 class="form-title mb-2 text-3xl font-bold text-gray-800">
                                    Selamat Datang
                                </h2>
                                <p class="form-subtitle text-gray-600">Masuk ke akun Taut Pinang Anda</p>
                            </div>

                            <!-- Login Form -->
                            <form class="space-y-6" action="{{ route('login') }}" method="POST" id="loginForm">
                                @csrf

                                <!-- Session Error Messages -->
                                @if (session('error'))
                                    <div class="error-message">
                                        <div class="flex items-start space-x-3">
                                            <i class="mt-1 text-red-500 fas fa-ban"></i>
                                            <div>
                                                <h4 class="text-sm font-semibold text-red-800">Akses Ditolak</h4>
                                                <p class="mt-1 text-sm text-red-700">{{ session('error') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Success Messages -->
                                @if (session('success'))
                                    <div class="success-message">
                                        <div class="flex items-start space-x-3">
                                            <i class="mt-1 text-green-500 fas fa-check-circle"></i>
                                            <div>
                                                <p class="mt-1 text-sm text-green-700">{{ session('success') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Error Messages -->
                                @if ($errors->any())
                                    <div class="error-message">
                                        <div class="flex items-start space-x-3">
                                            <i class="mt-1 text-orange-500 fas fa-exclamation-triangle"></i>
                                            <div>
                                                <h4 class="text-sm font-semibold text-orange-800">Terjadi kesalahan</h4>
                                                <ul class="mt-1 space-y-1 text-sm text-orange-700">
                                                    @foreach ($errors->all() as $error)
                                                        <li>• {{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Email Field -->
                                <div>
                                    <label for="email" class="form-label">
                                        Email Address
                                    </label>
                                    <div class="input-container">
                                        <input id="email" name="email" type="email" autocomplete="email"
                                            required value="{{ old('email') }}" class="form-input"
                                            placeholder="nama@example.com">
                                    </div>
                                    @error('email')
                                        <p class="error-text">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Password Field -->
                                <div>
                                    <label for="password" class="form-label">
                                        Password
                                    </label>
                                    <div class="input-container">
                                        <input id="password" name="password" type="password"
                                            autocomplete="current-password" required class="form-input"
                                            placeholder="••••••••">
                                    </div>
                                    @error('password')
                                        <p class="error-text">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Remember Me & Forgot Password -->
                                <div class="flex items-center justify-between">
                                    <label class="flex items-center space-x-3 cursor-pointer">
                                        <input type="checkbox" name="remember" class="checkbox-input">
                                        <span class="remember-text text-gray-700">
                                            Ingat saya
                                        </span>
                                    </label>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="submit-btn" id="loginBtn">
                                    <span class="btn-text" id="loginBtnText">
                                        <i class="mr-2 fas fa-sign-in-alt"></i>
                                        Masuk
                                    </span>
                                    <span class="hidden btn-spinner" id="loginBtnSpinner">
                                        <svg class="spinner" viewBox="0 0 24 24">
                                            <circle class="spinner-circle" cx="12" cy="12" r="10"
                                                stroke="currentColor" stroke-width="4" fill="none" />
                                        </svg>
                                        Memproses...
                                    </span>
                                </button>

                                <!-- Login Options -->
                                <p class="divider-text mb-4 text-sm font-medium text-center text-gray-500">atau masuk dengan</p>

                                <!-- Google Login -->
                                <a href="{{ route('auth.google') }}" class="google-btn" id="googleBtn">
                                    <span class="btn-text" id="googleBtnText">
                                        <svg class="w-5 h-5" viewBox="0 0 24 24">
                                            <path fill="#4285F4"
                                                d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                                            <path fill="#34A853"
                                                d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                                            <path fill="#FBBC05"
                                                d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                                            <path fill="#EA4335"
                                                d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
                                        </svg>
                                        Masuk dengan Google
                                    </span>
                                    <span class="hidden btn-spinner" id="googleBtnSpinner">
                                        <svg class="spinner" viewBox="0 0 24 24">
                                            <circle class="spinner-circle" cx="12" cy="12" r="10"
                                                stroke="currentColor" stroke-width="4" fill="none" />
                                        </svg>
                                        Menghubungkan...
                                    </span>
                                </a>

                                <!-- Register Info -->
                                <div class="mt-6 text-center">
                                    <p class="register-info-text text-gray-600">
                                        Untuk mendaftar akun baru, silakan hubungi
                                        <span class="font-semibold text-transparent bg-gradient-to-r from-blue-600 to-emerald-600 bg-clip-text">Admin TautPinang</span>
                                    </p>
                                </div>
                              </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

    <!-- JavaScript untuk Spinner dan Dark Mode Toggle -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Dark Mode Toggle Handler - Integrated with Guest Layout System
            const darkModeToggle = document.getElementById('darkModeToggle');

            // Function to set theme (matches guest layout)
            function setTheme(theme) {
                const htmlElement = document.documentElement;
                if (theme === 'dark') {
                    htmlElement.setAttribute('data-theme', 'dark');
                    localStorage.setItem('theme', 'dark');
                } else {
                    htmlElement.setAttribute('data-theme', 'light');
                    localStorage.setItem('theme', 'light');
                }

                // Update icons visibility
                const sunIcon = document.getElementById('sunIcon');
                const moonIcon = document.getElementById('moonIcon');

                if (theme === 'dark') {
                    if (sunIcon) sunIcon.classList.remove('hidden');
                    if (moonIcon) moonIcon.classList.add('hidden');
                } else {
                    if (sunIcon) sunIcon.classList.add('hidden');
                    if (moonIcon) moonIcon.classList.remove('hidden');
                }
            }

            // Function to toggle theme
            function toggleTheme() {
                const currentTheme = document.documentElement.getAttribute('data-theme');
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                setTheme(newTheme);
            }

            // Initialize theme on load
            const savedTheme = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

            // Set initial theme based on current state or preference
            const currentTheme = document.documentElement.getAttribute('data-theme');

            // Update icons immediately based on current theme
            function updateIcons() {
                const theme = document.documentElement.getAttribute('data-theme') || (prefersDark ? 'dark' : 'light');
                const sunIcon = document.getElementById('sunIcon');
                const moonIcon = document.getElementById('moonIcon');

                if (theme === 'dark') {
                    if (sunIcon) sunIcon.classList.remove('hidden');
                    if (moonIcon) moonIcon.classList.add('hidden');
                } else {
                    if (sunIcon) sunIcon.classList.add('hidden');
                    if (moonIcon) moonIcon.classList.remove('hidden');
                }
            }

            if (savedTheme) {
                setTheme(savedTheme);
            } else if (currentTheme) {
                // Use theme already set by guest layout
                updateIcons();
            } else if (prefersDark) {
                setTheme('dark');
            } else {
                setTheme('light');
            }

            // Add click handler to toggle button
            if (darkModeToggle) {
                darkModeToggle.addEventListener('click', toggleTheme);
            }

            // Listen for system theme changes
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
                if (!localStorage.getItem('theme')) {
                    setTheme(e.matches ? 'dark' : 'light');
                }
            });

            // Login Form Submit Handler
            const loginForm = document.getElementById('loginForm');
            const loginBtn = document.getElementById('loginBtn');
            const loginBtnText = document.getElementById('loginBtnText');
            const loginBtnSpinner = document.getElementById('loginBtnSpinner');

            if (loginForm && loginBtn) {
                loginForm.addEventListener('submit', function(e) {
                    // Validasi form
                    const email = document.getElementById('email').value;
                    const password = document.getElementById('password').value;

                    if (email && password) {
                        // Tampilkan spinner dan sembunyikan text
                        loginBtnText.classList.add('hidden');
                        loginBtnSpinner.classList.remove('hidden');

                        // Tambahkan class loading ke button
                        loginBtn.classList.add('loading');

                        // Disable button untuk mencegah double submit
                        loginBtn.disabled = true;
                    }
                });
            }

            // Google Login Handler
            const googleBtn = document.getElementById('googleBtn');
            const googleBtnText = document.getElementById('googleBtnText');
            const googleBtnSpinner = document.getElementById('googleBtnSpinner');

            if (googleBtn) {
                googleBtn.addEventListener('click', function(e) {
                    // Jangan prevent default karena ini link yang harus redirect

                    // Tampilkan spinner dan sembunyikan text
                    googleBtnText.classList.add('hidden');
                    googleBtnSpinner.classList.remove('hidden');

                    // Tambahkan class loading ke button
                    googleBtn.classList.add('loading');

                    // Optional: disable link untuk mencegah double click
                    googleBtn.style.pointerEvents = 'none';
                });
            }

            // Reset spinner jika user klik back button
            window.addEventListener('pageshow', function(event) {
                if (event.persisted) {
                    // Reset login button
                    if (loginBtnText && loginBtnSpinner) {
                        loginBtnText.classList.remove('hidden');
                        loginBtnSpinner.classList.add('hidden');
                        if (loginBtn) {
                            loginBtn.classList.remove('loading');
                            loginBtn.disabled = false;
                        }
                    }

                    // Reset google button
                    if (googleBtnText && googleBtnSpinner) {
                        googleBtnText.classList.remove('hidden');
                        googleBtnSpinner.classList.add('hidden');
                        if (googleBtn) {
                            googleBtn.classList.remove('loading');
                            googleBtn.style.pointerEvents = 'auto';
                        }
                    }
                }
            });
        });
    </script>

    <style>
        /* Background Theme Override */
        [data-theme="light"] div[data-theme-bg="true"] {
            background: linear-gradient(to bottom right, #eff6ff, #ffffff, #ecfdf5) !important;
        }

        [data-theme="dark"] div[data-theme-bg="true"] {
            background: linear-gradient(to bottom right, #111827, #1e3a8a, #064e3b) !important;
        }

        /* Floating Shapes Theme Control */
        [data-theme="light"] .light-shape {
            display: block;
        }

        [data-theme="dark"] .light-shape {
            display: none;
        }

        [data-theme="light"] .dark-shape {
            display: none;
        }

        [data-theme="dark"] .dark-shape {
            display: block;
        }

        /* Toggle Button Theme Control */
        .toggle-button {
            background: rgba(255, 255, 255, 0.8);
            border-color: #e5e7eb;
        }

        [data-theme="dark"] .toggle-button {
            background: rgba(31, 41, 55, 0.8);
            border-color: #374151;
        }

        .toggle-button:hover {
            background: rgba(255, 255, 255, 1);
        }

        [data-theme="dark"] .toggle-button:hover {
            background: rgba(31, 41, 55, 1);
        }

        /* Logo Theme Control */
        [data-theme="dark"] .logo-glow {
            background: linear-gradient(to right, #2563eb, #059669);
            opacity: 0.4;
        }

        [data-theme="dark"] .logo-container {
            background: #1f2937;
            border-color: #1e3a8a;
        }

        /* Brand Title & Description */
        [data-theme="dark"] .brand-title {
            background: linear-gradient(to right, #60a5fa, #34d399, #10b981);
            -webkit-background-clip: text;
            background-clip: text;
        }

        [data-theme="dark"] .brand-desc {
            color: #d1d5db;
        }

        /* Feature Cards */
        .feature-card {
            transition: all 0.3s ease;
        }

        [data-theme="dark"] .feature-card-blue {
            background: rgba(31, 41, 55, 0.5);
            border-color: #1e3a8a;
        }

        [data-theme="dark"] .feature-card-emerald {
            background: rgba(31, 41, 55, 0.5);
            border-color: #064e3b;
        }

        [data-theme="dark"] .feature-card-orange {
            background: rgba(31, 41, 55, 0.5);
            border-color: #92400e;
        }

        /* Icon Containers */
        [data-theme="dark"] .icon-container-blue {
            background: #1e3a8a;
        }

        [data-theme="dark"] .icon-container-emerald {
            background: #064e3b;
        }

        [data-theme="dark"] .icon-container-orange {
            background: #92400e;
        }

        .icon-container-blue i {
            transition: color 0.3s ease;
        }

        .icon-container-emerald i {
            transition: color 0.3s ease;
        }

        .icon-container-orange i {
            transition: color 0.3s ease;
        }

        [data-theme="dark"] .icon-container-blue i {
            color: #60a5fa !important;
        }

        [data-theme="dark"] .icon-container-emerald i {
            color: #34d399 !important;
        }

        [data-theme="dark"] .icon-container-orange i {
            color: #fbbf24 !important;
        }

        /* Feature Text */
        .feature-title {
            transition: color 0.3s ease;
        }

        .feature-desc {
            transition: color 0.3s ease;
        }

        [data-theme="dark"] .feature-title {
            color: #f3f4f6 !important;
        }

        [data-theme="dark"] .feature-desc {
            color: #d1d5db !important;
        }

        /* Form Elements */
        [data-theme="dark"] .form-icon-gradient {
            background: linear-gradient(to bottom right, #2563eb, #059669);
        }

        [data-theme="dark"] .form-title {
            color: #f3f4f6 !important;
        }

        [data-theme="dark"] .form-subtitle {
            color: #d1d5db !important;
        }

        [data-theme="dark"] .remember-text {
            color: #d1d5db !important;
        }

        [data-theme="dark"] .divider-text {
            color: #9ca3af !important;
        }

        [data-theme="dark"] .register-info-text {
            color: #d1d5db !important;
        }

        [data-theme="dark"] .register-info-text span {
            background: linear-gradient(to right, #60a5fa, #34d399);
            -webkit-background-clip: text;
            background-clip: text;
        }

        /* Theme-aware Login Card */
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(59, 130, 246, 0.1);
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            transition: all 0.3s ease;
        }

        [data-theme="dark"] .login-card {
            background: rgba(17, 24, 39, 0.95);
            border: 1px solid rgba(59, 130, 246, 0.2);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3), 0 10px 10px -5px rgba(0, 0, 0, 0.2);
        }

        /* Form Labels */
        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
            transition: color 0.3s ease;
        }

        [data-theme="dark"] .form-label {
            color: #d1d5db;
        }

        /* Form Inputs */
        .form-input {
            width: 100%;
            padding: 0.875rem 1rem;
            background: white;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            color: #111827;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        [data-theme="dark"] .form-input {
            background: #1f2937;
            border-color: #374151;
            color: #f9fafb;
        }

        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        [data-theme="dark"] .form-input:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
        }

        .form-input::placeholder {
            color: #9ca3af;
        }

        [data-theme="dark"] .form-input::placeholder {
            color: #6b7280;
        }

        /* Checkbox Input */
        .checkbox-input {
            width: 1.25rem;
            height: 1.25rem;
            background: white;
            border: 2px solid #d1d5db;
            border-radius: 6px;
            color: #3b82f6;
            transition: all 0.3s ease;
        }

        [data-theme="dark"] .checkbox-input {
            background: #1f2937;
            border-color: #4b5563;
        }

        .checkbox-input:checked {
            background: #3b82f6;
            border-color: #3b82f6;
        }

        /* Submit Button */
        .submit-btn {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #3b82f6, #10b981);
            border: none;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            transform: translateY(0);
            position: relative;
            overflow: hidden;
        }

        .submit-btn:hover:not(.loading) {
            background: linear-gradient(135deg, #2563eb, #059669);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        [data-theme="dark"] .submit-btn:hover:not(.loading) {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3);
        }

        .submit-btn.loading {
            cursor: not-allowed;
            opacity: 0.9;
        }

        /* Google Button */
        .google-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            width: 100%;
            padding: 0.875rem;
            background: white;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            color: #374151;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            transform: translateY(0);
            position: relative;
            overflow: hidden;
        }

        [data-theme="dark"] .google-btn {
            background: #1f2937;
            border-color: #374151;
            color: #d1d5db;
        }

        .google-btn:hover:not(.loading) {
            background: #f9fafb;
            border-color: #d1d5db;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        [data-theme="dark"] .google-btn:hover:not(.loading) {
            background: #374151;
            border-color: #4b5563;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.3);
        }

        .google-btn.loading {
            cursor: not-allowed;
            opacity: 0.9;
        }

        /* Error Message */
        .error-message {
            background: #fef3c7;
            border: 1px solid #f59e0b;
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }

        [data-theme="dark"] .error-message {
            background: rgba(220, 38, 38, 0.15);
            border-color: rgba(239, 68, 68, 0.3);
        }

        .error-text {
            color: #d97706;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        [data-theme="dark"] .error-text {
            color: #f87171;
        }

        /* Dark theme untuk error message styles */
        [data-theme="dark"] .text-red-800 {
            color: #fca5a5 !important;
        }

        [data-theme="dark"] .text-red-700 {
            color: #f87171 !important;
        }

        [data-theme="dark"] .text-green-700 {
            color: #86efac !important;
        }

        /* Spinner Styles */
        .spinner {
            width: 20px;
            height: 20px;
            margin-right: 0.5rem;
            animation: spin 1s linear infinite;
        }

        .spinner-circle {
            stroke-dasharray: 50;
            stroke-dashoffset: 25;
            animation: spin-circle 1.5s ease-in-out infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes spin-circle {
            0% {
                stroke-dashoffset: 50;
            }

            50% {
                stroke-dashoffset: 12.5;
            }

            100% {
                stroke-dashoffset: 50;
            }
        }

        .hidden {
            display: none !important;
        }

        .btn-text,
        .btn-spinner {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .login-card {
                padding: 2rem;
            }
        }

        @media (max-width: 640px) {
            .login-card {
                padding: 1.5rem;
            }
        }

        /* Dark Mode Toggle Button Animation */
        #darkModeToggle {
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        #darkModeToggle:hover {
            transform: scale(1.05);
        }

        #darkModeToggle:active {
            transform: scale(0.95);
        }
    </style>
</x-guest-layout>
