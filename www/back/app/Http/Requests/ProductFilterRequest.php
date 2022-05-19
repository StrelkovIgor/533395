<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * App\Http\Requests\ProductRequest
 *
 * @property string $name
 * @property float $price_from
 * @property float $price_to
 * @property string $name_shop
 * @property string $date_import
 * @property string $sort
 * @property bollean $desc
 */

class ProductFilterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public $sortIn = ['name', 'price'];

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
            "name" => "string",
            "price_from" => "numeric",
            "price_to" => "numeric",
            "name_shop" => "string",
            "date_import" => "date_format:Y-m-d",
            "sort" => [
                Rule::in($this->sortIn)
            ],
            'desc' => "boolean"
        ];
    }
}
