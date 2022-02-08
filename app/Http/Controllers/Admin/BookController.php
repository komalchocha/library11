<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\BookDataTable;
use App\Http\Controllers\Controller;
use App\Models\Bookcategory;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function  index(BookDataTable $bookDataTable)
    {

        return $bookDataTable->render('Admin.Book.index');
    }
    public function create()
    {
        $bookcategories=BookCategory::all();
        return view('Admin.Book.create',compact('bookcategories'));
    }
    public function store(Request $request)
    {
        $category = BookCategory::create([
            'name' => $request->name,
            
        ]);
        $category->save();
        session(['alert' => 'Insert Sucessfully', 'class' => 'alert alert-danger']);

        return redirect()->route('admin.book.category_view_list');
    }
}
