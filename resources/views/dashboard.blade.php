<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <main class="flex-grow container mx-auto mt-12 text-center">
        <h1 class="text-4xl font-bold text-gray-800">Selamat Datang di Aplikasi Perizinan Pulang</h1>
        <p class="mt-4 text-lg text-gray-600">Aplikasi ini mempermudah proses pengajuan izin pulang untuk anak asrama.</p>

        <x-dashboard-table>
            <!-- Isi tabel -->
            @foreach ($ijins as $ijin)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900  dark:text-white">
                        {{ $ijin->student->username }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $ijin->class }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $ijin->reason }}
                    </td>
                    <td class="px-6 py-4">
                        Verified
                    </td>
                </tr>
            @endforeach
        </x-dashboard-table>

    </main>
</x-app-layout>
