<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;

class DashboardsController extends Controller
{
    public function index()
    {
        return view('users.dashboards.index');
    }
}
