<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        if ($category->category_status == "1") {
            return view('categories.show',compact('category'));
        } else {
            abort(404);
        }
    }
}
