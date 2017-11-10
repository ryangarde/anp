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

    /**
     * Create pagination with filters for the resources including soft deleted resources.
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
    ) {
        return $this->model->filter($request)
            ->withTrashed()
            ->orderBy('created_at', $orderBy)
            ->paginate($length)
            ->withPath(
                $this->model->createPaginationUrl($request, $removePage)
            );
    }
}
