<?php

namespace App\Exports;

use App\Order;
use App\OrderProduct;
use App\ProductRetailSize;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;


class OrdersExport implements FromView, ShouldAutoSize
{

    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function view(): View
    {
        $orderProducts = OrderProduct::orderBy('order_id')->get();
        $count = 0;
        $lastIndex = $orderProducts->reverse()->keys()->first();
        foreach ($orderProducts as $index => $orderProduct){
            // only get reports from orders that are confirmed
            if($orderProduct->order->status < 3) {
                unset($orderProducts[$index]);
            }
            // filter date from
            if (isset($this->request->date_from)) {
                if($orderProduct->order->created_at < $this->request->date_from){
                    unset($orderProducts[$index]);
                }
            }
            // filter date to
            if (isset($this->request->date_to)) {
                if($orderProduct->order->created_at > $this->request->date_to){
                    unset($orderProducts[$index]);
                }
            }
            // filter producer
            if ($this->request->producer_id != 'all') {
                if ($orderProduct->product->producer->id != $this->request->producer_id){
                    unset($orderProducts[$index]);
                }
            }
            // filter product
            if ($this->request->product_id != 'all') {
                if ($orderProduct->product->id != $this->request->product_id){
                    unset($orderProducts[$index]);
                }
            }
            // filter customer
            if ($this->request->user_id != 'all') {
                if ($orderProduct->order->user->id != $this->request->user_id){
                    unset($orderProducts[$index]);
                }
            }
            // filter admin
            if ($this->request->admin_id != 'all') {
                if ($orderProduct->order->admin->id != $this->request->admin_id) {
                    unset($orderProducts[$index]);
                }
            }


            $price[$index] = ProductRetailSize::where('product_id',$orderProduct->product->id)->where('retail_size_id',$orderProduct->retail_size_id)->get()->first();

            $shipment[$index] = $orderProduct->shipment;
            if($orderProduct->in_stock == 0) {
                $amount[$index] = 0;
                $discount[$index] = 0;
            } else {
                $amount[$index] = $price[$index]->price * $orderProduct->quantity + $shipment[$index];
                $discount[$index] = $orderProduct->order->discount/100;
            }
            $amount_returned[$index] = $price[$index]->price * $orderProduct->quantity_returned;
            $subtotal[$index] = (1 - $discount[$index]) * $amount[$index];
        }

        return view('admins.reports.export',compact('orderProducts','order','price','amount','amount_returned','subtotal','lastIndex','discount'));
    }
}
