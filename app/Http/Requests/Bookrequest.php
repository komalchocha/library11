<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class Bookrequest extends FormRequest
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
    public function rules()
    {
        if($this->id == ""){
        return [
           
            'name' => [
                    'required|NULL,deleted_at', Rule::unique('books')->where(function ($query) {
                return $query->where('category_id', $this->categorie_name);
            })
        ],
        'image' => 'required|image|mimes:jpg,png,svg',

            ];
        }
        else {
            return [
                'name' => [
                    'required|NULL,deleted_at', Rule::unique('books')
                    ->where('category_id', $this->categorie_name)->whereNot('id', $this->id)
                ],
                'image' => 'required|image|mimes:jpg,png,svg',


            ];
        }
    }
}
