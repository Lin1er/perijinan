<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Whacenter') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <form method="POST" action="{{ route('admin.whacenter.update', $whacenter->id) }}">
            @csrf
            @method('PATCH')

            <!-- Form Fields -->
            <div class="mb-4">
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $whacenter->name }}" required autofocus />
            </div>

            <div class="mb-4">
                <x-label for="device_id" value="{{ __('device_id') }}" />
                <input id="device_id" name="device_id" rows="4" class="block mt-1 w-full" value="{{ $whacenter->device_id }}"></input>
            </div>

            <div class="mb-4">
                <x-label for="default" value="{{ __('Default') }}" />
                <select id="default" name="default" class="block mt-1 w-full">
                    <option value="0" {{ $whacenter->default == 0 ? 'selected' : '' }}>No</option>
                    <option value="1" {{ $whacenter->default == 1 ? 'selected' : '' }}>Yes</option>
                </select>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4 px-6 py-2 bg-blue-500 text-white hover:bg-blue-700">
                    {{ __('Update') }}
                </x-button>
            </div>
        </form>
    </div>
</x-app-layout>
