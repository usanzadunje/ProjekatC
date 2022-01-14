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
     * Checks if resource has certain role. Best used with Role model constants
     * e.g. Role::ADMIN
     *
     * @param int|string $role
     * @return bool
     */
    public function hasRole(int|string $role): bool {
        if(is_string($role)) {
            $role = $this->getRoleIdFromName($role);
        }

        return $this->role === (int)$role;
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
            $role = $this->getRoleIdFromName($role);
        }

        if(!$this->roleExists($role)) {
            return false;
        }

        return $this->update(['role_id' => $role]);
    }

    /**
     * Returns integer number (ID) of role passed by its name or null if it does not exist.
     *
     * @param string $role
     * @return int|null
     */
    private function getRoleIdFromName(string $role): int|null {
        return Role::where('name', 'like', $role)->value('id');
    }

    /**
     * Checks whether passed role is existing in database table 'role'.
     *
     * @param int|null $role
     * @return bool
     */
    public function roleExists(int|null $role): bool {
        $existingRoles = Role::pluck('id')->toArray();

        return in_array($role, $existingRoles);
    }
}