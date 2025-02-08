<x-app-layout>
    <div class="w-full max-w-3xl mx-auto bg-blue-100 rounded-lg p-6 shadow-md">
        <div class="flex justify-between">
            <div>
                <h1 class="text-2xl font-semibold mb-6 text-blue-800">Detail Izin</h1>
            </div>
            <div class="flex justify-end">
                @can('admin')
                    <form action="{{ route('ijin.destroy', $ijin->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Hapus
                        </button>
                    </form>
                @endcan
            </div>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-2 mb-6 text-gray-800">
            <div class="font-semibold w-fit">Username:</div>
            <div class="col-span-1">{{ $ijin->student->username }}</div>
            <div class="font-semibold w-fit">Kelas:</div>
            <div class="col-span-1">{{ $ijin->student->studentClass->name }}</div>
            <div class="font-semibold col-span-1">Alasan:</div>
            <div class="col-span-1">{{ $ijin->reason }}</div>
            <div class="font-semibold col-span-1">Diajukan Oleh:</div>
            <div class="col-span-1">{{ $ijin->user->name }}</div>
            <div class="font-semibold col-span-1">Tanggal Keluar:</div>
            <div class="col-span-1">{{ $ijin->date_pick->format('d-m-Y') }}</div>
            <div class="font-semibold col-span-1">Tenggat Kembali:</div>
        <div class="col-span-1">{{ $ijin->date_return->format('d-m-Y') }}</div>
            @if ($ijin->date_returned)
                <div class="font-semibold col-span-1">Tanggal Dikembalikan:</div>
                <div class="col-span-1">
                    {{ $ijin->date_returned 
                        ? \Carbon\Carbon::parse($ijin->date_returned)
                            ->timezone('Asia/Jakarta') // Mengubah timezone ke Jakarta
                            ->locale('id')             // Mengatur bahasa ke Indonesia
                            ->isoFormat('LLLL')        // Format tanggal dan waktu
                        : '-' 
                    }}
                </div>
            @endif
            <div class="font-semibold col-span-1">Status Izin:</div>
            <div class="col-span-1">
                <span
                    class="px-2 py-1 rounded text-white {{ $ijin->status == 'wait_approval' ? 'bg-yellow-500' : ($ijin->status == 'approved' ? 'bg-green-500' : 'bg-red-500') }}">
                    {{ $ijin->getStatusLabelAttribute($ijin->status) }}
                </span>
            </div>
        </div>

        <div class="mb-6">
            <h2 class="text-lg font-semibold text-gray-800">Lampiran</h2>
            <div class="flex flex-col space-y-2 mt-2">
                @if ($ijin->attachments['medic'] ?? null)
                    <a href="{{ asset('storage/' . $ijin->attachments['medic']) }}" target="_blank"
                        class="text-blue-600 underline w-fit">Lihat Lampiran Medis</a>
                @else
                    <p class="text-gray-500">Tidak Ada Lampiran Medis</p>
                @endif
                @if ($ijin->attachments['pickup'] ?? null)
                    <a href="{{ asset('storage/' . $ijin->attachments['pickup']) }}" target="_blank"
                        class="text-blue-600 underline w-fit">Lihat Bukti Penjemputan</a>
                @endif
                @if ($ijin->attachments['return'] ?? null)
                    <a href="{{ asset('storage/' . $ijin->attachments['return']) }}" target="_blank"
                        class="text-blue-600 underline w-fit">Lihat Bukti Pengembalian</a>
                @endif
                @if (Storage::disk('public')->exists('surat_ijin/surat_ijin_' . $ijin->id . '.pdf'))
                    <a href="{{ asset('storage/surat_ijin/surat_ijin_' . $ijin->id . '.pdf') }}" target="_blank"
                        class="text-blue-600 underline w-fit">Lihat Surat Izin</a>
                @endif
            </div>
        </div>

        <div class="mb-6">
            <h2 class="text-lg font-semibold text-gray-800">Catatan</h2>
            <p class="text-gray-700">{{ $ijin->getNotesAttribute($ijin->notes) }}</p>
        </div>

        <!-- Bagian Verifikasi dan Validasi -->
        <div class="flex flex-col space-y-4">
            @if ($ijin->status == 'wait_approval')
                @can('verifikasi izin')
                    <form action="{{ route('ijin.verify', $ijin->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <label for="date_return" class="block text-sm font-medium text-gray-700">Tanggal
                            Pengembalian:</label>
                        <input type="date" name="date_return" id="date_return" value="{{ $ijin->date_return }}"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-md">

                        <label for="notes" class="block text-sm font-medium text-gray-700">Catatan:</label>
                        <textarea name="notes" id="notes" rows="4" class="mt-1 block w-full p-2 border border-gray-300 rounded-md"></textarea>

                        <div class="flex justify-between mx-4 mt-2">
                            <!-- Tombol Setujui -->
                            <button type="submit" name="action" value="approve"
                                class="bg-green-500 text-white py-2 px-4 rounded-md">Setujui Izin</button>

                            <!-- Tombol Tolak -->
                            <button type="submit" name="action" value="reject"
                                class="bg-red-500 text-white py-2 px-4 rounded-md">Tolak Izin</button>
                        </div>
                    </form>
                @endcan
            @elseif ($ijin->status == 'approved')
                @can('validasi jemput')
                    <x-camera name="pickup" label="Bukti Dijemput" :route="route('ijin.pickup', $ijin->id)" />
                @endcan
            @elseif ($ijin->status == 'picked_up')
                @can('validasi kembali')
                    <x-camera name="return" label="Bukti Dikembalikan" route="{{ route('ijin.return', $ijin->id) }}" />
                @endcan
            @endif
        </div>
    </div>

    <style>
        video,
        canvas {
            width: 100%;
            height: auto;
            max-width: 640px;
        }

        .object-fit {
            width: 100%;
            height: auto;
            object-fit: contain;
        }
    </style>
</x-app-layout>
