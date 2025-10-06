<nav x-data="{ open: false }" class="bg-white shadow fixed w-full top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <!-- Logo -->
        <a href="{{ url('/') }}" class="text-xl font-bold text-indigo-700">Crystal CRM</a>

        <!-- Desktop Menu -->
        <div class="hidden md:flex space-x-6">
            <a href="{{ url('/') }}" 
               class="{{ request()->is('/') ? 'text-indigo-700 font-semibold' : 'text-gray-700 hover:text-indigo-700' }}">
               Home
            </a>
            <a href="{{ route('features') }}" 
               class="{{ request()->routeIs('features') ? 'text-indigo-700 font-semibold' : 'text-gray-700 hover:text-indigo-700' }}">
               Features
            </a>
            <a href="{{ route('whyus') }}" 
               class="{{ request()->routeIs('whyus') ? 'text-indigo-700 font-semibold' : 'text-gray-700 hover:text-indigo-700' }}">
               Why Us
            </a>
            
            <a href="{{ route('contact.show') }}" 
               class="{{ request()->routeIs('contact.show') ? 'text-indigo-700 font-semibold' : 'text-gray-700 hover:text-indigo-700' }}">
               Contact
            </a>
            <a href="{{ route('pricing') }}" 
   class="{{ request()->routeIs('pricing') ? 'text-indigo-700 font-semibold' : 'text-gray-700 hover:text-indigo-700' }}">
   Pricing
</a>

        </div>

        <!-- Auth Buttons (Desktop) -->
        <div class="hidden md:flex space-x-4">
            @auth
                <a href="{{ route('dashboard') }}" 
                   class="{{ request()->routeIs('dashboard') ? 'bg-indigo-700 text-white' : 'bg-indigo-600 text-white hover:bg-indigo-700' }} px-4 py-2 rounded-lg">
                    Dashboard
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="px-4 py-2 border rounded-lg text-gray-700 hover:bg-gray-100">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" 
                   class="{{ request()->routeIs('login') ? 'text-indigo-700 font-semibold' : 'text-gray-700 hover:text-indigo-700' }} px-2">
                   Login
                </a>
                <a href="{{ route('register') }}" 
                   class="{{ request()->routeIs('register') ? 'bg-indigo-700 text-white' : 'bg-indigo-600 text-white hover:bg-indigo-700' }} px-4 py-2 rounded-lg">
                   Register
                </a>
            @endauth
        </div>

        <!-- Mobile Menu Button -->
        <div class="md:hidden">
            <button @click="open = !open" class="text-gray-700 focus:outline-none">
                <span x-show="!open">☰</span>
                <span x-show="open">✖</span>
            </button>
        </div>
    </div>

    <!-- Mobile Dropdown -->
    <div x-show="open" x-transition class="md:hidden px-6 pb-4 space-y-2">
        <a href="{{ url('/') }}" 
           class="{{ request()->is('/') ? 'text-indigo-700 font-semibold' : 'text-gray-700 hover:text-indigo-700' }}">
           Home
        </a>
        <a href="{{ route('features') }}" 
           class="{{ request()->routeIs('features') ? 'text-indigo-700 font-semibold' : 'text-gray-700 hover:text-indigo-700' }}">
           Features
        </a>
        <a href="{{ route('whyus') }}" 
        class="{{ request()->routeIs('whyus') ? 'text-indigo-700 font-semibold' : 'text-gray-700 hover:text-indigo-700' }}">
        Why Us
     </a>
        <a href="{{ route('contact.show') }}" 
           class="{{ request()->routeIs('contact.show') ? 'text-indigo-700 font-semibold' : 'text-gray-700 hover:text-indigo-700' }}">
           Contact
        </a>
        <a href="{{ route('pricing') }}" 
   class="{{ request()->routeIs('pricing') ? 'text-indigo-700 font-semibold' : 'text-gray-700 hover:text-indigo-700' }}">
   Pricing
</a>


        @auth
            <a href="{{ route('dashboard') }}" 
               class="{{ request()->routeIs('dashboard') ? 'text-indigo-700 font-semibold' : 'text-gray-700 hover:text-indigo-700' }}">
               Dashboard
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block text-gray-700 hover:text-indigo-700">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" 
               class="{{ request()->routeIs('login') ? 'text-indigo-700 font-semibold' : 'text-gray-700 hover:text-indigo-700' }}">
               Login
            </a>
            <a href="{{ route('register') }}" 
               class="{{ request()->routeIs('register') ? 'text-indigo-700 font-semibold' : 'text-gray-700 hover:text-indigo-700' }}">
               Register
            </a>
        @endauth
    </div>
    <script src="//unpkg.com/alpinejs" defer></script>

</nav>

<!-- Spacer -->
<div class="h-20"></div>
