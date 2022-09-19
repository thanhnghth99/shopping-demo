<?php

namespace App\Services;

use App\Models\Color;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ColorService
{
    public function getList(array $filter = [])
    {
        $color = new Color;
        $colorTable = $color->getTable();
        $query = $color
            ->select("{$colorTable}.*")
            ->search($filter, ['categories.name']);
        
        return $query->orderBy('name')->getPaginate($filter);
    }

    public function create($data)
    {
        DB::beginTransaction();
        try {
            $color = Color::create($data);

            DB::commit();

            return $color;
        } catch (\Exception $err) {
            DB::rollBack();
            Log::error($err->getMessage());

            return null;
        }
    }

    public function update($data, Color $color)
    {
        DB::beginTransaction();
        try {
            $color->fill($data)->save();

            DB::commit();

            return $color;
        } catch (\Exception $err) {
            DB::rollBack();
            Log::error($err->getMessage());

            return null;
        }
    }

    public function delete(Color $color)
    {
        $color->delete();
    }
}