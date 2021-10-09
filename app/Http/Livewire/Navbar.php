<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class Navbar extends Component
{
    public function render()
    {
        $categories = Category::where('category_status', '1')->get();
        return view('livewire.navbar', compact('categories'));
    }
}
