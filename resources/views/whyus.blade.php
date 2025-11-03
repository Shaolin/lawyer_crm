<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Why Us — Law Office Pro for Lawyers</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 text-gray-800 antialiased">

    <!-- Navbar -->
    @include('layouts.navbar')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-indigo-700 to-indigo-900 text-white py-20">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-5xl font-bold">Why Choose Law Office Pro?</h1>
            <p class="mt-4 text-lg md:text-xl text-gray-200">
                Built for legal professionals, Law Office Pro streamlines your workflow so you can focus on winning cases.
            </p>
        </div>
    </section>

    <!-- Why Us Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-2xl md:text-3xl font-bold text-center text-gray-800">What Sets Us Apart</h2>
            <p class="text-center text-gray-600 mt-2">Trusted by law firms for reliability, security, and ease of use</p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-12">
                <!-- User Friendly -->
                <div class="bg-white shadow rounded-2xl p-6 hover:shadow-lg transition">
                    <div class="text-indigo-600 text-1xl mb-4">🎯</div>
                    <h3 class="text-xl font-semibold text-gray-800">User-Friendly</h3>
                    <p class="text-gray-600 mt-2">
                        Designed with lawyers in mind — intuitive, easy to navigate, and no tech skills required.
                    </p>
                </div>

                <!-- Secure -->
                <div class="bg-white shadow rounded-2xl p-6 hover:shadow-lg transition">
                    <div class="text-indigo-600 text-1xl mb-4">🔒</div>
                    <h3 class="text-xl font-semibold text-gray-800">Bank-Level Security</h3>
                    <p class="text-gray-600 mt-2">
                        Your sensitive data is protected with top-grade encryption and access controls.
                    </p>
                </div>

                <!-- Affordable -->
                <div class="bg-white shadow rounded-2xl p-6 hover:shadow-lg transition">
                    <div class="text-indigo-600 text-1xl mb-4">💰</div>
                    <h3 class="text-xl font-semibold text-gray-800">Affordable</h3>
                    <p class="text-gray-600 mt-2">
                        Get enterprise-level features at a cost designed for small and mid-sized law firms.
                    </p>
                </div>

                <!-- Customizable -->
                <div class="bg-white shadow rounded-2xl p-6 hover:shadow-lg transition">
                    <div class="text-indigo-600 text-1xl mb-4">⚙️</div>
                    <h3 class="text-xl font-semibold text-gray-800">Customizable</h3>
                    <p class="text-gray-600 mt-2">
                        Tailor workflows, permissions, and modules to suit the unique needs of your practice.
                    </p>
                </div>

                <!-- Support -->
                <div class="bg-white shadow rounded-2xl p-6 hover:shadow-lg transition">
                    <div class="text-indigo-600 text-1xl mb-4">🤝</div>
                    <h3 class="text-xl font-semibold text-gray-800">Dedicated Support</h3>
                    <p class="text-gray-600 mt-2">
                        Our team is always ready to help with onboarding, training, and ongoing support.
                    </p>
                </div>

                <!-- Growth -->
                <div class="bg-white shadow rounded-2xl p-6 hover:shadow-lg transition">
                    <div class="text-indigo-600 text-1xl mb-4">🚀</div>
                    <h3 class="text-xl font-semibold text-gray-800">Scalable for Growth</h3>
                    <p class="text-gray-600 mt-2">
                        Whether you’re solo or a growing firm, Law Office Pro grows with you seamlessly.
                    </p>
                </div>
            </div>
        </div>
    </section>

     <!-- Footer -->
     @include('layouts.footer')

    </body>
    </html>
