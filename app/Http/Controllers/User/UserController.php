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
    public function search(Request $request)
    {
        $name = $request->input('search')?? '';
        $book = Book::with(['getcategory']);
        if ($name) {
            $product = $book->where('name', 'LIKE', "%{$name}%")->orwhereHas('getcategory', function ($query) use ($name) {
                $query->where('name', 'LIKE', "%{$name}%");
            })->select('name','image','description', 'auther','id', 'category_id')->get();
        }
        return response()->json(['status' => true, 'data' => $product]);
    }
    public function bookhistory($id)
    {
        $books = BookIssue::with('book')->where('user_id', $id)->get();
        

        return view('User.book_history', compact('books'));
    }
}
