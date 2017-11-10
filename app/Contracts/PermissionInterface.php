<?php

namespace App\Contracts;

interface PermissionInterface
{
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
    );
}
