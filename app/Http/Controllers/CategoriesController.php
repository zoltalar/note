<?php

namespace App\Http\Controllers;

use App\Category;

class CategoriesController extends Controller
{
    public function ajax()
    {
        return response()->json(Category::all());
    }
}