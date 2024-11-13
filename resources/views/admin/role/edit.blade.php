<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Role') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('admin.role.update', $role) }}">
                        @csrf
                        @method('PATCH')

                        <!-- Role Name -->
                        <div class="mb-4">
                            <x-label for="name" :value="__('Role Name')" />

                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $role->name)" required autofocus />
                        </div>

                        <!-- Role Permissions -->
                            <div class="mb-4">
                                <x-label for="permissions" :value="__('Permissions')" />

                                <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                                    @foreach ($permissions as $permission)
                                        <label class="flex items-center">
                                            <x-checkbox id="permissions" class="rounded border-gray-300" name="permissions[]" :value="$permission->id" :checked="in_array($permission->name, $role->permissions->pluck('name')->toArray())" />
                                            <span class="ml-2 text-sm text-gray-600">{{ $permission->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
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

