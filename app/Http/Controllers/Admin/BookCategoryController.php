<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\BookCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookcategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\BookCategory;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;

class BookCategoryController extends Controller
{
    public function  index(BookCategoryDataTable $bookCategoryDataTable){
        
        return $bookCategoryDataTable->render('Admin.BookCategory.index');

    }
    public function create(){

        return view('Admin.BookCategory.create');
    }
    public function storeCategory(UpdateCategoryRequest $request)
    {
            $category = BookCategory::create([
                'name' => $request->name,
                'status' => '1',
            ]);
 
        return redirect()->route('admin.book.category_view_list');

    }
    public function destroy(Request $request)
    {
        BookCategory::where('id', $request->id)->delete();
        return response()->json(['status' => true, 'message' => 'Delete Successfully']);
    

    }
    public function edit(Request $request,$id)
    {
        $bookcategory=BookCategory::find($id);
        return view('Admin.BookCategory.create', compact('bookcategory'));
    }
    public function update(UpdateCategoryRequest $request, $id)
    {
        $bookcategory = BookCategory::find($id);
        $bookcategory->name = $request->name;
        $bookcategory->save();

        return redirect()->route('admin.book.category_view_list');
        
    }
    
    public function statuschange(Request $request)
    {
        $data = BookCategory::find($request->id);
        if ($data->status == 1) {
            $data->status = 0;
        } else {
            $data->status = 1;
        }
        $data->save();

        return $data;
    }
}
