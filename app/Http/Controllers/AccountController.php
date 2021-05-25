<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Traits\AllowedAction;
use App\Http\Requests\Account\UpdateProfileRequest;
use App\Http\Requests\Account\UpdatePasswordRequest;

class AccountController extends Controller
{

    use AllowedAction;

    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        $this->setPrefixPermisionName('profile.')->addPermission([
            $this->prefixPermissionName . 'update' => ['profile', 'updateProfile'],
            $this->prefixPermissionName . 'change-password' => ['changePassword', 'updatePassword'],
        ])->registerPermission();
    }

    public function profile()
    {
        return view('account.profile', ['page_title' => 'Profile', 'user' => auth()->user(),]);
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = $this->userService->update($request->user(), $request->validated());
        return response()->json($user, 200);
    }

    public function changePassword()
    {
        return view('account.change-password', ['page_title' => 'Change Password', 'user' => auth()->user(),]);
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $data = [
            'password' => $request->new_password,
        ];
        $this->userService->update($request->user(), $data);
        return response()->json([], 204);
    }
}
