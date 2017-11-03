<?php

namespace App\Repositories;

use App\Contracts\EntrustInterface;
use App\User;
use App\UserRole;

class EntrustRepository implements EntrustInterface
{
    /**
     * Specify the model, change the model if necessary.
     *
     * @var string
     */
    protected $guard = 'admin';

    /**
     * Check if the user has the required role.
     *
     * @param  string/array $roles       Role name
     * @param  boolean      $requiredAll Require all roles
     * @return boolean                   Return true or false
     */
    public function hasRole($roles, $requiredAll = false)
    {
        /*if ($user = auth()->user()) {
            $userRoles = UserRole::with('role')->where('user_id', $user->id)->get();
        }*/

        if (! $userRoles = auth($this->guard)->user()->with('roles')->first()) {
            return false;
        }

        if (is_array($roles)) {
            foreach ($roles as $role) {
                $hasRole = $this->hasRole($role);

                if ($hasRole && !$requiredAll) {
                    return true;
                } elseif (! $hasRole && $requiredAll) {
                    return false;
                }
            }

            return $requiredAll;
        } else {
            foreach ($userRoles->roles as $userRole) {
                if ($userRole->name == $roles) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Check if the user has the required permission.
     *
     * @param  string/array $permissions Permission name
     * @param  boolean      $requiredAll Require all permissions
     * @return boolean                   Return true or false
     */
    public function hasPermission($permissions, $requiredAll = false)
    {
        if ($user = auth()->user()) {
            $userRoles = UserRole::with('permissions')->where('user_id', $user->id)->get();
        }

        if (is_array($permissions)) {
            foreach ($permissions as $permission) {
                $hasPermission = $this->hasRole($permission);

                if ($hasPermission && !$requiredAll) {
                    return true;
                } elseif (! $hasPermission && $requiredAll) {
                    return false;
                }
            }

            return $requiredAll;
        } else {
            foreach ($userRoles as $userRole) {
                foreach ($userRole->permissions as $permission) {
                    if ($permission->name == $permissions) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    /**
     * Check if the user has the required role and permission.
     *
     * @param  string/array $roles       Role Name
     * @param  string/array $permissions Permission Name
     * @param  boolean      $requiredAll Require all roles and permissions
     * @return boolean                   Return true or false
     */
    public function hasAbility($roles, $permissions, $requiredAll = false)
    {
        $checkedRoles = [];
        $checkedPermissions = [];

        if (is_array($roles)) {
            foreach ($roles as $role) {
                $checkedRoles[$role] = $this->hasRole($role);
            }
        }

        if (is_array($permissions)) {
            foreach ($permissions as $permission) {
                $checkedPermissions[$permission] = $this->hasRole($permission);
            }
        }

        if (($requiredAll && !(in_array(false, $checkedRoles) || in_array(false, $checkedPermissions))) ||
            (! $requiredAll && (in_array(true, $checkedRoles) || in_array(true, $checkedPermissions)))) {
            return true;
        }

        return false;
    }

    /**
     * Check if the user has the required department.
     *
     * @param  string  $department Department code
     * @return boolean             Return true or false
     */
    public function hasDepartment($department)
    {
        if ($user = auth()->user()) {
            $userDepartment = User::with('department')->where('id', $user->id)->first();
        }

        if ($userDepartment->department->code == $department) {
            return true;
        }

        return false;
    }
}
