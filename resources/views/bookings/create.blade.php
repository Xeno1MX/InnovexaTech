<x-app-layout>
    <div class="container mx-auto py-12 sm:px-6 lg:px-8">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create Booking') }}
            </h2>
        </x-slot>

        @if ($errors->any())
            <div class="bg-red-500 text-white p-2 rounded-lg mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('bookings.store') }}" method="POST" class="bg-white p-4 rounded-lg shadow">
            @csrf

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
                    @foreach($spaces as $space)
                        <option value="{{ $space->id }}">{{ $space->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="subject_id" class="block text-sm font-medium text-gray-700">Subject</label>
                <select name="subject_id" id="subject_id" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" required>
                    <option value="">Select Subject</option>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endforeach
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

        <!-- Add jQuery CDN if not already included -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            $(document).ready(function() {
                const lecturers = @json($lecturers); // Pass the lecturers data to JavaScript

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
    </div>
</x-app-layout>
