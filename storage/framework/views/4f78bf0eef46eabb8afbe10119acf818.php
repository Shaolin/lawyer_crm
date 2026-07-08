<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Law Office Pro</title>
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">

    <!-- Navbar -->
    <?php echo $__env->make('layouts.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-indigo-900 to-purple-800 text-white">
        <div class="max-w-7xl mx-auto px-6 py-24 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Law Office Pro — Built for Law Firms</h1>
            <p class="text-lg md:text-xl mb-8 max-w-2xl mx-auto">
                Manage cases, clients, documents, billing, and court schedules — all in one secure platform designed for legal professionals.
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <?php if(auth()->guard()->guest()): ?>
                    <a href="<?php echo e(route('register')); ?>" 
                       class="px-6 py-3 bg-white text-indigo-900 font-semibold rounded-lg shadow hover:bg-gray-100">
                       Get Started
                    </a>
                    <a href="<?php echo e(route('features')); ?>" 
                       class="px-6 py-3 border border-white rounded-lg hover:bg-white hover:text-indigo-900">
                       Learn More
                    </a>
                <?php endif; ?>

                <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(route('dashboard')); ?>" 
                       class="px-6 py-3 bg-white text-indigo-900 font-semibold rounded-lg shadow hover:bg-gray-100">
                       Go to Dashboard
                    </a>
                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" 
                                class="px-6 py-3 border border-white rounded-lg hover:bg-white hover:text-indigo-900">
                            Logout
                        </button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="max-w-7xl mx-auto px-6 py-16 grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white rounded-2xl shadow p-6 hover:shadow-lg transition">
            <h3 class="text-xl font-semibold text-indigo-700 mb-2">Case Management</h3>
            <p class="text-gray-600">Track all your cases, documents, and legal notes in one place with ease.</p>
        </div>
        <div class="bg-white rounded-2xl shadow p-6 hover:shadow-lg transition">
            <h3 class="text-xl font-semibold text-indigo-700 mb-2">Court Dates & Deadlines</h3>
            <p class="text-gray-600">Stay ahead of court dates and legal deadlines with automated reminders.</p>
        </div>
        <div class="bg-white rounded-2xl shadow p-6 hover:shadow-lg transition">
            <h3 class="text-xl font-semibold text-indigo-700 mb-2">Client & Billing</h3>
            <p class="text-gray-600">Simplify client records and generate invoices quickly to streamline billing.</p>
        </div>
    </section>

    <!-- Why Choose Section -->
    <section class="bg-gray-100 py-16">
        <div class="max-w-5xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Why Choose Law Office Pro for Lawyers?</h2>
            <p class="text-lg text-gray-600 mb-12">
                We designed Law Office Pro with law firms in mind — helping you stay organized, save time, and grow your practice.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-left">
                <div class="flex items-start">
                    <span class="text-indigo-600 text-2xl mr-3">✔</span>
                    <p><strong>Save Time</strong> with automation that reduces manual work and paperwork.</p>
                </div>
                <div class="flex items-start">
                    <span class="text-indigo-600 text-2xl mr-3">✔</span>
                    <p><strong>Stay Organized</strong> by keeping cases, clients, and schedules in one dashboard.</p>
                </div>
                <div class="flex items-start">
                    <span class="text-indigo-600 text-2xl mr-3">✔</span>
                    <p><strong>Win More Cases</strong> by never missing deadlines and accessing documents instantly.</p>
                </div>
                <div class="flex items-start">
                    <span class="text-indigo-600 text-2xl mr-3">✔</span>
                    <p><strong>Secure & Reliable</strong> platform with data protection built for legal professionals.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>
</html>
<?php /**PATH C:\laragon\www\lawyer_crm\resources\views/welcome.blade.php ENDPATH**/ ?>