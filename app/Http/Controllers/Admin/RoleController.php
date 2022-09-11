<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Services\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(RoleService $roleService, Request $request)
    {
        $this->authorize('can_do', ['role read']);
        $filter = [
            ...$request->query(),
            'paginate' => 10,
        ];
        $roles = $roleService->getList($filter);
        return view('admin.role.index', compact('roles'));
    }

    public function create()
    {
        $this->authorize('can_do', ['role create']);
        $permissions = Permission::all();
        return view('admin.role.create', compact('permissions'));
    }

    public function store(StoreRoleRequest $request, RoleService $roleService)
    {
        date_default_timezone_set('asia/ho_chi_minh');
        $role = $roleService->create($request->validated());
        if(is_null($role))
        {
            return back()->with('error', 'Failed create.');
        }

        return redirect('/role')
            ->with('success', 'Successfully created.');
    }

    public function edit($id)
    {
        $this->authorize('can_do', ['role edit']);
        $roles = Role::with('permissions')->find($id)->toArray();
        $permissions = Permission::all();
        
        return view('admin.role.edit',['roles' => $roles, 'permissions' => $permissions]);
    }    

    public function update(UpdateRoleRequest $request, Role $role, RoleService $roleService)
    {
        date_default_timezone_set('asia/ho_chi_minh');

        $roleService->update($request->validated(), $role);
        
        return redirect('/role')
            ->with('success', 'Successfully updated.');
    }

    public function destroy(Role $role, RoleService $roleService)
    {
        $this->authorize('can_do', ['role delete']);
        $roleService->delete($role);
        return redirect('/role')
            ->with('success', 'Successfully deleted.');
    } 
    
    public function show()
    {

    }
}
