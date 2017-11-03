<?php

namespace App\Http\Controllers\Admins;

use App\Contracts\AdminInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminsController extends Controller
{
    /**
     * Admin object.
     *
     * @var App\Contracts\AdminInterface
     */
    protected $admin;

    /**
     * Create new instance of admin controller.
     *
     * @param AdminInterface $admin Admin interface
     */
    public function __construct(AdminInterface $admin)
    {
        $this->admin = $admin;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = $this->admin->paginateWithFilters(request());
        $searchUrl = $this->admin->getSearchUrl(request());
        $archives = $this->admin->archives();
        $path = request()->path();

        return view('admins.admins.index', compact('admins', 'searchUrl', 'archives', 'path'));
    }

    /**
     * Show admin profile
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $admin = auth()->guard('admin')->user();

        return view('admins.admins.profile', compact('admin'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin = $this->admin->findOrFail($id);

        return view('admins.admins.show', compact('admin'));
    }

    /**
     * Update admin profile
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:10|max:150',
        ]);

        Auth::guard('admin')->user()->fill($request->all())->save();

        return back()->with('message', 'Profile successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // If authorize delete the news.
        $this->admin->findOrFail($id)->delete();

        // After creating the post redirect to news page with a success message.
        return redirect()->route('admins.index')->with('message', 'Admin successfully deleted');
    }

    /**
     * Show assign role form.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function showAssignRoleForm($id)
    {
        $admin = $this->admin->findOrFail($id);

        $roles = $this->admin->getAssignedRoles($id);

        return view('admins.admins.assign-roles', compact('admin', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toggleRole(Request $request)
    {
        if ($this->admin->toggleRole($request)) {
            return redirect()->route('admins.show-assign-roles-form', $request->admin_id)->with('message', 'Role successfully assigned');
        }

        return redirect()->route('admins.show-assign-roles-form', $request->admin_id)->with('message', 'Something went wrong');
    }
}
