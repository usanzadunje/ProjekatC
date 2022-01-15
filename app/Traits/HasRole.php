<?php

namespace App\Traits;

use App\Models\Role;
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
     * Checks if resource has certain role.
     *
     * @param int|string $role
     * @return bool
     */
    public function hasRole(int|string $role): bool {
        if(is_string($role)) {
            $role = Role::getRoleIdFromName($role);
        }

        return $this->role === (int)$role;
    }

    /**
     * Checks if resource has any of the provided roles.
     *
     * @param array $roles
     * @return bool
     */
    public function hasAnyRole(array $roles): bool {
        foreach($roles as $role){
            $role = is_string($role) ? Role::getRoleIdFromName($role) : $role;

            if($this->role !== (int)$role) {
                continue;
            }

            return true;
        }

        return false;
    }

    /**
     * Changes role for the current resource.
     * Returns false if role does not exist or something wrong happened during update action.
     *
     * @param int|string $role
     * @return bool
     */
    public function changeRole(int|string $role): bool {
        if(is_string($role)) {
            $role = Role::getRoleIdFromName($role);
        }

        if(!Role::where('id', $role)->exists()) {
            return false;
        }

        return $this->update(['role_id' => $role]);
    }
}