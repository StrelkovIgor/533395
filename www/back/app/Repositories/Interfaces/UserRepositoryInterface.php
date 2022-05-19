<?php


namespace App\Repositories\Interfaces;


use App\Http\Requests\ShopProductFilterRequest;
use App\Models\Shop;

interface UserRepositoryInterface
{
    public function login($request);
}
