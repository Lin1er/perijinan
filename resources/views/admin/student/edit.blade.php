<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100 p-6">

<div class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Edit Student</h1>

    <form action="{{ route('admin.student.update', $student->id) }}" method="POST">
        @csrf
        @method('PATCH')
        
        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-semibold">Name:</label>
            <input type="text" name="name" id="name" value="{{ old('name', $student->name) }}" required
                   class="w-full p-2 border border-gray-300 rounded">
            @error('name')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Username -->
        <div class="mb-4">
            <label for="username" class="block text-gray-700 font-semibold">Username:</label>
            <input type="text" name="username" id="username" value="{{ old('username', $student->username) }}" required
                   class="w-full p-2 border border-gray-300 rounded">
            @error('username')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Class -->
        <div class="mb-4">
            <label for="student_class_id" class="block text-gray-700 font-semibold">Kelas:</label>
            <select name="student_class_id" id="student_class_id" class="w-full p-2 border border-gray-300 rounded" required>
                <option value="{{ $student->student_class_id }}">Select Class</option>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}" {{ old('student_class_id', $student->student_class_id) == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                @endforeach
            </select>
            @error('student_class_id')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>        

        <!-- Gender -->
        <div class="mb-4">
            <label for="gender" class="block text-gray-700 font-semibold">Gender:</label>
            <select name="gender" id="gender" class="w-full p-2 border border-gray-300 rounded" required>
                <option value="">Select Gender</option>
                <option value="male" {{ old('gender', $student->gender) === 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('gender', $student->gender) === 'female' ? 'selected' : '' }}>Female</option>
            </select>
            @error('gender')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Born Date -->
        <div class="mb-4">
            <label for="born_date" class="block text-gray-700 font-semibold">Born Date:</label>
            <input type="date" name="born_date" id="born_date" value="{{ old('born_date', $student->born_date ? $student->born_date->format('Y-m-d') : '') }}"
                   class="w-full p-2 border border-gray-300 rounded">
            @error('born_date')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Address -->
        <div class="mb-4">
            <label for="address" class="block text-gray-700 font-semibold">Address:</label>
            <textarea name="address" id="address" rows="3" required class="w-full p-2 border border-gray-300 rounded">{{ old('address', $student->address) }}</textarea>
            @error('address')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Update Student</button>
        </div>
    </form>
</div>

</body>
</html>
