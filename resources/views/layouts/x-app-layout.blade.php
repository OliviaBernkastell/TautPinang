<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Taut Pinang') }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Anime.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>

    <!-- Dark Mode Styles -->
    <style>
        :root {
            color-scheme: light dark;
        }

        html {
            color-scheme: light dark;
        }

        /* Light theme */
        [data-theme="light"] body {
            background: linear-gradient(to bottom right, #eff6ff, #ffffff, #ecfdf5);
            color: #111827;
        }

        /* Dark theme */
        [data-theme="dark"] body {
            background: linear-gradient(to bottom right, #111827, #1e3a8a, #064e3b);
            color: #f9fafb;
        }

        /* Theme-based text colors */
        [data-theme="light"] .text-gray-900 {
            color: #111827 !important;
        }

        [data-theme="dark"] .text-gray-900 {
            color: #e5e7eb !important;
        }

        [data-theme="light"] .text-gray-800 {
            color: #1f2937 !important;
        }

        [data-theme="dark"] .text-gray-800 {
            color: #e5e7eb !important;
        }

        [data-theme="light"] .text-gray-600 {
            color: #4b5563 !important;
        }

        [data-theme="dark"] .text-gray-600 {
            color: #9ca3af !important;
        }

        [data-theme="light"] .text-gray-500 {
            color: #6b7280 !important;
        }

        [data-theme="dark"] .text-gray-500 {
            color: #6b7280 !important;
        }

        [data-theme="light"] .text-gray-400 {
            color: #9ca3af !important;
        }

        [data-theme="dark"] .text-gray-400 {
            color: #9ca3af !important;
        }

        /* Theme-based background colors */
        [data-theme="light"] .bg-white {
            background-color: #ffffff !important;
        }

        [data-theme="dark"] .bg-white {
            background-color: #1f2937 !important;
        }

        [data-theme="light"] .bg-gray-50 {
            background-color: #f9fafb !important;
        }

        [data-theme="dark"] .bg-gray-50 {
            background-color: #374151 !important;
        }

        [data-theme="light"] .border-gray-200 {
            border-color: #e5e7eb !important;
        }

        [data-theme="dark"] .border-gray-200 {
            border-color: #374151 !important;
        }

        [data-theme="light"] .border-gray-300 {
            border-color: #d1d5db !important;
        }

        [data-theme="dark"] .border-gray-300 {
            border-color: #4b5563 !important;
        }

        [data-theme="light"] .border-gray-700 {
            border-color: #374151 !important;
        }

        [data-theme="dark"] .border-gray-700 {
            border-color: #6b7280 !important;
        }

        /* Theme-based hover states */
        [data-theme="light"] .hover\\:bg-gray-50:hover {
            background-color: #f3f4f6 !important;
        }

        [data-theme="dark"] .hover\\:bg-gray-50:hover {
            background-color: #4b5563 !important;
        }

        [data-theme="light"] .hover\\:bg-gray-700:hover {
            background-color: #374151 !important;
        }

        [data-theme="dark"] .hover\\:bg-gray-700:hover {
            background-color: #6b7280 !important;
        }

        /* Dark Mode Toggle Button */
        .dark-mode-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 50;
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(0, 0, 0, 0.1);
            padding: 8px 12px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        [data-theme="dark"] .dark-mode-toggle {
            background: rgba(31, 41, 55, 0.9);
            border-color: rgba(75, 85, 99, 0.3);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.3);
        }

        .dark-mode-toggle:hover {
            transform: scale(1.05);
        }

        .dark-mode-toggle:active {
            transform: scale(0.95);
        }

        /* Transitions */
        body, .bg-white, .bg-gray-50, .text-gray-900, .text-gray-800, .text-gray-600, .text-gray-500, .text-gray-400 {
            transition: color 0.3s ease, background-color 0.3s ease, border-color 0.3s ease;
        }
    </style>
</head>

<body>
    <button class="dark-mode-toggle" onclick="toggleTheme()" title="Toggle Dark Mode">
        <svg class="sun-icon w-5 h-5 text-yellow-500 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-9m9 9h9m-9 9h-9m9-9v9m0-9v9"></path>
        </svg>
        <svg class="moon-icon w-5 h-5 text-gray-700 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9 9 0 001.708 2.314L12 6.586l-7.354 7.354A9 9 0 002.646 18.354 9 9 0 006.646-1.614l1.708-2.928L12 17.414l7.354-7.354A9 9 0 0021.354 15.354z"></path>
        </svg>
    </button>

    <script>
        // Dark Mode Toggle Functionality
        function setTheme(theme) {
            const html = document.documentElement;
            if (theme === 'dark') {
                html.setAttribute('data-theme', 'dark');
                localStorage.setItem('theme', 'dark');
                document.querySelector('.sun-icon').classList.remove('hidden');
                document.querySelector('.moon-icon').classList.add('hidden');
            } else {
                html.setAttribute('data-theme', 'light');
                localStorage.setItem('theme', 'light');
                document.querySelector('.sun-icon').classList.add('hidden');
                document.querySelector('.moon-icon').classList.remove('hidden');
            }
        }

        function toggleTheme() {
            const currentTheme = document.documentElement.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            setTheme(newTheme);
        }

        // Initialize theme on page load
        document.addEventListener('DOMContentLoaded', () => {
            const savedTheme = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

            if (savedTheme) {
                setTheme(savedTheme);
            } else if (prefersDark) {
                setTheme('dark');
            } else {
                setTheme('light');
            }

            // Listen for system theme changes
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
                if (!localStorage.getItem('theme')) {
                    setTheme(e.matches ? 'dark' : 'light');
                }
            });
        });
    </script>

    {{ $slot }}
</body>
</html>