<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Pengguna') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ $user->name }}
                    </h2>

                    <p class="mt-4 text-sm text-gray-600">
                        {{ $user->email }}
                    </p>

                    <p class="mt-4 text-sm text-gray-600">
                        Roles: {{ $user->roles->pluck('name')->join(', ') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
