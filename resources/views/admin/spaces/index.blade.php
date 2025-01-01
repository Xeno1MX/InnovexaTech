<x-app-layout>
    <div class="container mx-auto py-12 px-8">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Spaces') }}
            </h2>
        </x-slot>

        {{-- <div class="mb-4">
            <a href="{{ route('spaces.create') }}" class="bg-custom-purple text-sm text-white px-4 py-2 rounded-md">Add New Space</a>
        </div> --}}

        <form action="{{ route('spaces.store') }}" method="POST" class="bg-white rounded-lg shadow">
            <div class="p-4 bg-custom-purple rounded-tr-lg rounded-tl-lg">
                <h6 class="text-white text-sm">Add Space</h6>
            </div>
            @csrf
            <div class="p-4">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Space Name</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" value="{{ old('name') }}">
                </div>

                <button type="submit" class="bg-custom-purple text-sm text-white px-4 py-2 rounded-lg">Create</button>
            </div>
        </form>

        <div class="my-5"></div>

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
                    <th class="py-2 px-4 border-b text-left">Name</th>
                    <th class="py-2 px-4 border-b text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if($spaces->count() > 0)
                    @foreach ($spaces as $space)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $space->id }}</td>
                            <td class="py-2 px-4 border-b">{{ $space->name }}</td>
                            <td class="py-2 px-4 border-b">
                                <div class="flex items-center">
                                    <a href="{{ route('spaces.edit', $space->id) }}" class="text-gray-500 hover:underline ml-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                    </a>
                                    <button class="delete-btn text-red-500 hover:underline ml-2" data-id="{{ $space->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3" class="py-2 px-4 border-b text-center text-gray-500">No Data</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="delete-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
        <div class="bg-black bg-opacity-50 absolute inset-0"></div>
        <div class="bg-white rounded-lg shadow-lg p-6 z-10">
            <h2 class="text-xl font-semibold mb-4">Confirm Delete</h2>
            <p>Are you sure you want to delete data?</p>
            <div class="flex justify-end mt-6">
                <button id="cancel-btn" class="bg-gray-500 text-white px-4 py-2 rounded-md mr-2">Cancel</button>
                <form id="delete-form" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md">Delete</button>
                </form>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            // Delete button click
            $('.delete-btn').click(function() {
                var id = $(this).data('id');
                $('#delete-form').attr('action', '/admin/spaces/' + id);
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
        });
    </script>
</x-app-layout>
