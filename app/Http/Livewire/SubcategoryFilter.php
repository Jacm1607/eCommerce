<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class SubcategoryFilter extends Component
{
    use WithPagination;
    public $subcategory, $orderBy;

    public $view = "grid";

    public function clear_filter()
    {
        $this->reset(['orderBy']);
    }
    public function render()
    {
        $productsQuery = Product::query()->whereHas('subcategory', function (Builder $query) {
            $query->where('id', $this->subcategory->id);
        });
        if ($this->orderBy) {
            $productsQuery = $productsQuery->orderBy('name',$this->orderBy);
        }
        $productsQuery=$productsQuery->where('status',1);
        $products = $productsQuery->paginate(12);
        return view('livewire.subcategory-filter',compact('products'));
    }
}
