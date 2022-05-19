<?php


namespace App\Repositories\Interfaces;


use App\Http\Requests\ShopProductFilterRequest;
use App\Models\Shop;

interface ShopRepositoryInterface
{
    public function getById(int $id) :Shop;
    public function getProductByFilter($id, ShopProductFilterRequest $request);
}
