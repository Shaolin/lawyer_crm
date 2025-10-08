<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Crystal CRM</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('crystalfavicon/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('crystalfavicon/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('crystalfavicon/favicon-16x16.png') }}">
<link rel="manifest" href="{{ asset('crystalfavicon/site.webmanifest') }}">


    <!-- Scripts -->
    @if (app()->environment('production'))
    <link rel="stylesheet" href="{{ asset('build/assets/app-BOrthtGJ.css') }}">
    <script type="module" src="{{ asset('build/assets/app-Da_XqnL6.js') }}"></script>
@else
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endif

</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900 dark:bg-gray-900 dark:text-gray-100">
    <div class="min-h-screen flex flex-col">

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow-sm border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <h1 class="text-xl font-semibold text-gray-800 dark:text-gray-100">
                        {{ $header }}
                    </h1>
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main class="flex-1 max-w-7xl mx-auto w-full py-8 px-4 sm:px-6 lg:px-8">
            {{ $slot }}
        </main>
    </div>

   <!-- Floating Button Container -->
<div class="fixed bottom-4 inset-x-0 flex justify-center gap-3 sm:gap-4 z-[9999] pointer-events-none">

    @auth
    <div class="flex bg-white/80 dark:bg-gray-900/80 backdrop-blur-md rounded-full px-3 py-2 shadow-lg pointer-events-auto gap-2">
        <!-- Back to Home -->
        <a href="{{ url('/') }}"
           class="inline-flex items-center px-3 py-2 text-xs sm:text-sm font-medium text-indigo-600 bg-white border border-indigo-600 rounded-full shadow hover:bg-indigo-50 dark:bg-gray-800 dark:text-gray-100 dark:border-indigo-400 dark:hover:bg-gray-700 transition">
             ⬅️ Home
        </a>

        <!-- Theme Toggle -->
        <button id="theme-toggle"
            class="inline-flex items-center justify-center px-3 py-2 text-xs sm:text-sm font-medium rounded-full bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-200 shadow hover:bg-gray-300 dark:hover:bg-gray-600 transition">
            🌞 / 🌙
        </button>

        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}"
           class="inline-flex items-center px-3 py-2 text-xs sm:text-sm font-medium text-white bg-indigo-600 rounded-full shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition">
             Dashboard
        </a>
    </div>
    @endauth
</div>



    <!-- Global Styles for Forms, Buttons & Tables -->
    <style>
        /* Inputs */
        input, textarea, select {
            @apply w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500;
            @apply dark:bg-gray-800 dark:border-gray-600 dark:text-gray-100 dark:placeholder-gray-400;
        }

        /* Primary Button */
        .btn-primary {
            @apply px-4 py-2 rounded-md font-medium bg-indigo-600 text-white hover:bg-indigo-700
                   focus:outline-none focus:ring-2 focus:ring-indigo-500
                   dark:bg-indigo-500 dark:hover:bg-indigo-600;
        }

        /* Secondary Button */
        .btn-secondary {
            @apply px-4 py-2 rounded-md font-medium bg-gray-200 text-gray-800 hover:bg-gray-300
                   focus:outline-none focus:ring-2 focus:ring-indigo-500
                   dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600;
        }

        /* Tables */
        table {
            @apply min-w-full divide-y divide-gray-200 dark:divide-gray-700;
        }
        thead {
            @apply bg-gray-50 dark:bg-gray-800;
        }
        th {
            @apply px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300;
        }
        td {
            @apply px-6 py-4 text-sm text-gray-900 dark:text-gray-100;
        }
    </style>

    <!-- Dark/Light Mode Script -->
    <script>
        const html = document.documentElement;
        const themeToggle = document.getElementById("theme-toggle");

        // On page load -> set theme from localStorage
        if (localStorage.getItem("theme") === "dark") {
            html.classList.add("dark");
        }

        // Toggle theme
        function toggleTheme() {
            if (html.classList.contains("dark")) {
                html.classList.remove("dark");
                localStorage.setItem("theme", "light");
            } else {
                html.classList.add("dark");
                localStorage.setItem("theme", "dark");
            }
        }

        // Attach click event
        if (themeToggle) {
            themeToggle.addEventListener("click", toggleTheme);
        }
    </script>
</body>
</html>
