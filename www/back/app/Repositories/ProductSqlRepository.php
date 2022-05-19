<?php


namespace App\Repositories;


use App\Exceptions\NotFoundException;
use App\Http\Requests\ProductFilterRequest;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductSqlRepository implements ProductRepositoryInterface
{

    public function getById(int $id) :Product
    {
        // TODO: Implement getById() method.
        $product = Product::find($id);
        if(!$product) throw new NotFoundException('Product not found');
        return $product;
    }

    public function create(ProductRequest $request)
    {
        // TODO: Implement create() method.
        return $this->createOrUpdate($request);

    }

    public function update($id, ProductRequest $request)
    {
        // TODO: Implement update() method.
        $product = $this->getById($id);
        return $this->createOrUpdate($request, $product);
    }

    public function getAllOrFilter(ProductFilterRequest $request)
    {
        // TODO: Implement getAllOrFilter() method.
        $productBuild = Product::select('products.*')->distinct();

        if($request->name)
            $productBuild->where('products.name', 'like', "%{$request->name}%");

        if($request->price_from || $request->price_to)
            $productBuild->where(function($query) use($request){
                if($request->price_from) $query->where('products.price', '>=', Product::priceFormat($request->price_from, false));
                if($request->price_to) $query->where('products.price', '<=', Product::priceFormat($request->price_to, false));
            });

        if($request->name_shop || $request->date_import)
            $productBuild->join('product_shop', 'product_shop.product_id', '=', 'products.id');

        if($request->date_import)
            $productBuild->where('import', '>', $request->date_import);

        if($request->name_shop)
            $productBuild->join('shops', 'shops.id', '=', 'product_shop.shop_id')
            ->where('shops.name', 'like', "%{$request->name_shop}%");

        $productBuild->orderBy($request->sort ?? 'products.id', $request->desc ? "desc" : 'asc');

        return $productBuild->get();

    }

    private function createOrUpdate(ProductRequest $request, $product = null)
    {
        $product = $product ?? new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->article = $request->article;
        $product->save();

        return $product;
    }
}
