<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="sm:py-5">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="w-full sm:w-3/4 lg:w-2/3">
                <button onclick="window.history.back()" class="bg-white text-center w-48 rounded-2xl h-8 relative text-black text-xl font-semibold group m-5 hidden sm:block border"
                    type="button">
                    <div
                        class="bg-blue-400 rounded-xl h-6 w-1/4 flex items-center justify-center absolute left-1 top-[4px] group-hover:w-[184px] z-10 duration-500">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1024 1024" height="25px" width="20px">
                            <path d="M224 480h640a32 32 0 1 1 0 64H224a32 32 0 0 1 0-64z" fill="#000000"></path>
                            <path
                                d="m237.248 512 265.408 265.344a32 32 0 0 1-45.312 45.312l-288-288a32 32 0 0 1 0-45.312l288-288a32 32 0 1 1 45.312 45.312L237.248 512z"
                                fill="#000000"></path>
                        </svg>
                    </div>
                    <p class="translate-x-2">Kembali</p>
                </button>
            </div>
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
