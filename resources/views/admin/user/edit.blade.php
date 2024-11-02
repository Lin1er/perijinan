<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-8 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('admin.user.update', $user->id) }}">
                        @csrf
                        @method('PATCH')

                        <div class="mb-4">
                            <x-label for="name" :value="__('Name')" class="text-lg font-semibold" />
                            <x-input id="name" class="block mt-1 w-full border border-gray-300 rounded-md shadow-sm" type="text" name="name" :value="old('name', $user->name)" required autofocus />
                        </div>

                        <div class="mb-4">
                            <x-label for="email" :value="__('Email')" class="text-lg font-semibold" />
                            <x-input id="email" class="block mt-1 w-full border border-gray-300 rounded-md shadow-sm" type="email" name="email" :value="old('email', $user->email)" required />
                        </div>

                        <div class="mb-4">
                            <x-label for="roles" :value="__('Roles')" class="text-lg font-semibold" />
                            <select id="roles" class="block mt-1 w-full border border-gray-300 rounded-md shadow-sm" name="roles">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-button class="ml-4 px-6 py-2 bg-blue-600 text-white hover:bg-blue-700 font-semibold rounded-md">
                                {{ __('Update') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
