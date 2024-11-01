<x-app-layout>
    <div class="container mx-auto mt-8 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Form Pengajuan Izin Pulang</h2>

        @if ($errors->any())
            <div class="mb-4">
                <div class="bg-red-500 text-white p-3 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('ijin.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="pickup_attachment" class="block text-gray-700 text-sm font-bold mb-2">Bukti DIjemput</label>
                <input type="file" name="pickup_attachment" class="form-control border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 w-full p-2">
            </div>

            <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 transition duration-300">Ajukan</button>
        </form>
    </div>
</x-app-layout>
