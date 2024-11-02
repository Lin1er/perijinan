<x-app-layout>
    <div class="flex flex-col items-center mt-10 px-4">
        <!-- Dashboard Cards -->
        <div class="w-full sm:w-2/3 lg:w-1/2 grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
            <!-- Card 1: Siswa Terdaftar -->
            <a href="{{ route('admin.student.index') }}" class="block">
                <div class="rounded-lg bg-gradient-to-r from-blue-500 to-blue-400 shadow-lg flex items-center p-4 hover:shadow-2xl transition-shadow duration-300">
                    <img src="assets/admin/student.svg" class="w-12 h-12 mr-3" alt="Student Icon">
                    <div>
                        <p class="text-white text-lg font-semibold">{{ $totalStudents }}</p>
                        <p class="text-white text-sm">Siswa Terdaftar</p>
                    </div>
                </div>
            </a>

            <!-- Card 2: Satpam Terdaftar -->
            <div class="rounded-lg bg-gradient-to-r from-green-500 to-green-400 shadow-lg flex items-center p-4 hover:shadow-2xl transition-shadow duration-300">
                <img src="assets/admin/security.svg" class="w-12 h-12 mr-3" alt="Security Icon">
                <div>
                    <p class="text-white text-lg font-semibold">{{ $totalSatpam }}</p>
                    <p class="text-white text-sm">Satpam Terdaftar</p>
                </div>
            </div>

            <!-- Card 3: Pengguna Terdaftar -->
            <div class="rounded-lg bg-gradient-to-r from-purple-500 to-purple-400 shadow-lg flex items-center p-4 hover:shadow-2xl transition-shadow duration-300">
                <img src="assets/admin/universal.svg" class="w-12 h-12 mr-3" alt="User Icon">
                <div>
                    <p class="text-white text-lg font-semibold">{{ $totalUsers }}</p>
                    <p class="text-white text-sm">Pengguna Terdaftar</p>
                </div>
            </div>

            <!-- Card 4: Guru Terdaftar -->
            <div class="rounded-lg bg-gradient-to-r from-red-500 to-red-400 shadow-lg flex items-center p-4 hover:shadow-2xl transition-shadow duration-300">
                <img src="assets/admin/teacher.svg" class="w-12 h-12 mr-3" alt="Teacher Icon">
                <div>
                    <p class="text-white text-lg font-semibold">{{ $totalTeachers }}</p>
                    <p class="text-white text-sm">Guru Terdaftar</p>
                </div>
            </div>

            <!-- Card 5: Orang tua Terdaftar -->
            <div class="rounded-lg bg-gradient-to-r from-red-500 to-red-400 shadow-lg flex items-center p-4 hover:shadow-2xl transition-shadow duration-300">
                <img src="assets/admin/teacher.svg" class="w-12 h-12 mr-3" alt="Teacher Icon">
                <div>
                    <p class="text-white text-lg font-semibold">{{ $totalParents }}</p>
                    <p class="text-white text-sm">Orang Tua Terdaftar</p>
                </div>
            </div>
        </div>

        <!-- User Management Table -->
        <div class="w-full sm:w-3/4 lg:w-2/3 bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Manage Users</h2>
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 text-sm uppercase leading-normal">
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Role</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    @foreach ($users as $user)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <span class="font-medium">{{ $user->name }}</span>
                            </td>
                            <td class="py-3 px-6 text-left">
                                {{ $user->roles->pluck('name')->join(', ') }}
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <a href="{{ route('admin.user.edit', $user->id) }}" class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                                        ✏️
                                    </a>
                                    <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-4 mr-2 transform hover:text-red-500 hover:scale-110">
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

    <style>
        .hover\:shadow-2xl:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }
    </style>
</x-app-layout>
