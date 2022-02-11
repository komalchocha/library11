<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\BookDataTable;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookCategory;
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
        $category = Book::where('category_id',$request->input('category_id'))->orwhere('name', '=', $request->input('title'))->first();
        if( $category === null){
            $file = $request->image;
            $extension = $file->getclientoriginalextension();
            $filename = rand() . '_post.' . $extension;
            $file->move('storage/image', $filename);
            $category = Book::create([
                'name' => $request->title,
                'auther' => $request->auther,
                'description' => $request->description,
                'image' => $filename,
                'category_id' => $request->categorie_name,
                'books' => $request->books,
    
            ]);
        }else{
            return redirect()->route('admin.book.create')->with('error', 'Please select another name');

        }
        $category->save();

        session(['alert' => 'Insert Sucessfully', 'class' => 'alert alert-danger']);

        return redirect()->route('admin.book.book_view_list');
    }
    public function edit(Request $request, $id)
    {
        $book = Book::find($id);
        $bookcategories=BookCategory::all();
        return view('Admin.Book.edit', compact('book', 'bookcategories'));
    }
    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        $book->name = $request->name;
        $book->save();
        return redirect()->route('admin.book.book_view_list');
    }
    public function destroy(Request $request)
    {
        Book::where('id', $request->id)->delete();
        return response()->json(['status' => true, 'message' => 'Delete Successfully']);
    }
}
