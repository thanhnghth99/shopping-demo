<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        $this->authorize('can_do', ['permission read']);
        $permissions = Permission::paginate(10);
        return view('admin.permission.index', compact('permissions'));
    }

    public function create()
    {
        $this->authorize('can_do', ['permission create']);
        Permission::all();
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
