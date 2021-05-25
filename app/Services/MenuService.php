<?php

namespace App\Services;

use App\Models\Menu;

class MenuService extends BaseService
{

    public function __construct(Menu $menu)
    {
        $this->model = $menu;
    }

    public function getStructuredMenu()
    {
        return $this->where('menu_parent_id', null)->orderBy('sequence')->with(['children', 'permissions'])->get();
    }
}
