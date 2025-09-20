<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crystal CRM for Lawyers</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 text-gray-800 antialiased">
    @include('layouts.navbar')

    <!-- Hero Section (Full Width + Height) -->
    <section class="relative bg-gradient-to-r from-indigo-900 to-purple-800 text-white w-full min-h-[60vh] flex flex-col items-center justify-center text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Get in Touch</h1>
        <p class="text-lg md:text-xl max-w-2xl">
            Have questions about Crystal CRM? Fill out the form and we’ll get back to you as soon as possible.
        </p>
    </section>

    <!-- Contact Section (Edge-to-Edge Full Width) -->
    <section class="bg-white py-20 w-full">
        <div class="grid md:grid-cols-2 gap-0 w-full">
            
            <!-- Contact Form -->
            <div class="bg-gray-50 p-10 rounded-none shadow-lg w-full">
                @if(session('success'))
                    <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" required
                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" required
                               class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Message</label>
                        <textarea name="message" rows="5" required
                                  class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                    </div>
                    <button type="submit"
                            class="w-full px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700">
                        Send Message
                    </button>
                </form>
            </div>

            <!-- Contact Info & Map -->
            <div class="flex flex-col justify-center bg-white w-full p-10">
                <h3 class="text-2xl font-bold text-indigo-700">Contact Information</h3>
                <p class="mt-4 text-gray-600 leading-relaxed">
                    📍 Enugu, Nigeria <br>
                    📞 +234 7030920009 <br>
                    📞 +234 7045693525 <br>
                    📧 support@crystalcrm.com
                </p>

                <div class="mt-8 overflow-hidden shadow-lg w-full">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31619.782838628645!2d3.3792!3d6.5244!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103bf4b8b5f0b1f1%3A0xa1c5b3fbd8a2!2sLagos!5e0!3m2!1sen!2sng!4v1234567890"
                        width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    @include('layouts.footer')
</body>
</html>

