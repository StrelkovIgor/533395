<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShopProductFilterRequest;
use App\Http\Resources\ProductResource;
use App\Repositories\ShopSqlRepository;

class ShopController extends Controller
{

    public function getProduct($id, ShopProductFilterRequest $productRepository, ShopSqlRepository $shopRepository)
    {
        $products = $shopRepository->getProductByFilter($id, $productRepository);
        return response()->json(ProductResource::collection($products));
    }

}
