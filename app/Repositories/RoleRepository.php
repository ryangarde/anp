<?php

namespace App\Repositories;

use App\Contracts\RoleInterface;
use App\Contracts\PermissionInterface as PermissionObject;
use App\Role;

class RoleRepository extends Repository implements RoleInterface
{
    /**
     * Permission object.
     *
     * @var App\Contracts\PermissionInterface
     */
    protected $permission;

    /**
     * Create new instance of role repository.
     *
     * @param PermissionObject $permission Permission interface
     * @param Role             $role       Role model
     */
    public function __construct(PermissionObject $permission, Role $role)
    {
        parent::__construct($role);
        $this->permission = $permission;
        $this->role = $role;
    }

    /**
     * Toggle to add or remove persmission on certain role.
     *
     * @param  \Illuminate\Http\Request $request
     * @return boolean
     */
    public function togglePermission($request)
    {
        if ($this->role->findOrFail($request->role_id)->permissions()->toggle($request->permission_id)) {
            return true;
        }

        return false;
    }

    /**
     * Get assigned permissions on certain role.
     *
     * @param  int $id Role id
     * @return json
     */
    public function getAssignedPermissions($id)
    {
        $checkedPermissions = [];
        $counter = 0;

        $permissions = $this->permission->all();

        $assignedPermissions = $this->role->findOrFail($id)->permissions()->get();

        foreach ($permissions as $permission) {
            if (! empty(json_decode($assignedPermissions, true))) {
                foreach ($assignedPermissions as $assignedPermission) {
                    if ($permission->id == $assignedPermission->id) {
                        $value = true;
                        break;
                    } else {
                        $value = false;
                    }
                }

                array_push($checkedPermissions, $value);
            } else {
                return $permissions;
            }
        }

        return $permissions->transform(function ($item) use ($checkedPermissions, & $counter) {
            $permission = [];

            $permission['id'] = $item->id;
            $permission['name'] = $item->name;
            $permission['display_name'] = $item->display_name;
            $permission['description'] = $item->description;
            $permission['assigned'] = $checkedPermissions[$counter];

            json_encode($permission);

            $counter++;

            return $permission;
        });
    }

    /**
     * Create pagination with filters for the resources including soft deleted resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer                   $length
     * @param  boolean                   $removePage
     * @param  string                    $orderBy
     * @return array json object
     */
    public function paginateWithFiltersAndWithTrashed($request = null, $length = 10, $removePage = false, $orderBy = 'desc')
    {
        return $this->model->filter($request)
            ->withTrashed()
            ->orderBy('created_at', $orderBy)
            ->paginate($length)
            ->withPath(
                $this->model->createPaginationUrl($request, $removePage)
            );
    }
}
