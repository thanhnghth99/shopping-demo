<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

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

    public function handleFileUpload(?UploadedFile $file)
    {
        if(is_null($file))
        {
            return null;
        }

        $fileName = date('Y-m-d_H-i-s') . '_' . $file->getClientOriginalName();
        $file->storeAs('images', $fileName);

        return $fileName;
    }

    public function create($data)
    {
        DB::beginTransaction();
        try {
            $product = Product::create($data);
            $product->colors()->sync(Arr::get($data, 'color', []));
            $product->sizes()->sync(Arr::get($data, 'size', []));
            $product->subcategories()->sync(Arr::get($data, 'subcategory', []));
            
            if (!empty($data['image'])) {
                foreach ($data['image'] as $file) {
                    $fileName = $this->handleFileUpload($file);
                    $product->images()->create(['name' => $fileName]);
                }
                $product->save();
            }

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

            if (!empty($data['image'])) {
                $images = $product->images;
                foreach($images as $image)
                {
                    $filePath = public_path('images/' .$image->name);
                    if(File::exists($filePath))
                    {
                        unlink($filePath);
                    }
                    $product->images()->detach();
                    $image->delete();
                }
                foreach($data['image'] as $file) {
                    $fileName = $this->handleFileUpload($file);
                    $product->images()->create(['name' => $fileName]);
                }
                $product->save();
            }

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
