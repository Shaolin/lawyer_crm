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

    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
        <form method="GET" action="<?php echo e(route('dashboard.documents.index')); ?>" class="flex items-center gap-2">
            <input type="text"
                   name="search"
                   value="<?php echo e(request('search')); ?>"
                   placeholder="Search documents, client, case, or uploader..."
                   class="w-full px-4 py-2 border rounded-lg dark:bg-gray-800 dark:border-gray-700 dark:text-gray-100 focus:ring-indigo-500 focus:border-indigo-500"
            >
            <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                Search
            </button>
        </form>
    </div>

     <?php $__env->slot('header', null, []); ?> 
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
                <?php echo e(__('Documents')); ?>

            </h2>
            <a href="<?php echo e(route('dashboard.documents.create')); ?>"
               class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700">
                + Upload Document
            </a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            
            <div class="sm:hidden space-y-4">
                <?php $__empty_1 = true; $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-4 border border-gray-100 dark:border-gray-700">
                        <h3 class="font-semibold text-gray-900 dark:text-gray-100 text-lg mb-2">
                            <?php echo e($document->title); ?>

                        </h3>

                        <p class="text-sm text-gray-600 dark:text-gray-300">
                            <span class="font-medium">Client:</span> <?php echo e($document->client->name ?? 'N/A'); ?>

                        </p>

                        <p class="text-sm text-gray-600 dark:text-gray-300">
                            <span class="font-medium">Case:</span> <?php echo e($document->legalCase->title ?? 'N/A'); ?>

                        </p>

                        <p class="text-sm text-gray-600 dark:text-gray-300">
                            <span class="font-medium">Uploaded By:</span> <?php echo e($document->user->name ?? 'N/A'); ?>

                        </p>

                        <p class="text-sm text-indigo-600 dark:text-indigo-400 mt-2">
                            <a href="<?php echo e(asset('storage/' . $document->file_path)); ?>" target="_blank" class="hover:underline">
                                📄 View File
                            </a>
                        </p>

                        <div class="flex items-center justify-end gap-4 pt-3 mt-2 border-t border-gray-200 dark:border-gray-700">
                            <a href="<?php echo e(route('dashboard.documents.show', $document)); ?>"
                               class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-600 text-sm">
                                View
                            </a>
                            <a href="<?php echo e(route('dashboard.documents.edit', $document)); ?>"
                               class="text-indigo-600 hover:text-indigo-900 text-sm">
                                Edit
                            </a>
                            <form action="<?php echo e(route('dashboard.documents.destroy', $document)); ?>" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this document?');">
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
                    <p class="text-center text-gray-500 dark:text-gray-400 mt-6">No documents found.</p>
                <?php endif; ?>

                
                <div class="mt-4">
                    <?php echo e($documents->links()); ?>

                </div>
            </div>

            
            <div class="hidden sm:block bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Client</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Case</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Uploaded By</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">File</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        <?php $__empty_1 = true; $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-gray-100"><?php echo e($document->title); ?></td>
                                <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300"><?php echo e($document->client->name ?? 'N/A'); ?></td>
                                <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300"><?php echo e($document->legalCase->title ?? 'N/A'); ?></td>
                                <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-300"><?php echo e($document->user->name ?? 'N/A'); ?></td>
                                <td class="px-6 py-4 text-sm">
                                    <a href="<?php echo e(asset('storage/' . $document->file_path)); ?>" target="_blank"
                                       class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200">
                                        View File
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-right text-sm flex items-center justify-end gap-3">
                                    <a href="<?php echo e(route('dashboard.documents.show', $document)); ?>"
                                       class="text-gray-600 hover:text-gray-900 dark:text-gray-300 dark:hover:text-gray-100">
                                        View
                                    </a>
                                    <a href="<?php echo e(route('dashboard.documents.edit', $document)); ?>"
                                       class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200">
                                        Edit
                                    </a>
                                    <form action="<?php echo e(route('dashboard.documents.destroy', $document)); ?>" method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this document?');">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit"
                                                class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-200">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                    No documents found.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

                
                <div class="p-4">
                    <?php echo e($documents->links()); ?>

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
<?php /**PATH C:\laragon\www\lawyer_crm\resources\views/dashboard/documents/index.blade.php ENDPATH**/ ?>