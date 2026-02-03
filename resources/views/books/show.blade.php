<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $book->name }} - Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        .font-serif {
            font-family: 'Merriweather', serif;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen flex items-center justify-center p-6">

    <div class="max-w-5xl w-full bg-white rounded-3xl shadow-2xl overflow-hidden">
        <div class="flex flex-col md:flex-row">

            <div class="md:w-1/3 bg-slate-900 p-10 flex items-center justify-center relative">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-900 to-slate-900 opacity-90"></div>

                <img src="{{ asset('images/' . $book->image) }}" alt="{{ $book->name }}"
                    class="relative w-48 md:w-64 shadow-[0_20px_50px_rgba(0,0,0,0.5)] rounded-lg transform transition duration-500 hover:scale-105 hover:rotate-1">
            </div>

            <div class="md:w-2/3 p-10 md:p-12 flex flex-col justify-between">

                <div>
                    <div class="flex justify-between items-start mb-6">
                        @if ($book->status === 'available')
                            <span
                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <span class="w-2 h-2 rounded-full bg-green-600 animate-pulse"></span>
                                Available Now
                            </span>
                        @else
                            <span
                                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                <span class="w-2 h-2 rounded-full bg-red-600"></span>
                                Currently Borrowed
                            </span>
                        @endif

                        <a href="{{ route('books.index') }}" class="text-gray-400 hover:text-gray-600 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </a>
                    </div>

                    <h1 class="text-4xl font-serif font-bold text-gray-900 mb-2 leading-tight">{{ $book->name }}</h1>
                    <p class="text-lg text-blue-600 font-medium mb-8 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                            </path>
                        </svg>
                        {{ $book->author }}
                    </p>

                    <div class="mb-8">
                        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">About this book</h3>
                        <p class="text-gray-600 leading-relaxed text-lg">
                            {{ $book->description }}
                        </p>
                    </div>
                </div>

                <div class="border-t border-gray-100 pt-8 mt-4">
                    @if ($book->status === 'available')
                        <div class="flex items-center gap-4">
                            <form action="{{ route('books.borrow', $book->id) }}" method="POST" class="w-full">
                                @csrf
                                <button type="submit"
                                    class="w-full group bg-slate-900 hover:bg-blue-700 text-white text-lg font-semibold py-4 px-6 rounded-xl transition-all duration-300 shadow-lg hover:shadow-blue-500/30 flex justify-center items-center gap-2">
                                    <span>Borrow Book</span>
                                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>
                        <p class="text-center text-sm text-gray-400 mt-3">Clicking will instantly add this book to your
                            profile.</p>
                    @else
                        <button disabled
                            class="w-full bg-gray-100 text-gray-400 text-lg font-semibold py-4 px-6 rounded-xl cursor-not-allowed flex justify-center items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Unavailable / Borrowed
                        </button>
                        <p class="text-center text-sm text-red-400 mt-3">Please check back later.</p>
                    @endif
                </div>

            </div>
        </div>
    </div>

</body>

</html>
