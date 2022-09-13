<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryService
{
    public function getList(array $filter = [])
    {
        $category = new Category;
        $categoryTable = $category->getTable();
        $query = $category
            ->select("{$categoryTable}.*")
            ->search($filter, ['categories.name']);
        
        return $query->orderBy('name')->getPaginate($filter);
    }

    public function create($data)
    {
        DB::beginTransaction();
        try {
            $category = Category::create($data);

            DB::commit();

            return $category;
        } catch (\Exception $err) {
            DB::rollBack();
            Log::error($err->getMessage());

            return null;
        }
    }

    public function update($data, Category $category)
    {
        DB::beginTransaction();
        try {
            $category->fill($data)->save();

            DB::commit();

            return $category;
        } catch (\Exception $err) {
            DB::rollBack();
            Log::error($err->getMessage());

            return null;
        }
    }

    public function delete(Category $category)
    {
        $category->delete();
    }
}