<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request) {
        if (auth()->user()->can('order.index')) {
            if (isset($request->status)) {
                $orders = Order::where('status', "$request->status")->paginate(10)->appends(request()->query());
            } else {
                $orders = Order::paginate(10)->appends(request()->query());
            }

            $pendiente = Order::where('status', '1')->count();
            $recibido = Order::where('status', '2')->count();
            $enviado = Order::where('status', '3')->count();
            $entregado = Order::where('status', '4')->count();
            $anulado = Order::where('status', '0')->count();

            return view('admin.orders.index', compact('orders', 'pendiente', 'recibido', 'enviado', 'entregado', 'anulado'));
        } else {
            abort(403);
        }
    }

    public function show(Order $order){
        if (auth()->user()->can('order.show')) {
            return view('admin.orders.show', compact('order'));
        } else {
            abort(403);
        }
    }
}
