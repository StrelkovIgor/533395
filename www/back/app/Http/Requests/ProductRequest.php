<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * App\Http\Requests\ProductRequest
 *
 * @property string $name
 * @property string $description
 * @property integer $price
 * @property string $article
 */


class ProductRequest extends FormRequest
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
            'name' => 'required|v',
            'description' => 'nullable|string|',
            'price' => 'required|numeric|min:0',
            'article' => 'required|regex:/[A-Z]{3}[0-9]{3}/',
        ];
    }
}
