<div class="dashboard-container">
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dashboard-title">
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
                <p id="tp-text" class="mb-1 text-lg text-gray-700 translate-y-2 opacity-0 welcome-text">
                    Selamat datang di <strong>Taut Pinang</strong>
                </p>
                <p id="tp-text-2" class="text-sm text-gray-500 translate-y-2 opacity-0 welcome-subtitle">
                    Satu halaman, banyak tautan - rapi, cepat, dan mudah dibagikan.
                </p>

                <!-- Quick Actions -->
                <div id="quick-actions" class="flex flex-wrap justify-center gap-3 mt-6 opacity-0">
                    <a href="{{ route('buat-tautan') }}" wire:navigate
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-all duration-200 transform border border-transparent rounded-md shadow-sm action-btn-primary bg-gradient-to-r from-blue-600 via-green-600 to-orange-600 hover:from-blue-700 hover:via-green-700 hover:to-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 hover:scale-105">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Buat Tautan Baru
                    </a>
                    <a href="{{ route('kelola-tautan') }}" wire:navigate
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white transition-all duration-200 transform bg-gray-600 border border-transparent rounded-md shadow-sm action-btn-secondary hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 hover:scale-105">
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
                <div class="p-6 shadow-lg stat-card stat-card-indigo bg-white/90 backdrop-blur rounded-xl">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 p-3 bg-indigo-100 rounded-lg stat-icon-indigo">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900 stat-title">Total Tautan</h3>
                            <p class="text-2xl font-bold text-indigo-600 stat-value">{{ $statistics['total'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Active Tautans -->
                <div class="p-6 shadow-lg stat-card stat-card-green bg-white/90 backdrop-blur rounded-xl">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 p-3 bg-green-100 rounded-lg stat-icon-green">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900 stat-title">Tautan Aktif</h3>
                            <p class="text-2xl font-bold text-green-600 stat-value">{{ $statistics['active'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Links -->
                <div class="p-6 shadow-lg stat-card stat-card-yellow bg-white/90 backdrop-blur rounded-xl">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 p-3 bg-yellow-100 rounded-lg stat-icon-yellow">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900 stat-title">Total Links</h3>
                            <p class="text-2xl font-bold text-yellow-600 stat-value">{{ $statistics['total_links'] }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Inactive Tautans -->
                <div class="p-6 shadow-lg stat-card stat-card-red bg-white/90 backdrop-blur rounded-xl">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 p-3 bg-red-100 rounded-lg stat-icon-red">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900 stat-title">Tautan Nonaktif</h3>
                            <p class="text-2xl font-bold text-red-600 stat-value">{{ $statistics['inactive'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Average Links -->
                <div class="p-6 shadow-lg stat-card stat-card-purple bg-white/90 backdrop-blur rounded-xl">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 p-3 bg-purple-100 rounded-lg stat-icon-purple">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900 stat-title">Rata-rata Links</h3>
                            <p class="text-2xl font-bold text-purple-600 stat-value">{{ $statistics['avg_links'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- This Month -->
                <div class="p-6 shadow-lg stat-card stat-card-blue bg-white/90 backdrop-blur rounded-xl">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 p-3 bg-blue-100 rounded-lg stat-icon-blue">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900 stat-title">Bulan Ini</h3>
                            <p class="text-2xl font-bold text-blue-600 stat-value">{{ $statistics['this_month'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Uploaded Images -->
                <div class="p-6 shadow-lg stat-card stat-card-teal bg-white/90 backdrop-blur rounded-xl">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 p-3 bg-teal-100 rounded-lg stat-icon-teal">
                            <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900 stat-title">Gambar Upload</h3>
                            <p class="text-2xl font-bold text-teal-600 stat-value">{{ $statistics['uploaded_images'] }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- This Week -->
                <div class="p-6 shadow-lg stat-card stat-card-orange bg-white/90 backdrop-blur rounded-xl">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 p-3 bg-orange-100 rounded-lg stat-icon-orange">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900 stat-title">Minggu Ini</h3>
                            <p class="text-2xl font-bold text-orange-600 stat-value">{{ $statistics['this_week'] }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Tautans Section -->
            @if ($recentTautans->count() > 0)
                <div id="recent-section" class="p-6 shadow-lg bg-white/90 backdrop-blur rounded-xl recent-section">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium text-gray-900 recent-title">Tautan Terbaru</h3>
                        <a href="{{ route('kelola-tautan') }}" wire:navigate
                            class="text-sm text-indigo-600 hover:text-indigo-500 recent-link">
                            Lihat Semua →
                        </a>
                    </div>
                    <div class="space-y-3">
                        @foreach ($recentTautans as $tautan)
                            <div
                                class="flex items-center justify-between p-3 transition-colors rounded-lg tautan-item bg-gray-50 hover:bg-gray-100">
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0">
                                        @if ($tautan->logo_url)
                                            <img class="object-cover w-10 h-10 rounded-lg"
                                                src="{{ $tautan->logo_url }}" alt="Logo">
                                        @else
                                            <div
                                                class="flex items-center justify-center w-10 h-10 bg-gray-300 rounded-lg logo-placeholder">
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
                                        <p class="font-medium text-gray-900 tautan-title">{{ $tautan->title }}</p>
                                        <p class="text-sm text-gray-500 tautan-meta">/{{ $tautan->slug }} •
                                            {{ $tautan->links_count }} links</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span
                                        class="status-badge-{{ $tautan->is_active ? 'active' : 'inactive' }} inline-flex px-2 py-1 text-xs font-medium rounded-full">
                                        {{ $tautan->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                    <a href="{{ route('tautan.show', $tautan->slug) }}" target="_blank"
                                        class="text-indigo-600 visit-link hover:text-indigo-500" title="Kunjungi">
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
                <div id="empty-state"
                    class="p-12 text-center shadow-lg bg-white/90 backdrop-blur rounded-xl empty-state">
                    <div class="flex flex-col items-center">
                        <svg class="w-16 h-16 mb-4 text-gray-400 empty-icon" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1">
                            </path>
                        </svg>
                        <h3 class="mb-2 text-lg font-medium text-gray-900 empty-title">Belum Ada Tautan</h3>
                        <p class="mb-4 text-gray-500 empty-desc">Mulai dengan membuat tautan pertama Anda</p>
                        <a href="{{ route('buat-tautan') }}" wire:navigate
                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-white border border-transparent rounded-md shadow-sm empty-btn bg-gradient-to-r from-blue-600 via-green-600 to-orange-600 hover:from-blue-700 hover:via-green-700 hover:to-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
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

<style>
    /* Dashboard Dark Mode Styles */

    /* Dashboard Title */
    [data-theme="dark"] .dashboard-title {
        color: #e5e7eb !important;
    }

    /* Header Slot - Dark Mode */
    [data-theme="dark"] .px-4.py-6.sm\\:px-6.lg\\:px-8,
    [data-theme="dark"] [class*="px-4"] [class*="py-6"] {
        background: rgba(17, 24, 39, 0.95) !important;
        border-bottom: 1px solid rgba(55, 65, 81, 0.3) !important;
    }

    [data-theme="dark"] .text-gray-800 {
        color: #e5e7eb !important;
    }

    /* Stat Values - Dark Mode */
    [data-theme="dark"] .stat-value {
        color: #f3f4f6 !important;
    }

    [data-theme="dark"] .stat-value.text-indigo-600 {
        color: #a5b4fc !important;
    }

    [data-theme="dark"] .stat-value.text-green-600 {
        color: #34d399 !important;
    }

    [data-theme="dark"] .stat-value.text-yellow-600 {
        color: #fbbf24 !important;
    }

    [data-theme="dark"] .stat-value.text-red-600 {
        color: #f87171 !important;
    }

    [data-theme="dark"] .stat-value.text-purple-600 {
        color: #c084fc !important;
    }

    [data-theme="dark"] .stat-value.text-blue-600 {
        color: #60a5fa !important;
    }

    [data-theme="dark"] .stat-value.text-teal-600 {
        color: #2dd4bf !important;
    }

    [data-theme="dark"] .stat-value.text-orange-600 {
        color: #fb923c !important;
    }

    /* Welcome Card */
    [data-theme="dark"] .welcome-card {
        background: rgba(17, 24, 39, 0.8) !important;
        color: #f3f4f6 !important;
    }

    [data-theme="dark"] .welcome-text {
        color: #d1d5db !important;
    }

    [data-theme="dark"] .welcome-subtitle {
        color: #9ca3af !important;
    }

    /* Stat Cards */
    [data-theme="dark"] .stat-card {
        background: rgba(17, 24, 39, 0.9) !important;
        border: 1px solid rgba(55, 65, 81, 0.3);
    }

    [data-theme="dark"] .stat-title {
        color: #f3f4f6 !important;
    }

    /* Icon Containers - Dark Mode */
    [data-theme="dark"] .stat-icon-indigo {
        background: #312e81 !important;
    }

    [data-theme="dark"] .stat-icon-green {
        background: #064e3b !important;
    }

    [data-theme="dark"] .stat-icon-yellow {
        background: #78350f !important;
    }

    [data-theme="dark"] .stat-icon-red {
        background: #7f1d1d !important;
    }

    [data-theme="dark"] .stat-icon-purple {
        background: #5b21b6 !important;
    }

    [data-theme="dark"] .stat-icon-blue {
        background: #1e3a8a !important;
    }

    [data-theme="dark"] .stat-icon-teal {
        background: #115e59 !important;
    }

    [data-theme="dark"] .stat-icon-orange {
        background: #9a3412 !important;
    }

    /* Icon Colors - Dark Mode */
    [data-theme="dark"] .stat-icon-indigo svg {
        color: #a5b4fc !important;
    }

    [data-theme="dark"] .stat-icon-green svg {
        color: #34d399 !important;
    }

    [data-theme="dark"] .stat-icon-yellow svg {
        color: #fbbf24 !important;
    }

    [data-theme="dark"] .stat-icon-red svg {
        color: #f87171 !important;
    }

    [data-theme="dark"] .stat-icon-purple svg {
        color: #c084fc !important;
    }

    [data-theme="dark"] .stat-icon-blue svg {
        color: #60a5fa !important;
    }

    [data-theme="dark"] .stat-icon-teal svg {
        color: #2dd4bf !important;
    }

    [data-theme="dark"] .stat-icon-orange svg {
        color: #fb923c !important;
    }

    /* Recent Section */
    [data-theme="dark"] .recent-section {
        background: rgba(17, 24, 39, 0.9) !important;
        border: 1px solid rgba(55, 65, 81, 0.3);
    }

    [data-theme="dark"] .recent-title {
        color: #f3f4f6 !important;
    }

    [data-theme="dark"] .recent-link {
        color: #818cf8 !important;
    }

    [data-theme="dark"] .recent-link:hover {
        color: #6366f1 !important;
    }

    /* Tautan Items */
    [data-theme="dark"] .tautan-item {
        background: rgba(31, 41, 55, 0.5) !important;
        border: 1px solid rgba(55, 65, 81, 0.2);
    }

    [data-theme="dark"] .tautan-item:hover {
        background: rgba(55, 65, 81, 0.5) !important;
    }

    [data-theme="dark"] .tautan-title {
        color: #f3f4f6 !important;
    }

    [data-theme="dark"] .tautan-meta {
        color: #9ca3af !important;
    }

    [data-theme="dark"] .logo-placeholder {
        background: rgba(55, 65, 81, 0.5) !important;
    }

    [data-theme="dark"] .logo-placeholder svg {
        color: #6b7280 !important;
    }

    /* Action Buttons */
    [data-theme="dark"] .action-btn-primary {
        filter: brightness(0.9) !important;
    }

    [data-theme="dark"] .action-btn-secondary {
        background: #4b5563 !important;
        border-color: #374151 !important;
    }

    [data-theme="dark"] .action-btn-secondary:hover {
        background: #374151 !important;
    }

    /* Status Badges */
    [data-theme="dark"] .status-badge {
        background: rgba(55, 65, 81, 0.5) !important;
        color: #d1d5db !important;
        border: 1px solid rgba(75, 85, 99, 0.3);
    }

    [data-theme="dark"] .status-badge-active {
        background: rgba(16, 185, 129, 0.2) !important;
        color: #34d399 !important;
        border: 1px solid rgba(16, 185, 129, 0.3) !important;
    }

    [data-theme="dark"] .status-badge-inactive {
        background: rgba(239, 68, 68, 0.2) !important;
        color: #f87171 !important;
        border: 1px solid rgba(239, 68, 68, 0.3) !important;
    }

    /* Light mode status badges */
    .status-badge-active {
        background: rgba(16, 185, 129, 0.1);
        color: #059669;
        border: 1px solid rgba(16, 185, 129, 0.2);
    }

    .status-badge-inactive {
        background: rgba(239, 68, 68, 0.1);
        color: #dc2626;
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    /* Empty State Button */
    [data-theme="dark"] .empty-btn {
        filter: brightness(0.9) !important;
    }

    [data-theme="dark"] .visit-link {
        color: #818cf8 !important;
    }

    [data-theme="dark"] .visit-link:hover {
        color: #6366f1 !important;
    }

    /* Empty State */
    [data-theme="dark"] .empty-state {
        background: rgba(17, 24, 39, 0.9) !important;
        border: 1px solid rgba(55, 65, 81, 0.3);
    }

    [data-theme="dark"] .empty-icon {
        color: #6b7280 !important;
    }

    [data-theme="dark"] .empty-title {
        color: #f3f4f6 !important;
    }

    [data-theme="dark"] .empty-desc {
        color: #9ca3af !important;
    }

    /* Canvas Background */
    [data-theme="dark"] #bg-canvas {
        filter: brightness(0.8) contrast(1.2);
    }

    /* Transitions */
    .stat-card,
    .welcome-card,
    .recent-section,
    .empty-state,
    .tautan-item {
        transition: all 0.3s ease;
    }

    .stat-title,
    .welcome-text,
    .welcome-subtitle,
    .recent-title,
    .tautan-title,
    .tautan-meta,
    .empty-title,
    .empty-desc {
        transition: color 0.3s ease;
    }

    .stat-icon-indigo,
    .stat-icon-green,
    .stat-icon-yellow,
    .stat-icon-red,
    .stat-icon-purple,
    .stat-icon-blue,
    .stat-icon-teal,
    .stat-icon-orange {
        transition: background-color 0.3s ease;
    }

    .stat-icon-indigo svg,
    .stat-icon-green svg,
    .stat-icon-yellow svg,
    .stat-icon-red svg,
    .stat-icon-purple svg,
    .stat-icon-blue svg,
    .stat-icon-teal svg,
    .stat-icon-orange svg {
        transition: color 0.3s ease;
    }

    /* Additional Interactive Elements Transitions */
    .action-btn-primary,
    .action-btn-secondary,
    .empty-btn {
        transition: all 0.3s ease;
    }

    .status-badge-active,
    .status-badge-inactive {
        transition: all 0.3s ease;
    }

    .recent-link,
    .visit-link {
        transition: color 0.3s ease;
    }

    .logo-placeholder {
        transition: background-color 0.3s ease;
    }

    .logo-placeholder svg {
        transition: color 0.3s ease;
    }

    /* Universal Dark Mode Reset */
    [data-theme="dark"] * {
        border-color: rgba(55, 65, 81, 0.3) !important;
    }

    /* Parent containers background */
    [data-theme="dark"] [x-slot],
    [data-theme="dark"] header,
    [data-theme="dark"] .container,
    [data-theme="dark"] .mx-auto {
        background: transparent !important;
    }

    /* All padding containers that might be the header */
    [data-theme="dark"] [class*="px-4"][class*="py-6"],
    [data-theme="dark"] [class*="sm:px-6"],
    [data-theme="dark"] [class*="lg:px-8"] {
        background: rgba(17, 24, 39, 0.95) !important;
        border-bottom: 1px solid rgba(55, 65, 81, 0.3) !important;
    }

    /* Text Elements - Dark Mode */
    [data-theme="dark"] .welcome-text,
    [data-theme="dark"] .welcome-subtitle,
    [data-theme="dark"] .tp-text,
    [data-theme="dark"] .tp-text-2,
    [data-theme="dark"] .stat-title,
    [data-theme="dark"] .recent-title,
    [data-theme="dark"] .tautan-title,
    [data-theme="dark"] .tautan-meta,
    [data-theme="dark"] .empty-title,
    [data-theme="dark"] .empty-desc,
    [data-theme="dark"] strong,
    [data-theme="dark"] .text-gray-800,
    [data-theme="dark"] .dashboard-title {
        color: #f3f4f6 !important;
    }

    /* Force override for all text-gray-800 elements */
    [data-theme="dark"] [class*="text-gray-800"] {
        color: #e5e7eb !important;
    }

    /* Stat Values - Dark Mode Override */
    [data-theme="dark"] .stat-value {
        color: #f3f4f6 !important;
    }

    [data-theme="dark"] .stat-value.text-indigo-600,
    [data-theme="dark"] .stat-value.text-green-600,
    [data-theme="dark"] .stat-value.text-yellow-600,
    [data-theme="dark"] .stat-value.text-red-600,
    [data-theme="dark"] .stat-value.text-purple-600,
    [data-theme="dark"] .stat-value.text-blue-600,
    [data-theme="dark"] .stat-value.text-teal-600,
    [data-theme="dark"] .stat-value.text-orange-600 {
        color: #f3f4f6 !important;
    }

    /* Card Backgrounds - Dark Mode */
    [data-theme="dark"] .welcome-card,
    [data-theme="dark"] .stat-card,
    [data-theme="dark"] .recent-section,
    [data-theme="dark"] .empty-state,
    [data-theme="dark"] .tautan-item {
        background: rgba(17, 24, 39, 0.95) !important;
        border: 1px solid rgba(55, 65, 81, 0.3) !important;
    }

    /* Buttons - Dark Mode */
    [data-theme="dark"] .action-btn-secondary {
        background: #374151 !important;
        border-color: #4b5563 !important;
    }

    [data-theme="dark"] .action-btn-secondary:hover {
        background: #4b5563 !important;
    }

    /* Icon Containers - Dark Mode Override */
    [data-theme="dark"] .stat-icon-indigo,
    [data-theme="dark"] .stat-icon-green,
    [data-theme="dark"] .stat-icon-yellow,
    [data-theme="dark"] .stat-icon-red,
    [data-theme="dark"] .stat-icon-purple,
    [data-theme="dark"] .stat-icon-blue,
    [data-theme="dark"] .stat-icon-teal,
    [data-theme="dark"] .stat-icon-orange {
        background: rgba(31, 41, 55, 0.8) !important;
    }

    /* Icon Colors - Dark Mode Override */
    [data-theme="dark"] .stat-icon-indigo svg,
    [data-theme="dark"] .stat-icon-green svg,
    [data-theme="dark"] .stat-icon-yellow svg,
    [data-theme="dark"] .stat-icon-red svg,
    [data-theme="dark"] .stat-icon-purple svg,
    [data-theme="dark"] .stat-icon-blue svg,
    [data-theme="dark"] .stat-icon-teal svg,
    [data-theme="dark"] .stat-icon-orange svg {
        fill: #9ca3af !important;
        color: #9ca3af !important;
        stroke: #9ca3af !important;
    }

    /* Placeholder Images - Dark Mode */
    [data-theme="dark"] .logo-placeholder {
        background: rgba(55, 65, 81, 0.6) !important;
    }

    [data-theme="dark"] .logo-placeholder svg {
        color: #6b7280 !important;
    }
</style>

<script>
    // Fungsi untuk deteksi dan mengatur tema otomatis berdasarkan preferensi sistem
    function detectAndSetSystemTheme() {
        const savedTheme = localStorage.getItem('theme');
        const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

        // Jika tidak ada tema yang tersimpan, gunakan preferensi sistem
        if (!savedTheme) {
            const theme = systemPrefersDark ? 'dark' : 'light';
            document.documentElement.setAttribute('data-theme', theme);
            localStorage.setItem('theme', theme);
        } else {
            // Gunakan tema yang tersimpan
            document.documentElement.setAttribute('data-theme', savedTheme);
        }
    }

    // Inisialisasi tema sebelum DOM loaded
    detectAndSetSystemTheme();

    // Listener untuk perubahan preferensi sistem
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
        const savedTheme = localStorage.getItem('theme');
        // Hanya update otomatis jika user tidak pernah mengatur tema manual
        if (!savedTheme || savedTheme === 'system') {
            const newTheme = e.matches ? 'dark' : 'light';
            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
        }
    });

    document.addEventListener('DOMContentLoaded', () => {
        // Pastikan tema sudah terdeteksi dengan benar
        detectAndSetSystemTheme();
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

    // p5.js background: partikel lembut warna biru–hijau dengan pergerakan halus + dark mode support
    window.addEventListener('load', function() { // p5 is guaranteed to be loaded here
        new p5((p) => {
            let particles = [];
            const COUNT = 40;
            let canvasParent;
            let isDarkMode = false;

            function updateTheme() {
                isDarkMode = document.documentElement.getAttribute('data-theme') === 'dark';
            }

            // Listen for theme changes
            const observer = new MutationObserver(() => {
                updateTheme();
            });

            observer.observe(document.documentElement, {
                attributes: true,
                attributeFilter: ['data-theme']
            });

            updateTheme(); // Initial theme check

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
                    // Adjust hue based on theme
                    if (isDarkMode) {
                        this.hue = p.random(200, 240); // biru-ungu untuk dark mode
                    } else {
                        this.hue = p.random(180, 210); // spektrum biru-hijau untuk light mode
                    }
                }
                update() {
                    this.x += this.ax * 0.3;
                    this.y += this.ay * 0.3;

                    // pantulan lembut
                    if (this.x < -this.r || this.x > p.width + this.r || this.y < -this.r || this
                        .y > p.height + this.r) {
                        this.reset();
                        this.x = p.constrain(this.x, 0, p.width);
                        this.y = p.constrain(this.y, 0, p.height);
                    }

                    // easing alpha
                    this.alpha += (this.targetAlpha - this.alpha) * 0.02;
                }
                draw() {
                    p.noStroke();
                    if (isDarkMode) {
                        // Dark mode particles - lebih soft dan warna berbeda
                        p.fill(this.hue, 50, 70, this.alpha * 0.7);
                    } else {
                        // Light mode particles
                        p.fill(this.hue, 60, 85, this.alpha);
                    }
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

                // layer kabut lembut - berbeda untuk dark/light mode
                p.noStroke();
                if (isDarkMode) {
                    // Dark mode fog - lebih gelap
                    p.fill(220, 40, 20, 25);
                } else {
                    // Light mode fog
                    p.fill(200, 50, 96, 30);
                }
                p.rect(0, 0, p.width, p.height);

                particles.forEach(pt => {
                    pt.update();
                    pt.draw();
                });
            };
        }, 'bg-canvas');
    });
</script>
