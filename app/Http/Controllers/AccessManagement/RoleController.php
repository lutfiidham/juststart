<?php

namespace App\Http\Controllers\AccessManagement;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Services\MenuService;
use App\Services\RoleService;
use App\Traits\AllowedAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\AccessManagement\Role\StoreRoleRequest;
use App\Http\Requests\AccessManagement\Role\UpdateRoleRequest;
use App\Services\PermissionService;

class RoleController extends Controller
{
    use AllowedAction;

    private $roleService, $menuService, $permissionService;

    public function __construct(RoleService $roleService, MenuService $menuService, PermissionService $permissionService)
    {
        $this->roleService = $roleService;
        $this->menuService = $menuService;
        $this->permissionService = $permissionService;
        $this->setPrefixPermisionName('access-management.roles')->addResourcePermission()->addPermission('view', 'datatable')->addPermission('delete', 'destroyMultiple')->registerPermission();
    }

    /**
     * Display view listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('access-management.role.index')->with(['page_title' => __('Role')]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatable(Request $request)
    {
        $data = $this->roleService->datatable($request);
        return response()->json(compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = $this->menuService->getStructuredMenu();
        $additionalPermissions = $this->permissionService->getAdditionalPermissions();
        return view('access-management.role.create')->with(['page_title' => __('Create Role'), 'menus' => $menus, 'additionalPermissions' => $additionalPermissions,]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        $role = $this->roleService->store($request->validated());
        return response()->json($role, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('access-management.role.show')->with(['page_title' => __('Role Detail'), 'role' => $role]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $role->load(['menus:id', 'permissions:id']);
        $grantedMenus = $role->menus->pluck('id');
        $grantedPermissions = $role->permissions->pluck('id');
        $menus = $this->menuService->getStructuredMenu();
        $additionalPermissions = $this->permissionService->getAdditionalPermissions();

        return view('access-management.role.edit')->with(['page_title' => 'Edit Role', 'role' => $role, 'menus' => $menus, 'grantedMenus' => $grantedMenus, 'grantedPermissions' => $grantedPermissions, 'additionalPermissions' => $additionalPermissions,]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $role = $this->roleService->update($role, $request->validated());
        return response()->json($role, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $this->roleService->destroy($role);
        return response()->json([], 204);
    }

    public function destroyMultiple(Request $request)
    {
        $this->roleService->destroyMultiple($request->only('roles'));
        return response()->json([], 204);
    }
}
