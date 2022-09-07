<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::insert([
            ['name' => 'permission read', 'status' => Permission::STATUS_ENABLE],
            ['name' => 'permission create', 'status' => Permission::STATUS_ENABLE],
            ['name' => 'permission edit', 'status' => Permission::STATUS_ENABLE],
            ['name' => 'permission delete', 'status' => Permission::STATUS_ENABLE],
            ['name' => 'role read', 'status' => Permission::STATUS_ENABLE],
            ['name' => 'role create', 'status' => Permission::STATUS_ENABLE],
            ['name' => 'role edit', 'status' => Permission::STATUS_ENABLE],
            ['name' => 'role delete', 'status' => Permission::STATUS_ENABLE],
            ['name' => 'user read', 'status' => Permission::STATUS_ENABLE],
            ['name' => 'user create', 'status' => Permission::STATUS_ENABLE],
            ['name' => 'user edit', 'status' => Permission::STATUS_ENABLE],
            ['name' => 'user delete', 'status' => Permission::STATUS_ENABLE],
        ]);
    }
}
