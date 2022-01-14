<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name'];

    const ADMIN = 1;

    const STAFF = 2;

    const REGULAR = 3;

    /**
     * Returns integer number (ID) of role passed by its name or null if it does not exist.
     *
     * @param string $role
     * @return int|null
     */
    public static function getRoleIdFromName(string $role): int|null {
        return static::where('name', 'like', $role)->value('id');
    }
}
