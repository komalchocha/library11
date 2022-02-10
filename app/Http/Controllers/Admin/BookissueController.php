<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\BookIssueDataTable;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookIssue;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookissueController extends Controller
{
    public function  index(BookIssueDataTable $bookissueDataTable)
    {
        return $bookissueDataTable->render('Admin.BookIssue.index');
    }
    public function store(Request $request)
    {
        
        
        $bookissue = BookIssue::create([
            'user_id' => Auth::user()->id,
            'book_id' => $request->id,
            'status' => '0',
            'fine_ammount' => '0',
            'book_status' => '0',
           
            
        ]);
        dd($bookissue);
        $bookissue->save();
        return redirect('/welcome_library');




    }
    public function counfirm(Request $request){

        $data = BookIssue::find($request->id);
        $book = BookIssue::with('book')->where('id', $request->id)->first();
        $decrement= $book->book->decrement('books', 1);
        if ($data->status == 0) {
            $data->status = 1;
            
        }
        $decrement->save();
        $data->save();
        return $data;

    }
  
}
