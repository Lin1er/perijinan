<x-app-layout>
    <table class="w-full max-w-screen text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-500 uppercase bg-white-50 dark:bg-white-500 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-2 py-3">Nama</th>
                <th scope="col" class="px-2 py-3">ID</th>
            </tr>
        </thead>
        <tbody id="ijinTable">
            @forelse ($whacenters as $whacenter)
                <tr class="border-b dark:bg-white-400 dark:border-white-400 dark:hover:bg-white-400 cursor-pointer">
                    <th scope="row" class="px-2 py-4 font-medium text-black">
                        {{ $whacenter->name }}
                    </th>
                    <td class="px-3 py-4">{{ $whacenter->whacenter_id }}</td>
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
</x-app-layout>