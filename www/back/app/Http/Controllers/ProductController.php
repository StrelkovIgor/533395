<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductFilterRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Repositories\ProductSqlRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index($id, ProductSqlRepository $productRepository)
    {
        $product = $productRepository->getById($id);
        return response()->json(new ProductResource($product));
    }

    public function getAll(ProductSqlRepository $productRepository, ProductFilterRequest $request)
    {
        return response()->json(
                ProductResource::collection($productRepository->getAllOrFilter($request)
            ));
    }

    public function create(ProductRequest $request, ProductSqlRepository $productRepository)
    {
        $newProduct = $productRepository->create($request);
        return response()->json(new ProductResource($newProduct));
    }

    public function update($id, ProductRequest $request, ProductSqlRepository $productRepository)
    {
        return response()->json(new ProductResource($productRepository->update($id, $request)));

    }

}
