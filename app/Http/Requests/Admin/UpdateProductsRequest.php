<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductsRequest extends FormRequest
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
        return [
            
            'product_name' => 'required|unique:products,product_name,'.$this->route('product'),
            'product_price' => 'max:2147483647|required|numeric',
            'products_customers.*' => 'exists:clients,id',
        ];
    }
}
