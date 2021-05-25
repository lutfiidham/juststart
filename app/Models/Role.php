<?php

namespace App\Models;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use LogsActivity;

    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    protected $fillable = ['name', 'guard_name'];

    public function menus()
    {
        return $this->belongsToMany(\App\Models\Menu::class);
    }
}
