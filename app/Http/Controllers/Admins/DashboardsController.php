<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;

class DashboardsController extends Controller
{
    public function index()
    {
        return view('admins.dashboards');
    }
}
