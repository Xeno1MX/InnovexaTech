<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="font-sans antialiased">

    <div class="flex w-full h-screen">
        <?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="h-full bg-gray-100 flex-1 flex flex-col">

            <?php echo $__env->make('layouts.navigation', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="flex-1 overflow-y-auto">
                <!-- Page Heading -->
                <?php if(isset($header)): ?>
                    <header class="bg-white shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            <?php echo e($header); ?>

                        </div>
                    </header>
                <?php endif; ?>

                <!-- Page Content -->
                <main>
                    <?php echo e($slot); ?>

                </main>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Toggle sidebar visibility
            $('#toggleSidebar').on('click', function () {
                $('#sidebar').toggleClass('md:min-w-[300px]');
                $('#sidebar').toggleClass('w-0');
                $('#sidebar-name').toggleClass('hidden');
                // $('#main-content').toggleClass('ml-0');
            });
        });
    </script>
</body>
</html>
<?php /**PATH C:\laragon\www\Laravel\management-project\management-project\resources\views/layouts/app.blade.php ENDPATH**/ ?>