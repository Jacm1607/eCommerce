<?php

namespace App\Http\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class AddCartItem extends Component
{
    public $product, $quantity;
    public $qty = 1;
    public $options = [];

    public function mount()
    {
        $this->quantity = qty_available($this->product->id);
        if(count($this->product->images) > 0) {
            $image = Storage::url($this->product->images->first()->url);
        } else {
            $image = asset('img/no_imagen.png');
        }
        $this->options['image'] = $image;
    }

    public function decrement(){
        $this->qty = $this->qty - 1;
    }

    public function increment(){
        $this->qty = $this->qty + 1;
    }

    public function addItem()
    {
        if ($this->product->offer_price > 0 && !is_null($this->product->offer_price)) {
            $price = $this->product->offer_price;
        }
        else {
            $price = $this->product->price;
        }
            Cart::add([
            'id' => $this->product->id,
            'name' => $this->product->name,
            'qty' => $this->qty,
            'price' => $price,
            'weight' => 500,
            'options' => $this->options
        ]);

        $this->reset('qty');
        $this->quantity = qty_available($this->product->id);
        $this->emitTo('dropdown-cart', 'render');
        $this->emitTo('cart-mobile', 'render');
        $this->dispatchBrowserEvent('item-add');
    }
    public function render()
    {
        return view('livewire.add-cart-item');
    }
}
