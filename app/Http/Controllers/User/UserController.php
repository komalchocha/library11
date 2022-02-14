<?php

namespace App\Http\Controllers\User;

use App\DataTables\BookDataTable;
use App\DataTables\BookIssueDataTable;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookIssue;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function  index(Request $request)
    {
        $books=Book::with('bookissued')->get();
        $bookissue=BookIssue::all();
        $book = Book::with('getcategory');
        $name = $request->input('search') ?? '';

        if($request->ajax() && $request->input('search')) {
            $books = $book->where('name', 'LIKE', "%{$name}%")
                ->Orwhere('auther', 'Like', "%{$name}%")
                ->orwhereHas('getcategory', function ($query) use ($name) {
                    $query->where('name', 'LIKE', "%{$name}%");
                })
                ->select('name', 'image', 'description', 'auther', 'id', 'category_id')
                ->get();

                return response()->json(['status' => true, 'data' => $books]);
            }
       
            else{

            return view('User.index',compact('books', 'bookissue'));

        }


    }
    public function book($id)
    {
        $viewbook = Book::find($id);
       
        return view('User.index', compact('viewbook'));
    }
    
    public function store(Request $request,$id)
    {
        $bookissue= BookIssue::where('book_id',$id)->where('user_id', Auth::user()->id)->first();
        if(!empty($bookissue)){
            
            $date = Carbon::now()->addDays(8);
            $bookissue->status=0;
            $bookissue->return_date = $date;
            $bookissue->update();


        }else{

        $date = Carbon::now()->addDays(8);
        $bookissue = BookIssue::create([
            'user_id' => Auth::user()->id,
            'book_id' => $request->id,
            'status' => '0',
            'fine_ammount' => '0',
            'return_date' => $date,


        ]);

        }
    
        return response()->json(['status' => true, 'data' => $bookissue, 'message' => 'Your book request send Sucessfully']);
    }
    public function bookhistory($id)
       {
           $books = BookIssue::with('book')->where('user_id', $id)->get();
           
           return view('User.book_history', compact('books'));
       }
}
