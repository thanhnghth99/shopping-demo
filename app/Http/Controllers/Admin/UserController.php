<?php

namespace App\Http\Controllers\Admin;

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
    }

    public function create(Role $role)
    {
        $this->authorize('can_do', ['user create']);
        $roles = $role->all();
        return view('admin.user.create', compact('roles'));
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
        $users = $user->with('roles')->find($user->id)->toArray();
        $roles = $role->all();

        return view('admin.user.edit',['users' => $users, 'roles' => $roles]);
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
        $this->authorize('can_do', ['user delete']);
        $userService->delete($user);
        return redirect('/user')
            ->with('success', 'Successfully deleted.');
    } 
    
    public function show()
    {

    }
}
