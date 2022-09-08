<?php

namespace App\Http\Controllers;

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

    public function create(Permission $permission, Role $role)
    {
        $this->authorize('can_do', ['role create']);
        $role->all();
        $permissions = $permission->all();
        return view('admin.role.create', ['permissions' => $permissions]);
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

    public function edit(Role $role, Permission $permission)
    {
        $this->authorize('can_do', ['role edit']);
        $roles = $role->find($role->id);
        $permissions = $permission->all();
        $dataPermissions = $roles->permissions->pluck('id')->toArray();

        return view('admin.role.edit',['roles' => $roles, 'permissions' => $permissions, 'dataPermissions' => $dataPermissions]);
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
