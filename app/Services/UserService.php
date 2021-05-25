<?php

namespace App\Services;

use App\Models\Menu;
use App\Models\User;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Services\BaseService;
use App\Models\DocumentDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Exceptions\GeneralException;
use App\Notifications\SubmitTransactionNotification;
use App\Notifications\VerifyTransactionNotification;

class UserService extends BaseService
{

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function getUserMenu(User $user): array
    {
        $menus = Menu::with('submenu')->byUser($user)->whereNull('menu_parent_id')->orderBy('sequence')->get()->unique()->toArray();
        return $menus;
    }

    public function searchUserMenu(User $user, $keyword)
    {
        $menus = Menu::select('menus.*', 'parent.title as parent_title')->byUser($user)->leftJoin('menus as parent', 'menus.menu_parent_id', '=', 'parent.id')->whereRaw("lower(menus.title) like ?", [('%' . strtolower($keyword) . '%')])->doesntHave('children')->orderBy('title')->get()->unique();
        return $menus;
    }

    public function datatable(Request $request): array
    {
        $users = $this->model->with('roles:name')
            ->when($request->user()->id != 1, function ($query) {
                $query->where('id', '!=', 1);
            })
            ->get();
        $data = [];
        foreach ($users as $key => $user) {
            $data[$key]['no']                  = $key + 1;
            $data[$key]['id']                  = $user->id;
            $data[$key]['name']                = $user->name;
            $data[$key]['email']               = $user->email;
            $data[$key]['roles']               = $user->roles;
            $data[$key]['active']              = $user->active;
            $data[$key]['edit_url']            = route('access_management.users.edit', ['user' => $user]);
            $data[$key]['show_url']            = route('access_management.users.show', ['user' => $user]);
            $data[$key]['delete_url']          = route('access_management.users.destroy', ['user' => $user]);
            $data[$key]['change_password_url'] = route('access_management.users.change_password', ['user' => $user]);
        }
        return $data;
    }

    public function deletedDatatable(Request $request): array
    {
        $users = $this->model->with('roles:name')->onlyTrashed()->get();
        $data = [];
        foreach ($users as $key => $user) {
            $data[$key]['no']                  = $key + 1;
            $data[$key]['id']                  = $user->id;
            $data[$key]['name']                = $user->name;
            $data[$key]['email']               = $user->email;
            $data[$key]['roles']               = $user->roles;
        }
        return $data;
    }

    public function store($data): User
    {
        DB::beginTransaction();

        try {
            $user = $this->model->create($data);
            $user->roles()->sync($data['roles']);
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error($e->getMessage());

            throw new GeneralException(__('There was a problem creating the user.'));
        }

        DB::commit();

        return $user;
    }

    public function update(User $user, $data): User
    {
        if (auth()->user()->id != 1 && $user->id == 1) { //jika yang login bukan superadmin dan mau mengubah superadmin
            throw new GeneralException(__('Cannot update Super Admin user.'));
        }

        DB::beginTransaction();

        try {
            $user->update($data);
            if (isset($data['roles'])) {
                $user->roles()->sync($data['roles']);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error($e->getMessage());

            throw new GeneralException(__('There was a problem updating the user.'));
        }

        DB::commit();

        return $user;
    }

    public function destroy(User $user, $softDelete = true)
    {
        if ($user->id == 1) {
            throw new GeneralException(__('Cannot delete Super Admin user.'));
        }

        if ($user->id == auth()->user()->id) {
            throw new GeneralException(__('Cannot delete yourself.'));
        }

        DB::beginTransaction();

        try {
            if (!$softDelete) {
                $user->roles()->detach();
                $user->forceDelete();
                DB::commit();
                return;
            }

            $user->delete();
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error($e->getMessage());

            throw new GeneralException(__('There was a problem deleting the user.'));
        }

        DB::commit();
    }

    public function destroyMultiple($data, $softDelete = true)
    {
        if (in_array(1, $data['users'])) {
            throw new GeneralException(__('Cannot delete Super Admin user.'));
        }

        if (in_array(auth()->user()->id, $data['users'])) {
            throw new GeneralException(__('Cannot delete yourself.'));
        }

        DB::beginTransaction();

        try {
            $users = $this->model->when(!$softDelete, function ($query) {
                $query->withTrashed();
            })->whereIn('id', $data['users'])->get();

            foreach ($users as $user) {
                if (!$softDelete) {
                    $user->roles()->detach();
                    $user->forceDelete();
                    continue;
                }

                $user->delete();
            }
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error($e->getMessage());

            throw new GeneralException(__('There was a problem deleting the user.'));
        }
        DB::commit();
    }

    public function restoreMultiple($data)
    {
        DB::beginTransaction();

        try {
            $users = $this->model->onlyTrashed()->whereIn('id', $data['users'])->get();

            foreach ($users as $user) {
                $user->restore();
            }
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error($e->getMessage());

            throw new GeneralException(__('There was a problem restoring the user.'));
        }

        DB::commit();
    }

    public function deactivateMultiple($data)
    {
        if (in_array(1, $data['users'])) {
            throw new GeneralException(__('Cannot deactivate Super Admin.'));
        }

        if (in_array(auth()->user()->id, $data['users'])) {
            throw new GeneralException(__('Cannot deactivate yourself.'));
        }

        $this->model->whereIn('id', $data['users'])->update(['active' => false]);
    }

    public function reactivateMultiple($data)
    {
        $this->model->whereIn('id', $data['users'])->update(['active' => true]);
    }

    public function updatePassword(User $user, $data)
    {
        if (auth()->user()->id != 1 && $user->id == 1) { //jika yang login bukan superadmin dan mau mengubah password superadmin
            throw new GeneralException(__('Cannot change Super Admin password.'));
        }

        return $this->update($user, $data);
    }
}
