<x-app-layout>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-semibold mb-4">Detail Izin</h1>
    
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-bold mb-2">Informasi Siswa</h2>
            <p><strong>Username:</strong> {{ $ijin->student->username }}</p>
            <p><strong>Kelas:</strong> {{ $ijin->class }}</p>
    
            <h2 class="text-xl font-bold mt-4 mb-2">Detail Izin</h2>
            <p><strong>Alasan:</strong> {{ $ijin->reason }}</p>
            <p><strong>Tanggal Keluar:</strong> {{ $ijin->date_out }}</p>
            <p><strong>Tanggal Masuk:</strong> {{ $ijin->date_in }}</p>
            <p><strong>Status Verifikasi:</strong> {{ $ijin->verify_status == '1' ? 'Verified' : 'Pending' }}</p>
            
            @if ($ijin->attachment_link)
                <p><strong>Lampiran:</strong> <a href="{{ asset('storage/' . $ijin->attachment_link) }}" target="_blank" class="text-blue-500 underline">Lihat Lampiran</a></p>
            @endif
        </div>

        @if ($ijin->verify_status == 0)
            @can('verifikasi izin')
                <div class="mt-4">
                    <x-submit-button text="Verifikasi" color="blue" size="md" onclick="window.location='{{ route('ijin.edit', $ijin->id) }}'" />
                </div>
            @endcan
        @elseif ($ijin->verify_status == 1)
            @can('validasi jemput')
                <div class="mt-4">
                    <x-submit-button text="Dijemput" color="blue" size="md" onclick="window.location='{{ route('ijin.edit', $ijin->id) }}'" />
                </div>
            @endcan
        @elseif ($ijin->verify_status == 2)
            @can('validasi kembali')
            <div class="mt-4">
                <x-submit-button text="Dikembalikan" color="blue" size="md" onclick="window.location='{{ route('ijin.edit', $ijin->id) }}'" />
            </div>
            @endcan
        @endif

    </div>
</x-app-layout>
