<?php

namespace App\Services;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Exceptions\GeneralException;

class RoleService extends BaseService
{

    public function __construct(Role $role)
    {
        $this->model = $role;
    }

    public function store($data): Role
    {
        DB::beginTransaction();

        try {
            $role = $this->model->create($data);
            $role->menus()->sync($data['menus']);
            $role->permissions()->sync($data['permissions']);
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error($e->getMessage());

            throw new GeneralException(__('There was a problem creating the role.'));
        }

        DB::commit();

        return $role;
    }

    public function update(Role $role, $data): Role
    {
        DB::beginTransaction();

        try {
            $role->update($data);
            $role->menus()->sync($data['menus']);
            $role->permissions()->sync($data['permissions']);
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error($e->getMessage());

            throw new GeneralException(__('There was a problem updating the role.'));
        }

        DB::commit();

        return $role;
    }

    public function destroy(Role $role): bool
    {
        if ($role->id == 1) {
            throw new GeneralException(__('Cannot delete Super Admin Role'));
        }
        if ($role->users()->count() > 0) {
            throw new GeneralException(__('Cannot delete a role with associated users.'));
        }

        DB::beginTransaction();

        try {
            $role->menus()->detach();
            $role->permissions()->detach();
            $delete = $role->delete();
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error($e->getMessage());

            throw new GeneralException(__('There was a problem deleting the role.'));
        }

        DB::commit();

        return $delete;
    }

    public function destroyMultiple($data)
    {
        if (in_array(1, $data['roles'])) {
            throw new GeneralException(__('Cannot delete Super Admin Role.'));
        }

        DB::beginTransaction();

        try {
            $roles = $this->model->whereIn('id', $data['roles'])->withCount('users')->get();
            foreach ($roles as $role) {
                if ($role->users_count > 0) {
                    throw new GeneralException(__('Cannot delete a role with associated users.'));
                }
                $role->menus()->detach();
                $role->permissions()->detach();
                $role->delete();
            }
        } catch (GeneralException $e) {
            DB::rollBack();

            throw new GeneralException($e->getMessage());
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error($e->getMessage());

            throw new GeneralException(__('There was a problem deleting the role.'));
        }

        DB::commit();
    }

    public function getAllRoles()
    {
        return $this->model->when(auth()->user()->id != 1, function ($query) {
            $query->where('id', '!=', 1);
        })->get();
    }

    public function datatable(Request $request): array
    {
        $roles = $this->model->when($request->user()->id != 1, function ($query) {
            $query->where('id', '!=', 1);
        })->withCount('users')->get();
        $data = [];
        foreach ($roles as $key => $role) {
            $data[$key]['no']          = $key + 1;
            $data[$key]['id']          = $role->id;
            $data[$key]['name']        = $role->name;
            $data[$key]['users_count'] = $role->users_count;
            $data[$key]['edit_url']    = route('access_management.roles.edit', ['role' => $role]);
            $data[$key]['show_url']    = route('access_management.roles.show', ['role' => $role]);
            $data[$key]['delete_url']  = route('access_management.roles.destroy', ['role' => $role]);
        }
        return $data;
    }
}
