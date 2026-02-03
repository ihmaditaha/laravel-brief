<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Borrowing;

class BookController extends Controller
{

    public function index()
    {
        $books = Book::all();

        return view('books.index', compact('books'));
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('books.show', compact('book'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = time() . '.' . $request->image->extension();

        $request->image->move(public_path('images'), $imageName);

        Book::create([
            'name' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'image' => $imageName,
        ]);

        return redirect()->route('librarian.dashboard')->with('success', 'Book added successfully!');
    }

    public function borrow($id)
    {
        $book = Book::findOrFail($id);

        if ($book->status !== 'available') {
            return back()->with('error', 'Sorry, this book is already borrowed by someone else.');
        }

        $today = now();
        $nextMonth = now()->addMonth();

        Borrowing::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,

            'borrowing_date' => $today,
            'return_date' => $nextMonth,
        ]);

        $book->update(['status' => 'borrowed']);

        return redirect()->route('books.index')->with('success', 'Book borrowed successfully!');
    }

    public function returnBook($id)
    {
        $book = Book::findOrFail($id);
        $user = Auth::user();

        $user->borrowedBooks()->detach($book->id);

        $book->update(['status' => 'available']);

        return back()->with('success', 'Book returned successfully!');
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'author' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'author' => $request->author,
            'description' => $request->description,
        ];

        if ($request->hasFile('image')) {
            if ($book->image && file_exists(public_path('images/' . $book->image))) {
                unlink(public_path('images/' . $book->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);

            $data['image'] = $imageName;
        }

        $book->update($data);

        return redirect()->route('librarian.dashboard')->with('success', 'Book updated successfully!');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        if ($book->status !== 'available') {
            return back()->with('error', 'Cannot delete this book because it is currently borrowed by a member.');
        }

        $book->delete();
        return back()->with('success', 'Book moved to trash successfully!');
    }

    public function trash()
    {
        $deletedBooks = Book::onlyTrashed()->get();
        return view('books.trash', compact('deletedBooks'));
    }

    public function restore($id)
    {
        $book = Book::withTrashed()->findOrFail($id);
        $book->restore();
        return back()->with('success', 'Book restored successfully!');
    }
}
