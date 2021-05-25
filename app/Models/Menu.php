<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    protected $fillable = ['name', 'description', 'url', 'icon', 'menu_parent_id'];

    function scopeByUser($query, User $user)
    {
        $roleId = $user->roles->pluck('id')->toArray();
        return $query->distinct()->join('menu_role', 'menus.id', '=', 'menu_role.menu_id')->whereIn('menu_role.role_id', $roleId);
    }

    public function children()
    {
        return $this->hasMany(__CLASS__, 'menu_parent_id')->orderBy('sequence')->with(['children', 'permissions']);
    }

    public function submenu()
    {
        return $this->hasMany(__CLASS__, 'menu_parent_id')->orderBy('sequence')->byUser(auth()->user())->with('submenu');
    }

    public function parent()
    {
        return $this->belongsTo(__CLASS__, 'menu_parent_id')->orderBy('sequence')->with('parent');
    }

    public function parentByUser()
    {
        return $this->belongsTo(__CLASS__, 'menu_parent_id')->orderBy('sequence')->byUser(auth()->user())->with('parentByUser');
    }

    public function permissions()
    {
        return $this->hasMany(\App\Models\Permission::class);
    }

    public function roles()
    {
        return $this->belongsToMany(\App\Models\Role::class);
    }
}
