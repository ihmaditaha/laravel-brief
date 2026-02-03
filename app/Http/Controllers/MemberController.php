<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class MemberController extends Controller
{
    public function profile()
    {
        $user = Auth::user();

        $borrowedBooks = [];

        return view('librarian.members.index', compact('user', 'borrowedBooks'));
    }

    public function destroy($id)
    {
        $member = User::findOrFail($id);
        $isHasBooks = $member->borrowedBooks()->exists();

        if ($isHasBooks) {
            return back()->with('error', 'This member cannot be deleted because they still have borrowed books. They must be returned first.');
        }
        $member->delete();
        return back()->with('success', 'The member has been successfully deleted!');
    }
}
