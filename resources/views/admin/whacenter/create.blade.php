<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Whacenter') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('admin.whacenter.store') }}">
            @csrf

            <!-- Form Fields -->
            <div class="mb-4">
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" required autofocus />
            </div>

            <div class="mb-4">
                <x-label for="device_id" value="{{ __('device_id') }}" />
                <input id="device_id" name="device_id" rows="4" class="block mt-1 w-full"></input>
            </div>

            <div class="flex items-center justify-end mt-4">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Add</button>
            </div>
        </form>
    </div>
</x-app-layout>
