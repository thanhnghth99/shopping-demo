<?php

namespace App\Services;

use App\Models\SubCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SubCategoryService
{
    public function getList(array $filter = [])
    {
        $subCategory = new SubCategory;
        $subCategoryTable = $subCategory->getTable();
        $query = $subCategory
            ->select("{$subCategoryTable}.*")
            ->search($filter, ['sub_categories.name']);
        
        return $query->orderBy('name')->getPaginate($filter);
    }

    public function create($data)
    {
        DB::beginTransaction();
        try {
            $subCategory = SubCategory::create($data);

            DB::commit();

            return $subCategory;
        } catch (\Exception $err) {
            DB::rollBack();
            Log::error($err->getMessage());

            return null;
        }
    }

    public function update($data, SubCategory $subCategory)
    {
        DB::beginTransaction();
        try {
            $subCategory->fill($data)->save();

            DB::commit();

            return $subCategory;
        } catch (\Exception $err) {
            DB::rollBack();
            Log::error($err->getMessage());

            return null;
        }
    }

    public function delete($id)
    {
        SubCategory::destroy($id);
    }
}