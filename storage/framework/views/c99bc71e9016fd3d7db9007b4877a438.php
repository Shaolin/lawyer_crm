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
            <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
                <?php echo e(__('Cases')); ?>

            </h2>
            <a href="<?php echo e(route('dashboard.cases.create')); ?>"
               class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700">
                + Add Case
            </a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            
            <div class="sm:hidden space-y-4">
                <?php $__empty_1 = true; $__currentLoopData = $cases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $case): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4 border border-gray-100 dark:border-gray-700">
                        <h3 class="font-semibold text-gray-900 dark:text-gray-100 text-lg mb-2">
                            <?php echo e($case->title); ?>

                        </h3>
                        <p class="text-sm text-gray-600 dark:text-gray-300">
                            <span class="font-medium">Client:</span> <?php echo e($case->client->name ?? 'N/A'); ?>

                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-300">
                            <span class="font-medium">Lawyer:</span> <?php echo e($case->user->name ?? 'N/A'); ?>

                        </p>
                        <p class="text-sm text-gray-600 dark:text-gray-300 mb-3">
                            <span class="font-medium">Status:</span> <?php echo e(ucfirst($case->status)); ?>

                        </p>

                        <div class="flex items-center justify-end gap-4 pt-2 border-t border-gray-200 dark:border-gray-700">
                            <a href="<?php echo e(route('dashboard.cases.show', $case)); ?>"
                               class="text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white text-sm">
                                View
                            </a>
                            <a href="<?php echo e(route('dashboard.cases.edit', $case)); ?>"
                               class="text-indigo-600 hover:text-indigo-900 text-sm">
                                Edit
                            </a>
                            <form action="<?php echo e(route('dashboard.cases.destroy', $case)); ?>" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this case?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit"
                                        class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-600 text-sm">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-center text-gray-500 dark:text-gray-400 mt-6">No cases found.</p>
                <?php endif; ?>
            </div>

            
            <div class="hidden sm:block bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden mt-4">
                <?php if (isset($component)) { $__componentOriginal7d9f6e0b9001f5841f72577781b2d17f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7d9f6e0b9001f5841f72577781b2d17f = $attributes; } ?>
<?php $component = App\View\Components\Table::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Table::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                     <?php $__env->slot('head', null, []); ?> 
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Client</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Lawyer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-medium uppercase">Actions</th>
                        </tr>
                     <?php $__env->endSlot(); ?>

                     <?php $__env->slot('body', null, []); ?> 
                        <?php $__empty_1 = true; $__currentLoopData = $cases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $case): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium"><?php echo e($case->title); ?></td>
                                <td class="px-6 py-4 text-sm"><?php echo e($case->client->name ?? 'N/A'); ?></td>
                                <td class="px-6 py-4 text-sm"><?php echo e($case->user->name ?? 'N/A'); ?></td>
                                <td class="px-6 py-4 text-sm capitalize"><?php echo e($case->status); ?></td>
                                <td class="px-6 py-4 text-right text-sm flex items-center justify-end gap-3">
                                    <a href="<?php echo e(route('dashboard.cases.show', $case)); ?>"
                                       class="text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-white">
                                        View
                                    </a>
                                    <a href="<?php echo e(route('dashboard.cases.edit', $case)); ?>"
                                       class="text-indigo-600 hover:text-indigo-900">
                                        Edit
                                    </a>
                                    <form action="<?php echo e(route('dashboard.cases.destroy', $case)); ?>" method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this case?');">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit"
                                                class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-600">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                    No cases found.
                                </td>
                            </tr>
                        <?php endif; ?>
                     <?php $__env->endSlot(); ?>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7d9f6e0b9001f5841f72577781b2d17f)): ?>
<?php $attributes = $__attributesOriginal7d9f6e0b9001f5841f72577781b2d17f; ?>
<?php unset($__attributesOriginal7d9f6e0b9001f5841f72577781b2d17f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7d9f6e0b9001f5841f72577781b2d17f)): ?>
<?php $component = $__componentOriginal7d9f6e0b9001f5841f72577781b2d17f; ?>
<?php unset($__componentOriginal7d9f6e0b9001f5841f72577781b2d17f); ?>
<?php endif; ?>
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
<?php /**PATH C:\laragon\www\lawyer_crm\resources\views/dashboard/cases/index.blade.php ENDPATH**/ ?>