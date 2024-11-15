<x-app-layout>
    <div class="flex flex-col items-center mt-10 px-4">
        <!-- Dashboard Cards -->
        <div class="w-full sm:w-2/3 lg:w-fit grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
            <!-- Card 1: Siswa Terdaftar -->
            <div class="rounded-lg bg-gradient-to-r from-blue-500 to-blue-400 shadow-lg flex flex-col items-center p-4 hover:shadow-2xl transition-shadow duration-300">
                <img src="assets/admin/student.svg" class="w-12 h-12 mr-3 hidden sm:block" alt="Student Icon">
                <div class="grid grid-cols-2 gap-2">
                    <div class="">
                        <p class="text-white text-lg font-semibold">{{ $totalStudents }} <span class="text-white text-sm">Siswa Terdaftar</span></p>
                        <a href="{{ route('admin.student.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 transition ease-in-out duration-150">Lihat Siswa</a>
                    </div>
                    <div>
                        <p class="text-white text-lg font-semibold">{{ $totalStudents }} <span class="text-white text-sm">Kelas Terdaftar</span></p>
                        <a href="{{ route('admin.kelas.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 transition ease-in-out duration-150">Lihat Kelas</a>
                    </div>
                </div>
            </div>

            <!-- Card 3: Pengguna Terdaftar -->
            <div class="rounded-lg bg-gradient-to-r from-purple-500 to-purple-400 shadow-lg flex items-center p-4 hover:shadow-2xl transition-shadow duration-300">
                <img src="assets/admin/universal.svg" class="w-12 h-12 mr-3 hidden sm:block" alt="User Icon">
                <div>
                    <p class="text-white text-lg font-semibold">{{ $totalUsers }} <span class="text-white text-sm">Pengguna Terdaftar</span></p>
                    <p class="text-white text-sm">{{ $totalTeachers }} Guru</p>
                    <p class="text-white text-sm">{{ $totalSatpam }} Satpam</p>
                    <p class="text-white text-sm">{{ $totalParents }} Orang Tua</p>
                </div>
            </div>

            <!-- Card 4: Whacenter Terdaftar -->
            <div class="rounded-lg bg-gradient-to-r from-green-500 to-green-400 shadow-lg flex items-center p-4 hover:shadow-2xl transition-shadow duration-300">
                <img src="assets/admin/universal.svg" class="w-12 h-12 mr-3 hidden sm:block" alt="User Icon">
                <div>
                    <p class="text-white text-lg font-semibold">WhaCenter</p>
                    <p class="text-white">Device : {{ $whacenter->name }}</p>
                    <p class="text-white">Status : Default</p>
                    <a href="{{ route('admin.whacenter.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 transition ease-in-out duration-150">Pengaturan</a>
                </div>
            </div>

            <!-- Card 6: Izin -->
            <div
                class="rounded-lg bg-gradient-to-r from-red-500 to-red-400 shadow-lg flex items-center p-5 hover:shadow-2xl transition-shadow duration-300 space-x-4">
                <img src="assets/admin/teacher.svg" class="w-14 h-14 hidden sm:block" alt="Teacher Icon">
                <div class="flex flex-col space-y-2">
                    <div class="flex items-center space-x-2">
                        <div
                            class="bg-gray-500 rounded-full w-5 h-5 flex items-center justify-center text-white text-xs font-bold">
                            {{ $totalIzinWaiting }}
                        </div>
                        <p class="text-white text-sm">Menunggu Disetujui</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div
                            class="bg-green-500 rounded-full w-5 h-5 flex items-center justify-center text-white text-xs font-bold">
                            {{ $totalIzinApproved }}
                        </div>
                        <p class="text-white text-sm">Disetujui</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div
                            class="bg-red-600 rounded-full w-5 h-5 flex items-center justify-center text-white text-xs font-bold">
                            {{ $totalIzinRejected }}
                        </div>
                        <p class="text-white text-sm">Ditolak</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div
                            class="bg-blue-600 rounded-full w-5 h-5 flex items-center justify-center text-white text-xs font-bold">
                            {{ $totalIzinDone }}
                        </div>
                        <p class="text-white text-sm">Selesai</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div
                            class="bg-blue-600 rounded-full w-5 h-5 flex items-center justify-center text-white text-xs font-bold">
                            {{ $totalStudentsWentHome }}
                        </div>
                        <p class="text-white text-sm">Siswa Pulang</p>
                    </div>
                </div>
            </div>
            
            <!-- Card 4: Whacenter Terdaftar -->
            <div class="rounded-lg bg-gradient-to-r from-yellow-500 to-yellow-400 shadow-lg flex items-center p-4 hover:shadow-2xl transition-shadow duration-300">
                <img src="assets/admin/universal.svg" class="w-12 h-12 mr-3 hidden sm:block" alt="User Icon">
                <div>
                    <p class="text-white text-lg font-semibold">Roles & Permission</p>
                    <p class="text-white">Role : {{ $totalRole }}</p>
                    <p class="text-white">Permission : {{ $totalPermission }}</p>
                    <a href="{{ route('admin.role.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 transition ease-in-out duration-150">Pengaturan</a>
                </div>
            </div>
        </div>

        <!-- User Management Table with Search -->
        <div class="w-full sm:w-3/4 lg:w-2/3 bg-white shadow-lg rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-700">Manage Users</h2>

            <!-- Search Bar -->
            <div class="mb-4">
                <input type="text" id="searchInput" placeholder="Search users by name or role..."
                    class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
            </div>

            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 text-sm uppercase leading-normal">
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Role</th>
                        <th class="py-3 px-6 text-left hidden sm:block">Phone</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody id="userTable" class="text-gray-600 text-sm font-light">
                    @foreach ($users as $user)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3  text-left whitespace-nowrap">
                                <span class="font-medium" title="{{ $user->name }}">{{ Str::limit($user->name, 20) }}</span>
                            </td>
                            <td class="py-3 px-3 text-left">
                                {{ $user->roles->pluck('name')->join(', ') }}
                            </td>
                            <td class="hidden sm:block">
                                <a href="https://wa.me/62{{ $user->phoneNumber }}" target="_blank">{{ $user->phoneNumber }}</a>
                            </td>
                            <td class="py-3 text-center">
                                <div class="flex item-center justify-center">
                                    <a href="{{ route('admin.user.edit', $user->id) }}"
                                        class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                                        ✏️
                                    </a>
                                    <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST"
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

        <script>
            // Filter function
            document.getElementById('searchInput').addEventListener('input', function() {
                const searchText = this.value.toLowerCase();
                const rows = document.querySelectorAll('#userTable tr');

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

    </div>

    <style>
        .hover\:shadow-2xl:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }
    </style>
</x-app-layout>
