<?php

namespace App\Http\Controllers\User;

use App\DataTables\BookDataTable;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookIssue;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function  index(Request $request)

    {
        $books=Book::with('bookissued')->get();
        
        $bookissue=BookIssue::all();
        return view('User.index',compact('books', 'bookissue'));
    }
    public function book($id)
    {
        $viewbook = Book::find($id);
       
        return view('User.index', compact('viewbook'));
    }
}
