<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function index()
    {
        return view('users.index');
    }
}
