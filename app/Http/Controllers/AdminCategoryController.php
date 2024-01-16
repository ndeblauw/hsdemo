<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:5', 'max:20'],
        ]);

        $category = Category::firstOrCreate([
            'name' => $request->name,
        ]);

        session()->flash('success_notification', "Category '{$category->name}' created.");

        return redirect()->route('admin.categories.create');
    }

    public function show(Category $category)
    {
        return view('admin.categories.show', [
            'category' => $category,
        ]);
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', [
            'category' => $category,
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => ['required', 'min:5', 'max:20'],
        ]);

        $category->update([
            'name' => $request->name,
        ]);

        session()->flash('success_notification', "Category '{$category->name}' updated.");

        return redirect()->route('admin.categories.show', $category->id);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        session()->flash('success_notification', "Category '{$category->name}' deleted.");

        return redirect()->route('admin.categories.index');
    }
}
