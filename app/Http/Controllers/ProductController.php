<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        if ($product->status === '0') {
            abort(404);
        } else {
            return view('product.show', compact('product'));
        }
    }
}
