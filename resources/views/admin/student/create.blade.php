<x-app-layout>
    <div class="container mx-auto mt-8 p-6 bg-white shadow-lg rounded-lg">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Tambah Siswa</h2>

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

        <form method="POST" action="{{ route('admin.student.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
                <input type="text" name="name" class="form-control border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 w-full p-2" required>
            </div>

            <div class="mb-4">
                <label for="username" class="block text-gray-700 text-sm font-bold mb-2">Nama Panggilan</label>
                <input type="text" name="username" class="form-control border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 w-full p-2" required>
            </div>

            <div class="mb-4">
                {{-- @foreach ($classes as $class)
                    {{ $class->id, $class->name }}
                @endforeach --}}
                <label for="student_class_id" class="block text-gray-700 text-sm font-bold mb-2">Kelas</label>
                <select name="student_class_id" class="form-control border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-500 w-full p-2" required>
                    <option value="" disabled selected>Pilih Kelas</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 transition duration-300">Simpan</button>
        </form>
    </div>
</x-app-layout>
