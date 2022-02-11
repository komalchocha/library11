<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookIssue;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $books=Book::all();
        $bookissue=BookIssue::all();
        $avalablebook= Book::where('books', '>', '0');
        $issuedbook=BookIssue::where('status','=','1');
        return view('Admin.Dashboard.dashboard',compact('books', 'bookissue', 'avalablebook', 'issuedbook'));
    }
  
}
