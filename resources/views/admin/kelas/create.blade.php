<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Angkatan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('admin.kelas.store') }}">
                        @csrf

                        <!-- kelas Name -->
                        <div class="mb-4">
                            <x-label for="name" :value="__('Nama Angkatan')" />

                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                        </div>

                        <!-- kelas Description -->
                        <div class="mb-4">
                            <x-label for="batch" :value="__('Angkatan Ke')" />

                            <x-input id="batch" class="block mt-1 w-full" type="text" name="batch" :value="old('batch')" required />
                        </div>
                        
                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-3 bg-blue-700 rounded-lg">
                                {{ __('Buat') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
