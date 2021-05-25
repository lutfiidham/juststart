<?php

namespace App\Http\Controllers\AccessManagement;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Traits\AllowedAction;
use App\Http\Controllers\Controller;

class DeletedUserController extends Controller
{
    use AllowedAction;

    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        $this->setPrefixPermisionName('access-management.users')->addPermission([
            $this->prefixPermissionName . '.view-deleted'       => ['index', 'datatable',],
            $this->prefixPermissionName . '.delete-permanently' => 'destroyMultiple',
            $this->prefixPermissionName . '.restore-deleted'    => 'restoreMultiple',
        ])->registerPermission();
    }

    public function index()
    {
        return view('access-management.user.deleted.index', ['page_title' => 'Deleted User']);
    }

    public function datatable(Request $request)
    {
        $data = $this->userService->deletedDatatable($request);
        return response()->json(compact('data'), 200);
    }

    public function destroyMultiple(Request $request)
    {
        $this->userService->destroyMultiple($request->only('users'), false);
        return response()->json([], 204);
    }

    public function restoreMultiple(Request $request)
    {
        $this->userService->restoreMultiple($request->only('users'));
        return response()->json([], 204);
    }
}
