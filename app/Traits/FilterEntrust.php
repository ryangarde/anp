<?php

/*
 * This file is part of filter entrust.
 *
 * (c) Gether Kestrel B. Medel <dus.medel22@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/*
|--------------------------------------------------------------------------
| Filter Entrust (Filter by Roles and Permissions)
|--------------------------------------------------------------------------
|
| Here is where all filtering entrust logic happens.
| Current version supports simple ACL filtering, meaning you can't make
| the same role with different permissions on it.
|
*/

namespace App\Traits;

trait FilterEntrust
{
    /**
     * Check roles filtering
     *
     * @var boolean
     */
    private $checkRoles = false;

    /**
     * Check permissions filtering
     *
     * @var boolean
     */
    private $checkPermissions = false;

    /**
     * Filtering entrust.
     *
     * @param  \Illuminate\Database\Query $query
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    public function filterEntrust(& $query, & $request)
    {
        // Check if filtering roles and permissions is needed
        self::checkRolesAndPermissions($request);

        // Role is not null and permission is null // Filter Roles only
        if ($this->checkRoles && ! $this->checkPermissions) {
            self::filterByRoles($query, $request);
        }

        // Roles is null and permission is not null // Filter Permissions only
        if ($this->checkPermissions && ! $this->checkRoles) {
            self::filterByPermissions($query, $request);
        }

        // Roles is not null and permission is not null // Filter Roles and Permission simultaneously
        if ($this->checkRoles && $this->checkPermissions) {
            self::filterByRolesAndPermissions($query, $request);
        }
    }

    /**
     * Check roles and permissions filtering is needed.
     *
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    public function checkRolesAndPermissions(& $request)
    {
        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'filterByRoles') !== false && is_array($value)) {
                foreach ($value as $arrayValue) {
                    if ($arrayValue !== null) {
                        $this->checkRoles = true;
                        break;
                    }
                }
            }

            if (strpos($key, 'filterByPermissions') !== false && is_array($value)) {
                foreach ($value as $arrayValue) {
                    if ($arrayValue !== null) {
                        $this->checkPermissions = true;
                        break;
                    }
                }
            }
        }
    }

    /**
     * Filter roles.
     *
     * @param  \Illuminate\Database\Query $query
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    public function filterByRoles(& $query, & $request)
    {
        $query->whereHas('roles', function ($query) use ($request) {
            $query->where(function ($query) use ($request) {
                foreach ($request->all() as $key => $value) {
                    if (strpos($key, 'filterByRoles') !== false && is_array($value)) {
                        foreach ($value as $arrayValue) {
                            if ($arrayValue !== null) {
                                $query->orWhere('name', 'LIKE', '%' . $arrayValue . '%');
                            }
                        }
                    }
                }
            });
        });
    }

    /**
     * Filter permissions.
     *
     * @param  \Illuminate\Database\Query $query
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    public function filterByPermissions(& $query, & $request)
    {
        $query->whereHas('roles', function ($query) use ($request) {
            $query->whereHas('permissions', function ($query) use ($request) {
                $query->where(function ($query) use ($request) {
                    foreach ($request->all() as $key => $value) {
                        if (strpos($key, 'filterByPermissions') !== false && is_array($value)) {
                            foreach ($value as $arrayValue) {
                                if ($arrayValue !== null) {
                                    $query->orWhere('name', 'LIKE', '%' . $arrayValue . '%');
                                }
                            }
                        }
                    }
                });
            });
        });
    }

    /**
     * Filter roles and permissions simultaneously.
     *
     * @param  \Illuminate\Database\Query $query
     * @param  \Illuminate\Http\Request $request
     * @return void
     */
    public function filterByRolesAndPermissions(& $query, & $request)
    {
        $query->whereHas('roles', function ($query) use ($request) {
            $query->where(function ($query) use ($request) {
                foreach ($request->all() as $key => $value) {
                    if (strpos($key, 'filterByRoles') !== false && is_array($value)) {
                        foreach ($value as $arrayValue) {
                            if ($arrayValue !== null) {
                                $query->orWhere('name', 'LIKE', '%' . $arrayValue . '%');
                            }
                        }
                    }
                }
            });
        });

        $query->whereHas('roles', function ($query) use ($request) {
            $query->whereHas('permissions', function ($query) use ($request) {
                $query->where(function ($query) use ($request) {
                    foreach ($request->all() as $key => $value) {
                        if (strpos($key, 'filterByPermissions') !== false && is_array($value)) {
                            foreach ($value as $arrayValue) {
                                if ($arrayValue !== null) {
                                    $query->orWhere('name', 'LIKE', '%' . $arrayValue . '%');
                                }
                            }
                        }
                    }
                });
            });
        });
    }
}
