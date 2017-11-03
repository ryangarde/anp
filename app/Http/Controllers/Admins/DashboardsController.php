<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Facades\App\Contracts\EntrustInterface;

class DashboardsController extends Controller
{
    public function index()
    {
        if (EntrustInterface::hasPermission('')) {
            return 'yes';
        }

        return 'no';

        /*return auth('admin')->user()->with([
            'roles' => function ($query) {
                $query->with('permissions');
            }
        ])->first();

        return view('admins.dashboards');*/
    }
}
