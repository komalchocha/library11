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
   
    public function counfirm(Request $request){

        $data = BookIssue::find($request->id);
        $book = BookIssue::with('book')->where('id', $request->id)->first();
        $book->book->decrement('books', 1);
        if ($data->status == 0) {
            $data->status = 1;
        }
        $data->save();
        return $data;

    }
    public function bookissue(Request $request){

        $data = BookIssue::find($request->id);
        if ($data->status == 1) {
            $data->status = 2;
        }
        $data->save();
        return $data;

    }
    public function finereturn(Request $request){

        $data = BookIssue::find($request->id);
        $book = BookIssue::with('book')->where('id', $request->id)->first();
        $book->book->increment('books', 1);
        if ($data->status == 3) {
            $data->status = 2;
            $data->fine_ammount =0;
        }
        $data->save();
        return $data;

    }
  
}

