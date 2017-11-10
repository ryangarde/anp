<?php

namespace App\Contracts;

interface AdminInterface
{
    /**
     * Toggle to add or remove role on certain admin.
     *
     * @param  \Illuminate\Http\Request $request
     * @return boolean
     */
    public function toggleRole($request);

    /**
     * Get assigned roles on certain admin.
     *
     * @param  int $id Permission id
     * @return json
     */
    public function getAssignedRoles($id);
}
