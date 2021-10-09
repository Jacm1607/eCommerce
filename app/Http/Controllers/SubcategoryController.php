<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;

class SubcategoryController extends Controller
{
    public function show(Subcategory $subcategory)
    {
        return view('subcategory.show',compact('subcategory'));
    }
}
