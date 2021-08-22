<?php

namespace App\Http\Controllers;

use App\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    private function generateInvoiceNumber()
    {
        $orders = Order::all();
        if ($orders->isEmpty()) {
            $invoice = 1;
            return $invoice;
        }

        foreach ($orders as $order) {
            $latest = Order::latest()->first();

            if ($latest) {
                $num = $latest->order_id + 1;
                $invoice = $num;
                return $invoice;
            }
        }
    }

    public function orderPlace(Request $request)
    {
        $inv = $this->generateInvoiceNumber();
        $date = Carbon::now();
        $total = \Gloudemans\Shoppingcart\Facades\Cart::total();

        $cartItems = Cart::content();

        foreach ($cartItems as $cartItem) {
            $order = new Order();
            $order->order_id = $inv;
            $order->date = $date;
            $order->first_name = $request->first_name;
            $order->last_name = $request->last_name;
            $order->street_address_one = $request->street_address_one;
            $order->street_address_two = $request->street_address_two;
            $order->town = $request->town;
            $order->zip = $request->zip;
            $order->phone = $request->phone;
            $order->email = $request->email;
            $order->product_name = $cartItem->name;
            $order->product_price = $cartItem->price;
            $order->product_image = $cartItem->options->image;
            $order->product_quantity = $cartItem->qty;
            $order->cart_sub = $cartItem->subtotal;
            $order->cart_total = $total;
            $order->payment = $request->payment;
            $order->status = 'Processing';
            $order->client_id = session()->get('client-id');
            $order->save();
        }

        Cart::destroy();
        return redirect('/shopall')->with('status', 'Order GRMT000'.$inv.' Successfully Placed');


    }

    public function statusUpdate($id){
        if(session()->has('admin-email')){
            DB::table('orders')
                ->where('order_id', $id)
                ->update(['status' => 'Complete']);
            return redirect('/orders');
        }
        else{
            return view('admin.admin-login');
        }
    }
}
