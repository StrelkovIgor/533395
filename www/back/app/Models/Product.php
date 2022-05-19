<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Product
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $price
 * @property string $article
 */

class Product extends Model
{
    use HasFactory;

    public function shops()
    {
        return $this->belongsToMany(Shop::class)->withPivot(['article', 'import']);
    }

    public function getPriceAttribute($value)
    {
        return self::priceFormat($value);
    }

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = self::priceFormat($value, false);
    }

    /**
     * side = true => 1020 => 10.2
     * side = false => 10.2 => 1020
     * getting rid of 8 - 6.4 != 1.6
     *
     * @param $price
     * @param bool $side
     */
    public static function priceFormat($price, $side = true)
    {
        return $side ? round($price * 0.01, 2) : (int) str_replace('.', '', number_format($price, 2, '.', '')) ;
    }
}
