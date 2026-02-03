<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Book</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-10">

    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">✏️ Edit Book: {{ $book->name }}</h2>
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Book Title</label>
                <input type="text" name="name" value="{{ $book->name }}"
                    class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Author</label>
                <input type="text" name="author" value="{{ $book->author }}"
                    class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Description</label>
                <textarea name="description" rows="4"
                    class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ $book->description }}</textarea>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Book Cover</label>

                <div class="mb-2 p-2 border rounded bg-gray-50">
                    <p class="text-xs text-gray-500 mb-1">Current Image:</p>
                    <img src="{{ asset('images/' . $book->image) }}" class="h-24 rounded">
                </div>

                <input type="file" name="image" class="w-full border p-2 rounded bg-white">
                <p class="text-xs text-gray-500 mt-1">Leave empty if you don't want to change the image.</p>
            </div>

            <div class="flex justify-between items-center mt-6">
                <a href="{{ route('librarian.dashboard') }}"
                    class="text-gray-500 hover:text-gray-700 font-bold">Cancel</a>

                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 font-bold shadow transition">
                    Update Changes
                </button>
            </div>
        </form>
    </div>

</body>

</html>
