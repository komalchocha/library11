<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\BookCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookcategoryRequest;
use App\Models\BookCategory;
use Illuminate\Http\Request;

class BookCategoryController extends Controller
{
    public function  index(BookCategoryDataTable $bookCategoryDataTable){
        
        return $bookCategoryDataTable->render('Admin.BookCategory.index');

    }
    public function create(){
        return view('Admin.BookCategory.create');
    }
    public function storeCategory(BookCategoryRequest $request)
    {
        $category = BookCategory::create([
            'name' => $request->name,
        ]);
        $category->save();
        session(['alert' => 'Insert Sucessfully', 'class' => 'alert alert-danger']);

        return redirect()->route('admin.book.category_view_list');

    }
}
