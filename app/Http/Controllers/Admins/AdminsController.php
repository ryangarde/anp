<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminsController extends Controller
{
    public function profile()
    {
        $admin = auth()->guard('admin')->user();

        return view('admins.profile', compact('admin'));
    }

    public function updateProfile(Request $request)
    {
        return $request->all();
        // Validate all fields.
        $this->validate($request, [
            'name' => 'required|min:10|max:150',
        ]);
        //Auth::user()->fill($request->all())->save();
    }
}
