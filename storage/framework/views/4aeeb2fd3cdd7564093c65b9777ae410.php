<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100">
                <?php echo e(__('Client Details')); ?>

            </h2>
            <a href="<?php echo e(route('dashboard.clients.index')); ?>" class="btn-secondary">
                ← Back
            </a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <!-- Client Info -->
                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            <?php echo e($client->name); ?>

                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Registered on <?php echo e($client->created_at->format('M d, Y')); ?>

                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Email</h4>
                            <p class="text-gray-900 dark:text-gray-100"><?php echo e($client->email ?? '—'); ?></p>
                        </div>

                        <div>
                            <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Phone</h4>
                            <p class="text-gray-900 dark:text-gray-100"><?php echo e($client->phone ?? '—'); ?></p>
                        </div>

                        <div class="md:col-span-2">
                            <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Address</h4>
                            <p class="text-gray-900 dark:text-gray-100"><?php echo e($client->address ?? '—'); ?></p>
                        </div>

                        <div class="md:col-span-2">
                            <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Notes</h4>
                            <p class="text-gray-900 dark:text-gray-100"><?php echo e($client->notes ?? '—'); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="mt-6 flex space-x-4">
                    <a href="<?php echo e(route('dashboard.clients.edit', $client)); ?>" class="btn-primary">
                        Edit Client
                    </a>

                    <form action="<?php echo e(route('dashboard.clients.destroy', $client)); ?>" 
                          method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this client?');">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn-danger">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\lawyer_crm\resources\views/dashboard/clients/show.blade.php ENDPATH**/ ?>