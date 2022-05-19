<?php


namespace App\Repositories;

use App\Exceptions\NotFoundException;
use App\Http\Requests\ShopProductFilterRequest;
use App\Models\Shop;
use App\Repositories\Interfaces\ShopRepositoryInterface;

class ShopSqlRepository implements ShopRepositoryInterface
{


    public function getById(int $id): Shop
    {
        // TODO: Implement getById() method.
        $shop = Shop::find($id);
        if(!$shop) throw new NotFoundException('Shop not found');
        return $shop;
    }

    public function getProductByFilter($id ,ShopProductFilterRequest $request)
    {
        // TODO: Implement getProductByFilter() method.
        $shop = $this->getById($id);
        $productBuild = $shop->products();

        if($request->name)
            $productBuild->where('name', 'like', "%{$request->name}%");

        if($request->price_from || $request->price_to)
            $productBuild->where(function($query) use($request){
                if($request->price_from) $query->where('products.price', '>=', Product::priceFormat($request->price_from, false));
                if($request->price_to) $query->where('products.price', '<=', Product::priceFormat($request->price_to, false));
            });

        if($request->date_import)
            $productBuild->wherePivot('import', '>', $request->date_import);

        if($request->sort)
            foreach($request->sort as $key => $sort)
                $productBuild->orderBy($sort, isset($request->desc[$key]) && $request->desc[$key] ? "desc" : 'asc');

        return $productBuild->get();
    }
}
