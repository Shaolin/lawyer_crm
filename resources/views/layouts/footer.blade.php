<footer class="bg-gray-900 text-gray-300 py-8 mt-12">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8">
        
        <!-- Logo & About -->
        <div>
            <h3 class="text-white text-lg font-bold">Law Office Pro</h3>
            <p class="mt-2 text-sm">
                A modern CRM built for law firms. Manage your cases, clients, tasks, and billing with ease and security.
            </p>
        </div>

        <!-- Quick Links -->
        <div>
            <h3 class="text-white text-lg font-bold">Quick Links</h3>
            <ul class="mt-2 space-y-2 text-sm">
                <li><a href="{{ route('features') }}" class="hover:text-white">Features</a></li>
                <li><a href="{{ url('whyus') }}" class="hover:text-white">Why Choose Us</a></li>
                <li><a href="{{ route('contact.show') }}" class="hover:text-white">Contact Us</a></li>
                <li><a href="{{ route('login') }}" class="hover:text-white">Login</a></li>
                <li><a href="{{ route('register') }}" class="hover:text-white">Sign Up</a></li>
            </ul>
        </div>

        <!-- Contact -->
        <div>
            <h3 class="text-white text-lg font-bold">Contact</h3>
            <p class="mt-2 text-sm">📍 Enugu, Nigeria</p>
            <p class="text-sm">📧 support@lawofficepro.com</p>
        </div>
    </div>

    <!-- Bottom Bar -->
    <div class="mt-8 border-t border-gray-700 pt-4 text-center text-sm text-gray-500">
        © {{ date('Y') }} Law Office Pro. All rights reserved.
    </div>
</footer>
