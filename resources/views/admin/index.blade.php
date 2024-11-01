<x-app-layout>
    <div class="flex justify-center mt-10 px-4">
        <div class="w-full sm:w-2/3 lg:w-1/2 grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Card 1: Siswa Terdaftar -->
            <a href="{{ route('admin.student.index') }}" class="block">
                <div class="rounded-lg bg-gradient-to-r from-blue-500 to-blue-400 shadow-lg flex items-center p-4 hover:shadow-2xl transition-shadow duration-300">
                    <img src="assets/admin/student.svg" class="w-12 h-12 mr-3" alt="Student Icon">
                    <div class="text-center">
                        <p class="text-white text-lg font-semibold">100/300</p>
                        <p class="text-white text-sm">Siswa Terdaftar</p>
                    </div>
                </div>
            </a>

            <!-- Card 2: Satpam Terdaftar -->
            <div class="rounded-lg bg-gradient-to-r from-green-500 to-green-400 shadow-lg flex items-center p-4 hover:shadow-2xl transition-shadow duration-300">
                <img src="assets/admin/security.svg" class="w-12 h-12 mr-3" alt="Security Icon">
                <div class="text-center">
                    <p class="text-white text-lg font-semibold">100</p>
                    <p class="text-white text-sm">Satpam Terdaftar</p>
                </div>
            </div>

            <!-- Card 3: Pengguna Terdaftar -->
            <div class="rounded-lg bg-gradient-to-r from-purple-500 to-purple-400 shadow-lg flex items-center p-4 hover:shadow-2xl transition-shadow duration-300">
                <img src="assets/admin/universal.svg" class="w-12 h-12 mr-3" alt="User Icon">
                <div class="text-center">
                    <p class="text-white text-lg font-semibold">100</p>
                    <p class="text-white text-sm">Pengguna Terdaftar</p>
                </div>
            </div>

            <!-- Card 4: Guru Terdaftar -->
            <div class="rounded-lg bg-gradient-to-r from-red-500 to-red-400 shadow-lg flex items-center p-4 hover:shadow-2xl transition-shadow duration-300">
                <img src="assets/admin/teacher.svg" class="w-12 h-12 mr-3" alt="Teacher Icon">
                <div class="text-center">
                    <p class="text-white text-lg font-semibold">100</p>
                    <p class="text-white text-sm">Guru Terdaftar</p>
                </div>
            </div>

            <!-- Card 4: Angka 5 (misalnya untuk status) -->
            <div class="rounded-lg bg-gradient-to-r from-yellow-500 to-yellow-400 shadow-lg flex items-center justify-center p-4 hover:shadow-2xl transition-shadow duration-300">
                <p class="text-white text-2xl font-semibold">5</p>
            </div>

            <!-- Card 6: Angka 6 (misalnya untuk status lain) -->
            <div class="rounded-lg bg-gradient-to-r from-teal-500 to-teal-400 shadow-lg flex items-center justify-center p-4 hover:shadow-2xl transition-shadow duration-300">
                <p class="text-white text-2xl font-semibold">6</p>
            </div>
        </div>
    </div>

    <style>
        .hover\:shadow-2xl:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        /* Responsiveness improvements */
        @media (max-width: 640px) {
            .text-lg {
                font-size: 1rem;
            }

            .text-sm {
                font-size: 0.875rem;
            }
        }
    </style>
</x-app-layout>
