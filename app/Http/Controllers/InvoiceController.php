<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class InvoiceController extends Controller
{
    public function generateInvoice($id) {
        if(session()->has('admin-email')){
            $orderItems = Order::where('order_id', $id)->get();
            $pdf = PDF::loadView('admin.invoice', compact('orderItems'));
            return $pdf->stream('invoice GRMT000'.$id.'.pdf');
        }
        else{
            return redirect('/admin-login');
        }
    }
}
