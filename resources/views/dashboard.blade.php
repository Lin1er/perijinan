<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <main class="flex-grow container mx-auto mt-12 text-center">
            <div class="flex flex-col items-left border border-blue-400 bg-blue-400 bg-opacity-50 p-4 rounded">
                <div class="flex items-center">
                    <img src="/images/testingprof.png" style="width: 125px; height: 125px; border-radius: 100%;" alt="Profile Image" />
                    <div class="ml-4">
                        <h1 class="text-2xl font-bold text-gray-800">Nama Anda</h1>
                        <p class="text-lg text-gray-600">Posisi/Jabatan Anda</p>
                    </div>
                </div>
                <h3 class="text-4xl font-bold text-gray-800">Selamat Datang di Aplikasi Perizinan Pulang</h1>
                <p class="mt-4 text-lg text-gray-600">Aplikasi ini mempermudah proses pengajuan izin pulang untuk anak asrama.</p>
            </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg my-4">
            <div class="pb-4 bg-white dark:bg-white-900 flex flex-col sm:flex-row justify-between p-5">
                <!-- Form Pencarian dan Filter Status -->
                <div class="relative w-full sm:w-auto mb-4 sm:mb-0">
                    <form action="{{ route('dashboard') }}" method="GET"
                        class="flex items-center space-x-2 justify-between">
                        <div class="relative mt-1 grow max-w-80">
                            <input type="text" name="search" id="table-search"
                                class="block pt-2 w-full text-sm text-gray-900 border border-blue-white rounded-lg sm:w-80 bg-white-50 focus:ring-white-500 focus:border-white-500 dark:bg-white-700 dark:border-white-600 dark:placeholder-white-400 dark:text-white dark:focus:ring-white-500 dark:focus:border-white-500"
                                placeholder="Search for items" value="{{ request('search') }}">
                        </div>
                        <select name="status"
                            class="block pt-2 px-3 border border-gray-300 rounded-lg text-sm bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-white-700 dark:border-white-600 dark:text-black dark:focus:ring-blue-00 dark:focus:border-blue-500">
                            <option value="">All Status</option>
                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Verified</option>
                            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Pending</option>
                        </select>
                        <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-white-700 text-center">
                            Filter
                        </button>
                    </form>
                </div>
                <a href="/ijin/create" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 text-center">
                    Ajukan
                </a>
            </div>

            <table class="w-full max-w-screen text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-500 uppercase bg-white-50 dark:bg-white-500 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-2 py-3">Nama</th>
                        <th scope="col" class="px-3 py-3">Kelas</th>
                        <th scope="col" class="px-2 py-3 hidden sm:table-cell">Keterangan</th>
                        <th scope="col" class="px-4 py-3">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ijins as $ijin)
                        <tr class="bg-white border-b dark:bg-white-400 dark:border-white-400 hover:bg-gray-50 dark:hover:bg-white-400 cursor-pointer"
                            onclick="window.location='{{ route('ijin.show', $ijin->id) }}'">
                            <th scope="row" class="px-2 py-4 font-medium text-gray-500 dark:text-gray">
                                {{ $ijin->student->username }}
                            </th>
                            <td class="px-3 py-4">{{ $ijin->student->studentClass->name }}</td>
                            <td class="px-2 py-4 hidden sm:table-cell">{{ Str::limit($ijin->reason, 10) }}</td>
                            <td class="px-4 py-4">
                                {{ $ijin->verify_status == '1' ? 'Verified' : 'Pending' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                Tidak ada data
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination Links -->
            <div class="py-4">
                {{ $ijins->links() }}
            </div>
        </div>
    </main>
</x-app-layout>
