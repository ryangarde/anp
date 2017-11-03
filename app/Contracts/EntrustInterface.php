<?php

namespace App\Contracts;

interface EntrustInterface
{
    /**
     * Check if the user has the required role.
     *
     * @param  string/array  $roles       Role name
     * @param  boolean       $requiredAll Require all roles
     * @return boolean                    Return true or false
     */
    public function hasRole($roles, $requiredAll = false);

    /**
     * Check if the user has the required permission.
     *
     * @param  string/array  $permissions Permission name
     * @param  boolean       $requiredAll Require all permissions
     * @return boolean                    Return true or false
     */
    public function hasPermission($permissions, $requiredAll = false);

    /**
     * Check if the user has the required role and permission.
     *
     * @param  string/array  $roles       Role Name
     * @param  string/array  $permissions Permission Name
     * @param  boolean       $requiredAll Require all roles and permissions
     * @return boolean                    Return true or false
     */
    public function hasAbility($roles, $permissions, $requiredAll = false);

    /**
     * Check if the user has the required department.
     *
     * @param  string  $department Department code
     * @return boolean             Return true or false
     */
    public function hasDepartment($department);
}
