<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\Permission;
use Str;

class MenuPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sequence = 1;
        $this->createMenuPermission(['title'    => 'Home', 'page'     => 'home', 'icon'     => 'fa fa-home', 'sequence' => $sequence++,], ['V']);
        $this->accessMenu($sequence++);
    }

    private function accessMenu($parentSequence)
    {
        $menu = $this->createMenuPermission(['title'    => 'Access Management', 'page'     => '#', 'icon'     => 'fa fa-key', 'sequence' => $parentSequence,]);

        $childSequence = 1;
        $this->createMenuPermission(['title' => 'Role', 'page' => 'access-management/roles', 'sequence' => $childSequence++, 'menu_parent_id' => $menu->id], ['*']);
        $this->createMenuPermission(['title' => 'User', 'page' => 'access-management/users', 'sequence' => $childSequence++, 'menu_parent_id' => $menu->id], ['*'], ['change-password', 'deactivate', 'reactivate', 'view-deleted', 'delete-permanently', 'restore-deleted']);
    }

    /**
     * createMenuPermission
     *
     * @param  array $data
     * @param  array $basePermission
     * @param  array $additionalPermission
     * @return void
     */
    private function createMenuPermission(array $data, array $basePermission = [], array $additionalPermission = []): Menu
    {
        $menu = Menu::create($data);

        $basePermissionMaps = [
            'V' => 'View',
            'C' => 'Create',
            'R' => 'Read',
            'U' => 'Update',
            'D' => 'Delete',
        ];

        if (in_array('*', $basePermission)) {
            $basePermission  = ['V', 'C', 'R', 'U', 'D'];
        } else if (!in_array('V', $basePermission) && count($basePermission) > 0) {
            //jika developer lupa kasih permission "V / View" ke sebuah menu, maka otomatis disisipkan permission View
            $basePermission = array_merge(['V'], $basePermission);
        }


        $prefixPermissionName = Str::of($menu->page)->replace('/', '.')->lower();

        foreach ($basePermission as $permission) {
            $menu->permissions()->save(new Permission([
                'name'        => $prefixPermissionName . '.' . strtolower($basePermissionMaps[$permission]),
                'description' => $basePermissionMaps[$permission] . ' ' . $menu->title,
            ]));
        }

        foreach ($additionalPermission as $permission) {
            $menu->permissions()->save(new Permission([
                'name' => $prefixPermissionName . '.' . $permission,
                'description' => Str::of($permission)->replace('-', ' ')->title() . ' ' . $menu->title,
            ]));
        }

        return $menu;
    }
}
