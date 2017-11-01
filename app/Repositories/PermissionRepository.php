<?php

namespace App\Repositories;

use App\Contracts\PermissionInterface;
use App\Permission;

class PermissionRepository extends Repository implements PermissionInterface
{
    /**
     * Create new instance of permission repository.
     *
     * @param Permission $permission Permission model
     */
    public function __construct(Permission $permission)
    {
        parent::__construct($permission);
        $this->permission = $permission;
    }
}
