<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contracts\UserInterface;
use App\Contracts\OrderInterface;
use App\Order;
class UsersController extends Controller
{
    /**
     * User object.
     *
     * @var App\Contracts\UserInterface
     */
    protected $user;

    /**
     * Order object.
     *
     * @var App\Contracts\OrderInterface
     */
    protected $order;

    /**
     * Create new instance of user controller.
     *
     * @param CategoryInterface $user User interface
     */
    public function __construct(UserInterface $user, OrderInterface $order)
    {
        $this->user = $user;
        $this->order = $order;
    }

    public function index()
    {
        $users = $this->user->getUserThatHasOrders();

        return view('admins.users.index',compact('users'));
    }

    public function show($id)
    {
        $user = $this->user->findOrFail($id);

        return view('admins.users.show', compact('user'));
    }

    public function showOrders($id)
    {
        $user = $this->user->findOrFail($id);
        $orders = $user->orders;

        return view('admins.users.showOrders', compact('orders','user'));
    }
}
