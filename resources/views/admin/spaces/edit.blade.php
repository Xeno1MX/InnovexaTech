<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Edit Space</h1>

        @if ($errors->any())
            <div class="bg-red-500 text-white p-2 rounded-lg mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('spaces.update', $space->id) }}" method="POST" class="bg-white p-4 rounded-lg shadow-lg">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Space Name</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" value="{{ $space->name }}">
            </div>

            <button type="submit" class="bg-custom-purple text-white px-4 py-2 rounded-lg">Update</button>
        </form>
    </div>
</x-app-layout>
