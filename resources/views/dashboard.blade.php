<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <main class="flex-grow container mx-auto mt-12 text-center">
        <h1 class="text-4xl font-bold text-gray-800">Selamat Datang di Aplikasi Perizinan Pulang</h1>
        <p class="mt-4 text-lg text-gray-600">Aplikasi ini mempermudah proses pengajuan izin pulang untuk anak asrama.</p>

        <div class="mt-8 flex flex-col gap-4">
            <a href="/pengajuan" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                Ajukan Izin Pulang
            </a>
            <a href="/pengajuan-status" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                Status Pengajuan
            </a>
        </div>
    </main>
</x-app-layout>
