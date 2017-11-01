<?php

namespace App\Http\Controllers\Admins;

use App\Contracts\PermissionInterface;
use App\Contracts\RoleInterface;
use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    /**
     * Permission object.
     *
     * @var App\Contracts\PermissionInterface
     */
    protected $permissions;

    /**
     * Role object.
     *
     * @var App\Contracts\RoleInterface
     */
    protected $role;

    /**
     * Create new instance of role controller.
     *
     * @param PermissionObject $permission Permission interface.
     * @param RoleObject       $role       Role interface.
     */
    public function __construct(PermissionInterface $permission, RoleInterface $role)
    {
        $this->permission = $permission;
        $this->role = $role;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieve all news filter if needed.
        $roles = $this->role->paginateWithFiltersAndWithTrashed(request());

        // Get search url for filtering.
        $searchUrl = $this->role->getSearchUrl(request());

        // Retrieve Archives
        $archives = $this->role->archives();

        // Get current path for archives
        $path = request()->path();

        return view('admins.roles.index', compact('roles', 'searchUrl', 'archives', 'path'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$this->role->authorize('create');

        return view('admins.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$this->role->authorize('create');

        $this->validate($request, [
            'name' => 'required|unique:roles|min:2|max:255',
            'display_name' => 'required|unique:roles|min:2|max:255',
            'description' => 'required|min:2|max:500',
        ]);

        $this->role->store($request);

        return redirect()->route('roles.index')->with('message', 'Role successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = $this->role->findOrFail($id);

        $permissions = $this->role->findOrFail($id)->permissions()->get();

        return view('admins.roles.show', compact('role', 'permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$this->role->authorize('update');

        $role = $this->role->findOrFail($id);

        return view('admins.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //$this->role->authorize('update');

        $role = $this->role->findOrFail($id);

        $role->fill($request->all())->save();
        
        return redirect()->route('roles.edit', $role->id)->with('message', 'Role successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$this->role->authorize('delete');

        $this->role->findOrFail($id)->delete();

        return redirect()->route('roles.index')->with('message', 'Role successfully deleted');
    }

    /**
     * Show assigned permission form.
     *
     * @param  int $id Role id
     * @return \Illuminate\Http\Response
     */
    public function showAssignPermissionForm($id)
    {
        $role = $this->role->findOrFail($id);

        $permissions = $this->role->getAssignedPermissions($id);

        return view('admins.roles.assign-permissions', compact('role', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function togglePermission(Request $request)
    {
        if ($this->role->togglePermission($request)) {
            return redirect()
                ->route('roles.show-assign-permissions-form', $request->role_id)
                ->with('message', 'Permission successfully assigned');
        }

        return redirect()
            ->route('roles.show-assign-permissions-form', $request->role_id)
            ->with('message', 'Something went wrong');
    }
}
