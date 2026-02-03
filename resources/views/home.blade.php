<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Home - Welcome</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="max-w-4xl w-full mx-auto p-6">

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-8 text-white">
                <h1 class="text-4xl font-bold mb-2">Welcome back, {{ Auth::user()->name }}! 👋</h1>
                <p class="text-blue-100 text-lg">You are logged in as a <span
                        class="font-bold uppercase">{{ Auth::user()->role }}</span>.</p>
            </div>

            <div class="p-8">
                <p class="text-gray-600 mb-6 text-lg">
                    This is your personal dashboard home. Select where you want to go next:
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @if (Auth::user()->role === 'librarian')
                        <a href="{{ route('librarian.dashboard') }}"
                            class="group block p-6 border rounded-xl hover:shadow-lg transition bg-purple-50 border-purple-100 hover:bg-purple-100">
                            <div class="flex items-center justify-between mb-4">
                                <span
                                    class="text-3xl bg-purple-200 w-12 h-12 flex items-center justify-center rounded-full">🛡️</span>
                                <span class="text-purple-600 font-bold group-hover:translate-x-1 transition">Go →</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800">Admin Dashboard</h3>
                            <p class="text-gray-500 mt-2">Manage books, members, and library settings.</p>
                        </a>

                        <a href="{{ route('books.index') }}"
                            class="group block p-6 border rounded-xl hover:shadow-lg transition bg-white hover:bg-gray-50">
                            <div class="flex items-center justify-between mb-4">
                                <span
                                    class="text-3xl bg-gray-100 w-12 h-12 flex items-center justify-center rounded-full">📚</span>
                                <span class="text-gray-400 group-hover:translate-x-1 transition">Go →</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800">View Public Catalog</h3>
                            <p class="text-gray-500 mt-2">See how the library looks to members.</p>
                        </a>
                    @else
                        <a href="{{ route('books.index') }}"
                            class="group block p-6 border rounded-xl hover:shadow-lg transition bg-blue-50 border-blue-100 hover:bg-blue-100">
                            <div class="flex items-center justify-between mb-4">
                                <span
                                    class="text-3xl bg-blue-200 w-12 h-12 flex items-center justify-center rounded-full">📖</span>
                                <span class="text-blue-600 font-bold group-hover:translate-x-1 transition">Go →</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800">Browse Library</h3>
                            <p class="text-gray-500 mt-2">Explore our collection and borrow books.</p>
                        </a>

                        <a href="{{ route('members.index') }}"
                            class="group block p-6 border rounded-xl hover:shadow-lg transition bg-green-50 border-green-100 hover:bg-green-100">
                            <div class="flex items-center justify-between mb-4">
                                <span
                                    class="text-3xl bg-green-200 w-12 h-12 flex items-center justify-center rounded-full">👤</span>
                                <span class="text-green-600 font-bold group-hover:translate-x-1 transition">Go →</span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800">My Profile</h3>
                            <p class="text-gray-500 mt-2">Check your borrowed books and return history.</p>
                        </a>
                    @endif

                </div>
            </div>

            <div class="bg-gray-50 p-4 border-t text-center">
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit"
                        class="text-red-500 hover:text-red-700 font-semibold hover:underline text-sm">
                        Log out from system
                    </button>
                </form>
            </div>
        </div>

        <p class="text-center text-gray-400 text-sm">Municipal Library System &copy; 2026</p>

    </div>

</body>

</html>
