<?php

namespace App\Http\Controllers\Users;

use App\Contracts\OrderInterface;
use App\Contracts\UserInterface;
use App\Contracts\OrderProductInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\Order;
use Illuminate\Http\Request;
use App\User;
use App\Mail\OrderSuccessful;

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
     * OrderProduct object.
     *
     * @var App\Contracts\OrderInterface
     */
    protected $orderProduct;
    /**
     * Create new instance of product object.
     *
     * @param OrderInterface $order Order interface
     * @param UserInterface  $user  User interface
     */
    public function __construct(OrderInterface $order, UserInterface $user, OrderProductInterface $orderProduct){
        $this->order = $order;
        $this->user  = $user;
        $this->orderProduct = $orderProduct;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = $this->user->getUserOrders();
        return view('users.dashboards.orders', compact('orders'));
    }

    /**
     * Show an order with list of items.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $orderProduct = $this->orderProduct->showOrder($id);
        return view ('users.dashboards.show-orders',compact('orderProduct','id'));
    }

    /**
     * Process order.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function order(Request $request)
    {
        if (! $this->user->isShoppingCartEmpty()) {
            if ($this->order->order()) {
                /*$orderMail = new orderMail([
                    'name'         => auth()->user()->name,
                    'email'        => auth()->user()->email,
                    'phone_number' => auth()->user()->phone_number,
                    'message'      => auth()->user()->name . ' has ordered'
                ]);*/
                $products = $this->orderProduct->getProductList();
                //\Mail::to(auth()->user())->send(new OrderSuccessful($products));

                if ($this->user->clearShoppingCart()) {
                    return redirect()->route('orders.index')->with('message', 'Order successful please wait for confirmation on your email');
                }
            }

            return redirect()->route('orders.index')->with('message', 'Whoops something went wrong please try again');
        }
    }

    /**
     * Cancel order.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function cancelOrder($id)
    {
        if ($this->order->cancelOrder($id)) {
            $this->order->changeStatus($id);
            /*$cancelOrderMail = new cancelOrderMail([
                'name'         => auth()->user()->name,
                'email'        => auth()->user()->email,
                'phone_number' => auth()->user()->phone_number,
                'message'      => 'Order number ' . request()->id . ' has been cancelled'
            ]);
            Mail::send($cancelOrderMail);*/
            return redirect()->route('orders.index')->with('message', 'Order successfully cancelled');
        }

        return redirect()->route('orders.check-orders')->with('message', 'Whoops something went wrong please try again');
    }
}
