<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Features — Law Office Pro for Lawyers</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 text-gray-800 antialiased">

    <!-- Navbar -->
    @include('layouts.navbar')

    <!-- Hero -->
    <header class="pt-28 bg-gradient-to-r from-indigo-700 to-indigo-900 text-white">
        <div class="max-w-7xl mx-auto px-6 py-20 md:py-28 text-center">
            <h1 class="text-3xl md:text-5xl font-extrabold leading-tight">Powerful Features for Law Firms</h1>
            <p class="mt-4 text-lg md:text-xl text-indigo-100 max-w-3xl mx-auto">
                Law Office Pro gives you everything you need to manage your practice — clients, cases, documents,
                invoicing and team collaboration — built with lawyers in mind.
            </p>
            <div class="mt-8 flex justify-center gap-4">
                <a href="{{ route('register') }}" class="px-6 py-3 bg-white text-indigo-900 font-semibold rounded-lg shadow hover:bg-gray-100">
                    Get Started
                </a>
                <a href="{{ route('whyus') }}" class="px-6 py-3 border border-white rounded-lg hover:bg-white/10">
                    Why Law Office Pro
                </a>
            </div>
        </div>
    </header>

    <!-- Core Features Grid -->
    <main class="max-w-7xl mx-auto px-6 py-16">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 text-center">Our Core Modules</h2>
        <p class="text-center text-gray-600 mt-2">Designed specifically for legal professionals</p>

        <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Clients -->
            <article class="bg-white rounded-1xl shadow p-6 hover:shadow-lg transition">
                <div class="text-indigo-600 text-2xl mb-4">👥</div>
                <h3 class="text-xl font-semibold text-gray-800">Clients</h3>
                <p class="text-gray-600 mt-2">Store client contact data, case history, invoices and notes in one place.</p>
            </article>

            <!-- Cases -->
            <article class="bg-white rounded-2xl shadow p-6 hover:shadow-lg transition">
                <div class="text-indigo-600 text-1xl mb-4">⚖️</div>
                <h3 class="text-xl font-semibold text-gray-800">Cases</h3>
                <p class="text-gray-600 mt-2">Organize open, in-progress and closed matters with timelines and status tracking.</p>
            </article>

            <!-- Invoices -->
            <article class="bg-white rounded-2xl shadow p-6 hover:shadow-lg transition">
                <div class="text-indigo-600 text-1xl mb-4">📄</div>
                <h3 class="text-xl font-semibold text-gray-800">Invoices</h3>
                <p class="text-gray-600 mt-2">Create, send and download PDF invoices; track payments and statuses.</p>
            </article>

            <!-- Documents -->
            <article class="bg-white rounded-2xl shadow p-6 hover:shadow-lg transition">
                <div class="text-indigo-600 text-1xl mb-4">📂</div>
                <h3 class="text-xl font-semibold text-gray-800">Documents</h3>
                <p class="text-gray-600 mt-2">Upload, organize and download case documents securely.</p>
            </article>

            <!-- Tasks -->
            <article class="bg-white rounded-2xl shadow p-6 hover:shadow-lg transition">
                <div class="text-indigo-600 text-1xl mb-4">✅</div>
                <h3 class="text-xl font-semibold text-gray-800">Tasks & Calendar</h3>
                <p class="text-gray-600 mt-2">Create tasks & court-date reminders and view them in a simple calendar.</p>
            </article>

            <!-- Users -->
            <article class="bg-white rounded-2xl shadow p-6 hover:shadow-lg transition">
                <div class="text-indigo-600 text-1xl mb-4">🧑‍💼</div>
                <h3 class="text-xl font-semibold text-gray-800">Users & Roles</h3>
                <p class="text-gray-600 mt-2">Invite team members and assign roles (admin, lawyer, staff) for secure access.</p>
            </article>
        </div>
    </main>

    <!-- Why Choose Law Office Pro -->
    <section id="why" class="bg-gray-100 py-16">
        <div class="max-w-5xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Why Choose Law Office Pro for Lawyers?</h2>
            <p class="text-lg text-gray-600 mb-12">
                Built for legal professionals — focused on security, reliability and workflow efficiency.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-left">
                <div class="flex items-start">
                    <span class="text-indigo-600 text-2xl mr-3">✔</span>
                    <p><strong>Save Time</strong> with templates, automation and integrated billing.</p>
                </div>
                <div class="flex items-start">
                    <span class="text-indigo-600 text-2xl mr-3">✔</span>
                    <p><strong>Stay Organized</strong> by keeping cases, clients and documents in one place.</p>
                </div>
                <div class="flex items-start">
                    <span class="text-indigo-600 text-2xl mr-3">✔</span>
                    <p><strong>Never Miss A Deadline</strong> — court date reminders and task notifications keep you on schedule.</p>
                </div>
                <div class="flex items-start">
                    <span class="text-indigo-600 text-2xl mr-3">✔</span>
                    <p><strong>Secure</strong> — role-based access and secure storage to protect client data.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('layouts.footer')

</body>
</html>
