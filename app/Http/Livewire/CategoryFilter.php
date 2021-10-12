<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryFilter extends Component
{
    use WithPagination;

    public $category, $subcategoria, $marca;

    public $view = "grid";

    protected $listeners = ['loadBrands'];

    public function clear_filter()
    {
        $this->reset(['subcategoria', 'marca']);
    }

    public function render()
    {
        $productsQuery = Product::query()->whereHas('subcategory.category', function (Builder $query) {
            $query->where('id', $this->category->id);
        });

        if ($this->subcategoria) {
            $productsQuery = $productsQuery->whereHas('subcategory', function (Builder $query) {
                $query->where('name', $this->subcategoria);
            });
        }

        // if ($this->marca) {
        //     $productsQuery = $productsQuery->whereHas('brand', function (Builder $query) {
        //         $query->where('name', $this->marca);
        //     });
        // }
        $productsQuery = $productsQuery->where('status', '!=', '0');
        $products = $productsQuery->paginate(12);
        return view('livewire.category-filter', compact('products'));
    }
}
