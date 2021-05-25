<?php

namespace App\Http\Controllers\AccessManagement;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\RoleService;
use App\Services\UserService;
use App\Traits\AllowedAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\AccessManagement\User\ChangePasswordRequest;
use App\Http\Requests\AccessManagement\User\StoreUserRequest;
use App\Http\Requests\AccessManagement\User\UpdateUserRequest;

class UserController extends Controller
{
    use AllowedAction;

    private $userService, $roleService;

    public function __construct(UserService $userService, RoleService $roleService)
    {
        $this->userService = $userService;
        $this->roleService = $roleService;
        $this->setPrefixPermisionName('access-management.users')->addResourcePermission()->addPermission([
            $this->prefixPermissionName . '.view'            => 'datatable',
            $this->prefixPermissionName . '.delete'          => 'destroyMultiple',
            $this->prefixPermissionName . '.deactivate'      => 'deactivateMultiple',
            $this->prefixPermissionName . '.reactivate'      => 'reactivateMultiple',
            $this->prefixPermissionName . '.change-password' => ['changePassword', 'updatePassword',],
        ])->registerPermission();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('access-management.user.index')->with(['page_title' => __('Users')]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatable(Request $request)
    {
        $data = $this->userService->datatable($request);
        return response()->json(compact('data'), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->roleService->getAllRoles();
        return view('access-management.user.create')->with(['page_title' => __('Create User'), 'roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $user = $this->userService->store($request->validated());
        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        abort_if(auth()->user()->id != 1 && $user->id == 1, 403, __('You cannot view Super Admin detail'));

        return view('access-management.user.show')->with(['page_title' => __('User Detail'), 'user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        abort_if(auth()->user()->id != 1 && $user->id == 1, 403, __('You cannot edit Super Admin detail')); //jika yang login bukan superadmin dan mau mengubah superadmin

        $roles = $this->roleService->getAllRoles();
        $grantedRoles = $user->roles->pluck('id')->toArray();
        return view('access-management.user.edit')->with(['page_title' => __('Edit User'), 'user' => $user, 'roles' => $roles, 'grantedRoles' => $grantedRoles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user = $this->userService->update($user, $request->validated());
        return response()->json($user, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->userService->destroy($user);
        return response()->json([], 204);
    }

    public function destroyMultiple(Request $request)
    {
        $this->userService->destroyMultiple($request->only('users'));
        return response()->json([], 204);
    }

    public function deactivateMultiple(Request $request)
    {
        $this->userService->deactivateMultiple($request->only('users'));
        return response()->json([], 204);
    }

    public function reactivateMultiple(Request $request)
    {
        $this->userService->reactivateMultiple($request->only('users'));
        return response()->json([], 204);
    }

    public function changePassword(User $user)
    {
        abort_if(auth()->user()->id != 1 && $user->id == 1, 403, __('You cannot change Super Admin password'));
        abort_if($user->from_api, 403, __('Cannot change password user from Petrokimia API'));

        return view('access-management.user.change-password')->with(['page_title' => __('Change User Password'), 'user' => $user,]);
    }

    public function updatePassword(ChangePasswordRequest $request, User $user)
    {
        $user = $this->userService->updatePassword($user, $request->validated());
        return response()->json($user, 200);
    }
}
