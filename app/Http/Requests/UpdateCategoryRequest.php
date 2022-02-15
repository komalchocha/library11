<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $id=$this->id;
        
        if($id){
        return [
            'name' => 'required|unique:book_categories,name,NULL,deleted_at' . $id,

        ];
    }else{
         return [
            'name' => 'required|unique:book_categories,name,NULL,deleted_at',
         ];
        }
    }
   
   
}
