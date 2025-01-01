<x-app-layout>
    <div class="container mx-auto py-12 sm:px-6 lg:px-8 ">

        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add New Space') }}
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

        <form action="{{ route('spaces.store') }}" method="POST" class="bg-white p-4 rounded-lg shadow">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Space Name</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg" value="{{ old('name') }}">
            </div>

            <button type="submit" class="bg-custom-purple text-sm text-white px-4 py-2 rounded-lg">Create</button>
        </form>
    </div>
</x-app-layout>
