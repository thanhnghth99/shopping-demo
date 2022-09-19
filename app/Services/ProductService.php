<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductService
{
    public function getList(array $filter = [])
    {
        $product = new Product();
        $productTable = $product->getTable();
        $query = $product
            ->select("{$productTable}.*")
            ->search($filter, ['products.name']);

        return $query->getPaginate($filter);
    }

    public function create($data)
    {
        DB::beginTransaction();
        try {
            $product = Product::create($data);
            $product->colors()->sync(Arr::get($data, 'color', []));
            $product->sizes()->sync(Arr::get($data, 'size', []));
            $product->subcategories()->sync(Arr::get($data, 'subcategory', []));

            DB::commit();

            return $product;
        } catch (\Exception $err) {
            DB::rollBack();
            Log::error($err->getMessage());

            return null;
        }
    }

    public function update($data, Product $product)
    {
        DB::beginTransaction();
        try {
            $product->fill($data)->save();
            $product->colors()->sync(Arr::get($data, 'color', []));
            $product->sizes()->sync(Arr::get($data, 'size', []));
            $product->subcategories()->sync(Arr::get($data, 'subcategory', []));

            DB::commit();

            return $product;
        } catch (\Exception $err) {
            DB::rollBack();
            Log::error(($err->getMessage()));

            return null;
        }
    }

    public function delete(Product $product)
    {
        $product->colors()->detach();
        $product->sizes()->detach();
        $product->subcategories()->detach();
        $product->delete();
    }
}
