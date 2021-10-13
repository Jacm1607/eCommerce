<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Notifications\Invoice;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use PDF;

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

    public function success(Request $request)
    {
        if (Session::has('payment')) {
            $user = User::find(auth()->user()->id);
            Session::forget('payment');
            $order = Order::findOrFail($request->result);
            $order->status = Order::RECIBIDO;
            $order->api_order_id = $request->order_id;
            $order->update();
            $user->notify(new Invoice($order));
            return view('order.success');
        } else {
            abort(403);
        }
    }

    public function index()
    {
        $orders = Order::where('user_id',auth()->user()->id)->orderBy('id','desc')->paginate(10);
        return view('order.index',compact('orders'));
    }

    public function show(Order $order)
    {
        $this->authorize('author',$order);
        $items = json_decode($order->content);
        return view('order.show',compact('order','items'));
    }
    public function stream_pdf(Order $order)
    {
        $data = [
            'id' => $order->id,
            'name' => $order->name,
            'lastname' => $order->lastname,
            'ci' => $order->ci,
            'cellphone' => $order->cellphone,
            'razon_social' => $order->razon_social,
            'nit' => $order->nit,
            'email' => $order->email,
            'address' => $order->address,
            'envio_type' => $order->delivery_method->name,
            'pago_type' => $order->pay_method->name,
            'items' => json_decode($order->content),
            'total' => $order->total,
            'shipping_cost' => $order->shipping_cost
        ];
        $pdf = PDF::loadView('order.pdf', $data);
        return $pdf->stream();
    }
}
