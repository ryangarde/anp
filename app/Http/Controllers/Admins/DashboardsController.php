<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Facades\App\Contracts\EntrustInterface;

class DashboardsController extends Controller
{
    public function index()
    {
        if (EntrustInterface::hasAbility('encoder', 'products')) {
            return 'yes';
        }

        return 'no';

        //return view('admins.dashboards');
    }
}
