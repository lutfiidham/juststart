<?php

namespace App\Services;

use App\Models\Permission;

class PermissionService extends BaseService
{

    public function __construct(Permission $permission)
    {
        $this->model = $permission;
    }

    public function getAdditionalPermissions()
    {
        return $this->model->whereNull('menu_id')->get();
    }
}
