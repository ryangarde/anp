<?php

namespace App\Http\Controllers\Admins;

use App\Contracts\PermissionInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    /**
     * Permission object.
     *
     * @var App\Contracts\PermissionInterface
     */
    protected $permission;

    /**
     * Create new instance of permission controller.
     *
     * @param Permissionbject $permission Permission interface
     */
    public function __construct(PermissionInterface $permission)
    {
        $this->permission = $permission;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieve all news filter if needed.
        $permissions = $this->permission->paginateWithFiltersAndWithTrashed(request());

        // Get search url for filtering.
        $searchUrl = $this->permission->getSearchUrl(request());

        // Retrieve Archives
       // $archives = $this->permission->archives();

        // Get current path for archives
       // $path = request()->path();

        return view('admins.permissions.index', compact('permissions', 'searchUrl', 'archives', 'path'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Check if user is logged in.
        //$this->permission->authorize('create');

        // If user is logged in show create permission form.
        return view('admins.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Check if user is logged in.
        // $this->permission->authorize('create');

        // Validate all fields.
        $this->validate($request, [
            'name' => 'required|unique:permissions|min:2|max:255',
            'display_name' => 'required|unique:permissions|min:2|max:255',
            'description' => 'required|min:2',
        ]);

        // If validation passed create the permission.
        $this->permission->store($request);

        // After creating the permission redirect to roles page with a success message.
        return redirect()->route('permissions.index')->with('message', 'Permission successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admins.permissions.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Check if user is authorized to update.
        $this->permission->authorize('update');

        // If authorize find resource.
        $permission = $this->permission->findOrFail($id);

        // If authorize pass the permission object to the view.
        return view('admins.permissions.edit', compact('permission'));
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
        // Check if user is authorized to update.
        $this->permission->authorize('update');

        // If authorize find the permission resource using id.
        $permission = $this->permission->findOrFail($id);

        // If authorize fill the fields and save.
        $permission->fill($request->all())->save();

        // After updating the permission redirect to edit page with a success message.
        return redirect()->route('permissions.edit', $permission->id)->with('message', 'Permission successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Check if user is authorized to delete.
        $this->permission->authorize('delete');

        // If authorize delete the permission.
        $this->permission->findOrFail($id)->delete();

        // After deleting the permission redirect to permission list page with a success message.
        return redirect()->route('permissions.index')->with('message', 'Permission successfully deleted');
    }
}
