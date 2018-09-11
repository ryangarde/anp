<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\OrderInterface;
use App\Contracts\ProducerInterface;
use App\Contracts\ProductInterface;
use App\Contracts\UserInterface;
use App\Contracts\AdminInterface;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OrdersExport;

class ReportsController extends Controller
{
    protected $order;
    protected $producer;
    protected $product;

    public function __construct(OrderInterface $order, ProducerInterface $producer, ProductInterface $product, UserInterface $user, AdminInterface $admin)
    {
        $this->order = $order;
        $this->producer = $producer;
        $this->product = $product;
        $this->user = $user;
        $this->admin = $admin;
    }

    public function create()
    {
        $producers = $this->producer->all();
        $products = $this->product->all();
        $users = $this->user->getUserThatHasOrders();
        $admins = $this->admin->all();

        return view('admins.reports.create',compact('producers','products','users','admins'));
    }

    public function export(Request $request)
    {
        return Excel::download(new OrdersExport($request), 'orders.xlsx');
    }
}
