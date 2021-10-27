<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index(){
        if (auth()->user()->can('category.index')) {
            return view('admin.categories.index');
        } else {
            abort(403);
        }
    }
}
