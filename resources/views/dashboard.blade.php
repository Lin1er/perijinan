<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <main class="flex-grow container mx-auto sm:mt-12 text-center">
        <div x-data="{ open: true }" x-show="open"
            class="flex flex-col items-left border border-blue-400 bg-blue-400 bg-opacity-50 p-4 rounded">
            <div class="flex justify-end items-center">
                <button @click="open = false"
                    class="text-black hover:text-gray-800 bg-transparent rounded-full focus:outline-none">
                    ✕
                </button>
            </div>
            <h3 class="sm:text-4xl text-3xl font-bold text-gray-800">Selamat Datang di Aplikasi Perizinan Siswa</h3>
            <div class="flex justify-center items-center flex-col">
                <div class="mt-2" x-show="! photoPreview block">
                    <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="rounded-full h-[125px] w-[125px] object-cover">
                </div>
                <div class="flex flex-col">
                    <h1 class="text-2xl font-bold text-gray-800">{{ Auth::user()->name }}</h1>
                    <p class="text-lg text-gray-600">{{ Auth::user()->roles->first()->name }}</p>
                </div>
            </div>
            <p class="mt-4 text-lg text-gray-600">Aplikasi ini mempermudah proses pengajuan izin untuk anak asrama.</p>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg my-2">
            <div class="pb-4 bg-white dark:bg-white-900 flex flex-col sm:flex-row justify-between p-5">
                <div class="relative w-full sm:w-auto mb-4 sm:mb-0">
                    <form action="{{ route('dashboard') }}" method="GET"
                        class="flex items-center space-x-2 justify-between">
                        <div class="relative grow max-w-80">
                            <input type="text" name="search" id="table-search" oninput="filterTable()"
                                class="block w-full text-sm text-gray-900 border border-blue-white rounded-lg sm:w-80 bg-white-50 focus:ring-white-500 focus:border-white-500 dark:bg-white-700 dark:border-white-600 dark:placeholder-white-400 dark:focus:ring-white-500 dark:focus:border-white-500"
                                placeholder="Search for items" value="{{ request('search') }}">
                        </div>
                        <select name="status" onchange="filterTable()"
                            class="w-fit block px-3 border border-gray-300 rounded-lg text-sm bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-white-700 dark:border-white-600 dark:text-black dark:focus:ring-blue-00 dark:focus:border-blue-500">
                            <option value="">All Status</option>
                            <option value="wait_approval" {{ request('status') == 'wait_approval' ? 'selected' : '' }}>
                                Menunggu Disetujui</option>
                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Disetujui
                            </option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak
                            </option>
                            <option value="late" {{ request('status') == 'late' ? 'selected' : '' }}>Terlambat
                            </option>
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
                        <th scope="col" class="px-3 py-3">Angkatan</th>
                        <th scope="col" class="px-2 py-3 hidden sm:table-cell">Keterangan</th>
                        <th scope="col" class="px-4 py-3">Status</th>
                    </tr>
                </thead>
                <tbody id="ijinTable">
                    @forelse ($ijins as $ijin)
                        <tr class="
                                @if (Carbon\Carbon::parse($ijin->date_return) < Carbon\Carbon::now()) bg-orange-300
                                    hover:bg-orange-100
                                @else
                                    @if ($ijin->status == 'approved')
                                        bg-green-300
                                        hover:bg-green-100
                                    @elseif ($ijin->status == 'wait_approval')
                                        bg-yellow-300
                                        hover:bg-yellow-100
                                    @elseif ($ijin->status == 'rejected')
                                        bg-red-300
                                        hover:bg-red-100
                                    @else
                                        bg-white
                                        hover:bg-gray-100 @endif
                                @endif
                                 border-b dark:bg-white-400 dark:border-white-400 dark:hover:bg-white-400 cursor-pointer"
                            onclick="window.location='{{ route('ijin.show', $ijin->id) }}'">
                            <th scope="row" class="px-2 py-4 font-medium text-black">
                                {{ $ijin->student->username }}
                            </th>
                            <td class="px-3 py-4 text-black">{{ $ijin->student->studentClass->name }}</td>
                            <td class="px-2 py-4 hidden sm:table-cell text-black">{{ Str::limit($ijin->reason, 100) }}
                            </td>
                            <td class="px-4 py-4 text-black">
                                @if (Carbon\Carbon::parse($ijin->date_return) < Carbon\Carbon::now())
                                    Telat Kembali
                                @else
                                    {{ $ijin->getStatusLabelAttribute($ijin->status) }}
                                @endif
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
        </div>

        <div class="my-4 mb-5 mx-4 sm:mx-0">
            {{ $ijins->links() }}
        </div>

        <script>
            function filterTable() {
                const searchInput = document.getElementById('table-search').value.toLowerCase();
                const statusSelect = document.querySelector('select[name="status"]').value;
                const rows = document.querySelectorAll('#ijinTable tr');

                rows.forEach(row => {
                    const name = row.querySelector('th').innerText.toLowerCase();
                    const status = row.querySelector('td:last-child').innerText.trim().toLowerCase();

                    const matchesSearch = name.includes(searchInput);
                    const matchesStatus = statusSelect === '' || status === statusSelect.toLowerCase();

                    if (matchesSearch && matchesStatus) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }
        </script>
    </main>
</x-app-layout>

