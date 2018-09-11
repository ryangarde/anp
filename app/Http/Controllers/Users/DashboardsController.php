<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Contracts\UserInterface;
use Illuminate\Http\Request;

class DashboardsController extends Controller
{
    protected $user;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        return view('users.dashboards.index');
    }

    function show($id)
    {
        return view('users.dashboards.user');
    }

    public function edit($id)
    {
        return view('users.dashboards.edit');
    }

    public function upload(Request $request, $id)
    {
        $this->validate($request, [
            'image' => 'required|image'
        ]);
        $user = $this->user->findOrFail($id);
        $user->update(['image' => $request->image]);
       // $user->fill($request->all())->save();
        return back()->with('message','Image uploaded');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|min:2|max:255',
            'phone_number' => 'required|min:7',
            'lot_block' => 'max:255',
            'street' => 'required|max:255',
            'subdivision_barangay' => 'required|max:255',
            'city_municipality' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'zip_code' => 'required|min:4|max:255',
        ]);

        $user = $this->user->findOrFail($id);
        $user->fill($request->all())->save();

        return back()->with('message','Profile Updated');
    }
}
