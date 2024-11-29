<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Class') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('admin.kelas.update', $studentClass->id) }}">
                        @csrf
                        @method('PATCH')

                        <!-- Class Name -->
                        <div class="mb-4">
                            <x-label for="name" :value="__('Class Name')" />

                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $studentClass  ->name)" required autofocus />
                        </div>
                        
                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-3 bg-blue-700 rounded-lg">
                                {{ __('Update') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

