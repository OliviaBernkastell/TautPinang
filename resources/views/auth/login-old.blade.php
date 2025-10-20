<x-guest-layout>
    <!-- Full Screen Background -->
    <div class="min-h-screen bg-gradient-to-br from-blue-900 via-blue-800 to-green-900 fixed inset-0">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0">
            <div class="absolute w-32 h-32 bg-gradient-to-br from-blue-600/30 to-blue-400/20 rounded-full blur-3xl floating-element" style="top: 15%; left: 5%;"></div>
            <div class="absolute w-24 h-24 bg-gradient-to-br from-blue-500/30 to-blue-300/20 rounded-full blur-2xl floating-element" style="top: 60%; right: 10%;"></div>
            <div class="absolute w-28 h-28 bg-gradient-to-br from-green-600/30 to-green-400/20 rounded-full blur-2xl floating-element" style="top: 35%; left: 70%;"></div>
            <div class="absolute w-20 h-20 bg-gradient-to-br from-green-500/30 to-green-300/20 rounded-full blur-xl floating-element" style="bottom: 25%; left: 25%;"></div>
            <div class="absolute w-16 h-16 bg-gradient-to-br from-orange-600/30 to-orange-400/20 rounded-full blur-xl floating-element" style="top: 25%; right: 25%;"></div>
            <div class="absolute w-24 h-24 bg-gradient-to-br from-orange-500/30 to-orange-300/20 rounded-full blur-2xl floating-element" style="bottom: 15%; right: 30%;"></div>
        </div>
    </div>

    <!-- Main Content - Full Screen Grid -->
    <div class="min-h-screen grid grid-cols-1 lg:grid-cols-2">
        <!-- Left Side - Branding (Desktop Only) -->
        <div class="hidden lg:flex items-center justify-center bg-gradient-to-br from-blue-800/90 via-blue-700/80 to-green-700/80 backdrop-blur-xl">
            <div class="w-full max-w-lg px-8 text-white">
                <!-- Logo -->
                <div class="text-center mb-12">
                    <div class="relative inline-block mb-8 logo-container">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-400/40 to-green-400/30 rounded-3xl blur-xl animate-pulse"></div>
                        <div class="relative w-32 h-32 rounded-3xl border-4 border-white/60 shadow-2xl bg-gradient-to-br from-white/95 to-white/80 p-4 backdrop-blur-sm">
                            <img src="{{ asset('img/favicon.png') }}" alt="Taut Pinang" class="w-full h-full object-contain">
                        </div>
                    </div>
                    <h1 class="text-5xl font-bold mb-4 main-title bg-gradient-to-r from-blue-200 via-green-200 to-orange-200 bg-clip-text text-transparent">
                        Taut Pinang
                    </h1>
                    <p class="text-blue-100 text-xl mb-2 font-light subtitle">Website Pembuat Tautan</p>
                    <p class="text-green-100 text-base font-medium institution">BPS Kota Tanjungpinang</p>
                </div>

                <!-- Features -->
                <div class="space-y-8">
                    <div class="flex items-start space-x-4 feature-item">
                        <div class="flex-shrink-0 w-14 h-14 bg-gradient-to-br from-blue-600/30 to-blue-500/20 backdrop-blur-md rounded-2xl flex items-center justify-center border border-blue-400/40">
                            <i class="fas fa-link text-2xl text-blue-200"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold mb-2 bg-gradient-to-r from-blue-200 to-blue-100 bg-clip-text text-transparent">Pembuat Tautan Cerdas</h3>
                            <p class="text-blue-100/90 leading-relaxed">
                                Buat dan kelola tautan pendek yang profesional dan efisien
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4 feature-item">
                        <div class="flex-shrink-0 w-14 h-14 bg-gradient-to-br from-green-600/30 to-green-500/20 backdrop-blur-md rounded-2xl flex items-center justify-center border border-green-400/40">
                            <i class="fas fa-chart-line text-2xl text-green-200"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold mb-2 bg-gradient-to-r from-green-200 to-green-100 bg-clip-text text-transparent">Analitik Real-time</h3>
                            <p class="text-green-100/90 leading-relaxed">
                                Pantau performa tautan dengan statistik lengkap dan akurat
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4 feature-item">
                        <div class="flex-shrink-0 w-14 h-14 bg-gradient-to-br from-orange-600/30 to-orange-500/20 backdrop-blur-md rounded-2xl flex items-center justify-center border border-orange-400/40">
                            <i class="fas fa-shield-alt text-2xl text-orange-200"></i>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold mb-2 bg-gradient-to-r from-orange-200 to-orange-100 bg-clip-text text-transparent">Keamanan Terjamin</h3>
                            <p class="text-orange-100/90 leading-relaxed">
                                Sistem keamanan berlapis untuk melindungi data dan privasi
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="mt-16 pt-8 border-t border-white/20 text-center">
                    <div class="flex items-center justify-center space-x-2 mb-2">
                        <div class="w-2 h-2 bg-blue-300 rounded-full"></div>
                        <p class="text-blue-200 text-sm font-light">© 2025 BPS Kota Tanjungpinang</p>
                        <div class="w-2 h-2 bg-green-300 rounded-full"></div>
                    </div>
                    <p class="text-green-200/70 text-xs font-light">Platform Pembuat Tautan Resmi</p>
                </div>
            </div>
        </div>

        <!-- Right Side - Login Form (Full Screen on Mobile, Half on Desktop) -->
        <div class="flex items-center justify-center bg-gradient-to-br from-white/95 to-blue-50/50 backdrop-blur-2xl">
            <div class="w-full max-w-md px-6 sm:px-8 lg:px-12">
                <!-- Mobile Logo -->
                <div class="lg:hidden text-center mb-8 mobile-logo">
                    <div class="relative inline-block mb-6">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-400/40 to-green-400/30 rounded-2xl blur-xl animate-pulse"></div>
                        <div class="relative w-20 h-20 rounded-2xl border-4 border-white/60 shadow-lg bg-gradient-to-br from-white/95 to-white/80 p-3 backdrop-blur-sm">
                            <img src="{{ asset('img/favicon.png') }}" alt="Taut Pinang" class="w-full h-full object-contain">
                        </div>
                    </div>
                    <h1 class="text-3xl font-bold mb-2 bg-gradient-to-r from-blue-600 to-green-600 bg-clip-text text-transparent">Taut Pinang</h1>
                    <p class="text-gray-600 text-sm">Website Pembuat Tautan</p>
                </div>

                <!-- Login Form -->
                <div class="login-form">
                    <div class="text-center mb-8 welcome-section">
                        <div class="absolute -top-10 left-1/2 transform -translate-x-1/2">
                            <div class="w-3 h-3 bg-blue-400 rounded-full animate-pulse"></div>
                        </div>
                        <h2 class="text-3xl lg:text-4xl font-bold mb-3 welcome-title bg-gradient-to-r from-blue-600 via-green-600 to-orange-600 bg-clip-text text-transparent">
                            Masuk
                        </h2>
                        <p class="text-gray-600 welcome-subtitle font-light">Selamat datang di Taut Pinang</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}" class="space-y-6 login-form-element">
                        @csrf

                        <!-- Status Messages -->
                        @if (session('status'))
                            <div class="p-4 bg-gradient-to-r from-green-50/90 to-blue-50/90 border border-green-300/50 rounded-2xl text-sm font-medium text-green-700 flex items-center success-message backdrop-blur-sm shadow-lg">
                                <div class="w-2 h-2 bg-green-500 rounded-full mr-3"></div>
                                {{ session('status') }}
                            </div>
                        @endif

                        <!-- Validation Errors -->
                        @if ($errors->any())
                            <div class="p-4 bg-gradient-to-r from-red-50/90 to-orange-50/90 border border-red-300/50 rounded-2xl error-container backdrop-blur-sm shadow-lg">
                                <div class="flex items-center mb-3">
                                    <div class="w-2 h-2 bg-red-500 rounded-full mr-2"></div>
                                    <span class="text-sm font-medium text-red-800">Terjadi kesalahan:</span>
                                </div>
                                <ul class="text-sm text-red-600 space-y-2">
                                    @foreach ($errors->all() as $error)
                                        <li class="flex items-start">
                                            <div class="text-red-400 mr-2 mt-0.5">•</div>
                                            {{ $error }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Email Field -->
                        <div class="form-field">
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-3 field-label flex items-center">
                                <span class="text-blue-500 mr-2">◆</span>
                                Username
                            </label>
                            <div class="relative">
                                <input
                                    id="email"
                                    class="w-full px-4 py-4 bg-gradient-to-br from-white/90 to-blue-50/50 border-2 border-blue-200/50 rounded-2xl focus:ring-4 focus:ring-blue-500/20 focus:border-blue-400 transition-all duration-300 backdrop-blur-sm field-input shadow-lg"
                                    type="text"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    autofocus
                                    autocomplete="username"
                                    placeholder="Masukkan username"
                                >
                                <div class="absolute inset-0 rounded-2xl bg-gradient-to-r from-blue-500/10 to-green-500/10 opacity-0 focus-within:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
                            </div>
                        </div>

                        <!-- Password Field -->
                        <div class="form-field">
                            <label for="password" class="block text-sm font-semibold text-gray-700 mb-3 field-label flex items-center">
                                <span class="text-green-500 mr-2">◆</span>
                                Password
                            </label>
                            <div class="relative">
                                <input
                                    id="password"
                                    class="w-full px-4 py-4 bg-gradient-to-br from-white/90 to-green-50/50 border-2 border-green-200/50 rounded-2xl focus:ring-4 focus:ring-green-500/20 focus:border-green-400 transition-all duration-300 backdrop-blur-sm field-input shadow-lg"
                                    type="password"
                                    name="password"
                                    required
                                    autocomplete="current-password"
                                    placeholder="Masukkan password"
                                >
                                <div class="absolute inset-0 rounded-2xl bg-gradient-to-r from-green-500/10 to-orange-500/10 opacity-0 focus-within:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
                            </div>
                        </div>

                        <!-- Remember Me & Forgot Password -->
                        <div class="flex items-center justify-between form-options">
                            <label for="remember_me" class="flex items-center cursor-pointer checkbox-container group">
                                <div class="relative">
                                    <input
                                        type="checkbox"
                                        id="remember_me"
                                        name="remember"
                                        class="sr-only"
                                    >
                                    <div class="checkbox-custom w-5 h-5 bg-gradient-to-br from-blue-200 to-green-200 border-2 border-blue-300/50 rounded-lg flex items-center justify-center transition-all duration-300 group-hover:border-blue-400">
                                        <div class="checkmark-custom text-white text-xs opacity-0 transition-all duration-300">✓</div>
                                    </div>
                                </div>
                                <span class="ml-3 text-sm text-gray-600 group-hover:text-gray-900 transition-colors duration-300">Ingat saya</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium transition-all duration-300 forgot-link flex items-center group">
                                    <span>Lupa kata sandi?</span>
                                    <span class="ml-1 transform group-hover:translate-x-1 transition-transform duration-300">→</span>
                                </a>
                            @endif
                        </div>

                        <!-- Login Button -->
                        <button type="submit" class="w-full relative bg-gradient-to-r from-blue-600 via-green-600 to-orange-600 hover:from-blue-700 hover:via-green-700 hover:to-orange-700 text-white font-semibold py-4 px-6 rounded-2xl transform transition-all duration-300 flex items-center justify-center login-button group shadow-lg hover:shadow-xl">
                            <!-- Glow Effect -->
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-400/30 to-green-400/30 rounded-2xl blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 glow-effect"></div>

                            <!-- Button Content -->
                            <div class="relative z-10 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                </svg>
                                <span class="button-text text-lg">Masuk</span>
                            </div>
                        </button>

                        <!-- Divider -->
                        <div class="relative my-6">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-200"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-4 bg-gradient-to-br from-white/90 to-blue-50/50 backdrop-blur-sm text-gray-500 font-medium">atau masuk dengan</span>
                            </div>
                        </div>

                        <!-- Google Login Button -->
                        <a href="{{ route('auth.google') }}" class="w-full bg-white border-2 border-gray-200 hover:border-gray-300 hover:bg-gray-50 text-gray-700 font-semibold py-4 px-6 rounded-2xl flex items-center justify-center transition-all duration-300 hover:scale-105 shadow-lg google-button">
                            <svg class="w-5 h-5 mr-3" viewBox="0 0 24 24">
                                <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                                <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                                <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                                <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                            </svg>
                            <span class="font-medium">Google</span>
                        </a>
                    </form>

                    <!-- Help Section -->
                    <div class="mt-12 pt-8 border-t border-blue-200/30 help-section text-center">
                        <div class="inline-flex items-center justify-center w-12 h-12 bg-gradient-to-br from-blue-100 to-green-100 rounded-2xl mb-3 help-icon shadow-lg">
                            <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                        </div>
                        <p class="text-sm text-gray-600 font-light leading-relaxed">
                            Hubungi PIC web BPS Tanjungpinang
                        </p>
                        <div class="flex justify-center space-x-2 text-xs mt-2">
                            <div class="w-2 h-2 bg-blue-400 rounded-full"></div>
                            <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                            <div class="w-2 h-2 bg-orange-400 rounded-full"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- CDN: anime.js -->
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // EPIC PAGE LOAD ENTRANCE ANIMATION USING ANIME.JS

            // Hide all elements initially for dramatic entrance
            anime.set('.logo-container', { opacity: 0, scale: 0, rotate: -180 });
            anime.set('.main-title', { opacity: 0, translateY: -100, scale: 0.5 });
            anime.set('.subtitle', { opacity: 0, translateY: 50 });
            anime.set('.institution', { opacity: 0, translateY: 50 });
            anime.set('.feature-item', { opacity: 0, translateX: -200, scale: 0.8 });
            anime.set('.feature-icon', { opacity: 0, scale: 0, rotate: -180 });
            anime.set('.footer-section', { opacity: 0, translateY: 50 });
            anime.set('.login-form', { opacity: 0, translateX: 100, scale: 0.9 });
            anime.set('.welcome-title', { opacity: 0, translateY: -80, scale: 0.7 });
            anime.set('.welcome-subtitle', { opacity: 0, translateY: 40 });
            anime.set('.form-field', { opacity: 0, translateY: 60, scale: 0.95 });
            anime.set('.login-button', { opacity: 0, scale: 0.8, rotate: -5 });
            anime.set('.google-button', { opacity: 0, scale: 0.8, translateY: 20 });
            anime.set('.help-section', { opacity: 0, translateY: 40 });

            // Animate background elements
            anime({
                targets: '.floating-element',
                translateX: function() {
                    return anime.random(-30, 30);
                },
                translateY: function() {
                    return anime.random(-20, 20);
                },
                scale: [1, 1.1, 1],
                opacity: [
                    {value: 0.2, duration: 2000},
                    {value: 0.4, duration: 2000}
                ],
                easing: 'easeInOutSine',
                duration: 4000,
                loop: true,
                direction: 'alternate',
                delay: anime.stagger(1500)
            });

            // 0.3s - Logo epic entrance
            anime({
                targets: '.logo-container',
                opacity: [0, 1],
                scale: [0, 1.3, 1],
                rotate: [-180, 0],
                duration: 1500,
                easing: 'easeOutElastic(1, 0.5)',
                delay: 300
            });

            // 0.8s - Title dramatic appearance
            anime({
                targets: '.main-title',
                opacity: [0, 1],
                translateY: [-100, 0],
                scale: [0.5, 1.1, 1],
                duration: 1200,
                easing: 'easeOutBack(1.7)',
                delay: 800
            });

            // 1.0s - Subtitle smooth fade in
            anime({
                targets: '.subtitle',
                opacity: [0, 1],
                translateY: [30, 0],
                duration: 800,
                easing: 'easeOutQuad',
                delay: 1000
            });

            // 1.2s - Institution fade in
            anime({
                targets: '.institution',
                opacity: [0, 1],
                translateY: [30, 0],
                duration: 800,
                easing: 'easeOutQuad',
                delay: 1200
            });

            // 1.5s - Features epic entrance with stagger
            anime({
                targets: '.feature-item',
                opacity: [0, 1],
                translateX: [-200, 0],
                scale: [0.8, 1.1, 1],
                duration: 1000,
                easing: 'easeOutBack(1.7)',
                delay: anime.stagger(200, {start: 1500})
            });

            // Feature icons rotation effect
            anime({
                targets: '.feature-icon',
                opacity: [0, 1],
                scale: [0, 1.4, 1],
                rotate: [-180, 0],
                duration: 800,
                easing: 'easeOutBack(1.7)',
                delay: anime.stagger(200, {start: 1700})
            });

            // 2.0s - Footer appearance
            anime({
                targets: '.footer-section',
                opacity: [0, 1],
                translateY: [50, 0],
                duration: 800,
                easing: 'easeOutQuad',
                delay: 2000
            });

            // 1.8s - Login form dramatic entrance
            anime({
                targets: '.login-form',
                opacity: [0, 1],
                translateX: [100, 0],
                scale: [0.9, 1.05, 1],
                duration: 1200,
                easing: 'easeOutBack(1.7)',
                delay: 1800
            });

            // 2.0s - Welcome title
            anime({
                targets: '.welcome-title',
                opacity: [0, 1],
                translateY: [-80, 0],
                scale: [0.7, 1.2, 1],
                duration: 1000,
                easing: 'easeOutBack(1.7)',
                delay: 2000
            });

            // 2.2s - Welcome subtitle
            anime({
                targets: '.welcome-subtitle',
                opacity: [0, 1],
                translateY: [40, 0],
                duration: 800,
                easing: 'easeOutQuad',
                delay: 2200
            });

            // 2.4s - Form fields cascade entrance
            anime({
                targets: '.form-field',
                opacity: [0, 1],
                translateY: [60, 0],
                scale: [0.95, 1.02, 1],
                duration: 800,
                easing: 'easeOutBack(1.7)',
                delay: anime.stagger(150, {start: 2400})
            });

            // 2.8s - Login button epic finale
            anime({
                targets: '.login-button',
                opacity: [0, 1],
                scale: [0.8, 1.2, 1],
                rotate: [-5, 2, 0],
                duration: 1000,
                easing: 'easeOutBack(1.7)',
                delay: 2800
            });

            // 3.0s - Google button entrance
            anime({
                targets: '.google-button',
                opacity: [0, 1],
                scale: [0.8, 1.1, 1],
                translateY: [20, 0],
                duration: 800,
                easing: 'easeOutBack(1.7)',
                delay: 3000
            });

            // 3.2s - Help section final appearance
            anime({
                targets: '.help-section',
                opacity: [0, 1],
                translateY: [40, 0],
                duration: 800,
                easing: 'easeOutQuad',
                delay: 3200
            });

            // Mobile logo animation
            if (window.innerWidth < 1024) {
                anime({
                    targets: '.mobile-logo',
                    scale: [0.8, 1],
                    opacity: [0, 1],
                    duration: 800,
                    easing: 'easeOutQuad',
                    delay: 1500
                });
            }

            // Form field focus animations
            document.querySelectorAll('.field-input').forEach(input => {
                input.addEventListener('focus', function() {
                    anime({
                        targets: this,
                        scale: 1.02,
                        duration: 300,
                        easing: 'easeOutQuad'
                    });
                });

                input.addEventListener('blur', function() {
                    anime({
                        targets: this,
                        scale: 1,
                        duration: 300,
                        easing: 'easeOutQuad'
                    });
                });
            });

            // Button magical interactions
            const loginButton = document.querySelector('.login-button');
            const loginForm = document.querySelector('.login-form-element');
            let isSubmitting = false;

            if (loginButton) {
                loginButton.addEventListener('mouseenter', function() {
                    if (!isSubmitting) {
                        anime({
                            targets: this,
                            scale: 1.05,
                            translateY: -2,
                            duration: 300,
                            easing: 'easeOutQuad'
                        });

                        // Animate glow effect
                        const glowEffect = this.querySelector('.glow-effect');
                        if (glowEffect) {
                            anime({
                                targets: glowEffect,
                                opacity: [0, 1],
                                scale: [1, 1.2],
                                duration: 300,
                                easing: 'easeOutQuad'
                            });
                        }
                    }
                });

                loginButton.addEventListener('mouseleave', function() {
                    if (!this.matches(':active') && !isSubmitting) {
                        anime({
                            targets: this,
                            scale: 1,
                            translateY: 0,
                            duration: 300,
                            easing: 'easeOutQuad'
                        });

                        // Animate glow effect
                        const glowEffect = this.querySelector('.glow-effect');
                        if (glowEffect) {
                            anime({
                                targets: glowEffect,
                                opacity: 0,
                                scale: 1,
                                duration: 300,
                                easing: 'easeOutQuad'
                            });
                        }
                    }
                });
            }

            // Form submission loading state
            if (loginForm) {
                loginForm.addEventListener('submit', function(e) {
                    if (!isSubmitting) {
                        isSubmitting = true;
                        const originalContent = loginButton.innerHTML;

                        // Ganti tombol dengan spinner
                        loginButton.innerHTML = `
                            <span class="flex items-center justify-center">
                                <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Masuk...
                            </span>
                        `;

                        // Reset setelah 5 detik
                        setTimeout(() => {
                            if (isSubmitting) {
                                isSubmitting = false;
                                loginButton.innerHTML = originalContent;
                            }
                        }, 5000);
                    }
                });
            }

            // Logo subtle breathing effect
            anime({
                targets: '.logo-container',
                scale: [1, 1.01, 1],
                duration: 5000,
                easing: 'easeInOutSine',
                loop: true
            });
        });
    </script>

    <style>
        .field-input {
            position: relative;
            z-index: 2;
        }

        .checkbox-container {
            position: relative;
        }

        .login-button {
            position: relative;
            overflow: hidden;
        }

        .glow-effect {
            pointer-events: none;
        }

        .feature-icon {
            transition: all 0.3s ease;
        }

        .login-button {
            transition: all 0.3s ease;
        }

        .forgot-link {
            transition: all 0.3s ease;
        }

        /* Smooth transitions */
        * {
            transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            transition-duration: 150ms;
        }
    </style>
</x-guest-layout>