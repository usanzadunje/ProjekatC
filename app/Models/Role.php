<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Role whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
