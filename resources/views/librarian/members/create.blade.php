<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Member</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 p-10">
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Whoops!</strong>
            <span class="block sm:inline">There were some problems with your input.</span>
            <ul class="mt-2 list-disc list-inside text-sm text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Register New Member</h2>

        <form action="{{ url('/librarian/members') }}" method="POST">
            @csrf <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Full Name</label>
                <input type="text" name="name" required
                    class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Email Address</label>
                <input type="email" name="email" required
                    class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Phone Number</label>
                <input type="text" name="phone_number"
                    class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Address</label>
                <input type="text" name="address"
                    class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                    placeholder="City, Street...">
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Initial Password</label>
                <input type="password" name="password" required
                    class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
                    placeholder="Create a password for the member">
            </div>

            <div class="flex justify-between items-center">
                <a href="{{ route('librarian.dashboard') }}" class="text-gray-500 hover:text-gray-700">Cancel</a>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 font-bold">
                    Save Member
                </button>
            </div>
        </form>
    </div>
</body>

</html>
