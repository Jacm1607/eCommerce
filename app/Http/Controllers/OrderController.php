<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function payment(Order $order)
    {
        $this->authorize('author',$order);
        $this->authorize('payment',$order);
        Cart::destroy();
        $items = json_decode($order->content);
        Session::put('pay',true);
        return view('order.resume',compact('order','items'));
    }
}
