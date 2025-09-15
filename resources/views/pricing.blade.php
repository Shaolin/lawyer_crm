<!DOCTYPE html> 
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pricing – Crystal CRM</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 text-gray-800 antialiased">

    <!-- Navbar -->
    @include('layouts.navbar')

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-indigo-900 to-purple-800 text-white">
        <div class="max-w-7xl mx-auto px-6 py-24 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Flexible Pricing for Law Firms</h1>
            <p class="text-lg md:text-xl mb-8 max-w-2xl mx-auto">
                Whether you’re a solo lawyer or managing a mid-sized chamber, Crystal CRM has a plan that fits your needs and budget.
            </p>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="bg-gray-50 py-20">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h2 class="text-4xl font-extrabold text-indigo-700">Simple, Transparent Pricing</h2>
            <p class="mt-4 text-lg text-gray-600">All plans include a 14-day free trial — no risk, no commitment.</p>

            <div class="mt-16 grid gap-8 md:grid-cols-3">
                <!-- Solo Lawyer -->
                <div class="bg-white rounded-2xl shadow-lg p-10 border border-gray-200 hover:shadow-xl transition relative">
                    <span class="absolute top-0 right-0 bg-green-600 text-white px-3 py-1 rounded-bl-lg text-sm font-semibold">
                        14 Days Free Trial
                    </span>
                    <h3 class="text-2xl font-bold text-indigo-700">Solo Lawyer / Small Chambers</h3>
                    <p class="mt-2 text-gray-600">For 1–3 lawyers who want to stay organized.</p>
                    <p class="mt-6 text-2xl font-extrabold text-gray-900">
                        ₦10,000<span class="text-lg font-medium text-gray-600">/month</span>
                    </p>
                    <ul class="mt-6 space-y-3 text-gray-700">
                        <li>✔ Manage Clients & Cases</li>
                        <li>✔ Basic Invoicing</li>
                        <li>✔ Document Storage</li>
                    </ul>
                    <a href="#" class="mt-8 block w-full bg-indigo-600 text-white py-3 rounded-lg font-medium hover:bg-indigo-700 transition">
                        Start Free Trial
                    </a>
                </div>

                <!-- Small-Mid Firms -->
                <div class="bg-white rounded-2xl shadow-lg p-10 border border-gray-200 hover:shadow-xl transition relative">
                    <span class="absolute top-0 right-0 bg-green-600 text-white px-3 py-1 rounded-bl-lg text-sm font-semibold">
                        14 Days Free Trial
                    </span>
                    <h3 class="text-2xl font-bold text-indigo-700">Small-Mid Firms</h3>
                    <p class="mt-2 text-gray-600">For 3–10 lawyers who need more control.</p>
                    <p class="mt-6 text-2xl font-extrabold text-gray-900">
                        ₦20,000<span class="text-lg font-medium text-gray-600">/month</span>
                    </p>
                    <ul class="mt-6 space-y-3 text-gray-700">
                        <li>✔ Case Tracking</li>
                        <li>✔ Staff Accounts</li>
                        <li>✔ Invoice & Reports</li>
                    </ul>
                    <a href="#" class="mt-8 block w-full bg-indigo-600 text-white py-3 rounded-lg font-medium hover:bg-indigo-700 transition">
                        Start Free Trial
                    </a>
                </div>

                <!-- Enterprise -->
                <div class="bg-white rounded-2xl shadow-lg p-10 border border-gray-200 hover:shadow-xl transition relative">
                    <span class="absolute top-0 right-0 bg-green-600 text-white px-3 py-1 rounded-bl-lg text-sm font-semibold">
                        14 Days Free Trial
                    </span>
                    <h3 class="text-2xl font-bold text-indigo-700">Custom Enterprise</h3>
                    <p class="mt-2 text-gray-600">For large firms that need custom setup & support.</p>
                    <p class="mt-6 text-2xl font-extrabold text-gray-900">
                        ₦50k–₦100k<span class="text-lg font-medium text-gray-600">/month</span>
                    </p>
                    <ul class="mt-6 space-y-3 text-gray-700">
                        <li>✔ Custom Setup</li>
                        <li>✔ Dedicated Support</li>
                        <li>✔ Advanced Integrations</li>
                    </ul>
                    <a href="#" class="mt-8 block w-full bg-indigo-600 text-white py-3 rounded-lg font-medium hover:bg-indigo-700 transition">
                        Start Free Trial
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('layouts.footer')

</body>
</html>
