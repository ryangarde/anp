<?php

namespace App\Contracts;

interface RoleInterface
{
    /**
     * Toggle to add or remove persmission on certain role.
     *
     * @param  \Illuminate\Http\Request $request
     * @return boolean
     */
    public function togglePermission($request);

    /**
     * Get assigned permissions on certain role.
     *
     * @param  int $id Role id
     * @return json
     */
    public function getAssignedPermissions($id);

    /**
     * Create pagination with filters for the resources.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer                   $length
     * @param  boolean                   $removePage
     * @param  string                    $orderBy
     * @return array json object
     */
    public function paginateWithFiltersAndWithTrashed(
        $request = null,
        $length = 10,
        $removePage = false,
        $orderBy = 'desc'
    );
}
