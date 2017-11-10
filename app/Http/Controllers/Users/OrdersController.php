<?php

namespace App\Http\Controllers\Users;

use App\Contracts\OrderInterface;
use App\Contracts\UserInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Order object.
     *
     * @var App\Contracts\OrderInterface
     */
    protected $order;

    /**
     * User object.
     *
     * @var App\Contracts\UserInterface
     */
    protected $user;

    /**
     * Create new instance of product object.
     *
     * @param OrderInterface $order Order interface
     * @param UserInterface  $user  User interface
     */
    public function __construct(OrderInterface $order, UserInterface $user)
    {
        $this->order = $order;
        $this->user  = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = $this->user->getOrders();

        return view('orders', compact('orders'));
    }

    /**
     * Process order.
     *
     * @return \Illuminate\Http\Response
     */
    public function order()
    {
        if (! $this->user->isShoppingCartEmpty()) {
            $user = $this->user->shoppingCart();

            /*if ($this->order->order($user)) {

                $orderMail = new orderMail([
                    'name'         => auth()->user()->name,
                    'email'        => auth()->user()->email,
                    'phone_number' => auth()->user()->phone_number,
                    'message'      => auth()->user()->name . ' has ordered'
                ]);

                Mail::send($orderMail);

                if ($this->user->clearShoppingCart()) {
                    return redirect()->route('orders.check-orders')->with('message', 'Order successful please wait for confirmation on your email');
                }
            }

            return redirect()->route('orders.check-orders')->with('message', 'Whoops something went wrong please try again');*/
        }
    }

    /**
     * Cancel order.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelOrder()
    {
        if ($this->order->cancelOrder(request())) {
            $cancelOrderMail = new cancelOrderMail([
                'name'         => auth()->user()->name,
                'email'        => auth()->user()->email,
                'phone_number' => auth()->user()->phone_number,
                'message'      => 'Order number ' . request()->id . ' has been cancelled'
            ]);

            Mail::send($cancelOrderMail);

            return redirect()->route('orders.check-orders')->with('message', 'Order successfully cancelled');
        }

        return redirect()->route('orders.check-orders')->with('message', 'Whoops something went wrong please try again');
    }
}
