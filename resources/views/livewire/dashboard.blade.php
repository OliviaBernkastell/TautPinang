<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Dashboard
        </h2>
    </x-slot>

    <div class="relative py-12">
        <!-- Kanvas p5.js sebagai background -->
        <div id="bg-canvas" class="absolute inset-0 -z-0"></div>

        <div class="relative z-10 mx-auto max-w-7xl sm:px-6 lg:px-8">

            <!-- Welcome Section -->
            <div
                class="p-6 mb-6 overflow-hidden text-center shadow-xl bg-white/80 backdrop-blur sm:rounded-lg welcome-card">
                <!-- Logo di tengah -->
                <div class="mb-4">
                    <img id="tp-logo" src="{{ asset('img/favicon.png') }}" alt="Taut Pinang Logo"
                        class="w-24 h-24 mx-auto">
                </div>

                <!-- Paragraf penjelasan -->
                <p id="tp-text" class="mb-1 text-lg text-gray-700 translate-y-2 opacity-0">
                    Selamat datang di <strong>Taut Pinang</strong>
                </p>
                <p id="tp-text-2" class="text-sm text-gray-500 translate-y-2 opacity-0">
                    Satu halaman, banyak tautan - rapi, cepat, dan mudah dibagikan.
                </p>

                <!-- Quick Actions -->
                <div id="quick-actions" class="flex flex-wrap justify-center gap-3 mt-6 opacity-0">
                    <a href="{{ route('buat-tautan') }}" wire:navigate
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-all duration-200 transform border border-transparent rounded-md shadow-sm bg-gradient-to-r from-blue-600 via-green-600 to-orange-600 hover:from-blue-700 hover:via-green-700 hover:to-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 hover:scale-105">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Buat Tautan Baru
                    </a>
                    <a href="{{ route('kelola-tautan') }}" wire:navigate
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-all duration-200 transform bg-gray-600 border border-transparent rounded-md shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 hover:scale-105">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                            </path>
                        </svg>
                        Kelola Tautan
                    </a>
                </div>
            </div>

            <!-- Statistics Section -->
            <div id="stats-section" class="grid grid-cols-1 gap-6 mb-6 stats-grid sm:grid-cols-2 lg:grid-cols-4">
                <!-- Total Tautans -->
                <div class="p-6 shadow-lg stat-card bg-white/90 backdrop-blur rounded-xl">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 p-3 bg-indigo-100 rounded-lg">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Total Tautan</h3>
                            <p class="text-2xl font-bold text-indigo-600">{{ $statistics['total'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Active Tautans -->
                <div class="p-6 shadow-lg stat-card bg-white/90 backdrop-blur rounded-xl">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 p-3 bg-green-100 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Tautan Aktif</h3>
                            <p class="text-2xl font-bold text-green-600">{{ $statistics['active'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Links -->
                <div class="p-6 shadow-lg stat-card bg-white/90 backdrop-blur rounded-xl">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 p-3 bg-yellow-100 rounded-lg">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Total Links</h3>
                            <p class="text-2xl font-bold text-yellow-600">{{ $statistics['total_links'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Inactive Tautans -->
                <div class="p-6 shadow-lg stat-card bg-white/90 backdrop-blur rounded-xl">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 p-3 bg-red-100 rounded-lg">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Tautan Nonaktif</h3>
                            <p class="text-2xl font-bold text-red-600">{{ $statistics['inactive'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Average Links -->
                <div class="p-6 shadow-lg stat-card bg-white/90 backdrop-blur rounded-xl">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 p-3 bg-purple-100 rounded-lg">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Rata-rata Links</h3>
                            <p class="text-2xl font-bold text-purple-600">{{ $statistics['avg_links'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- This Month -->
                <div class="p-6 shadow-lg stat-card bg-white/90 backdrop-blur rounded-xl">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 p-3 bg-blue-100 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Bulan Ini</h3>
                            <p class="text-2xl font-bold text-blue-600">{{ $statistics['this_month'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Uploaded Images -->
                <div class="p-6 shadow-lg stat-card bg-white/90 backdrop-blur rounded-xl">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 p-3 bg-teal-100 rounded-lg">
                            <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Gambar Upload</h3>
                            <p class="text-2xl font-bold text-teal-600">{{ $statistics['uploaded_images'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- This Week -->
                <div class="p-6 shadow-lg stat-card bg-white/90 backdrop-blur rounded-xl">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 p-3 bg-orange-100 rounded-lg">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Minggu Ini</h3>
                            <p class="text-2xl font-bold text-orange-600">{{ $statistics['this_week'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Tautans Section -->
            @if ($recentTautans->count() > 0)
                <div id="recent-section" class="p-6 shadow-lg bg-white/90 backdrop-blur rounded-xl">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Tautan Terbaru</h3>
                        <a href="{{ route('kelola-tautan') }}" wire:navigate
                            class="text-sm text-indigo-600 hover:text-indigo-500 dark:text-indigo-400">
                            Lihat Semua →
                        </a>
                    </div>
                    <div class="space-y-3">
                        @foreach ($recentTautans as $tautan)
                            <div
                                class="flex items-center justify-between p-3 transition-colors rounded-lg bg-gray-50 hover:bg-gray-100">
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0">
                                        @if ($tautan->logo_url)
                                            <img class="object-cover w-10 h-10 rounded-lg"
                                                src="{{ $tautan->logo_url }}" alt="Logo">
                                        @else
                                            <div
                                                class="flex items-center justify-center w-10 h-10 bg-gray-300 rounded-lg">
                                                <svg class="w-6 h-6 text-gray-500" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1">
                                                    </path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900 dark:text-white">{{ $tautan->title }}</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">/{{ $tautan->slug }} •
                                            {{ $tautan->links_count }} links</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span
                                        class="inline-flex px-2 py-1 text-xs font-medium rounded-full {{ $tautan->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $tautan->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                    <a href="{{ route('tautan.show', $tautan->slug) }}" target="_blank"
                                        class="text-indigo-600 hover:text-indigo-500 dark:text-indigo-400"
                                        title="Kunjungi">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                            </path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <!-- Empty State -->
                <div id="empty-state" class="p-12 text-center shadow-lg bg-white/90 backdrop-blur rounded-xl">
                    <div class="flex flex-col items-center">
                        <svg class="w-16 h-16 mb-4 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1">
                            </path>
                        </svg>
                        <h3 class="mb-2 text-lg font-medium text-gray-900 dark:text-white">Belum Ada Tautan</h3>
                        <p class="mb-4 text-gray-500 dark:text-gray-400">Mulai dengan membuat tautan pertama Anda</p>
                        <a href="{{ route('buat-tautan') }}" wire:navigate
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white border border-transparent rounded-md shadow-sm bg-gradient-to-r from-blue-600 via-green-600 to-orange-600 hover:from-blue-700 hover:via-green-700 hover:to-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Buat Tautan Baru
                        </a>
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>

{{-- CDN: anime.js & p5.js --}}
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.9.0/p5.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Animasi masuk: logo & teks
        anime({
            targets: '#tp-logo',
            scale: [0.8, 1],
            rotate: [-5, 0],
            opacity: [0, 1],
            duration: 900,
            easing: 'easeOutElastic(1, .6)'
        });

  
        // Hover effects untuk logo
        const logo = document.querySelector('#tp-logo');
        logo.addEventListener('mouseenter', () => {
            anime.remove(logo);
            anime({
                targets: logo,
                scale: 1.06,
                duration: 250,
                easing: 'easeOutQuad'
            });
        });
        logo.addEventListener('mouseleave', () => {
            anime.remove(logo);
            anime({
                targets: logo,
                scale: 1,
                duration: 250,
                easing: 'easeOutQuad'
            });
        });

        // Hover effects untuk stat cards
        document.querySelectorAll('.stat-card').forEach(card => {
            card.addEventListener('mouseenter', () => {
                anime.remove(card);
                anime({
                    targets: card,
                    scale: 1.02,
                    translateY: -2,
                    duration: 300,
                    easing: 'easeOutQuad'
                });
            });
            card.addEventListener('mouseleave', () => {
                anime.remove(card);
                anime({
                    targets: card,
                    scale: 1,
                    translateY: 0,
                    duration: 300,
                    easing: 'easeOutQuad'
                });
            });
        });

        // Floating animation untuk welcome card
        anime({
            targets: '.welcome-card',
            translateY: [0, -5, 0],
            duration: 4000,
            easing: 'easeInOutSine',
            loop: true
        });

        // Fix stat cards visibility during scroll
        let userScrolled = false;
        let scrollTimeout;

        window.addEventListener('scroll', () => {
            userScrolled = true;

            // Clear existing timeout
            clearTimeout(scrollTimeout);

            // Force stat cards to be visible immediately when scrolling
            document.querySelectorAll('.stat-card').forEach(card => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            });

            // Set a timeout to reset the flag after scrolling stops
            scrollTimeout = setTimeout(() => {
                userScrolled = false;
            }, 150);
        });

        // Override the stat cards animation to handle scroll interruption
        const statCardAnimation = anime({
            targets: '.stat-card',
            opacity: [0, 1],
            translateY: [20, 0],
            duration: 500,
            delay: anime.stagger(100),
            autoplay: false, // We'll control this manually
            begin: function() {
                // Only run if user hasn't scrolled
                if (userScrolled) {
                    // Skip animation if user scrolled
                    document.querySelectorAll('.stat-card').forEach(card => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    });
                    statCardAnimation.pause();
                }
            }
        });

        // Add stat cards animation to timeline with condition
        anime.timeline({
                easing: 'easeOutQuad',
                delay: 150
            })
            .add({
                targets: '#tp-text',
                opacity: [0, 1],
                translateY: [8, 0],
                duration: 500
            })
            .add({
                targets: '#tp-text-2',
                opacity: [0, 1],
                translateY: [8, 0],
                duration: 500
            }, '-=250')
            .add({
                targets: '#quick-actions',
                opacity: [0, 1],
                translateY: [10, 0],
                duration: 600
            }, '-=200')
            .add({
                complete: function() {
                    // Only play stat cards animation if user hasn't scrolled
                    if (!userScrolled) {
                        statCardAnimation.play();
                    } else {
                        // If user scrolled, make sure cards are visible
                        document.querySelectorAll('.stat-card').forEach(card => {
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(0)';
                        });
                    }
                }
            }, '-=300')
            .add({
                targets: '#recent-section',
                opacity: [0, 1],
                translateY: [15, 0],
                duration: 600
            }, '-=200')
            .add({
                targets: '#empty-state',
                opacity: [0, 1],
                scale: [0.9, 1],
                duration: 600
            }, '-=200');
    });

    // p5.js background: partikel lembut warna biru–hijau dengan pergerakan halus
    new p5((p) => {
        let particles = [];
        const COUNT = 40;
        let canvasParent;

        class Particle {
            constructor() {
                this.reset(true);
            }
            reset(init = false) {
                this.x = p.random(p.width);
                this.y = p.random(p.height);
                this.r = p.random(40, 120);
                this.ax = p.random(0.2, 0.6) * (p.random() < 0.5 ? -1 : 1);
                this.ay = p.random(0.2, 0.6) * (p.random() < 0.5 ? -1 : 1);
                this.alpha = init ? 0 : p.random(60, 120);
                this.targetAlpha = p.random(60, 120);
                this.hue = p.random(180, 210); // spektrum biru-hijau
            }
            update() {
                this.x += this.ax * 0.3;
                this.y += this.ay * 0.3;

                // pantulan lembut
                if (this.x < -this.r || this.x > p.width + this.r || this.y < -this.r || this.y > p.height +
                    this.r) {
                    this.reset();
                    this.x = p.constrain(this.x, 0, p.width);
                    this.y = p.constrain(this.y, 0, p.height);
                }

                // easing alpha
                this.alpha += (this.targetAlpha - this.alpha) * 0.02;
            }
            draw() {
                p.noStroke();
                p.fill(this.hue, 60, 85, this.alpha);
                p.circle(this.x, this.y, this.r);
            }
        }

        p.setup = function() {
            canvasParent = document.getElementById('bg-canvas');
            const c = p.createCanvas(canvasParent.clientWidth, canvasParent.clientHeight);
            c.parent(canvasParent);
            p.colorMode(p.HSL, 360, 100, 100, 255);
            for (let i = 0; i < COUNT; i++) particles.push(new Particle());
            p.noiseSeed(Math.floor(Math.random() * 10000));
        };

        p.windowResized = function() {
            p.resizeCanvas(canvasParent.clientWidth, canvasParent.clientHeight);
        };

        p.draw = function() {
            // background transparan tipis agar menyatu dengan card
            p.clear();
            // layer kabut lembut
            p.noStroke();
            p.fill(200, 50, 96, 30);
            p.rect(0, 0, p.width, p.height);

            particles.forEach(pt => {
                pt.update();
                pt.draw();
            });
        };
    }, 'bg-canvas');
</script>
