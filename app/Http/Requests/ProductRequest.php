<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
            if($this->method() == "POST")
            {
                return 
                [
                    "name" => "required|unique:products|string|max:255",
                    "description" => "string|max:255",
                    "price"=>"required|numeric",
                    "status"=> "required|integer|in:0,1",
                    "stocky_quantity"=>"required|integer|min:0",
                ];
            }
            else{
                return 
                [
                    "name"=> "unique:products|string|max:255",
                    "description" => "string|max:255",
                    "price"=>"numeric",
                    "status"=> "integer|in:0,1",
                    "stocky_quantity"=>"integer|min:0",
                ];
            };
    }

}
