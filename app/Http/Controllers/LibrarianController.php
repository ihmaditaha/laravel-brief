<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Book;

class LibrarianController extends Controller
{
    public function index()
    {
        $books = Book::all();

        $members = User::where('role', 'member')->get();

        return view('librarian.dashboard', compact('books' , 'members'));
    }

    public function createMember()
    {
        return view('librarian.members.create');
    }

    public function storeMember(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        $generatedNumber = null;
        do {
            $generatedNumber = rand(10000000, 99999999);
        } while (User::where('membership_number', $generatedNumber)->exists());

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'member',
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'membership_number' => $generatedNumber,
        ]);

        return redirect()->route('librarian.dashboard')->with('success', 'Member created successfully! ID: ' . $generatedNumber);
    }
}
