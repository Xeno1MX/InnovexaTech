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
    <div class="container mx-auto py-12 px-8">
         <?php $__env->slot('header', null, []); ?> 
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <?php echo e(__('Booking Approvals')); ?>

            </h2>
         <?php $__env->endSlot(); ?>

        <?php if($message = Session::get('success')): ?>
            <div class="bg-green-500 text-white p-2 rounded-lg mb-4 flex justify-between items-center">
                <span><?php echo e($message); ?></span>
                <button class="close-btn ml-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        <?php endif; ?>

        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b text-left">ID</th>
                    <th class="py-2 px-4 border-b text-left">Date</th>
                    <th class="py-2 px-4 border-b text-left">Subject</th>
                    <th class="py-2 px-4 border-b text-left">Space</th>
                    <th class="py-2 px-4 border-b text-left">Lecturer</th>
                    <th class="py-2 px-4 border-b text-left">Applicant</th>
                    <th class="py-2 px-4 border-b text-left">Purpose</th>
                    <th class="py-2 px-4 border-b text-left">Status</th>
                    <th class="py-2 px-4 border-b text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if($bookings->count() > 0): ?>
                    <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="py-2 px-4 border-b"><?php echo e($booking->id); ?></td>
                        <td class="py-2 px-4 border-b">
                            <?php echo e(\Carbon\Carbon::parse($booking->date)->format('l')); ?>, <?php echo e(\Carbon\Carbon::parse($booking->date)->format('Y-m-d')); ?> <hr>
                            Start Time: <?php echo e($booking->start_time); ?> <br/><hr>
                            End Time: <?php echo e($booking->end_time); ?>

                        </td>
                        <td class="py-2 px-4 border-b"><?php echo e($booking->subject->name); ?></td>
                        <td class="py-2 px-4 border-b"><?php echo e($booking->space->name); ?></td>
                        <td class="py-2 px-4 border-b"><?php echo e($booking->lecturer->name); ?></td>
                        <td class="py-2 px-4 border-b"><?php echo e($booking->user->name); ?> <br/> Matric No: <?php echo e($booking->user->matric_number); ?></td>
                        <td class="py-2 px-4 border-b">
                            <button class="purpose-btn bg-custom-purple text-sm text-white px-2 py-1 rounded-md" data-purpose="<?php echo e($booking->purpose); ?>">View</button>
                        </td>
                        <td class="py-2 px-4 border-b capitalize">
                            <?php echo e($booking->status); ?>

                        </td>
                        <td class="py-2 px-4 border-b">
                            <?php if(in_array($booking->status, ['approved', 'rejected'])): ?>
                                <span>-</span>
                            <?php else: ?>
                                <div class="flex items-center">
                                    <button class="approve-btn bg-custom-purple1 text-sm text-white px-2 py-1 rounded-md mr-2" data-id="<?php echo e($booking->id); ?>">Approve</button>
                                    <button class="reject-btn bg-red-500 text-sm text-white px-2 py-1 rounded-md" data-id="<?php echo e($booking->id); ?>">Reject</button>
                                </div>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10" class="py-2 px-4 border-b text-center text-gray-500">No Data</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Approval/Rejection Confirmation Modal -->
    <div id="confirmation-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
        <div class="bg-black bg-opacity-50 absolute inset-0"></div>
        <div class="bg-white rounded-lg shadow-lg p-6 z-10">
            <h2 class="text-xl font-semibold mb-4">Confirm Action</h2>
            <p id="confirmation-text"></p>
            <div class="flex justify-end mt-6">
                <button id="cancel-btn" class="bg-custom-purple text-sm text-white px-4 py-2 rounded-md mr-2">Cancel</button>
                <form id="confirmation-form" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <button type="submit" class="bg-custom-purple1 text-sm text-white px-4 py-2 rounded-md">Confirm</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Purpose Modal -->
    <div id="purpose-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
        <div class="bg-black bg-opacity-50 absolute inset-0"></div>
        <div class="bg-white rounded-lg shadow-lg p-6 z-10 min-w-[450px] w-full sm:min-w-[450px] max-w-[650px] w-full sm:max-w-[650px]">
            <h2 class="text-xl font-semibold mb-4">Purpose</h2>
            <p id="purpose-text" class="text-gray-700"></p>
            <div class="flex justify-end mt-6">
                <button id="close-purpose-btn" class="bg-custom-purple text-sm text-white px-4 py-2 rounded-md text-sm">Close</button>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Close success message
            $('.close-btn').click(function() {
                $(this).closest('div').fadeOut();
            });

            // Handle Approve button click
            $('.approve-btn').click(function() {
                var id = $(this).data('id');
                $('#confirmation-text').text('Are you sure you want to approve this booking?');
                $('#confirmation-form').attr('action', '/admin/bookings/' + id + '/approve');
                $('#confirmation-modal').removeClass('hidden');
            });

            // Handle Reject button click
            $('.reject-btn').click(function() {
                var id = $(this).data('id');
                $('#confirmation-text').text('Are you sure you want to reject this booking?');
                $('#confirmation-form').attr('action', '/admin/bookings/' + id + '/reject');
                $('#confirmation-modal').removeClass('hidden');
            });

            // Handle Cancel button click
            $('#cancel-btn').click(function() {
                $('#confirmation-modal').addClass('hidden');
            });

            // Handle View Purpose button click
            $('.purpose-btn').click(function() {
                var purpose = $(this).data('purpose');
                $('#purpose-text').text(purpose);
                $('#purpose-modal').removeClass('hidden');
            });

            // Handle Close Purpose button click
            $('#close-purpose-btn').click(function() {
                $('#purpose-modal').addClass('hidden');
            });
        });
    </script>
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
<?php /**PATH C:\laragon\www\Laravel\management-project\management-project\resources\views/admin/bookings/index.blade.php ENDPATH**/ ?>