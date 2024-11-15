<x-app-layout>
    <div class="flex justify-center mt-4">
        <div class="w-full sm:w-3/4 lg:w-2/3 bg-white shadow-lg rounded-lg p-6">
            <div class="flex justify-between">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">Manage Whacenter Devices</h2>
                <div>
                    <a href="{{ route('admin.whacenter.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Add</a>
                </div>
            </div>
        
            {{-- <!-- Search Bar -->
            <div class="mb-4">
                <input type="text" id="searchInput" placeholder="Search users by name or role..."
                    class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div> --}}
        
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 text-sm uppercase leading-normal">
                        <th class="py-3 pl-3 text-left">Name</th>
                        <th class="py-3 text-left hidden sm:block">Device ID</th>
                        <th class="py-3 text-left">Status</th>
                        <th class="py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody id="userTable" class="text-gray-600 text-sm font-light">
                    @forelse ( $whacenters as $whacenter )
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 text-left whitespace-nowrap pl-3">
                            <span class="font-medium">{{ $whacenter->name }}</span>
                        </td>
                        <td class="py-3 text-left hidden sm:block">
                            {{ $whacenter->device_id }}
                        </td>
                        <td class="py-3 text-left">
                            {{ $whacenter->getDefaultStatus($whacenter->default) }}
                        </td>
                        <td class="py-3 text-center">
                            <div class="flex item-center justify-center">
                                <a href="{{ route('admin.whacenter.edit', $whacenter->id) }}"
                                    class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                                    ✏️
                                </a>
                                <form action="{{ route('admin.whacenter.destroy', $whacenter->id) }}" method="POST"
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
                    @empty
                    <tr>
                        <td class="py-3 px-6 text-center" colspan="3">
                            <span class="font-medium text-gray-500">No whacenter devices found</span>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>