<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\BookDataTable;
use App\Http\Controllers\Controller;
use App\Models\Book;
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
        $file = $request->image;
        $extension = $file->getclientoriginalextension();
        $filename = rand() . '_post.' . $extension;
        $file->move('storage/image', $filename);
        $category = Book::create([
            'name' => $request->title,
            'auther' => $request->auther,
            'descreption' => $request->description,
            'image' => $filename,
            'category_id' => $request->categorie_name,
            'books' => $request->books,

        ]);
        $category->save();

        session(['alert' => 'Insert Sucessfully', 'class' => 'alert alert-danger']);

        return redirect()->route('admin.book.category_view_list');
    }
}
