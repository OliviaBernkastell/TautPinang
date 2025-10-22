<x-guest-layout>
    <!-- Light Theme Background -->
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-emerald-50">
        <!-- Simple Subtle Background Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <!-- Simple floating shapes -->
            <div class="absolute w-32 h-32 rounded-full top-20 left-10 bg-blue-200/20 blur-2xl"></div>
            <div class="absolute w-40 h-40 rounded-full top-40 right-20 bg-emerald-200/20 blur-2xl"></div>
            <div class="absolute rounded-full bottom-20 left-1/4 w-36 h-36 bg-orange-200/20 blur-2xl"></div>
        </div>

        <!-- Main Content -->
        <div class="relative flex items-center justify-center min-h-screen px-4 py-12">
            <div class="w-full max-w-5xl mx-auto">
                <div class="grid items-center grid-cols-1 gap-12 lg:grid-cols-2">

                    <!-- Left Side - Branding -->
                    <div class="order-2 space-y-8 text-center lg:text-left lg:order-1">
                        <!-- Logo -->
                        <div class="flex justify-center lg:justify-start">
                            <div class="relative">
                                <div
                                    class="absolute inset-0 bg-gradient-to-r from-blue-400 to-emerald-400 rounded-2xl blur-xl opacity-30">
                                </div>
                                <div class="relative p-6 bg-white border border-blue-100 shadow-xl rounded-2xl">
                                    <img src="{{ asset('img/favicon.png') }}" alt="Taut Pinang"
                                        class="object-contain w-24 h-24">
                                </div>
                            </div>
                        </div>

                        <!-- Title and Description -->
                        <div class="space-y-4">
                            <h1 class="text-4xl font-bold lg:text-5xl">
                                <span
                                    class="text-transparent bg-gradient-to-r from-blue-600 via-cyan-600 to-emerald-600 bg-clip-text">
                                    Taut Pinang
                                </span>
                            </h1>
                            <p class="text-xl font-light text-gray-600">Website Pembuat Tautan</p>
                        </div>

                        <!-- Features -->
                        <div class="space-y-4">
                            <div
                                class="flex items-start p-4 space-x-4 border border-blue-100 rounded-xl bg-white/50 backdrop-blur-sm">
                                <div
                                    class="flex items-center justify-center flex-shrink-0 w-12 h-12 bg-blue-100 rounded-lg">
                                    <i class="text-lg text-blue-600 fas fa-link"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">Pembuat Tautan Cerdas</h3>
                                    <p class="text-gray-600">Buat tautan pendek yang efisien dan profesional</p>
                                </div>
                            </div>

                            <div
                                class="flex items-start p-4 space-x-4 border rounded-xl bg-white/50 backdrop-blur-sm border-emerald-100">
                                <div
                                    class="flex items-center justify-center flex-shrink-0 w-12 h-12 rounded-lg bg-emerald-100">
                                    <i class="text-lg fas fa-bolt text-emerald-600"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">Super Cepat</h3>
                                    <p class="text-gray-600">Akses instan tanpa hambatan</p>
                                </div>
                            </div>

                            <div
                                class="flex items-start p-4 space-x-4 border border-orange-100 rounded-xl bg-white/50 backdrop-blur-sm">
                                <div
                                    class="flex items-center justify-center flex-shrink-0 w-12 h-12 bg-orange-100 rounded-lg">
                                    <i class="text-lg text-orange-600 fas fa-users"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">User Friendly</h3>
                                    <p class="text-gray-600">Mudah digunakan untuk semua kalangan</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side - Login Form -->
                    <div class="order-1 lg:order-2">
                        <div class="login-card">
                            <!-- Form Header -->
                            <div class="mb-8 text-center">
                                <div
                                    class="inline-flex items-center justify-center w-16 h-16 mb-4 bg-gradient-to-br from-blue-500 to-emerald-500 rounded-2xl">
                                    <i class="text-2xl text-white fas fa-user"></i>
                                </div>
                                <h2 class="mb-2 text-3xl font-bold text-gray-800">
                                    Selamat Datang
                                </h2>
                                <p class="text-gray-600">Masuk ke akun Taut Pinang Anda</p>
                            </div>

                            <!-- Login Form -->
                            <form class="space-y-6" action="{{ route('login') }}" method="POST" id="loginForm">
                                @csrf

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
                                        <span class="text-gray-700">
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
                                <p class="mb-4 text-sm font-medium text-center text-gray-500">atau masuk dengan</p>

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

                                <!-- Register Link -->
                                <div class="mt-6 text-center">
                                    <p class="text-gray-600">
                                        Belum punya akun?
                                        <a href="{{ route('register') }}"
                                            class="text-transparent transition-all hover:underline bg-gradient-to-r from-blue-600 to-emerald-600 bg-clip-text">
                                            Daftar sekarang
                                        </a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript untuk Spinner -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
        /* Light Theme Styles */
        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(59, 130, 246, 0.1);
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
        }

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

        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-input::placeholder {
            color: #9ca3af;
        }

        .checkbox-input {
            width: 1.25rem;
            height: 1.25rem;
            background: white;
            border: 2px solid #d1d5db;
            border-radius: 6px;
            color: #3b82f6;
            transition: all 0.3s ease;
        }

        .checkbox-input:checked {
            background: #3b82f6;
            border-color: #3b82f6;
        }

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

        .submit-btn.loading {
            cursor: not-allowed;
            opacity: 0.9;
        }

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

        .google-btn:hover:not(.loading) {
            background: #f9fafb;
            border-color: #d1d5db;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .google-btn.loading {
            cursor: not-allowed;
            opacity: 0.9;
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

        .error-message {
            background: #fef3c7;
            border: 1px solid #f59e0b;
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        .error-text {
            color: #d97706;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        /* Responsive */
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
    </style>
</x-guest-layout>
