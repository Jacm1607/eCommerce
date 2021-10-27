<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class StatusOrder extends Component
{
    public $order, $status;

    public function mount(){
        $this->status = $this->order->status;
    }

    public function update(){
        if (auth()->user()->can('order.update-state')) {
            $this->order->status = $this->status;
            $this->order->save();
        } else {
            abort(403);
        }
    }

    public function render()
    {
        $items = json_decode($this->order->content);
        return view('livewire.admin.status-order', compact('items'));
    }
}
