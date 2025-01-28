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
                <?php echo e(__('Bookings')); ?>

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
        
        <?php if($errors->any()): ?>
            <div class="bg-red-500 text-white p-2 rounded-lg mb-4">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        

        <form action="<?php echo e(route('bookings.store')); ?>" method="POST" class="bg-white p-4 rounded-lg shadow">
            <?php echo csrf_field(); ?>

            <p class="text-md pb-2">Booking Time</p>
            <hr />
            <div class="mb-4 mt-3">
                <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                <input type="date" name="date" id="date" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" required>
            </div>

            <div class="mb-4">
                <label for="start_time" class="block text-sm font-medium text-gray-700">Start Time</label>
                <input type="time" name="start_time" id="start_time" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" required>
            </div>

            <div class="mb-4">
                <label for="end_time" class="block text-sm font-medium text-gray-700">End Time</label>
                <input type="time" name="end_time" id="end_time" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" required>
            </div>

            <div class="py-3">
            <hr />
            </div>

            <div class="mb-4 mt-2">
                <label for="space_id" class="block text-sm font-medium text-gray-700">Space</label>
                <select name="space_id" id="space_id" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" required>
                    <option value="">Select Space</option>
                    <?php $__currentLoopData = $spaces; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $space): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($space->id); ?>"><?php echo e($space->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="mb-4">
                <label for="subject_id" class="block text-sm font-medium text-gray-700">Subject</label>
                <select name="subject_id" id="subject_id" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" required>
                    <option value="">Select Subject</option>
                    <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($subject->id); ?>"><?php echo e($subject->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="mb-4">
                <label for="lecturer_id" class="block text-sm font-medium text-gray-700">Lecturer</label>
                <select name="lecturer_id" id="lecturer_id" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" required>
                    <option value="">Select Lecturer</option>
                    <!-- Lecturer options will be populated dynamically -->
                </select>
            </div>

            <div class="py-3">
                <hr />
            </div>

            <div class="mb-4">
                <label for="purpose" class="block text-sm font-medium text-gray-700">Purpose</label>
                <textarea name="purpose" id="purpose" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg"  required></textarea>
            </div>


            <button type="submit" class="bg-custom-purple text-white px-4 py-2 rounded-lg mt-4 text-sm">Create Booking</button>
        </form>

        <div class="my-5"></div>

        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b text-left">ID</th>
                    <th class="py-2 px-4 border-b text-left">Day</th>
                    <th class="py-2 px-4 border-b text-left">Time</th>
                    <th class="py-2 px-4 border-b text-left">Subject</th>
                    <th class="py-2 px-4 border-b text-left">Space</th>
                    <th class="py-2 px-4 border-b text-left">Lecturer</th>
                    <th class="py-2 px-4 border-b text-left">Status</th>
                    <th class="py-2 px-4 border-b text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if($bookings->count() > 0): ?>
                    <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="py-2 px-4 border-b"><?php echo e($booking->id); ?></td>
                        <td class="py-2 px-4 border-b"><?php echo e(\Carbon\Carbon::parse($booking->date)->format('l')); ?>, <?php echo e(\Carbon\Carbon::parse($booking->date)->format('Y-m-d')); ?></td>
                        <td class="py-2 px-4 border-b">
                            Start Time: <?php echo e($booking->start_time); ?> <br/>
                            End Time: <?php echo e($booking->end_time); ?>

                        </td>
                        <td class="py-2 px-4 border-b"><?php echo e($booking->subject->name); ?></td>
                        <td class="py-2 px-4 border-b"><?php echo e($booking->space->name); ?></td>
                        <td class="py-2 px-4 border-b"><?php echo e($booking->lecturer->name); ?></td>
                        <td class="py-2 px-4 border-b capitalize"><?php echo e($booking->status); ?></td>
                        <td class="py-2 px-4 border-b">
                            <div class="flex items-center">
                                <button class="view-btn text-gray-500 hover:underline" data-id="<?php echo e($booking->id); ?>" data-purpose="<?php echo e($booking->purpose); ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </button>
                                <?php if($booking->status === 'pending'): ?>
                                    <button class="delete-btn text-red-500 hover:underline ml-2" data-id="<?php echo e($booking->id); ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                    </button>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="py-2 px-4 border-b text-center text-gray-500">No Data</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

    </div>

    <div id="view-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
        <div class="bg-black bg-opacity-50 absolute inset-0"></div>
        <div class="bg-white rounded-lg shadow-lg p-6 z-10 min-w-[450px] w-full sm:min-w-[450px] max-w-[650px] w-full sm:max-w-[650px] sm:w-auto">
            <h2 class="text-xl font-semibold mb-4">Booking Purpose</h2>
            <p id="booking-purpose"></p>
            <div class="flex justify-end mt-6">
                <button id="close-view-modal" class="bg-gray-500 text-white px-4 py-2 rounded-md">Close</button>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="delete-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
        <div class="bg-black bg-opacity-50 absolute inset-0"></div>
        <div class="bg-white rounded-lg shadow-lg p-6 z-10">
            <h2 class="text-xl font-semibold mb-4">Confirm Delete</h2>
            <p>Are you sure you want to delete this data?</p>
            <div class="flex justify-end mt-6">
                <button id="cancel-btn" class="bg-gray-500 text-white px-4 py-2 rounded-md mr-2">Cancel</button>
                <form id="delete-form" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md">Delete</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            $('.view-btn').click(function() {
                var purpose = $(this).data('purpose');
                $('#booking-purpose').text(purpose);
                $('#view-modal').removeClass('hidden');
            });

            // Close view modal
            $('#close-view-modal').click(function() {
                $('#view-modal').addClass('hidden');
            });

            // Delete button click
            $('.delete-btn').click(function() {
                var id = $(this).data('id');
                $('#delete-form').attr('action', '/bookings/' + id);
                $('#delete-modal').removeClass('hidden');
            });

            // Cancel button click
            $('#cancel-btn').click(function() {
                $('#delete-modal').addClass('hidden');
            });

            // Close success message
            $('.close-btn').click(function() {
                $(this).closest('div').fadeOut();
            });

            const lecturers = <?php echo json_encode($lecturers, 15, 512) ?>; // Pass the lecturers data to JavaScript

            $('#subject_id').change(function() {
                const selectedSubjectId = $(this).val();

                // Clear previous options
                $('#lecturer_id').empty().append('<option value="">Select Lecturer</option>');

                if (selectedSubjectId) {
                    // Filter lecturers based on the selected subject
                    const filteredLecturers = lecturers.filter(lecturer => lecturer.subject_id == selectedSubjectId);

                    // Add new options
                    $.each(filteredLecturers, function(index, lecturer) {
                        $('#lecturer_id').append(
                            $('<option>').val(lecturer.id).text(lecturer.name)
                        );
                    });
                }
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
<?php /**PATH C:\laragon\www\Laravel\management-project\management-project\resources\views/bookings/index.blade.php ENDPATH**/ ?>