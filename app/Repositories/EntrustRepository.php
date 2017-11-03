<?php

namespace App\Repositories;

use App\Contracts\EntrustInterface;

class EntrustRepository implements EntrustInterface
{
    /**
     * Specify the model, leave blank for default guard.
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
        $userRoles = auth($this->guard)->user()->with('roles')->first();

        if (count($userRoles->roles) == 0) {
            return false;
        }

        if (is_array($roles)) {
            foreach ($roles as $role) {
                $hasRole = $this->hasRole($role);

                if ($hasRole && ! $requiredAll) {
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
        $userRoles = auth($this->guard)->user()->with([
                            'roles' => function ($query) {
                                $query->with('permissions');
                            }
                        ])->first();

        if (count($userRoles->roles) == 0) {
            return false;
        }

        if (is_array($permissions)) {
            foreach ($permissions as $permission) {
                $hasPermission = $this->hasPermission($permission);

                if ($hasPermission && ! $requiredAll) {
                    return true;
                } elseif (! $hasPermission && $requiredAll) {
                    return false;
                }
            }

            return $requiredAll;
        } else {
            foreach ($userRoles->roles as $userRole) {
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

        if (($requiredAll && ! (in_array(false, $checkedRoles) || in_array(false, $checkedPermissions))) ||
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
