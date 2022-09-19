<?php

namespace App\Services;

use App\Models\Size;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SizeService
{
    public function getList(array $filter = [])
    {
        $size = new Size;
        $sizeTable = $size->getTable();
        $query = $size
            ->select("{$sizeTable}.*")
            ->search($filter, ['sizes.name']);
        
        return $query->orderBy('name')->getPaginate($filter);
    }

    public function create($data)
    {
        DB::beginTransaction();
        try {
            $size = Size::create($data);

            DB::commit();

            return $size;
        } catch (\Exception $err) {
            DB::rollBack();
            Log::error($err->getMessage());

            return null;
        }
    }

    public function update($data, Size $size)
    {
        DB::beginTransaction();
        try {
            $size->fill($data)->save();

            DB::commit();

            return $size;
        } catch (\Exception $err) {
            DB::rollBack();
            Log::error($err->getMessage());

            return null;
        }
    }

    public function delete(Size $size)
    {
        $size->delete();
    }
}