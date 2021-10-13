<?php

namespace App\Http\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class AddCartItem extends Component
{
    public $product, $qty = 1;
    public $options = [];

    public function mount()
    {
        if(count($this->product->images) > 0) {
            $image = Storage::url($this->product->images->first()->url);
        } else {
            $image = asset('img/no_imagen.png');
        }
        $this->options['image'] = $image;
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
        $this->emitTo('dropdown-cart', 'render');
        $this->emitTo('cart-mobile', 'render');
        $this->dispatchBrowserEvent('item-add');
    }
    public function render()
    {
        return view('livewire.add-cart-item');
    }
}
