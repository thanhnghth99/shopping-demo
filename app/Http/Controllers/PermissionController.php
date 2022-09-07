<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index(Permission $permissions)
    {
        $permissions = $permissions->paginate(10);
        return view('admin.permission.index', compact('permissions'));
    }

    public function create(Permission $permission)
    {
        $permission->all();
        return view('admin.permission.create');
    }

    public function store(Request $request)
    {
        date_default_timezone_set('asia/ho_chi_minh');
        $data = $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        Permission::create($data);
        return redirect('/permission')
            ->with('success', 'Successfully created.');
    }

    public function show()
    {
        
    }
}
