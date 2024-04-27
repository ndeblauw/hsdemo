<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();

        return view('categories.index', ['categories' => $categories]);
    }

    public function show(string $id)
    {
        $category = Category::find($id);

        return view('categories.show', ['category' => $category]);
    }
}
