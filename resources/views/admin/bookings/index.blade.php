<x-app-layout>
    <div class="container mx-auto py-12 px-8">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Booking Approvals') }}
            </h2>
        </x-slot>

        @if ($message = Session::get('success'))
            <div class="bg-green-500 text-white p-2 rounded-lg mb-4 flex justify-between items-center">
                <span>{{ $message }}</span>
                <button class="close-btn ml-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif

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
                @if($bookings->count() > 0)
                    @foreach ($bookings as $booking)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $booking->id }}</td>
                        <td class="py-2 px-4 border-b">
                            {{ \Carbon\Carbon::parse($booking->date)->format('l') }}, {{ \Carbon\Carbon::parse($booking->date)->format('Y-m-d') }} <hr>
                            Start Time: {{ $booking->start_time }} <br/><hr>
                            End Time: {{ $booking->end_time }}
                        </td>
                        <td class="py-2 px-4 border-b">{{ $booking->subject->name }}</td>
                        <td class="py-2 px-4 border-b">{{ $booking->space->name }}</td>
                        <td class="py-2 px-4 border-b">{{ $booking->lecturer->name }}</td>
                        <td class="py-2 px-4 border-b">{{ $booking->user->name }} <br/> Matric No: {{ $booking->user->matric_number }}</td>
                        <td class="py-2 px-4 border-b">
                            <button class="purpose-btn bg-custom-purple text-sm text-white px-2 py-1 rounded-md" data-purpose="{{ $booking->purpose }}">View</button>
                        </td>
                        <td class="py-2 px-4 border-b capitalize">
                            {{ $booking->status }}
                        </td>
                        <td class="py-2 px-4 border-b">
                            @if(in_array($booking->status, ['approved', 'rejected']))
                                <span>-</span>
                            @else
                                <div class="flex items-center">
                                    <button class="approve-btn bg-custom-purple1 text-sm text-white px-2 py-1 rounded-md mr-2" data-id="{{ $booking->id }}">Approve</button>
                                    <button class="reject-btn bg-red-500 text-sm text-white px-2 py-1 rounded-md" data-id="{{ $booking->id }}">Reject</button>
                                </div>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="10" class="py-2 px-4 border-b text-center text-gray-500">No Data</td>
                    </tr>
                @endif
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
                    @csrf
                    @method('PATCH')
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
</x-app-layout>
