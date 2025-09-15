<x-app-layout>
    @include('layouts.navbar')
    
    <div class="bg-white py-16 px-6 lg:px-8">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-4xl font-extrabold text-gray-900">Get in Touch</h2>
            <p class="mt-4 text-lg text-gray-600">
                Have questions about Crystal CRM? Fill out the form and we’ll get back to you as soon as possible.
            </p>
        </div>
    
        <div class="mt-12 max-w-4xl mx-auto grid md:grid-cols-2 gap-12">
            <!-- Contact Form -->
            <div class="bg-gray-50 p-8 rounded-2xl shadow">
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
    
            <!-- Contact Info / Map -->
            <div class="flex flex-col justify-center">
                <h3 class="text-xl font-semibold text-gray-900">Contact Information</h3>
                <p class="mt-4 text-gray-600">
                    📍 Enugu, Nigeria <br>
                    📞 +234 7030920009 <br>
                    📧 support@crystalcrm.com
                </p>
    
                <div class="mt-6">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31619.782838628645!2d3.3792!3d6.5244!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103bf4b8b5f0b1f1%3A0xa1c5b3fbd8a2!2sLagos!5e0!3m2!1sen!2sng!4v1234567890"
                        width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
    
    @include('layouts.footer')
    </x-app-layout>
    