<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use App\Services\UserService;

class UserController extends Controller
{
    public function index(UserService $userService, Request $request)
    {
        $this->authorize('can_do', ['user read']);
        $filter = [
            ...$request->query(),
            'paginate' => 10,
        ];
        $users = $userService->getList($filter);
        return view('admin.user.index', compact('users'));
        return view('admin.user.index');
    }

    public function create(Role $role, User $user)
    {
        $this->authorize('can_do', ['user create']);
        $user->all();
        $roles = $role->all();
        return view('admin.user.create', ['roles' => $roles]);
    }

    public function store(StoreUserRequest $request, UserService $userService)
    {
        date_default_timezone_set('asia/ho_chi_minh');
        $user = $userService->create($request->validated());
        if(is_null($user))
        {
            return back()->with('error', 'Failed create.');
        }

        return redirect('/user')
            ->with('success', 'Successfully created.');
    }

    public function edit(User $user, Role $role)
    {
        $this->authorize('can_do', ['user edit']);
        $users = $user->find($user->id);
        $roles = $role->all();
        $dataRoles = $users->roles->pluck('id')->toArray();
        return view('admin.user.edit',['users' => $users, 'roles' => $roles, 'dataRoles' => $dataRoles]);
    }    

    public function update(UpdateUserRequest $request, UserService $userService, User $user)
    {
        date_default_timezone_set('asia/ho_chi_minh');
        $userService->update($request->validated(), $user);     

        return redirect('/user')
            ->with('success', 'Successfully updated.');
    }

    public function destroy(User $user, UserService $userService)
    {
        $userService->delete($user);
        return redirect('/user')
            ->with('success', 'Successfully deleted.');
    } 
    
    public function show()
    {

    }
}
