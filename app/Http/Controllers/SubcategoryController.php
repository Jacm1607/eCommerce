<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;

class SubcategoryController extends Controller
{
    public function show(Subcategory $subcategory)
    {
        if ($subcategory->subcategory_status == "1") {
            return view('subcategory.show',compact('subcategory'));
        } else {
            abort(404);
        }
    }
}
