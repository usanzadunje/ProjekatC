<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasRole
{
    /**
     * Accessor for role_id attribute for readability purposes.
     *
     * @return Attribute
     */
    public function role(): Attribute {
        return new Attribute(
            get: fn() => $this->role_id,
        );
    }

    /**
     * Checks if resource has certain role. Best used with Role model constants
     * e.g. Role::ADMIN
     *
     * @param int $role
     * @return bool
     */
    public function hasRole(int $role): bool {
        return $this->role === $role;
    }

    /**
     * Changes role for the current resource.
     *
     * @param int $role
     * @return bool
     */
    public function changeRole(int $role): bool {
        return $this->update(['role_id' => $role]);
    }
}