<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Edit Subject</h1>

        <?php if($errors->any()): ?>
            <div class="bg-red-500 text-white p-2 rounded-lg mb-4">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('subjects.update', $subject->id)); ?>" method="POST" class="bg-white p-4 rounded-lg shadow-lg">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <!-- Subject Name Field -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Subject Name</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" value="<?php echo e($subject->name); ?>">
            </div>

            <!-- Status Field (Radio Buttons) -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <div class="flex items-center space-x-4">
                    <label>
                        <input type="radio" name="status" value="1" class="mr-2" <?php echo e($subject->status == 1 ? 'checked' : ''); ?>>
                        Active
                    </label>
                    <label>
                        <input type="radio" name="status" value="0" class="mr-2" <?php echo e($subject->status == 0 ? 'checked' : ''); ?>>
                        Not Active
                    </label>
                </div>
            </div>

            <button type="submit" class="bg-custom-purple text-white px-4 py-2 rounded-lg">Update</button>
        </form>
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
<?php /**PATH C:\laragon\www\Laravel\management-project\management-project\resources\views/admin/subjects/edit.blade.php ENDPATH**/ ?>