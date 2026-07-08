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
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-100 leading-tight">
                <?php echo e(__('Document Details')); ?>

            </h2>
            <a href="<?php echo e(route('dashboard.documents.index')); ?>"
               class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600">
                Back to Documents
            </a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <!-- Title -->
                <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
                    <?php echo e($document->title); ?>

                </h3>

                <!-- Related Client -->
                <?php if($document->client): ?>
                    <p class="mt-2 text-gray-600 dark:text-gray-300">
                        <strong>Client:</strong> <?php echo e($document->client->name); ?>

                    </p>
                <?php endif; ?>

                <!-- Related Case -->
                <?php if($document->legalCase): ?>
                    <p class="mt-2 text-gray-600 dark:text-gray-300">
                        <strong>Case:</strong> <?php echo e($document->legalCase->title); ?>

                    </p>
                <?php endif; ?>

                <!-- Uploaded By -->
                <p class="mt-2 text-gray-600 dark:text-gray-300">
                    <strong>Uploaded by:</strong> <?php echo e($document->user->name ?? 'Unknown'); ?>

                </p>

                <!-- Description -->
                <?php if($document->description): ?>
                    <p class="mt-4 text-gray-700 dark:text-gray-200 whitespace-pre-line">
                        <?php echo e($document->description); ?>

                    </p>
                <?php endif; ?>

                <!-- File -->
                <div class="mt-6">
                    <a href="<?php echo e(asset('storage/' . $document->file_path)); ?>" 
                       target="_blank"
                       class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 dark:hover:bg-blue-500">
                        View / Download File
                    </a>
                </div>

                <!-- Actions -->
                <div class="mt-8 flex space-x-4">
                    <a href="<?php echo e(route('dashboard.documents.edit', $document)); ?>"
                       class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 dark:hover:bg-yellow-400">
                        Edit
                    </a>

                    <form action="<?php echo e(route('dashboard.documents.destroy', $document)); ?>" 
                          method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this document?');">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit"
                                class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 dark:hover:bg-red-800">
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
<?php /**PATH C:\laragon\www\lawyer_crm\resources\views/dashboard/documents/show.blade.php ENDPATH**/ ?>