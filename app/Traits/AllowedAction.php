<?php

namespace App\Traits;

trait AllowedAction
{

    protected $prefixPermissionName;
    protected $permissionList = [];

    protected function resourcePermissionMap()
    {
        return [
            $this->prefixPermissionName . '.view'   => ['index',],
            $this->prefixPermissionName . '.create' => ['create', 'store',],
            $this->prefixPermissionName . '.read'   => ['show',],
            $this->prefixPermissionName . '.update' => ['edit', 'update'],
            $this->prefixPermissionName . '.delete' => ['destroy',],
        ];
    }

    public function setPrefixPermisionName($name)
    {
        $this->prefixPermissionName = $name;
        return $this;
    }

    public function addResourcePermission()
    {
        if (!$this->isPrefixSet()) {
            throw new \Exception("Prefix has not been set");
        }

        $this->permissionList = array_merge_recursive($this->permissionList, $this->resourcePermissionMap());
        return $this;
    }

    public function addPermission($permissionName, $method = null, $withCurrentPrefix = true)
    {
        if (!$this->isPrefixSet()) {
            throw new \Exception("Prefix has not been set");
        }

        if (!is_array($permissionName) && $method == null) {
            throw new \Exception("Method parameter cannot be null");
        }

        if (!is_array($permissionName)) {
            $permissionKey = $withCurrentPrefix ? $this->prefixPermissionName . '.' . $permissionName : $permissionName;
            $permissionName = [$permissionKey => $method];
        }

        $this->permissionList = array_merge_recursive($this->permissionList, $permissionName);
        return $this;
    }

    private function isPrefixSet(): bool
    {
        return !!$this->prefixPermissionName;
    }

    public function registerPermission()
    {
        if (!$this->isPrefixSet()) {
            throw new \Exception("Prefix has not been set");
        }

        foreach ($this->permissionList as $permissionName => $method) {
            $this->middleware('permission:' . $permissionName)->only($method);
        }
    }
}
