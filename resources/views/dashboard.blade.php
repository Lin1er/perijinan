<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <main class="flex-grow container mx-auto mt-12 text-center">
        <h1 class="text-4xl font-bold text-gray-800">Selamat Datang di Aplikasi Perizinan Pulang</h1>
        <p class="mt-4 text-lg text-gray-600">Aplikasi ini mempermudah proses pengajuan izin pulang untuk anak asrama.
        </p>

        @can('mengajukan izin')
            <p>lo super admin bangsat</p>
        @endcan

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg my-4">
            <div class="pb-4 bg-white dark:bg-gray-900 flex flex-col sm:flex-row justify-between p-5">
                <!-- Form Pencarian dan Filter Status -->
                <div class="relative w-full sm:w-auto mb-4 sm:mb-0">
                    <form action="{{ route('dashboard') }}" method="GET"
                        class="flex items-center space-x-2 justify-between">
                        <div class="relative mt-1 grow max-w-80">
                            <input type="text" name="search" id="table-search"
                                class="block pt-2 w-full text-sm text-gray-900 border border-gray-300 rounded-lg sm:w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Search for items" value="{{ request('search') }}">
                        </div>
                        <select name="status"
                            class="block pt-2 px-3 border border-gray-300 rounded-lg text-sm bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="">All Status</option>
                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Verified</option>
                            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Pending</option>
                        </select>
                        <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 text-center">
                            Filter
                        </button>
                    </form>
                </div>
                <a href="/ijin/create" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 text-center">
                    Ajukan
                </a>
            </div>

            <table class="w-full max-w-screen text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-2 py-3">Nama</th>
                        <th scope="col" class="px-3 py-3">Kelas</th>
                        <th scope="col" class="px-2 py-3 hidden sm:table-cell">Keterangan</th>
                        <th scope="col" class="px-4 py-3">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ijins as $ijin)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 cursor-pointer"
                            onclick="window.location='{{ route('ijin.show', $ijin->id) }}'">
                            <th scope="row" class="px-2 py-4 font-medium text-gray-900 dark:text-white">
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
