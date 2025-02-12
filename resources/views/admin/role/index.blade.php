<x-app-layout>
    <div class="flex flex-col items-center px-4 mt-5 sm:mt-0">
        <div class="w-full sm:w-3/4 lg:w-2/3">
            <button onclick="window.history.back()" class="bg-white text-center w-48 rounded-2xl h-8 relative text-black text-xl font-semibold group m-5 hidden sm:block"
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
        <!-- Role Management Table with Search -->
        <div class="w-full sm:w-3/4 lg:w-2/3 bg-white shadow-lg rounded-lg p-6">
            <div class="flex justify-between">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">Manage Roles</h2>
                <a href="{{ route('admin.role.create') }}"
                    class="bg-blue-500 text-white px-4 py-2 mb-2 rounded hover:bg-blue-700">Create new</a>
            </div>
            <!-- Search Bar -->
            <div class="mb-4">
                <input type="text" id="searchInputRole" placeholder="Search roles by name or permission..."
                    class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 text-sm uppercase leading-normal">
                        <th class="py-3 pl-2 text-left">Name</th>
                        <th class="py-3 text-left">Permission</th>
                        <th class="py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody id="roleTable" class="text-gray-600 text-sm font-light">
                    @foreach ($roles as $role)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 text-left whitespace-nowrap pl-2">
                                <span class="font-medium">{{ $role->name }}</span>
                            </td>
                            <td class="py-3 text-left">
                                {{ $role->permissions->pluck('name')->join(', ') }}
                            </td>

                            <td class="py-3 text-center">
                                <div class="flex item-center justify-center">
                                    <a href="{{ route('admin.role.edit', $role->id) }}"
                                        class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                                        ✏️
                                    </a>
                                    <form action="{{ route('admin.role.destroy', $role->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="w-4 mr-2 transform hover:text-red-500 hover:scale-110">
                                            🗑️
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Permission Management Table with Search -->
        <div class="w-full sm:w-3/4 lg:w-2/3 bg-white shadow-lg rounded-lg p-6 my-5">
            <div class="flex justify-between">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">Manage Permissions</h2>
                <a href="{{ route('admin.permission.create') }}"
                    class="bg-blue-500 text-white px-4 py-2 mb-2 rounded hover:bg-blue-700">Create new</a>
            </div> <!-- Search Bar -->
            <div class="mb-4">
                <input type="text" id="searchInputPermission" placeholder="Search permission by name..."
                    class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 text-sm uppercase leading-normal">
                        <th class="py-3 text-left">Name</th>
                        <th class="py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody id="permissionTable" class="text-gray-600 text-sm font-light">
                    @foreach ($permissions as $permission)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 text-left whitespace-nowrap">
                                <span class="font-medium">{{ $permission->name }}</span>
                            </td>
                            <td class="py-3 text-center">
                                <div class="flex item-center justify-center">
                                    <a href="{{ route('admin.permission.edit', $permission->id) }}"
                                        class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                                        ✏️
                                    </a>
                                    <form action="{{ route('admin.permission.destroy', $permission->id) }}"
                                        method="POST" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="w-4 mr-2 transform hover:text-red-500 hover:scale-110">
                                            🗑️
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        // Filter role function
        document.getElementById('searchInputRole').addEventListener('input', function() {
            const searchText = this.value.toLowerCase();
            const rows = document.querySelectorAll('#roleTable tr');
            rows.forEach(row => {
                const name = row.querySelector('td:nth-child(1)').innerText.toLowerCase();
                const role = row.querySelector('td:nth-child(2)').innerText.toLowerCase();
                if (name.includes(searchText) || role.includes(searchText)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Filter permission function
        document.getElementById('searchInputPermission').addEventListener('input', function() {
            const searchText = this.value.toLowerCase();
            const rows = document.querySelectorAll('#permissionTable tr');
            rows.forEach(row => {
                const name = row.querySelector('td:nth-child(1)').innerText.toLowerCase();
                const role = row.querySelector('td:nth-child(2)').innerText.toLowerCase();
                if (name.includes(searchText) || role.includes(searchText)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</x-app-layout>
