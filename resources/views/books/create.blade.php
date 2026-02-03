<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add New Book</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-10">

    <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">📚 Add New Book</h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Book Title</label>
                <input type="text" name="title" required class="w-full p-2 border border-gray-300 rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Author</label>
                <input type="text" name="author" required class="w-full p-2 border border-gray-300 rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Description</label>
                <textarea name="description" rows="3" class="w-full p-2 border border-gray-300 rounded"></textarea>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Book Cover Image</label>
                <input type="file" name="image" class="w-full p-2 border border-gray-300 rounded bg-gray-50">
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('librarian.dashboard') }}" class="text-gray-500 hover:text-gray-700">Cancel</a>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 font-bold">
                    Save Book
                </button>
            </div>
        </form>
    </div>

</body>

</html>
