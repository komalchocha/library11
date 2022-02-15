<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\BookDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Bookrequest;
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
    public function store(Bookrequest $request)
    {
            $file = $request->image;
            $extension = $file->getclientoriginalextension();
            $filename = rand() . '_post.' . $extension;
            $file->move('storage/image', $filename);
            $category = Book::create([
                'name' => $request->name,
                'auther' => $request->auther,
                'description' => $request->description,
                'image' => $filename,
                'category_id' => $request->categorie_name,
                'books' => $request->books,
                'status' => '1',

    
            ]);
        return redirect()->route('admin.book.book_view_list');
    }
    public function edit(Request $request, $id)
    {
        $book = Book::find($id);
        $bookcategories=BookCategory::all();
        return view('Admin.Book.edit', compact('book', 'bookcategories'));
    }
    public function update(BookRequest $request, $id)
    {
        $book = Book::find($id);
        $book->name = $request->name;
        $book->auther = $request->auther;
        $book->description = $request->description;
        $book->category_id = $request->categorie_name;
        $book->books = $request->books;
        if (isset($request->image)) {
            $file = $request->image;
            $extension = $file->getclientoriginalextension();
            $filename = rand() . '_post.' . $extension;
            $file->move('storage/image', $filename);
            $book->image = $filename;
        }
        $book->update();
        return redirect()->route('admin.book.book_view_list');
    }
    public function destroy(Request $request)
    {
        Book::where('id', $request->id)->delete();
        return response()->json(['status' => true, 'message' => 'Delete Successfully']);
    }
}
