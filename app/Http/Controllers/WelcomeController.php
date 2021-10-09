<?php

namespace App\Http\Controllers;

use App\Models\Category;

class WelcomeController extends Controller
{
    public function __invoke()
    {
        $categories = Category::where('category_status',1)->get();
        return view('welcome', compact('categories'));
    }
}
