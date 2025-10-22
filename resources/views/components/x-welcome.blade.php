{{-- Taut Pinang Custom Welcome Component --}}
<div class="p-6 lg:p-8 bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 transition-colors duration-300">
    <div class="flex items-center justify-center">
        <img id="tp-welcome-logo" src="{{ asset('img/favicon.png') }}" alt="Taut Pinang Logo" class="block h-12 w-auto transition-all duration-300 dark:opacity-90">
    </div>

    <h1 class="mt-8 text-2xl font-medium text-gray-900 dark:text-gray-100 text-center">
        Selamat datang di <strong class="font-bold text-blue-600 dark:text-blue-400">Taut Pinang</strong>
    </h1>

    <p class="mt-2 text-center text-gray-600 dark:text-gray-400">
        Satu halaman, banyak tautan - rapi, cepat, dan mudah dibagikan.
    </p>

    <div class="mt-8 flex flex-wrap justify-center gap-4">
        <a href="{{ route('buat-tautan') }}"
           class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-gradient-to-r from-blue-600 via-green-600 to-orange-600 hover:from-blue-700 hover:via-green-700 hover:to-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:scale-105 dark:from-blue-500 dark:via-green-500 dark:to-orange-500">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Buat Tautan Baru
        </a>
        <a href="{{ route('kelola-tautan') }}"
           class="inline-flex items-center px-6 py-3 border border-gray-300 dark:border-gray-600 text-base font-medium rounded-md text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:scale-105">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
            Kelola Tautan
        </a>
    </div>
</div>