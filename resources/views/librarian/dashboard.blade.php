<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Librarian Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans">
    @if (session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 shadow-md rounded relative" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif
    <nav class="bg-white shadow-lg mb-8">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <span class="text-2xl">🛡️</span>
                <span class="font-bold text-xl text-gray-800">Librarian Panel</span>
            </div>

            <div class="flex items-center gap-6">
                <span class="text-gray-500 text-sm">Welcome, <strong>{{ Auth::user()->name }}</strong></span>

                <a href="{{ route('books.index') }}" target="_blank"
                    class="text-blue-600 hover:text-blue-800 flex items-center gap-1 hover:underline">
                    <span>View Public Catalog</span>
                    <span class="text-xs">↗</span>
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition shadow">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-6 pb-10">

        @if (session('success'))
            <div id="success-message"
                class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 shadow-md rounded"
                role="alert">
                <div class="flex items-center">
                    <div class="py-1"><svg class="fill-current h-6 w-6 text-green-500 mr-4"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path
                                d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                        </svg></div>
                    <div>
                        <p class="font-bold">Success!</p>
                        <p class="text-sm">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="bg-white p-6 rounded-lg shadow-md mb-10">
            <div class="flex justify-between items-center mb-6 border-b pb-4">
                <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                    📚 Books Collection
                </h2>
                <a href="{{ route('books.trash') }}"
                    class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 ml-2">
                    🗑️ View Trash
                </a>
                <a href="{{ route('books.create') }}"
                    class="bg-blue-600 text-white px-5 py-2.5 rounded hover:bg-blue-700 transition shadow flex items-center gap-2">
                    <span class="text-lg">+</span> Add New Book
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Image</th>
                            <th class="py-3 px-6 text-left">Title</th>
                            <th class="py-3 px-6 text-left">Author</th>
                            <th class="py-3 px-6 text-center">Status</th>
                            <th class="py-3 px-6 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        @foreach ($books as $book)
                            <tr class="border-b border-gray-200 hover:bg-gray-100 transition">
                                <td class="py-3 px-6 text-left">
                                    <div class="flex items-center">
                                        <img src="{{ asset('images/' . $book->image) }}"
                                            class="w-12 h-16 object-cover rounded border border-gray-200 shadow-sm" />
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-left font-medium text-gray-800">
                                    {{ $book->name }}
                                </td>
                                <td class="py-3 px-6 text-left">
                                    {{ $book->author }}
                                </td>
                                <td class="py-3 px-6 text-center">
                                    @if ($book->status === 'available')
                                        <span
                                            class="bg-green-200 text-green-600 py-1 px-3 rounded-full text-xs font-bold">Available</span>
                                    @else
                                        <span
                                            class="bg-red-200 text-red-600 py-1 px-3 rounded-full text-xs font-bold">Borrowed</span>
                                    @endif
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center gap-4">
                                        <a href="{{ route('books.edit', $book->id) }}"
                                            class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            ✏️
                                        </a>
                                        <form action="{{ route('books.destroy', $book->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-4 transform hover:text-red-500 hover:scale-110">
                                                🗑️
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if ($books->isEmpty())
                <div class="text-center py-10">
                    <p class="text-gray-500 text-lg">No books found in the library.</p>
                </div>
            @endif
        </div>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex justify-between items-center mb-6 border-b pb-4">
                <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                    👥 Library Members
                </h2>
                <a href="{{ route('librarian.members.create') }}"
                    class="bg-green-600 text-white px-5 py-2.5 rounded hover:bg-green-700 transition shadow flex items-center gap-2">
                    <span class="text-lg">+</span> Register Member
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Name</th>
                            <th class="py-3 px-6 text-left">Email</th>
                            <th class="py-3 px-6 text-center">Role</th>
                            <th class="py-3 px-6 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        @foreach ($members as $member)
                            <tr class="border-b border-gray-200 hover:bg-gray-100 transition">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="mr-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <span class="font-medium">{{ $member->name }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    {{ $member->email }}
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <span
                                        class="{{ $member->role === 'librarian' ? 'bg-purple-200 text-purple-600' : 'bg-blue-200 text-blue-600' }} py-1 px-3 rounded-full text-xs font-bold uppercase">
                                        {{ $member->role }}
                                    </span>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <form action="{{ route('members.destroy', $member->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-500 hover:text-red-700 hover:underline">
                                            Remove
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if ($members->isEmpty())
                <div class="text-center py-10">
                    <p class="text-gray-500 text-lg">No members found.</p>
                </div>
            @endif
        </div>

    </div>

    <script src="{{ asset('js/member.js') }}"></script>
</body>

</html>
