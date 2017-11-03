<?php

namespace App\Repositories;

use App\Admin;
use App\Contracts\AdminInterface;
use App\Contracts\RoleInterface;

class AdminRepository extends Repository implements AdminInterface
{
    /**
     * Role Object.
     *
     * @var App\Contracts\AnnouncementInterface
     */
    protected $role;

    /**
     * Create new instance of admin repository.
     *
     * @param Admin $admin Admin repository.
     */
    public function __construct(Admin $admin, RoleInterface $role)
    {
        parent::__construct($admin);
        $this->admin = $admin;
        $this->role = $role;
    }

    /**
     * Toggle to add or remove role on certain admin.
     *
     * @param  \Illuminate\Http\Request $request
     * @return boolean
     */
    public function toggleRole($request)
    {
        if ($this->admin->findOrFail($request->admin_id)->roles()->toggle($request->role_id)) {
            return true;
        }

        return false;
    }

    /**
     * Get assigned roles on certain admin.
     *
     * @param  int $id Permission id
     * @return json
     */
    public function getAssignedRoles($id)
    {
        $checkedRoles = [];
        $counter = 0;

        $roles = $this->role->all();

        $assignedRoles = $this->admin->findOrFail($id)->roles()->get();

        foreach ($roles as $role) {
            if (! empty(json_decode($assignedRoles, true))) {
                foreach ($assignedRoles as $assignedRole) {
                    if ($role->id == $assignedRole->id) {
                        $value = true;
                        break;
                    } else {
                        $value = false;
                    }
                }

                array_push($checkedRoles, $value);
            } else {
                return $roles;
            }
        }

        return $roles->transform(function ($item) use ($checkedRoles, & $counter) {
            $role = [];

            $role['id']           = $item->id;
            $role['name']         = $item->name;
            $role['display_name'] = $item->display_name;
            $role['description']  = $item->description;
            $role['assigned']     = $checkedRoles[$counter];

            json_encode($role);

            $counter++;

            return (object) $role;
        });
    }
}
