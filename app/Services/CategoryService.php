<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
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

    /**
     * @param   \Illuminate\Http\UploadedFile  $file
     */
    public function handleFileUpload(?UploadedFile $file)
    {
        if (is_null($file)) {
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
            $fileName = $this->handleFileUpload(Arr::get($data, 'image'));
            $data['image'] = $fileName;

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
            $fileName = $this->handleFileUpload(Arr::get($data, 'image'));
            if (!empty($fileName)) {
                $filePath = public_path('images/' .$category->image);
                if(File::exists($filePath))
                {
                    unlink($filePath);
                }
                $data['image'] = $fileName;
            }
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
