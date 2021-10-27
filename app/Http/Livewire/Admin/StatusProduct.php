<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class StatusProduct extends Component
{
    public $product, $status;

    public function mount(){
        $this->status = $this->product->status;
    }

    public function save(){
        if (auth()->user()->can('product.update-state')) {
            $this->product->status = $this->status;
            $this->product->save();
            $this->emit('saved');
        } else {
            abort(403);
        }
    }
    public function render()
    {
        return view('livewire.admin.status-product');
    }
}
