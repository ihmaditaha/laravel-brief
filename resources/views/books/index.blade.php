<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Library Catalog</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-10">

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert"
            id='success-message'>
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <nav class="max-w-7xl mx-auto bg-white p-4 rounded-lg shadow mb-8 flex justify-between items-center">

        <div class="font-bold text-gray-700">
            @auth
                👤 Welcome, <span class="text-blue-600">{{ Auth::user()->name }}</span>
            @else
                👋 Welcome, <span class="text-blue-600">Visitor</span>
            @endauth
        </div>

        <div class="flex gap-4 items-center">

            @auth
                @if (Auth::user()->role === 'librarian')
                    <a href="{{ route('librarian.dashboard') }}"
                        class="bg-purple-600 text-white px-3 py-2 rounded hover:bg-purple-700 transition font-bold shadow-md flex items-center gap-2 text-sm">
                        🛡️ Dashboard
                    </a>
                @endif

                <a href="{{ route('members.index') }}"
                    class="text-blue-600 hover:text-blue-800 font-semibold hover:underline flex items-center gap-1">
                    <span>My Profile</span> 📖
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition shadow-sm">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600 font-semibold transition">
                    Login
                </a>
            @endauth

        </div>
    </nav>

    <div class="max-w-7xl mx-auto">
        <h1 class="text-4xl font-bold text-center mb-10 text-gray-800">📚 Library Books Collection</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($books as $book)
                <a href="{{ route('books.show', $book->id) }}"
                    class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden block">
                    <div class="h-64 overflow-hidden">
                        <img src="{{ asset('images/' . $book->image) }}" alt="{{ $book->name }}"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="p-4">
                        <h3 class="text-xl font-bold text-gray-800 mb-1 truncate">{{ $book->name }}</h3>
                        <p class="text-gray-600 text-sm">By: {{ $book->author }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    <script src="{{ asset('js/member.js') }}"></script>
</body>

</html>
