<nav x-data="{ open: false }" class="bg-white shadow fixed w-full top-0 z-50">
   <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
       <!-- Logo -->
       <a href="{{ url('/') }}" class="text-xl font-bold text-indigo-700">Crystal CRM</a>

       <!-- Desktop Menu -->
       <div class="hidden md:flex space-x-6">
           <a href="{{ url('/') }}" 
              class="{{ request()->is('/') ? 'text-indigo-700 font-semibold' : 'text-gray-700 hover:text-indigo-700' }}">Home</a>
           <a href="{{ route('features') }}" 
              class="{{ request()->routeIs('features') ? 'text-indigo-700 font-semibold' : 'text-gray-700 hover:text-indigo-700' }}">Features</a>
           <a href="{{ route('whyus') }}" 
              class="{{ request()->routeIs('whyus') ? 'text-indigo-700 font-semibold' : 'text-gray-700 hover:text-indigo-700' }}">Why Us</a>
           <a href="{{ route('contact.show') }}" 
              class="{{ request()->routeIs('contact.show') ? 'text-indigo-700 font-semibold' : 'text-gray-700 hover:text-indigo-700' }}">Contact</a>
           <a href="{{ route('pricing') }}" 
              class="{{ request()->routeIs('pricing') ? 'text-indigo-700 font-semibold' : 'text-gray-700 hover:text-indigo-700' }}">Pricing</a>
       </div>

       <!-- Auth Buttons (Desktop) -->
       <div class="hidden md:flex space-x-4">
           @auth
               <a href="{{ route('dashboard') }}" 
                  class="{{ request()->routeIs('dashboard') ? 'bg-indigo-700 text-white' : 'bg-indigo-600 text-white hover:bg-indigo-700' }} px-4 py-2 rounded-lg">Dashboard</a>
               <form method="POST" action="{{ route('logout') }}">
                   @csrf
                   <button type="submit" class="px-4 py-2 border rounded-lg text-gray-700 hover:bg-gray-100">
                       Logout
                   </button>
               </form>
           @else
               <a href="{{ route('login') }}" 
                  class="{{ request()->routeIs('login') ? 'text-indigo-700 font-semibold' : 'text-gray-700 hover:text-indigo-700' }}">Login</a>
               <a href="{{ route('register') }}" 
                  class="{{ request()->routeIs('register') ? 'bg-indigo-700 text-white' : 'bg-indigo-600 text-white hover:bg-indigo-700' }} px-4 py-2 rounded-lg">Register</a>
           @endauth
       </div>

       <!-- Mobile Menu Button -->
       <div class="md:hidden">
           <button @click="open = !open" class="text-gray-700 focus:outline-none text-2xl">
               <span x-show="!open">☰</span>
               <span x-show="open">✖</span>
           </button>
       </div>
   </div>

   <!-- Overlay background -->
   <div 
       x-show="open"
       @click="open = false"
       x-transition.opacity
       class="fixed inset-0 bg-black bg-opacity-40 md:hidden z-40"
   ></div>

   <!-- Slide-in Mobile Menu -->
   <div
       x-show="open"
       x-transition:enter="transform transition ease-out duration-300"
       x-transition:enter-start="-translate-x-full"
       x-transition:enter-end="translate-x-0"
       x-transition:leave="transform transition ease-in duration-200"
       x-transition:leave-start="translate-x-0"
       x-transition:leave-end="-translate-x-full"
       class="fixed inset-y-0 left-0 w-3/4 bg-white shadow-lg p-6 space-y-4 z-50 md:hidden"
   >
       <a href="{{ url('/') }}" class="block {{ request()->is('/') ? 'text-indigo-700 font-semibold' : 'text-gray-700 hover:text-indigo-700' }}">Home</a>
       <a href="{{ route('features') }}" class="block {{ request()->routeIs('features') ? 'text-indigo-700 font-semibold' : 'text-gray-700 hover:text-indigo-700' }}">Features</a>
       <a href="{{ route('whyus') }}" class="block {{ request()->routeIs('whyus') ? 'text-indigo-700 font-semibold' : 'text-gray-700 hover:text-indigo-700' }}">Why Us</a>
       <a href="{{ route('contact.show') }}" class="block {{ request()->routeIs('contact.show') ? 'text-indigo-700 font-semibold' : 'text-gray-700 hover:text-indigo-700' }}">Contact</a>
       <a href="{{ route('pricing') }}" class="block {{ request()->routeIs('pricing') ? 'text-indigo-700 font-semibold' : 'text-gray-700 hover:text-indigo-700' }}">Pricing</a>

       <hr class="my-2">

       @auth
           <a href="{{ route('dashboard') }}" class="block {{ request()->routeIs('dashboard') ? 'text-indigo-700 font-semibold' : 'text-gray-700 hover:text-indigo-700' }}">Dashboard</a>
           <form method="POST" action="{{ route('logout') }}">
               @csrf
               <button type="submit" class="block text-gray-700 hover:text-indigo-700 w-full text-left">Logout</button>
           </form>
       @else
           <a href="{{ route('login') }}" class="block {{ request()->routeIs('login') ? 'text-indigo-700 font-semibold' : 'text-gray-700 hover:text-indigo-700' }}">Login</a>
           <a href="{{ route('register') }}" class="block {{ request()->routeIs('register') ? 'text-indigo-700 font-semibold' : 'text-gray-700 hover:text-indigo-700' }}">Register</a>
       @endauth
   </div>

   <script src="//unpkg.com/alpinejs" defer></script>
</nav>

<!-- Spacer -->
<div class="h-20"></div>
