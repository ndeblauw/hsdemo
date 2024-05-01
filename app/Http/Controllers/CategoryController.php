<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();

        return view('public.categories.index', ['categories' => $categories]);
    }

    public function show(string $id)
    {
        $category = Category::find($id);

        return view('public.categories.show', ['category' => $category]);
    }
}
