<?php


namespace App\Repositories\Interfaces;


use App\Http\Requests\ProductFilterRequest;
use App\Http\Requests\ProductRequest;
use App\Models\Product;

interface ProductRepositoryInterface
{
    public function getById(int $id) :Product;
    public function create(ProductRequest $request);
    public function update(int $id, ProductRequest $request);
    public function getAllOrFilter(ProductFilterRequest $request);
}
