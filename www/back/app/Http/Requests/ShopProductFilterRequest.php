<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * App\Http\Requests\ProductRequest
 *
 * @property string $name
 * @property float $price_from
 * @property float $price_to
 * @property string $date_import
 * @property string $sort
 * @property bollean $desc
 */

class ShopProductFilterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public $sortIn = ['id', 'name', 'price'];

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
            "date_import" => "date_format:Y-m-d",
            "sort" => "array",
            "sort.*" => [
                Rule::in($this->sortIn)
            ],
            "desc" => "array",
            "desc.*" => "boolean"
        ];
    }
}
