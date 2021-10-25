<?php

namespace App\Http\Livewire;

use App\Models\DeliveryMethod;
use App\Models\Municipality;
use App\Models\Order;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class FormOrder02 extends Component
{
    public $envio_type_step_1 = 0;
    public $branch_office, $ring, $address, $edifice_departament, $zone, $detail_address, $note , $terminal, $storehouse;
    public $pay_methods = [] , $delivery_methods = [];
    public $method_delivery_id = "" , $method_pay_id="";

    protected $rules = [
        'method_delivery_id' => 'required',
        'method_pay_id' => 'required'
    ];

    protected $messages = [
        'method_delivery_id.required' => 'Selecciona un método de entrega para continuar con la compra.',
        'method_pay_id.required' => 'Selecciona un método de pago para continuar con la compra.',
        'branch_office.required' => 'Selecciona una sucursal para continuar con la compra.',
        'ring.required' => 'Selecciona el anillo que corresponda a su dirección de entrega para continuar con la compra.',
        'address.required' => 'Ingrese una dirección de envio.',
        'zone.required' => 'Selecciona una zona para continuar con la compra.',
        'detail_address.required' => 'Detalle su ubicación para un envío más rápido.',
    ];

    public function updatedMethodDeliveryId($value)
    {
        $this->pay_methods = DeliveryMethod::find($value)->pay_methods()->get();
    }
    public function updatedEnvioTypeStep1($value)
    {
        $this->reset(['method_pay_id']);
        if ($value == 1) {
            $this->resetValidation([
                'branch_office'
            ]);
            $this->reset([
                'branch_office'
            ]);
        }
        if ($value == 2) {
            $this->reset([
                'ring',
                'edifice_departament',
                'address',
                'zone',
                'detail_address'
            ]);
            $this->resetValidation([
                'ring',
                'address',
                'zone',
                'detail_address'
            ]);
        }
    }

    public function registration()
    {
        $rules = $this->rules;
        if ( $this->method_delivery_id == 1) {
            $rules['branch_office'] = 'required';
        }
        if ($this->method_delivery_id == 2) {
            $rules['ring'] = 'required';
            $rules['address'] = 'required';
            $rules['zone'] = 'required';
            $rules['detail_address'] = 'required';
        }
        if ($this->method_delivery_id == 3) {
            $rules['terminal'] = 'required';
        }
        $this->validate($rules);

        $data_order = Session::get('data_order');

        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->name = $data_order['name'];
        $order->lastname = $data_order['lastname'];
        $order->ci= $data_order['ci'];
        $order->email= $data_order['email'];
        $order->cellphone= $data_order['cellphone'];
        $order->departament_id = $data_order['departament_id'];
        $order->province_id = $data_order['province_id'];
        $order->municipality_id = $data_order['municipality_id'];
        $order->razon_social = $data_order['razon_social'];
        $order->nit = $data_order['nit'];
        $order->status = 1;
        $order->delivery_method_id= $this->method_delivery_id;
        $order->pay_method_id= $this->method_pay_id;
        $order->shipping_cost = $data_order['cost_delivery'];
        $order->total = number_format((float)Cart::subtotal() + $data_order['cost_delivery'], 2, '.', '');
        $order->content = Cart::content();

        //RETIRO EN TIENDA
        if ($this->method_delivery_id == 1) {
            $order_address = $this->branch_office;
        }
        //ENVIO A DOMICILIO
        if ($this->method_delivery_id == 2) {
            $order_address = "Del $this->ring - Zona $this->zone. | Dirección: ".ucfirst($this->address)." ".ucfirst($this->edifice_departament).". ".ucfirst($this->detail_address).".";
        }
        //ENVIO A TERMINAL
        if ($this->method_delivery_id == 3) {
            $order_address = "Envio por la transportadora ".strtoupper($this->terminal).".";
        }
        //RETIRO EN ALMACEN
        if ($this->method_delivery_id == 4) {
            $order_address = "Retiro en almacén";
        }
        $order->address = $order_address;
        $order->save();
        Session::put('pay',true);
        return redirect()->route('orders.resume', $order);
    }

    public function mount()
    {
        if (Cart::count()) {
            $data_order = Session::get('data_order');
            $this->delivery_methods = Municipality::find($data_order['municipality_id'])->delivery_methods()->get();
        }
    }

    public function render()
    {
        return view('livewire.form-order02');
    }
}
