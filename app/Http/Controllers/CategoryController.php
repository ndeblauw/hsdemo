<?php

namespace App\Http\Controllers;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = \App\Models\Category::all();

        return view('site.categories.index', [
            'categories' => $categories,
        ]);
    }

    public function show(string $id)
    {
        $category = \App\Models\Category::findOrFail($id);

        return view('site.categories.show', [
            'category' => $category,
        ]);
    }
}
